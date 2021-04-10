<?php

namespace SHOP\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminConfig extends Model
{
    protected $table = 'admin_configs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'key',
        'value',
        'status',
        'deleted',
        'status_log',
    ];

    public static function set($key, $value) {
        $config = self::firstOrNew(['key' => $key]);
        $config->value = $value;
        $config->save();
        return $value;
    }

    public static function get($key, $default = null, $cache = true) {
        $config = self::where('key', $key)->first();
        return $config ? $config->value : $default;
    }
}
