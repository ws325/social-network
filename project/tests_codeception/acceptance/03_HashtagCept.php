<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('Check searching and #');


$I->amOnPage('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('');

$I->click('Tweet');

$I->fillField('tweet', 'To jest #post na temat #testu');

$I->click('Tweetnij');

$I->click('Tweet');

$I->fillField('tweet', 'Drugi #tweet');

$I->click('Tweetnij');

$I->seeInDatabase('posts', ['text' => 'To jest #post na temat #testu', 'user_id' => 1]);
$I->seeInDatabase('posts', ['text' => 'Drugi #tweet', 'user_id' => 1]);

$id1 = $I->grabFromDatabase('posts', 'id',  ['text' => 'To jest #post na temat #testu', 'user_id' => 1]);
$id2 = $I->grabFromDatabase('posts', 'id', ['text' => 'Drugi #tweet', 'user_id' => 1]);

$I->seeInDatabase('taggables',['taggable_id'=>$id1]);
$I->seeInDatabase('taggables',['taggable_id'=>$id2]);

$I->click('Profile');
$I->click('Tweets');

$I->see('To jest #post na temat #testu');
$I->see('Drugi #tweet');

$I->click('#post');

$I->see('To jest #post na temat #testu');
$I->dontSee('Drugi #tweet');

$I->click('Home');
$I->fillField('search','#testu');
$I->click('Wyszukaj');
$I->see('To jest #post na temat #testu');


$I->click('Home');
$I->fillField('search','John');
$I->click('Wyszukaj');
$I->see('John Doe');
