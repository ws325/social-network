<?php

$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('Register new user');

$I->amOnPage('/register');
$I->seeCurrentUrlEquals('/register');

$nick = 'jk_rowling';
$name = 'Joanne';
$email = 'rowling@gmail.com';
$password = 'secret123';

$I->click('Register');

$I->fillField('nick', $nick );
$I->fillField('name', $name);
$I->fillField('email', $email);
$I->fillField('password', $password);
$I->fillField('password_confirmation', $password);

$I->dontSeeInDatabase('users', [
    'nick' => $nick,
    'name' => $name,
    'email' => $email
]);

$I->click('Register');

$I->seeInDatabase('users', [
    'nick' => $nick,
    'name' => $name,
    'email' => $email,
    'block' => false,
    'mod' => false
]);

$I->seeCurrentUrlEquals('/');






