<?php

namespace App\Core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    
    public array $errors = [];
    
    /**
     * @return array
     */
    abstract public function rules(): array;
    
    /**
     * @param $data
     */
    public function setData($data)
    {
        foreach ($data as $field => $val) {
            if (property_exists($this, $field)) {
                $this->{$field} = $val;
            }
        }
    }
    
    /**
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            
            foreach ($rules as $rule) {
                $ruleName = is_string($rule)? $rule : $rule[0];
    
                if ($ruleName === self::RULE_REQUIRED && empty($value)) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
    
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
    
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
    
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH);
                }
            }
        }
        
        return empty($this->errors);
    }
    
    /**
     * @param  string  $attribute
     * @param  string  $rule
     * @param  array  $params
     */
    public function addError(string $attribute, string $rule, array $params = [])
    {
        $message = $this->errorMessages()[$rule];
        
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        
        $this->errors[$attribute][] = $message;
    }
    
    /**
     * @return string[]
     */
    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This password must be the same'
            // self::RULE_UNIQUE => 'Record with this {field} already exists',
        ];
    }
    
    /**
     * @param $attribute
     * @return false|mixed
     */
    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }
    
    /**
     * @param $attribute
     * @return mixed|string
     */
    public function getFirstError($attribute)
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }
}
