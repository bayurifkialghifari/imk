<?php
		
	namespace App\Models;

	use App\Core\Model;

	Class M_user extends Model
	{
		/**
		* @var
		* parent::store @param
		* 
		*				table, 
		*			 	@var data array 
		* 
		* parent::update @param
		* 
		*				@var where  array, 
		*				table, 
		*				@var data array
		* 
		* parent::delete @param
		*
		*				@var where  array, 
		*				table, 
		*
		*/

		/** 
		* Example store data
		*
		*/
		public function add()
		{
			parent::store('table', [
				'test' => 'st',
				'test' => 'ts',
			]);
		}

		/** 
		* Example update data
		*
		*/
		public function update()
		{
			parent::update(['id' => 1], 'table', [
				'test' => 'st',
				'test' => 'ts',
			]);
		}

		/** 
		* Example delete data
		*
		*/
		public function delete()
		{
			parent::delete(['id' => 1], 'table');
		}
	}