<?php

use RajuThapa8086\Validator\Validator as Validator;

class ValidatorTest extends PHPUnit_Framework_TestCase
{

    protected $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function testValidateRequired()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('fullname' => 'required'),
        //     array('fullname' => '')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('fullname' => 'required'),
            array('fullname' => 'John Doe')
        ));
    }

    public function testValidateTrimRequired()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('fullname' => 'trim_required'),
        //     array('fullname' => '    ')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('fullname' => 'trim_required'),
            array('fullname' => 'John Doe')
        ));
    }

    public function testValidateMin()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('fullname' => 'min:6'),
        //     array('fullname' => 'abcde')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('fullname' => 'min:6'),
            array('fullname' => 'abcdefgh')
        ));
    }

    public function testValidateMax()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('fullname' => 'max:6'),
        //     array('fullname' => 'abcdefg')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('fullname' => 'max:6'),
            array('fullname' => 'abcdef')
        ));
    }

    public function testValidateBetween()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('fullname' => 'between:6:10'),
        //     array('fullname' => 'abcde')
        // ));

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('fullname' => 'between:6:10'),
        //     array('fullname' => 'abcdefghijkl')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('fullname' => 'between:6:10'),
            array('fullname' => 'abcdef')
        ));
    }

    public function testValidateEmail()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('email' => 'email'),
        //     array('email' => 'abcde')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('email' => 'email'),
            array('email' => 'abcdef@example.com')
        ));
    }

    public function testValidateMatch()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('password' => 'match:confirm_password'),
        //     array('password' => 'abcde', 'confirm_password' => 'abcdef')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('password' => 'match:confirm_password'),
            array('password' => 'abcde', 'confirm_password' => 'abcde')
        ));
    }

    public function testValidateAlpha()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('username' => 'alpha'),
        //     array('username' => 'asd230')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('username' => 'alpha'),
            array('username' => 'abcdef')
        ));
    }

    public function testValidateAlnum()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('username' => 'alnum'),
        //     array('username' => 'asd##')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('username' => 'alnum'),
            array('username' => 'abcd3')
        ));
    }

    public function testValidateAlnumDash()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('username' => 'alnum_dash'),
        //     array('username' => 'asd##')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('username' => 'alnum_dash'),
            array('username' => 'abcd3-')
        ));
    }

    public function testValidateAlnumUnder()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('username' => 'alnum_under'),
        //     array('username' => 'asd##')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('username' => 'alnum_under'),
            array('username' => 'abcd3_')
        ));
    }

    public function testValidateAlnumUnderDash()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('username' => 'alnum_under_dash'),
        //     array('username' => 'asd##')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('username' => 'alnum_under_dash'),
            array('username' => 'abcd3_e-e_a0')
        ));
    }

    public function testValidateDigits()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('age' => 'digits'),
        //     array('age' => '30.3')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('age' => 'digits'),
            array('age' => '30')
        ));
    }

    public function testValidateNumeice()
    {
        $validator = $this->validator;

        # Test Fail
        // $this->assertEquals(array(), $validator->validate(
        //     array('price' => 'numeric'),
        //     array('price' => '30.3wd')
        // ));

        # Test Pass
        $this->assertEquals(array(), $validator->validate(
            array('price' => 'numeric'),
            array('price' => '30.39')
        ));
    }
}
