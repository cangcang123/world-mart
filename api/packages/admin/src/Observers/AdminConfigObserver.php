<?php

namespace SHOP\Admin\Observers;

use SHOP\Admin\Models\AdminConfig;

class AdminConfigObserver
{
    public function saving(AdminConfig $config) {
        $config->value = serialize($config->value);
    }

    public function retrieved(AdminConfig $config) {
        $config->value = unserialize($config->value);
    }
}
