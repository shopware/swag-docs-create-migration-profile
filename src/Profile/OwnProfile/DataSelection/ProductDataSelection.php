<?php declare(strict_types=1);

namespace SwagMigrationOwnProfileExample\Profile\OwnProfile\DataSelection;

use SwagMigrationAssistant\Migration\DataSelection\DataSelectionInterface;
use SwagMigrationAssistant\Migration\DataSelection\DataSelectionStruct;
use SwagMigrationAssistant\Migration\MigrationContextInterface;
use SwagMigrationOwnProfileExample\Profile\OwnProfile\DataSelection\DataSet\ProductDataSet;
use SwagMigrationOwnProfileExample\Profile\OwnProfile\OwnProfile;

class ProductDataSelection implements DataSelectionInterface
{
    /**
     * Identifier of this DataSelection
     */
    public const IDENTIFIER = 'products';

    /**
     * Supports only an OwnProfile
     */
    public function supports(MigrationContextInterface $migrationContext): bool
    {
        return $migrationContext->getProfile() instanceof OwnProfile;
    }

    public function getData(): DataSelectionStruct
    {
        return new DataSelectionStruct(
            self::IDENTIFIER,
            $this->getDataSets(),
            $this->getDataSetsRequiredForCount(),
            /*
             * Snippet of the original ProductDataSelection, if you
             * want to have a own title, you have to create a new snippet
             */
            'swag-migration.index.selectDataCard.dataSelection.products',
            100
        );
    }

    /**
     * Return all DataSets, which should be migrated with this DataSelection
     */
    public function getDataSets(): array
    {
        return [
            new ProductDataSet()
        ];
    }

    public function getDataSetsRequiredForCount(): array
    {
        return $this->getDataSets();
    }
}
