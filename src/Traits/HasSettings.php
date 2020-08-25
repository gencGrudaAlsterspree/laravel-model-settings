<?php

namespace Glorand\Model\Settings\Traits;

use Glorand\Model\Settings\Managers\AbstractSettingsManager;
use Illuminate\Support\Arr;

trait HasSettings
{
    public function getDefaultSettings(): array
    {
        if (property_exists($this, 'defaultSettings')) {
            return Arr::wrap($this->defaultSettings);
        }

        return [];
    }

    public function castSettingsAttribute($path, $value)
    {
        if($value && $this->hasCast(($attribute = 'settings.' . $path))) {
            return $this->castAttribute($attribute, $value);
        }
        return $value;
    }

    abstract public function getSettingsValue(): array;

    abstract public function settings(): AbstractSettingsManager;
}
