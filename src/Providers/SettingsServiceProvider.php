<?php

declare(strict_types=1);

namespace PhpRock\SettingsProvider\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use PhpRock\SettingsProvider\Http\Middleware\SettingsProviderEnabledMiddleware;
use PhpRock\SettingsProvider\Service\SettingsProvider;
use PhpRock\SettingsProvider\Config\ServiceConfigurationDictionary as Config;

final class SettingsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            Config::PATH_CONFIG => $this->getConfigPath()
        ], 'config');

        $this->loadViewsFrom(
            Config::PATH_VIEWS,
            Config::VIEWS_NAMESPACE
        );

        $this->app->booted(function () {
            $this->routes();
        });
    }

    /**
     * @return void
     */
    protected function routes(): void
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        $this->getRouter()
            ->middleware([
                SettingsProviderEnabledMiddleware::class,
                Config::MIDDLEWARE_WEB
            ])
            ->namespace(Config::NAMESPACE_CONTROLLER)
            ->prefix($this->app['config']->get(Config::CONFIG_ROUTE_PREFIX))
            ->domain($this->app['config']->get(Config::CONFIG_ROUTE_DOMAIN))
            ->group(Config::FILENAME_ROUTES_WEB);
    }

    /**
     * @return Router
     */
    protected function getRouter(): Router
    {
        return $this->app['router'];
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            Config::PATH_CONFIG,
            Config::CONFIG_NAMESPACE
        );

        $this->app->alias(
            SettingsProvider::class,
            Config::ALIAS_LSP
        );
    }

    /**
     * @return string
     */
    protected function getConfigPath(): string
    {
        return config_path(Config::FILENAME_CONFIG);
    }

    /**
     * @param  string $configPath
     */
    protected function publishConfig($configPath): void
    {
        $this->publishes([
            $configPath => config_path(Config::FILENAME_CONFIG)
        ], 'config');
    }
}
