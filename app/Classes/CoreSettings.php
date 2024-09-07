<?php

namespace App\Classes;

class CoreSettings {

public $settings = null;
public $cacheSettings = [];

public function __construct()
{
    $this->settings = require base_path('settings.php');
}

public function get($key, $default = null)
{
    if (isset($this->cacheSettings[$key])) {
        return $this->cacheSettings[$key];
    }
    $keys = explode('.', $key);
    $c = 0;
    $value = $this->settings;
    do {
        $keyName = $keys[$c++];
        if (!isset($value[$keyName])) {
            return $default;
        }
        $value = $value[$keyName];
    } while ($c < count($keys));

    return $this->cacheSettings[$key] = $value;
}
}