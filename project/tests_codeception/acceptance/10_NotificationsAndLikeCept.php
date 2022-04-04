<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('check notifications');
$I->amOnPage('/login');

$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');
$I->seeCurrentUrlEquals('/');
$I->click('Notifications');
$I->see('You don\'t have any notifications.');
$I->click('Profile');
$user_id=$I->grabFromDatabase('users', 'id', ['email'=>'john.doe@gmail.com']);
$I->seeCurrentUrlEquals('/profile/'.$user_id);

$I->click('like');
$I->click('Notifications');
$I->see('J.Doe polubił Twój post "Co tam? #how_you_doin? #ghd"');

