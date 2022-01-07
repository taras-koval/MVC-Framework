<?php

namespace App\Core;

abstract class Model
{
    public ?int $id = null;
    
    public function __construct(array $data = null)
    {
        if (isset($data)) {
            setObjectFromArray($this, $data);
        }
    }
    
    /**
     * Get table name in the database
     * @return string
     */
    abstract protected static function table() : string;
    
    /**
     * Get the first record found in the database
     * @param  array  $where
     * @return false|mixed
     */
    public static function find(array $where)
    {
        return db()->find(static::table(), $where, static::class);
    }
    
    public static function findById($id)
    {
        return static::find(['id' => $id]);
    }
    
    public function save()
    {
        $fields = get_object_vars($this);
        // camelCaseToSnakeCaseArrayKeys($fields);
        
        if (isset($this->id)) {
            return db()->update(static::table(), $fields);
        }
        
        return $this->id = db()->create(static::table(), $fields);
    }
    
    public function delete()
    {
        db()->delete(static::table(), $this->id);
    }
    
    public function setFromRequest(Request $request)
    {
        setObjectFromArray($this, $request->body());
    }
    
}