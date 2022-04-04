<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('check notifications');
$I->amOnPage('/login');

$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('/');

$I->click('Profile');
$user_id=$I->grabFromDatabase('users', 'id', ['email'=>'john.doe@gmail.com']);
$I->seeCurrentUrlEquals('/profile/'.$user_id);

$I->see('Who to follow');
$I->see('Trends');

$I->click('Notifications');
$I->amOnPage('/');
$I->click('Profile');
$I->amOnPage('/');

$I->fillField('search','John');
$I->click('Wyszukaj');
$I->see('John Doe');
$I->amOnPage('/');
