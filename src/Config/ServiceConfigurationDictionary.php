<?php

declare(strict_types=1);

namespace PhpRock\SettingsProvider\Config;

final class ServiceConfigurationDictionary
{
    /*
     * Main Definitions
     */

    private const SHORTCUT = 'rock-sp';
    private const NAMESPACE = 'PhpRock\SettingsProvider';
    private const ROOT_DIR = __DIR__ . '/../..';

    /*
     * Files and folders paths
     */

    public const FILENAME_CONFIG = 'settings-provider.php';
    public const PATH_CONFIG = self::ROOT_DIR . '/config/' . self::FILENAME_CONFIG;
    public const PATH_VIEWS = self::ROOT_DIR . '/resources/views';
    public const FILENAME_ROUTES_WEB = self::ROOT_DIR . '/routes/web.php';

    /*
     * Namespace
     */

    public const NAMESPACE_CONTROLLER = self::NAMESPACE . '\Http\Controller';

    /*
     * Configuration file attributes
     */

    public const CONFIG_NAMESPACE = self::SHORTCUT;

    public const CONFIG_ENABLED = self::CONFIG_NAMESPACE . '.enabled';
    public const CONFIG_ROUTE_PREFIX = self::CONFIG_NAMESPACE . '.route_prefix';
    public const CONFIG_ROUTE_DOMAIN = self::CONFIG_NAMESPACE . '.route_domain';

    /*
     * Views
     */

    public const VIEWS_NAMESPACE = self::SHORTCUT;

    /*
     * Global middleware
     */

    public const MIDDLEWARE_WEB = 'web';
    public const MIDDLEWARE_API = 'api';

    /*
     * Application alias configuration
     */

    public const ALIAS_LSP = self::SHORTCUT;
}
