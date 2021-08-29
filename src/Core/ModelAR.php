<?php

namespace App\Core;

abstract class ModelAR extends Model
{
    abstract public static function getDBTableName(): string;
    abstract public static function getDBFields(): array;
    
    public static function getDBPrimaryKey(): string
    {
        return 'id';
    }
    
    public function load($model): ModelAR
    {
        $fields = get_class_vars(get_class($model));
        
        foreach ($fields as $field => $value) {
            if (property_exists($this, $field)) {
                $this->{$field} = $model->{$field};
            }
        }
        
        return $this;
    }
    
    public static function find(array $where)
    {
        return db()->find(static::getDBTableName(), $where, static::class);
    }
    
    public function save()
    {
        $data = [];
        
        foreach ($this->getDBFields() as $field) {
            $data[$field] = $this->{$field};
        }
        
        return db()->add($this->getDBTableName(), $data);
    }
}