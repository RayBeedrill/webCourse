<?php

class CalcTest extends PHPUnit_Framework_TestCase {
    
    protected $fixture;

    protected function setUp()
    {
        $this->fixture = new Calc(); 
    }

    protected function tearDown()
    {
        $this->fixture = NULL;
    }


    /** 
    * @dataProvider providerFirstNum 
    */
    public function testGetFirstNum($a)
    {
        $this->fixture->setFirstNum($a);
        $this->assertInternalType('int', $this->fixture->GetFirstNum());
    }
    
    /** 
    * @dataProvider providerSecondNum 
    */
    public function testGetSecondNum($a)
    { 
        $this->fixture->setSecondNum($a);
        $this->assertInternalType('int', $this->fixture->GetSecondNum());
    }

    public function providerFirstNum()
    {
        return array (
            array (-100), 
            array (20), 
            array (50)
        ); 
    }

    public function providerSecondNum()
    {
        return array (
            array (150), 
            array (20), 
            array (35)
        ); 
    }

    /**
     * @depends testGetFirstNum
     * @depends testGetSecondNum
     * @dataProvider providerSum
     */
    public function testSum($a, $b, $c)
    {
        $this->fixture->setFirstNum($a);
        $this->fixture->setSecondNum($b);
        
        $this->assertEquals($c, $this->fixture->sum());
    }

    public function providerSum()
    {
        return array (
            array (-100, 150, 50), 
            array (20, 20, 40), 
            array (50, 35, 85)
        ); 
    }



    /**
     * @depends testSum
     * @dataProvider providerMinus
     */
    public function testMinus($a, $b, $c)
    {
        $this->fixture->setFirstNum($a);
        $this->fixture->setSecondNum($b);
        
        $this->assertEquals($c, $this->fixture->minus());
    }

    public function providerMinus()
    {
        return array (
            array (-100, 150, -250), 
            array (20, 20, 0), 
            array (50, 35, 15)
        ); 
    }
    
    /**
     * @depends testMinus
     * @dataProvider providerDivide
     * 
     */
    public function testDivide($a, $b, $c)
    {
        
        $this->fixture->setFirstNum($a);
        $this->fixture->setSecondNum($b);
        
        $this->assertEquals($c, $this->fixture->divide());
    }
    
    public function providerDivide()
    {
        return array (
            array (-100, 150, -0.66666666666666996), 
            array (20, 20, 1), 
            array (50, 35,  1.4285714285714)
        
        ); 
    }


    /**
     * @depends testDivide
     * @dataProvider providerMultiply
     * 
     */
    public function testMultiply($a, $b, $c)
    {
        $this->fixture->setFirstNum($a);
        $this->fixture->setSecondNum($b);
        
        $this->assertEquals($c, $this->fixture->multiply());
    }
    
    public function providerMultiply()
    {
        return array (
            array (-100, 150, -15000), 
            array (20, 20, 400), 
            array (50, 35, 1750 )
        
        ); 
    }
    
    /**
     * @depends testMultiply
     * @dataProvider providerPercent
     * 
     */
    public function testPercent($a, $b, $c)
    {
        $this->fixture->setFirstNum($a);
        $this->fixture->setSecondNum($b);
        
        $this->assertEquals($c, $this->fixture->percent());
    }
    
    public function providerPercent()
    {
        return array (
            array (100, 30, 30), 
            array (20, 20, 4), 
            array (50, 35, 17.5)
        
        ); 
    }
   
     /**
     * @depends testPercent
     * @dataProvider providerSqrt
     * 
     */
    public function testCalcSqrt($a, $b)
    {
        $this->assertEquals($b, $this->fixture->calcSqrt($a));
    }
    
    public function providerSqrt()
    {
        return array (
            array (100, 10), 
            array (20,4.472135954999579), 
            array (144, 12)
        
        ); 
    }
    
    
    /**
     * @depends testCalcSqrt
     */
    public function testMemClear()
    {
        $this->fixture->memClear();
        $this->assertEquals(0, $this->fixture->getMemory());
    }
    
    /**
     * @depends testMemClear
     * @dataProvider providerMemSum
     */
    public function testMemSum($a, $b, $c)
    {    
        $this->fixture->setMemory($b);
        $this->fixture->setFirstNum($a);
        $this->assertEquals($c, $this->fixture->memSum($this->fixture->getFirstNum()));
    }

    public function providerMemSum()
    {
        return array (
            array (100,25,125 ), 
            array (20, 44, 64), 
            array (144, 75, 219)
        
        ); 
    }
    
    /**
     * @depends testMemSum
     * @dataProvider providerMemMinus
     */
    public function testMemMinus($a, $b, $c)
    {
        $this->fixture->setMemory($b);
        $this->fixture->setFirstNum($a);
        $this->assertEquals($c, $this->fixture->memMinus($this->fixture->getFirstNum()));

    }
    
    public function providerMemMinus()
    {
        return array (
            array (100,25,-75 ), 
            array (20, 44, 24), 
            array (144, 75,-69)
        
        ); 
    }
}
