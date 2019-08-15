<?php declare(strict_types=1);

namespace SwagMigrationOwnProfileExample\Profile\OwnProfile\Converter;

use Shopware\Core\Defaults;
use Shopware\Core\Framework\Context;
use SwagMigrationAssistant\Migration\Converter\ConvertStruct;
use SwagMigrationAssistant\Migration\DataSelection\DefaultEntities;
use SwagMigrationAssistant\Migration\Mapping\MappingServiceInterface;
use SwagMigrationAssistant\Migration\MigrationContextInterface;
use SwagMigrationAssistant\Profile\Shopware\Converter\ShopwareConverter;
use SwagMigrationOwnProfileExample\Profile\OwnProfile\DataSelection\DataSet\ProductDataSet;
use SwagMigrationOwnProfileExample\Profile\OwnProfile\OwnProfile;

class ProductConverter extends ShopwareConverter
{
    /**
     * @var MappingServiceInterface
     */
    private $mappingService;

    /**
     * @var string
     */
    private $connectionId;

    /**
     * @var Context
     */
    private $context;

    public function __construct(
        MappingServiceInterface $mappingService
    ) {
        $this->mappingService = $mappingService;
    }

    /**
     * Supports only a OwnProfile and the ProductDataSet
     */
    public function supports(MigrationContextInterface $migrationContext): bool
    {
        return $migrationContext->getProfile() instanceof OwnProfile &&
            $migrationContext->getDataSet()::getEntity() === ProductDataSet::getEntity();
    }

    /**
     * Writes the created mapping
     */
    public function writeMapping(Context $context): void
    {
        $this->mappingService->writeMapping($context);
    }

    public function convert(array $data, Context $context, MigrationContextInterface $migrationContext): ConvertStruct
    {
        $this->connectionId = $migrationContext->getConnection()->getId();
        $this->context = $context;

        /**
         * Gets the product uuid out of the mapping table or creates a new one
         */
        $converted['id'] = $this->mappingService->createNewUuid(
            $migrationContext->getConnection()->getId(),
            ProductDataSet::getEntity(),
            $data['id'],
            $context
        );

        $this->convertValue($converted, 'productNumber', $data, 'product_number');
        $this->convertValue($converted, 'name', $data, 'product_name');
        $this->convertValue($converted, 'stock', $data, 'stock', self::TYPE_INTEGER);

        if (isset($data['tax'])) {
            $converted['tax'] = $this->getTax($data);
            $converted['price'] = $this->getPrice($data, $converted['tax']['taxRate']);
        }

        unset(
          $data['id'],
          $data['product_number'],
          $data['product_name'],
          $data['stock'],
          $data['tax'],
          $data['price']
        );

        if (empty($data)) {
            $data = null;
        }

        return new ConvertStruct($converted, $data);
    }

    private function getTax(array $data): array
    {
        $taxRate = (float) $data['tax'];

        /**
         * Gets the tax uuid by the given tax rate
         */
        $taxUuid = $this->mappingService->getTaxUuid($this->connectionId, $taxRate, $this->context);

        /**
         * If no tax rate is found, create a new one
         */
        if (empty($taxUuid)) {
            $taxUuid = $this->mappingService->createNewUuid(
                $this->connectionId,
                DefaultEntities::TAX,
                $data['id'],
                $this->context
            );
        }

        return [
            'id' => $taxUuid,
            'taxRate' => $taxRate,
            'name' => 'Own profile tax rate (' . $taxRate . ')',
        ];
    }

    private function getPrice(array $data, float $taxRate): array
    {
        $gross = (float) $data['price'] * (1 + $taxRate / 100);

        /**
         * Gets the currency uuid by the given iso code
         */
        $currencyUuid = $this->mappingService->getCurrencyUuid(
            $this->connectionId,
            'EUR',
            $this->context
        );

        /**
         * Return, if no currency is found
         */
        if ($currencyUuid === null) {
            return [];
        }

        $price = [];
        if ($currencyUuid !== Defaults::CURRENCY) {
            $price[] = [
                'currencyId' => Defaults::CURRENCY,
                'gross' => $gross,
                'net' => (float) $data['price'],
                'linked' => true,
            ];
        }

        $price[] = [
            'currencyId' => $currencyUuid,
            'gross' => $gross,
            'net' => (float) $data['price'],
            'linked' => true,
        ];

        return $price;
    }
}