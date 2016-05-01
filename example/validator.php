<?php

require_once __DIR__ . '/../vendor/autoload.php';

use RajuThapa8086\Validator\Validator as Validator;

$rules = array(
    'username' => 'trim_required|between:6:30|alnum',
    'password' => 'trim_required|between:6:30',
    'confirm_password' => 'trim_required|match:password',
    'email' => 'trim_required|email',
    'age' => 'trim_required|max:3|digits',
    'price' => 'trim_required|numeric',
);

$first_inputs = array(
    'username' => '',
    'password' => '',
    'confirm_password' => '',
    'email' => '',
    'age' => '',
    'price' => '',
);

$second_inputs = array(
    'username' => 'asd',
    'password' => 'asd',
    'confirm_password' => 'asdasd',
    'email' => 'asd',
    'age' => 'asdasd',
    'price' => 'asdasd',
);

$third_inputs = array(
    'username' => '@#sASD',
    'password' => 'asdasd',
    'confirm_password' => 'asdasdasdasd',
    'email' => 'admin@example.com',
    'age' => '2a2',
    'price' => '20202.23',
);

$fourth_inputs = array(
    'username' => 'user_sdf-sdf',
    'password' => 'asdasd',
    'confirm_password' => 'asdasd',
    'email' => 'admin@example.com',
    'age' => '100',
    'price' => '2020.20',
);

$messages = array(
    'trim_required' => "%s field is necessary",
);

// you can pass second parameter as $_POST if its from form
var_dump(Validator::run($rules, $first_inputs, $messages));
var_dump(Validator::run($rules, $second_inputs, $messages));
var_dump(Validator::run($rules, $third_inputs, $messages));

// validatiion pass
var_dump(Validator::run($rules, $fourth_inputs, $messages));

// you can also access via object

/*

$validator = new Validator();
var_dump($validator->validate($rules, $first_inputs, $messages));
var_dump($validator->validate($rules, $second_inputs, $messages));
var_dump($validator->validate($rules, $third_inputs, $messages));

// validatiion pass
var_dump($validator->validate($rules, $fourth_inputs, $messages));

 */
