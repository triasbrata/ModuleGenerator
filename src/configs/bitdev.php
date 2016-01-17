<?php return [
	'generate'=>[
		'namespace'=>[
			/**
			 * namespase default dari project yang sedang di kerjakan, secara default adalah App
			 */
			'project'=>'',
			/**
			 * namespace default dari model yang akan kita gunakan 
			 */
			'model'=>'',

			/**
			 * namespace default dari FormRequsest yang akan di gunakan
			 */
			'formRequest'=>'',
			/**
			 * pengaturan ini akn menyimpan namespace yang akan di hilangkan pada saat generate
			 * module, contohnya : /App/Http/Controllers/Admin/User/TesController, dari namespace tadi
			 * di hapus /App/Http/Controllers/ atau /App/Http/Controllers/Admin, Controller, Sehingga
			 * tinggal User/Tes. dan akan tampil menjadi User Tes untuk module name dan user.tes untuk 
			 * prefix
			 */
			'remove'=>[
				'prefix'=>array(), 
				'modulename'=>array() 
			]  
		],
		/**
		 * pengaturan untuk mengganti module name yang tidak sesuai degngan kata yang lebih tepat
		 */
		'modulename'=>array(),
		/**
		 * untuk mengganti prefix yang tidak sesuai dengan prefix yang lebih cocok
		 * FBI => F_B_I kurang bagus lalu di gantik menjadi fbi
		 */
		'prefixFixer'=>array(),
		/**
		 * pengaturan basepath dari applikasi
		 */
		'basepath' => [
			'apps'=>base_path('/app'),
			'view'=>base_path('resources/view')
		],
	],


];