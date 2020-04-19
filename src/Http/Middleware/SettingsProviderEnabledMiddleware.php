<?php

declare(strict_types=1);

namespace PhpRock\SettingsProvider\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PhpRock\SettingsProvider\Service\SettingsProvider;
use Symfony\Component\HttpFoundation\Response;

final class SettingsProviderEnabledMiddleware
{
    /** @var SettingsProvider */
    protected $settingsManager;

    /**
     * SettingsProviderEnabledMiddleware constructor.
     *
     * @param SettingsProvider $settingsManager
     */
    public function __construct(SettingsProvider $settingsManager)
    {
        $this->settingsManager = $settingsManager;
    }

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->settingsManager->isEnabled()) {
            abort(Response::HTTP_OK, 'Settings manager disabled.');
        }

        return $next($request);
    }
}
