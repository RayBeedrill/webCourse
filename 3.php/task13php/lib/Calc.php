<?php

class Calc
{
    private $firstNum;
    private $secondNum;
    private $memory;
   
    public function getFirstNum()
    {
        return $this->firstNum;
    }
    
    public function getSecondNum()
    { 
        return $this->secondNum;
    }
    
    public function setFirstNum($a){
        $this->firstNum = $a;
    }
    
    public function setSecondNum($b){
        $this->secondNum = $b;
    }
    
    public function getMemory(){
        return $this->memory;
    }
    
    public function setMemory($c){
        $this->memory = $c;
    }
    
    public function sum()
    {
        $a = $this->getFirstNum();
        $b = $this->getSecondNum();

        return $a + $b;
    }
    
    public function minus()
    {
        $a = $this->getFirstNum();
        $b = $this->getSecondNum();

        return $a - $b;
    }
    
    public function divide()
    {
        $a = $this->getFirstNum();
        $b = $this->getSecondNum();
        if($a !== 0 && $b !== 0)
        {
            return $a / $b;
        }
        else
        {
            throw new Exception(ERR_ZER); 
        }
    }
    
    public function multiply()
    {
        $a = $this->getFirstNum();
        $b = $this->getSecondNum();

        return $a * $b;
    }
    
    public function percent()
    {
         $a = $this->getFirstNum();
         $b = $this->getSecondNum();
         $b = $b * 0.01;
    
         return $a * $b;
    }
    public function calcSqrt($val)
    {
        return sqrt($val);
    }

    public function memClear()
    {
        $this->setMemory(0);
    }
    
    public function memSum($val)
    {
        $mem = $this->getMemory();
        $mem += $val;
        $this->setMemory($mem); 
        return $mem;
    }
    
    public function memMinus($val)
    {
        $mem = $this->getMemory();
        $mem -= $val;
        $this->setMemory($mem); 
        return $mem;
    }
}
