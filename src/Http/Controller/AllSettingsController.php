<?php

declare(strict_types=1);

namespace PhpRock\SettingsProvider\Http\Controller;

use Illuminate\Routing\Controller;
use PhpRock\SettingsProvider\Service\SettingsProvider;

class AllSettingsController extends Controller
{
    /** @var SettingsProvider */
    private $settingsProvider;

    public function __construct(SettingsProvider $settingsProvider)
    {
        $this->settingsProvider = $settingsProvider;
    }

    public function index(): string
    {
        return 'Laravel version: ' . $this->settingsProvider->getVersion() ;
    }
}
