<?php

$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('add new post');

$I->amOnPage('/login');

$I->fillField('email', 'joseph.doe@gmail.com');
$I->fillField('password', 'itsasecret');

$I->click('Log in');

$id = $I->grabFromDatabase('users', 'id', [
    'nick' => "Joseph"
]);

$I->amOnPage('/');
$I->click('Tweet');
$I->amOnPage('/posts/create');

$I->see("Add tweet");

$text = "something interesting";

$I->click('Tweetnij');

$I->seeCurrentUrlEquals('/posts/create');

$I->see('The tweet field is required.', 'li');

$I->fillField('tweet', $text);

$I->click('Tweetnij');

$I->seeCurrentUrlEquals('/profile/'.$id);

$I->dontSee("You don't have any tweets yet.");

$I->see($text);

$I->see('Edit');

$I->see('Delete');

$I->see('Comments');

$I->wantTo('edit new post');

$I->click('Edit');

$postId = $I->grabFromDatabase('posts', 'id', [
    'text' => $text
]);

$I->see($text);

$I->fillField('tweet', "");

$I->click('Edit');

$I->see('The tweet field is required.', 'li');

$text = "updated interesting post";

$I->fillField('tweet', $text);

$I->click('Edit');

$I->seeCurrentUrlEquals('/profile/'.$id);

$I->see($text);

$I->seeInDatabase('posts',['text'=>$text]);

$I->wantTo('delete new post');

$I->click('Delete');

$I->dontSeeInDatabase('posts',['text'=>$text]);

