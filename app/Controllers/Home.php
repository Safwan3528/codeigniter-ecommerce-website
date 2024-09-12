<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{

		$db = db_connect();

		$result = $db->query('SELECT * FROM gambar ORDER BY nama asc');
		$all_pekan = $result->getResult();

		//dd( $all_pekan );

		return view('homepage', [ 'all_pekan' => $all_pekan ]);
	}

	function hello() {
		echo "<h1>Hello...</h1>";
	}

	function welcome() {
		echo "<h1>Welcome</h1>";
	}
}
