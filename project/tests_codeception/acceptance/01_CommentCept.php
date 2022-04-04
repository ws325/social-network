<?php

$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('add new comment');

$I->amOnPage('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$id = $I->grabFromDatabase('users', 'id', [
    'nick' => "J.Doe"
]);

$I->seeCurrentUrlEquals('/');

$I->click('Profile');

$I->seeCurrentUrlEquals('/profile/'.$id);

$postId = $I->grabFromDatabase('posts', 'id', [
    'text' => "Co tam? #how_you_doin? #ghd"
]);
$I->amOnPage('/posts/'.$postId);

$comment="some comment";

$I->fillField('comment', $comment);

$I->click('Create');

$I->seeCurrentUrlEquals('/posts/'.$postId);

$I->seeInDatabase('comments', ['text'=>$comment]);

$I->see($comment);

$I->wantTo('delete comment');

$I->click('Delete',"#delete");

$I->seeCurrentUrlEquals('/posts/'.$postId);

$I->dontSeeInDatabase('comments', ['text'=>$comment]);
