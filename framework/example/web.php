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
	$app->add('/', 'Home');
	
	$app->add('/test_email', 'Home', 'email');
	
	$app->add('/test_orm', 'Home', 'orm');
	
	$app->add('/test_upload', 'Home', 'upload_view');
	$app->add('/test_upload', 'Home', 'upload_exe', 'post');

	$app->add('/test_pagination', 'Home', 'pagination');
	$app->add('/test_pagination_handler/:id', 'Home', 'pagination_handler');
	$app->add('/test_auth', 'Home', 'auth', 'post');

	$app->run('/');
