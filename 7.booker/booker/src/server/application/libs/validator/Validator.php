<?php
namespace application\libs\validator;

/**
 *  Class for validating data inputs
 */
class Validator
{
    private $rules;

    public $msg;

    /**
     * @param  string
     * @param  string or array
     * @return obj
     *
     *  Registrating rule for array item,
     *  to validate item vlaue
     */
    public function registRule($dataName, $rules)
    {
        $this->rules[$dataName] = $rules;
        return $this;
    }

    /**
     * @param  string
     * @param  integer
     * @return boolean
     *
     * Checks is string has only text
     */
    private function isText($string, $length = 100)
    {
        if($length > strlen($string))
        {
            $pattern = '/^[a-zA-Z]+$/';
            if(preg_match($pattern, $string))
            {
                return true;
            }
            else
            {
                $this->msg = 'not charcters';
                return false;
            }
        }
        else
        {
            $this->msg = 'very long';
            return false;
        }
    }

    /**
     * @param  string
     * @param  integer
     * @return boolean
     *
     * Checks is string has only text and nums
     */
    private function isNumText($string, $length = 100)
    {
        if($length > strlen($string))
        {
            $pattern = '/^[a-zA-Z0-9]+$/';
            if(preg_match($pattern, $string))
            {
                return true;
            }
            else
            {
                $this->msg = 'not charcters';
                return false;
            }
        }
        else
        {
            $this->msg = 'very long';
            return false;
        }
    }

    /**
     * @param  string
     * @return boolean
     *
     * Checks string is it email
     */
    private function isEmail($string)
    {
        
        $pattern = '/^(\S+)@([a-z0-9-]+)(\.)([a-z]{2,4})(\.?)([a-z]{0,4})+$/';
        if(preg_match($pattern, $string))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param  string
     * @return boolean
     *
     * Checks is input string - only interger
     */
    private function isInt($string)
    {
        if(!is_null($string))
        {    
            $value = (int)$string;
            if(is_int($value))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    /**
     * @param  string
     * @return boolean
     *
     * Check password wich must contain
     * atleast 1 number and 1 Cpaitalize character
     */
    private function checkPass($string)
    {
        $pattern = '/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/';
        if(preg_match($pattern, $string))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param  array
     * @return array
     *
     * Checks data for registred rules &
     * returns Array wich shows what data is valid
     */
    public function validate($data)
    {
        $result;
        foreach($this->rules as $key => $value)
        {
            if(!is_array($value))
            {
                $string = $data[$key];
                $result[$key] = $this->$value($string);
            }
            else
            {
                $rule = $value['rule'];
                $args = $value['args'];
                $string = $data[$key];
                $result[$key] = $this->$rule($string, $args);
            }
        }
        return $result;
    }
}

