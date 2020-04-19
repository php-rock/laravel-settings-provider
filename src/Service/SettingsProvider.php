<?php

declare(strict_types=1);

namespace PhpRock\SettingsProvider\Service;

use Illuminate\Contracts\Foundation\Application;
use PhpRock\SettingsProvider\Config\ServiceConfigurationDictionary;

final class SettingsProvider
{
    /** @var \Illuminate\Foundation\Application */
    protected $app;

    /** @var bool */
    private $enabled;

    /** @var string */
    private $version;

    /**
     * @param Application $app
     */
    public function __construct($app = null)
    {
        if (!$app) {
            $app = app();   //Fallback when $app is not given
        }

        $this->app = $app;

        $this->version = $app->version();
    }

    public function test(): string
    {
        return 'xxx1';
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        if ($this->enabled === null) {
            $config = $this->app['config'];
            $configEnabled = value($config->get(ServiceConfigurationDictionary::CONFIG_ENABLED));
            $this->enabled = $configEnabled && !$this->app->runningInConsole() && !$this->app->environment('testing');
        }

        return $this->enabled;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}
