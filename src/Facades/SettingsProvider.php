<?php

declare(strict_types=1);

namespace PhpRock\SettingsProvider\Facades;

use Illuminate\Support\Facades\Facade;
use PhpRock\SettingsProvider\Service\SettingsProvider as SPS;

class SettingsProvider extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return SPS::class;
    }
}
