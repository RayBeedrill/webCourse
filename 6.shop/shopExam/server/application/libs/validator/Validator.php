<?php
namespace application\libs\validator;
class Validator
{
    private $rules;

    public $msg;

    public function registRule($dataName, $rules)
    {
        $this->rules[$dataName] = $rules;
        return $this;
    }

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
    
//must 1 character big nums and characters
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

