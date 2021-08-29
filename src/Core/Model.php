<?php

namespace App\Core;

class Model
{
    public array $errors = [];
    
    public function loadFromRequest(Request $request)
    {
        $data = $request->getBody();
        
        foreach ($data as $field => $value) {
            if (property_exists($this, $field)) {
                $this->{$field} = $value;
            }
        }
    }
    
    public function getInputsInfo(): array
    {
        return [];
    }
    
    public function validate(): bool
    {
        $this->errors = (new Validator())->validate($this->getInputsInfo());
        return empty($this->errors);
    }
    
    public function getLabel($field): string
    {
        return $this->getInputsInfo()[$field]['label'] ?? '';
    }
    
    public function addError(string $field, string $message)
    {
        $this->errors[$field][] = $message;
    }
    
    public function hasError($field)
    {
        return $this->errors[$field] ?? false;
    }
    
    public function getFirstError($field)
    {
        $errors = $this->errors[$field] ?? [];
        return $errors[0] ?? '';
    }
    
}