<?php

namespace App\Core;

class Validator
{
    public const RULE_REQUIRED = 'required';
    public const RULE_ALPHANUMERIC = 'alphanumeric';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    
    private array $errors = [];
    
    public function validate(array $fields): array
    {
        foreach ($fields as $field => $fieldData) {
            $value = $fieldData['value'];
            
            foreach ($fieldData['rules'] as $key => $ruleValue) {
                $ruleName = is_int($key)? $ruleValue : $key;
                
                switch ($ruleName) {
                    case self::RULE_REQUIRED:
                        if (empty($value)) {
                            $this->addError($field, 'This field is required');
                        }
                        break;
                    case self::RULE_ALPHANUMERIC:
                        if (preg_match('~([^a-zA-Z0-9_-]+)~', $value)) {
                            $this->addError($field, $fieldData['label']. ' may only contain alphanumeric characters');
                        }
                        break;
                    case self::RULE_EMAIL:
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->addError($field, 'Email is invalid');
                        }
                        break;
                    case self::RULE_MIN:
                        if (strlen($value) < $ruleValue) {
                            $this->addError($field, "Min length of this field must be $ruleValue");
                        }
                        break;
                        
                    case self::RULE_MAX:
                        if (strlen($value) > $ruleValue) {
                            $this->addError($field, "Max length of this field must be $ruleValue");
                        }
                        break;
                    case self::RULE_MATCH:
                        if ($value !== $fields[$ruleValue]['value']) {
                            $this->addError($field, 'This field must be the same as '. $fields[$ruleValue]['label']);
                        }
                        break;
                    case self::RULE_UNIQUE:
                        if (isset($this->errors[$field])) {
                            break;
                        }
        
                        if (db()->find($ruleValue, [$field => $value])) {
                            $this->addError($field, 'This '. $fieldData['label'] .' already exists');
                        }
                        break;
                }
            }
        }
        
        return $this->errors;
    }
    
    private function addError(string $field, string $message)
    {
        $this->errors[$field][] = $message;
    }
    
}