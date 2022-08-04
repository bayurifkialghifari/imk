<?php

	use App\Core\Route;

	$app 			= new Route;

	/** 
	* 	@var
	*  
	*	$app->add( 'Alamat web', 
	*				'Class yang ada dicontroller contoh `Ggwp\Anjay` or `Anjay`', 
	*				'Method class `index`', 
	* 				'Method request `post, get, put, delete`');
	*   @param
	*   Ketik '/:id/id2/id3' pada alamat web untuk mengirimkan parameter
	*/

	// Router
	$app->add('/', '\Dashboard');

	// Master data 
	$app->add('/bahan', '\Bahan');
	$app->add('/bahan/insert', '\Bahan', 'insert', 'post');
	$app->add('/bahan/update', '\Bahan', 'update', 'post');
	$app->add('/bahan/delete', '\Bahan', 'delete', 'post');

	$app->add('/meja', '\Meja');
	$app->add('/meja/insert', '\Meja', 'insert', 'post');
	$app->add('/meja/update', '\Meja', 'update', 'post');
	$app->add('/meja/delete', '\Meja', 'delete', 'post');

	$app->add('/tipe', '\Tipe');
	$app->add('/tipe/insert', '\Tipe', 'insert', 'post');
	$app->add('/tipe/update', '\Tipe', 'update', 'post');
	$app->add('/tipe/delete', '\Tipe', 'delete', 'post');


	// User Management
	$app->add('/role', '\Role');
	$app->add('/role/insert', '\Role', 'insert', 'post');
	$app->add('/role/update', '\Role', 'update', 'post');
	$app->add('/role/delete', '\Role', 'delete', 'post');

	$app->add('/user', '\User');
	$app->add('/user/insert', '\User', 'insert', 'post');
	$app->add('/user/update', '\User', 'update', 'post');
	$app->add('/user/delete', '\User', 'delete', 'post');

	// Auth
	$app->add('/login', '\Auth\Login');
	$app->add('/doLogin', '\Auth\Login', 'doLogin', 'post');
	$app->add('/logout', '\Auth\Login', 'logout');

	$app->run('/');
