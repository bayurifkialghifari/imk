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
	// User Management
	$app->add('/film', '\Film');
	$app->add('/film/insert', '\Film', 'insert', 'post');
	$app->add('/film/update', '\Film', 'update', 'post');
	$app->add('/film/delete', '\Film', 'delete', 'post');


	$app->add('/studio', '\Studio');
	$app->add('/studio/insert', '\Studio', 'insert', 'post');
	$app->add('/studio/update', '\Studio', 'update', 'post');
	$app->add('/studio/delete', '\Studio', 'delete', 'post');


	// jadwal tayang
	$app->add('/jadwal', '\Jadwal');
	$app->add('/jadwal/insert', '\Jadwal', 'insert', 'post');
	$app->add('/jadwal/update', '\Jadwal', 'update', 'post');
	$app->add('/jadwal/delete', '\Jadwal', 'delete', 'post');

	// Pegawai
	$app->add('/pegawai', '\Pegawai');
	$app->add('/pegawai/insert', '\Pegawai', 'insert', 'post');
	$app->add('/pegawai/update', '\Pegawai', 'update', 'post');
	$app->add('/pegawai/delete', '\Pegawai', 'delete', 'post');

	// Auth
	$app->add('/login', '\Auth\Login');
	$app->add('/doLogin', '\Auth\Login', 'doLogin', 'post');
	$app->add('/logout', '\Auth\Login', 'logout');

	$app->run('/');
