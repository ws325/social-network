<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('see profile');

$I->amOnPage('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$id = $I->grabFromDatabase('users', 'id', [
    'nick' => "J.Doe"
]);

$I->amOnPage('/profile/'. $id);

$I->wantTo('see current user profile');

$I->see("Profile");
$I->see("John Doe");
$I->see("following");
$I->see("followers");
$I->see("Tweets");
$I->see("Likes");
$I->dontSee("","#follow");

$otherId = $I->grabFromDatabase('users', 'id', [
    'nick' => "Janice"
]);

$I->amOnPage('/profile/'. $otherId);

$I->see("Profile");
$I->see("Janice Doe");
$I->see("following");
$I->see("followers");
$I->see("Tweets");
$I->see("Likes");
$I->see("","#follow");

$I->wantTo('test main menu profile button');

$I->amOnPage('/');

$I->click('Profile');

$I->seeCurrentUrlEquals('/profile/'.$id);
