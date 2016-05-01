<?php

namespace RajuThapa8086\Validator;

class Validator
{

    /**
     * @var string
     */
    protected $currentInput;

    /**
     * @var array
     */
    protected $inputs;

    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @var array
     */
    protected $messages = array(
        "required" => "%s field is required.",
        "trim_required" => "%s field is required",
        "min" => "%s must be more than %d characters.",
        "max" => "%s cannot be more than %d characters.",
        "between" => "%s must be between %d to %d characters.",
        "match" => "%s must match with value of %s.",
        "email" => "%s must be valid email address.",
        "alpha" => "%s must contain alphabets only.",
        "alnum" => "%s must contain alphabets and numbers only.",
        "alnum_under" => "%s must contain alphabets, numbers and underscores (_) only.",
        "alnum_dash" => "%s must contain alphabets, numbers and dashes (-) only.",
        "alnum_under_dash" => "%s must contain alphabets , numbers, dashes (-) and underscores (_) only.",
        "digits" => "%s must contain digits only.",
        "numeric" => "%s must be numeric.",
    );

    public function __construct()
    {}

    /**
     * @param $rules
     * @param $inputs
     * @param array $messages
     * @return mixed
     */
    public function validate($rules, $inputs, $messages = array())
    {
        $this->inputs = $inputs;
        $this->messages = array_merge($this->messages, $messages);
        foreach ($rules as $input => $validationRules) {
            $this->currentInput = $input;
            $explodeValidationRules = explode('|', $validationRules);
            foreach ($explodeValidationRules as $validationRule) {
                $explodeValidationRule = explode(':', $validationRule);
                call_user_func_array(
                    array(
                        $this,
                        $this->getMethodName($explodeValidationRule[0]),
                    ),
                    $explodeValidationRule
                );
            }
        }
        return $this->errors;
    }

    /**
     * @param $methodName
     */
    public function required($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (strlen($input) == 0) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }

    /**
     * @param $methodName
     */
    public function trimRequired($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (strlen(trim($input)) == 0) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }
    /**
     * @param $methodName
     * @param $minValue
     */
    public function min($methodName, $minValue)
    {
        $input = $this->inputs[$this->currentInput];
        if (strlen($input) < $minValue) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput), $minValue);
        }
    }

    /**
     * @param $methodName
     * @param $maxValue
     */
    public function max($methodName, $maxValue)
    {
        $input = $this->inputs[$this->currentInput];
        if (strlen($input) > $maxValue) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput), $maxValue);
        }
    }

    /**
     * @param $methodName
     * @param $minValue
     * @param $maxValue
     */
    public function between($methodName, $minValue, $maxValue)
    {
        $input = $this->inputs[$this->currentInput];
        if (strlen($input) < $minValue || strlen($input) > $maxValue) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput), $minValue, $maxValue);
        }
    }

    /**
     * @param $methodName
     */
    public function email($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (filter_var($input, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }

    /**
     * @param $methodName
     * @param $matchInputName
     */
    public function match($methodName, $matchInputName)
    {
        $input = $this->inputs[$this->currentInput];
        $matchInput = $this->inputs[$matchInputName];
        if ($input !== $matchInput) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput), $this->getInputName($matchInputName));
        }
    }

    /**
     * @param $methodName
     */
    public function alpha($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (!ctype_alpha($input)) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }

    /**
     * @param $methodName
     */
    public function alnum($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (!ctype_alnum($input)) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }

    /**
     * @param $methodName
     */
    public function alnumDash($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (!ctype_alnum(str_replace('-', '', $input))) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }

    /**
     * @param $methodName
     */
    public function alnumUnder($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (!ctype_alnum(str_replace('_', '', $input))) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }

    /**
     * @param $methodName
     */
    public function alnumUnderDash($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (!ctype_alnum(str_replace(array('-', '_'), '', $input))) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }

    /**
     * @param $methodName
     */
    public function digits($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (!ctype_digit($input)) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }

    /**
     * @param $methodName
     */
    public function numeric($methodName)
    {
        $input = $this->inputs[$this->currentInput];
        if (!is_numeric($input)) {
            $this->errors[$this->currentInput][] = sprintf($this->messages[$methodName], $this->getInputName($this->currentInput));
        }
    }

    /**
     * @param $input
     */
    protected function getInputName($input)
    {
        return implode(" ", array_map(function ($item) {
            return ucfirst(strtolower(trim($item)));
        }, explode("_", $input)));
    }

    /**
     * @param $methodName
     * @return mixed
     */
    protected function getMethodName($methodName)
    {
        $explodeMethodName = explode("_", $methodName);
        $first = strtolower(trim(array_shift($explodeMethodName)));
        return $first . implode("", array_map(function ($item) {
            return ucfirst(strtolower(trim($item)));
        }, $explodeMethodName));
    }

    /**
     * @param $rules
     * @param $inputs
     * @param array $messages
     * @return array
     */
    public static function run($rules, $inputs, $messages = array())
    {
        $class = get_called_class();
        $obj = new $class();
        return $obj->validate($rules, $inputs, $messages);
    }

}
