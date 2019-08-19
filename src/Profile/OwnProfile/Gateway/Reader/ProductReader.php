<?php declare(strict_types=1);

namespace SwagMigrationOwnProfileExample\Profile\OwnProfile\Gateway\Reader;

use Doctrine\DBAL\Connection;
use SwagMigrationAssistant\Migration\MigrationContextInterface;
use SwagMigrationAssistant\Migration\Profile\ReaderInterface;
use SwagMigrationAssistant\Profile\Shopware\Gateway\Connection\ConnectionFactoryInterface;
use SwagMigrationAssistant\Profile\Shopware\Gateway\Local\Reader\LocalReaderInterface;
use SwagMigrationOwnProfileExample\Profile\OwnProfile\DataSelection\DataSet\ProductDataSet;
use SwagMigrationOwnProfileExample\Profile\OwnProfile\OwnProfile;

class ProductReader implements ReaderInterface, LocalReaderInterface
{
    /**
     * @var ConnectionFactoryInterface
     */
    private $connectionFactory;

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(ConnectionFactoryInterface $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * Supports only an OwnProfile and the ProductDataSet
     */
    public function supports(MigrationContextInterface $migrationContext): bool
    {
        return $migrationContext->getProfile() instanceof OwnProfile
            && $migrationContext->getDataSet()::getEntity() === ProductDataSet::getEntity();
    }

    /**
     * Creates a database connection and sets the connection class variable
     */
    protected function setConnection(MigrationContextInterface $migrationContext): void
    {
        $this->connection = $this->connectionFactory->createDatabaseConnection($migrationContext);
    }

    /**
     * Fetches all entities out of the product table with the given limit
     */
    public function read(MigrationContextInterface $migrationContext, array $params = []): array
    {
        $this->setConnection($migrationContext);

        $query = $this->connection->createQueryBuilder();
        $query->from('product');
        $query->addSelect('*');

        $query->setFirstResult($migrationContext->getOffset());
        $query->setMaxResults($migrationContext->getLimit());

        return $query->execute()->fetchAll(\PDO::FETCH_ASSOC);
    }
}