<?php

/**
 * --------------------------------------------------------------------
 * CODEIGNITER 4 - SimpleAuth
 * --------------------------------------------------------------------
 *
 * This content is released under the MIT License (MIT)
 *
 * @package    SimpleAuth
 * @author     GeekLabs - Lee Skelding 
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://github.com/GeekLabsUK/SimpleAuth
 * @since      Version 1.0
 * 
 */

 namespace App\Controllers;

class Superadmin extends BaseController
{
	public function index()
	{
		$data = [];
		$db = \Config\Database::connect();

		$today = date('Y-m-d');
		$first_day = date('Y-m').'-01';
		$last_day = date('Y-m-t');

		$sql = 'SELECT 
		DATE_FORMAT(created_at, "%Y-%m-%d") AS `day_date`, 
		SUM(orders.total_amount) `main_total`, 
		COUNT(*) `total_orders`
		FROM orders
		WHERE 
		orders.created_at >= "2021-03-01 00:00:00"
		AND orders.created_at <= "2021-03-31 23:59:59"
		GROUP BY DATE_FORMAT(created_at, "%Y-%m-%d")
		ORDER BY day_date asc';

		$sql_orders_today = 'SELECT 
		DATE_FORMAT(created_at, "%Y-%m-%d") AS `day_date`, 
		SUM(orders.total_amount) `main_total`, 
		COUNT(*) `total_orders`
		FROM orders
		WHERE 
		orders.created_at >= "'.$today.' 00:00:00"
		AND orders.created_at <= "'.$today.' 23:59:59"
		GROUP BY DATE_FORMAT(created_at, "%Y-%m-%d")
		ORDER BY day_date ASC';

		$sql_orders_month = 'SELECT 
		DATE_FORMAT(created_at, "%Y-%m") AS `day_date`, 
		SUM(orders.total_amount) `main_total`, 
		COUNT(*) `total_orders`
	FROM orders
	WHERE 
	orders.created_at >= "'.$first_day.' 00:00:00"
	AND orders.created_at <= "'.$last_day.' 23:59:59"
	GROUP BY DATE_FORMAT(created_at, "%Y-%m")
	ORDER BY day_date ASC';

		$db = \Config\Database::connect();
		$query = $db->query($sql);
		$query_month = $db->query($sql_orders_month);
		$query_today = $db->query($sql_orders_today);

		$data['graph'] = $query->getResultArray();
		$data['month_data'] = $query_month->getResultArray();
		$data['today_data'] = $query_month->getResultArray();

		return view('ecom-dashboard', $data);
	}

	//--------------------------------------------------------------------

}
