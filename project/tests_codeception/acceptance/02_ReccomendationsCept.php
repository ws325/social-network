<?php

use Illuminate\Support\Facades\Hash;

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('Check reccomendations');

$I->haveInDatabase('users',['name'=>'Test1','email'=>'testowy@gmail.com','password'=>'$2y$10$22ozDY6.JjlM6SnOSi3JoO2kn5cgan8mn28eD3o3fKk0lyAiAnvvO','nick'=>'T.1','id'=>333]);
$I->haveInDatabase('users',['name'=>'Test2','email'=>'1','password'=>'haslo','nick'=>'T.2','id'=>334]);
$I->haveInDatabase('users',['name'=>'Test3','email'=>'2','password'=>'haslo','nick'=>'T.3','id'=>335]);
$I->haveInDatabase('users',['name'=>'Test4','email'=>'3','password'=>'haslo','nick'=>'T.4','id'=>336]);

$I->haveInDatabase('followers',['follower_id'=>333,'user_id'=>334, 'notification_id'=> 15]);
$I->haveInDatabase('followers',['follower_id'=>333,'user_id'=>335, 'notification_id'=> 16]);
$I->haveInDatabase('followers',['follower_id'=>334,'user_id'=>336, 'notification_id'=> 17]);
$I->haveInDatabase('followers',['follower_id'=>335,'user_id'=>336, 'notification_id'=> 18]);

$I->amOnPage('/login');

$I->fillField('email', 'testowy@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('');
$I->click('Profile');
$I->see('T.1');

$I->click('Home');
$I->see('Test4 mutual users: 2');
