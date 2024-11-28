<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function getTableColums()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function hasColumn($key)
    {
        return in_array($key, $this->getTableColums());
    }

    public function scopeActived($query) {
        return $query->where($this->table . '.actived', static::STATUS_ACTIVE);
    }

    public function scopeInactived($query) {
        return $query->where($this->table . '.actived', static::STATUS_INACTIVE);
    }

    public static function activedLabels()
    {
        return [
            self::STATUS_ACTIVE => 'Aktif',
            self::STATUS_INACTIVE => 'Non Aktif',
        ];
    }

    public function getActivedLabel()
    {
        $list = static::activedLabels();
        if (!isset($this->attributes['actived'])) {
            return null;
        }
        
        return $list[$this->attributes['actived']] ? $list[$this->attributes['actived']] : $this->attributes['actived'];
    }

}
