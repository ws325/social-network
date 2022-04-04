<?php

$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('Register new user and check his profile');

$I->amOnPage('/register');
$I->seeCurrentUrlEquals('/register');

$nick = 'jk_rowling673222';
$name = 'Joanne';
$email = 'rowling247644@gmail.com';
$password = 'secret123';

$I->fillField('nick', $nick );
$I->fillField('name', $name);
$I->fillField('email', $email);
$I->fillField('password', $password);
$I->fillField('password_confirmation', $password);

$I->click('Register');

$I->seeInDatabase('users', [
    'nick' => $nick,
    'name' => $name,
    'email' => $email,
    'block' => false,
    'mod' => false
]);

$id = $I->grabFromDatabase('users', 'id', [
    'nick' => $nick
]);

$I->seeCurrentUrlEquals('/');

$I->click('Profile');

$I->seeCurrentUrlEquals('/profile/'.$id);

$I->see("following: 0");

$I->see("followers: 0");

$I->see("You don't have any tweets yet.");

$I->click('Likes');

$I->see("You don't have any likes yet.");

