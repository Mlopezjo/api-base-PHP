<?php

namespace Config\common\Validation;

class Validator {

    private $data;
    private $errors;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validate(array $rules): ?array
    {
        foreach ($rules as $name => $rulesArray) {
            if (array_key_exists($name, $this->data)) {
                foreach ($rulesArray as $rule) {
                    switch ($rule) {
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min':
                            $this->min($name, $this->data[$name], $rule);
                        case 'mail':
                            $this->mail($name, $this->data[$name]);
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            }
        }

        return $this->getErrors();
    }

    private function required(string $name, string $value)
    {
        $value = trim($value);

        if (!isset($value) || is_null($value) || empty($value)) {
            $this->errors[$name][] = "{$name} is required.";
        }
    }

    private function min(string $name, string $value, string $rule)
    {
        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int) $matches[0][0];

        if (strlen($value) < $limit) {
            $this->errors[$name][] = "{$name} must include a minimum of {$limit} characters";
        }
    }

    private function mail(string $name, string $value){

        $value = trim($value);

        if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
            $this->errors[$name][] = "{$name} must be email";
        }
    }

    private function getErrors(): ?array
    {
        return $this->errors;
    }
}