<?php

namespace App\Core;

class Validator
{
    /** 'required' */
    public const REQUIRED = 'required';
    
    /** 'alphanumeric' */
    public const ALPHANUMERIC = 'alphanumeric';
    
    /** 'words' */
    public const WORDS = 'words';
    
    /** 'email' */
    public const EMAIL = 'email';
    
    /** 'min' => 4 */
    public const MIN = 'min';
    
    /** 'max' => 32 */
    public const MAX = 'max';
    
    /** 'match' => 'password' */
    public const MATCH = 'match';
    
    /** 'unique' => 'users' */
    public const UNIQUE = 'unique';
    
    private array $errors = [];
    
    public function validate(array $rules, array $fields): array
    {
        foreach ($rules as $fieldKey => $fieldRules) {
            
            if (is_null($fields[$fieldKey])) {
                continue;
            }
    
            $fieldValue = $fields[$fieldKey];
    
            foreach($fieldRules as $ruleKey => $ruleValue) {
    
                switch (is_int($ruleKey) ? $ruleValue : $ruleKey) {
                    case self::REQUIRED:
                        if (empty($fieldValue)) {
                            $this->addError($fieldKey, 'This field is required.');
                        }
                        break;
    
                    case self::ALPHANUMERIC:
                        if (preg_match('~([^a-zA-Z0-9-]+)~', $fieldValue)) {
                            $this->addError($fieldKey, 'Field may only contain alphanumeric characters.');
                        }
                        break;
    
                    case self::WORDS:
                        if (preg_match('~([^a-zA-Z ]+)~', $fieldValue)) {
                            $this->addError($fieldKey, 'Field may only contain alphabetic characters.');
                        }
                        break;
    
                    case self::EMAIL:
                        if (!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
                            $this->addError($fieldKey, 'Email is invalid.');
                        }
                        break;
    
                    case self::MIN:
                        if (strlen($fieldValue) < $ruleValue) {
                            $this->addError($fieldKey, "Min length of this field must be $ruleValue.");
                        }
                        break;
    
                    case self::MAX:
                        if (strlen($fieldValue) > $ruleValue) {
                            $this->addError($fieldKey, "Max length of this field must be $ruleValue.");
                        }
                        break;
    
                    case self::MATCH:
                        if ($fieldValue !== $fields[$ruleValue]) {
                            $this->addError($fieldKey, "This field must be the same as " . ucfirst($ruleValue) . '.');
                        }
                        break;
    
                    case self::UNIQUE:
                        if (db()->find($ruleValue, [$fieldKey => $fieldValue])) {
                            $this->addError($fieldKey, 'This value already exists.');
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