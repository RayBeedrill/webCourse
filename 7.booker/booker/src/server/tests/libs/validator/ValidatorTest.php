<?php
use application\libs\validator as valid;

/**
 * Testing of the class
 * Class: Validator
 */
class ValidatorTest  extends PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $validator = new valid\Validator;

        $data = array(
            'sometext' => 'asdasdasd',
            'sometextNum' => 'asdasd231231',
            'someemail' => 'demezis@gmail.com',
            'onlyInt' => 1231,
            'pass' => '235387qqQQ'
        );

        $result = $validator
        ->registRule('sometext','isText')
        ->registRule('sometextNum','isNumText')
        ->registRule('someemail','isEmail')
        ->registRule('onlyInt','isInt')
        ->registRule('pass','checkPass')
        ->validate($data);
        foreach($result as $value)
        {
            $this->assertTrue($value);
        }
    }
}

