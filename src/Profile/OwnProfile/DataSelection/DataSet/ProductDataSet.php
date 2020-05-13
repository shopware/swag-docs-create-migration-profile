<?php declare(strict_types=1);

namespace SwagMigrationOwnProfileExample\Profile\OwnProfile\DataSelection\DataSet;

use SwagMigrationAssistant\Migration\DataSelection\DataSet\DataSet;
use SwagMigrationAssistant\Migration\MigrationContextInterface;
use SwagMigrationOwnProfileExample\Profile\OwnProfile\OwnProfile;

class ProductDataSet extends DataSet
{
    /**
     * Returns the entity identifier of this DataSet
     */
    public static function getEntity(): string
    {
        return 'product';
    }

    /**
     * Supports only an OwnProfile
     */
    public function supports(MigrationContextInterface $migrationContext): bool
    {
        return $migrationContext->getProfile() instanceof OwnProfile;
    }
}
