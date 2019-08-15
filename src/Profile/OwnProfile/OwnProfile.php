<?php declare(strict_types=1);

namespace SwagMigrationOwnProfileExample\Profile\OwnProfile;

use SwagMigrationAssistant\Migration\Profile\ProfileInterface;

class OwnProfile implements ProfileInterface
{
    public const PROFILE_NAME = 'ownProfile';

    public const SOURCE_SYSTEM_NAME = 'MySourceSystem';

    public const SOURCE_SYSTEM_VERSION = '1.0';

    public function getName(): string
    {
        return self::PROFILE_NAME;
    }

    public function getSourceSystemName(): string
    {
        return self::SOURCE_SYSTEM_NAME;
    }

    public function getVersion(): string
    {
        return self::SOURCE_SYSTEM_VERSION;
    }
}