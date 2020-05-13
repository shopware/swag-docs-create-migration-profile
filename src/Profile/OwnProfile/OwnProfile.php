<?php declare(strict_types=1);

namespace SwagMigrationOwnProfileExample\Profile\OwnProfile;

use SwagMigrationAssistant\Migration\Profile\ProfileInterface;

class OwnProfile implements ProfileInterface
{
    public const PROFILE_NAME = 'ownProfile';

    public const SOURCE_SYSTEM_NAME = 'MySourceSystem';

    public const SOURCE_SYSTEM_VERSION = '1.0';

    public const AUTHOR_NAME = 'shopware AG';

    public const ICON_PATH = '/swagmigrationassistant/static/img/migration-assistant-plugin.svg';

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

    public function getAuthorName(): string
    {
        return self::AUTHOR_NAME;
    }

    public function getIconPath(): string
    {
        return self::ICON_PATH;
    }
}
