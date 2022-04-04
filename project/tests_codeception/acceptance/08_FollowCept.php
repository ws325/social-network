<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('check notifications');
$I->amOnPage('/login');

$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');
$I->seeCurrentUrlEquals('/');
$I->amOnPage('/profile/10');
$I->click('Follow');
$I->seeInDatabase('followers', ['follower_id' => 1, 'user_id' => 10] );
$I->click('Unfollow');
$I->dontSeeInDatabase('followers', ['follower_id' => 1, 'user_id' => 10] );
