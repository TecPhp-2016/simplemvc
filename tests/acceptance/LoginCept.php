<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/mvc/user/login');
$I->see('Usuario');
$I->see('Password');
$I->submitForm('#formlogin', 
    array('username' => 'usuario1',
          'password' =>  'password1',
            'Login' => 'Login'
          )
  );

$I->see('Bienvenido usuario1');



