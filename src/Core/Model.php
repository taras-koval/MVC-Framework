<?php

namespace App\Core;

abstract class Model
{
    protected Database $db;
    
    public const RULE_REQUIRED = 'required';
    public const RULE_ALPHANUMERIC = 'alphanumeric';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    
    public array $errors = [];
    
    public function __construct()
    {
        $this->db = App::$database;
    }
    
    abstract public function table(): string;
    abstract public function fields(): array;
    abstract public function rules(): array;
    
    public function setData($data)
    {
        foreach ($data as $field => $val) {
            if (property_exists($this, $field)) {
                $this->{$field} = $val;
            }
        }
    }
    
    public function save(): bool
    {
        $table = $this->table();
        $fields = $this->fields();
        $params = array_map(fn($val) => ":$val", $fields);
    
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
            $table,
            implode(',', $fields),
            implode(',', $params)
        );
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($fields as $field) {
            $stmt->bindValue(":$field", $this->{$field});
        }
        
        $stmt->execute();
        return true;
    }
    
    public function labels(): array
    {
        return [];
    }
    
    public function getLabel($field)
    {
        return $this->labels()[$field] ?? $field;
    }
    
    public function validate(): bool
    {
        foreach ($this->rules() as $field => $rules) {
            $value = $this->{$field};
            
            foreach ($rules as $rule) {
                switch (is_string($rule)? $rule : $rule[0]) {
                    case self::RULE_REQUIRED:
                        if (empty($value)) {
                            $this->addError($field, self::RULE_REQUIRED);
                        }
                        break;
                    case self::RULE_ALPHANUMERIC:
                        if (preg_match('~([^a-zA-Z0-9_-]+)~', $value)) {
                            $this->addError($field, self::RULE_ALPHANUMERIC,
                                ['field' => $this->getLabel($field)]);
                        }
                        break;
                    case self::RULE_EMAIL:
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->addError($field, self::RULE_EMAIL);
                        }
                        break;
                    case self::RULE_MIN:
                        if (strlen($value) < $rule['min']) {
                            $this->addError($field, self::RULE_MIN, $rule);
                        }
                        break;
                    case self::RULE_MAX:
                        if (strlen($value) > $rule['max']) {
                            $this->addError($field, self::RULE_MAX, $rule);
                        }
                        break;
                    case self::RULE_MATCH:
                        if ($value !== $this->{$rule['match']}) {
                            $rule['match'] = $this->getLabel($rule['match']);
                            $this->addError($field, self::RULE_MATCH, $rule);
                        }
                        break;
                    case self::RULE_UNIQUE:
                        $className = $rule['class'];
                        $table = $className::table();
                        
                        $stmt = $this->db->prepare("SELECT * FROM $table WHERE $field = :field");
                        $stmt->bindValue(":field", $value);
                        $stmt->execute();
                        
                        if ($stmt->fetchObject()) {
                            $this->addError($field, self::RULE_UNIQUE,
                                ['field' => $this->getLabel($field)]);
                        }
                        break;
                }
            }
        }
        
        return empty($this->errors);
    }
    
    public function addError(string $attribute, string $rule, array $params = [])
    {
        $message = $this->errorMessages()[$rule];
        
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        
        $this->errors[$attribute][] = $message;
    }
    
    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_ALPHANUMERIC => '{field} may only contain alphanumeric characters',
            self::RULE_EMAIL => 'Email is invalid',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'Record with this {field} already exists'
        ];
    }
    
    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }
    
    public function getFirstError($attribute)
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }
}
