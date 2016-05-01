# Validator

**(A simple easy to use form validator)**

## Install

```
composer require rajuthapa8086/validator
```

## How To Use

```php
<?php

require 'vendor/autoload.php';

$validator = new Validator();

$rules = array(
	'username' => 'trim_required|between:6:30|alnum_under',
    'password' => 'trim_required|between:6:30|match:confirm_password',
    'confirm_password' => 'trim_required|match:password',
);


$inputs = array(
	'username' => 'as##ASAAS',
    'password' => 'aaa000a0a0s'
    'confirm_password' => 'asasas0as0d0as0d0as',
);

// OR
// $inputs => $_POST;


$errors = $validator->run($rules, $inputs);

// var_dump($errors);

```

**Now in your view or template file.**

```php
<?php if (count($errors)): ?>
<ul>
	<?php foreach($errors as $error): ?>
    <li><?php echo $error[0]; ?></li>
    <?php endforeach; ?>
</ul>
<?php endif: ?>

```
