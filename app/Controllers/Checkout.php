<?php

namespace App\Controllers;

class Checkout extends BaseController
{

    var $negeri = [
        '' => '[ -- sila pilih negeri -- ]',
        'WP Kuala Lumpur' => 'WP Kuala Lumpur',
        'WP Putrajaya' => 'WP Putrajaya',
        'WP Labuan' => 'WP Labuan',
        'Selangor' => 'Selangor',
        'Perak' => 'Perak',
        'Kedah' => 'Kedah',
        'Pulau Pinang' => 'Pulau Pinang',
        'Perlis' => 'Perlis',
        'Kelantan'=> 'Kelantan',
        'Terengganu' => 'Terengganu',
        'Pahang' => 'Pahang',
        'Johor' => 'Johor',
        'Melaka' => 'Melaka',
        'Negeri Sembilan' => 'Negeri Sembilan',
        'Sabah' => 'Sabah',
        'Sarawak' => 'Sarawak'
    ];

    function __construct() {
        $this->data['negeri'] = $this->negeri;
        $this->data['page_title'] = "Checkout";

		$this->session = session();

		$this->orders_model = new \App\Models\OrdersModel();
		$this->order_items_model = new \App\Models\OrderItemsModel();
		$this->payments_model = new \App\Models\PaymentsModel();

    }

    function index() {
        return view('checkout.php', $this->data);
    }

    private function get_cart_items() {
        if ( isset($_SESSION['cart']['items'])  )  {
            return count($_SESSION['cart']['items']);
        }
        return 0;
    }

    private function get_cart_qty() {
        $qty = 0;
        if (
            isset($_SESSION['cart']['items']) 
            && (count($_SESSION['cart']['items']) > 0) 
        ) {
            foreach($_SESSION['cart']['items'] as $item) {
                $qty += $item['qty'];
            }
        }
        return $qty;
    }

    private function get_cart_total_amount() {
        $total_amount = 0;
        if (
            isset($_SESSION['cart']['items']) 
            && (count($_SESSION['cart']['items']) > 0) 
        ) {
            foreach($_SESSION['cart']['items'] as $item) {
                $total_amount += ( $item['harga'] * $item['qty'] );
            }
        }
        return $total_amount;
    }

    function process_checkout() {
        // echo "processing checkout";
        // dd($_POST);

        $validation =  \Config\Services::validation();

        $validation->setRule('nama_penuh', 'Nama Penuh', 'required|min_length[3]');
        $validation->setRule('email', 'Email', 'required|valid_email');
        $validation->setRule('nombor_telefon', 'Nombor Telefon', 'required|min_length[10]');
        $validation->setRule('alamat_1', 'Alamat 1', 'required|min_length[10]');
        $validation->setRule('daerah', 'Daerah', 'required|min_length[3]');
        $validation->setRule('poskod', 'Poskod', 'required|exact_length[5]|numeric');
        $validation->setRule('negeri', 'Negeri', 'required');

        if ($validation->run($_POST)) {
            helper('text');

            $order_no = random_string('alnum', 10);

            $payment_data = [
                'nama_penuh' => $this->request->getPost('nama_penuh'),
                'email' => $this->request->getPost('email'),
                'order_no' => $order_no,
                'nombor_telefon' => $this->request->getPost('nombor_telefon'),
                'alamat_1' => $this->request->getPost('alamat_1'),
                'alamat_2' => $this->request->getPost('alamat_2'),
                'poskod' => $this->request->getPost('poskod'),
                'daerah' => $this->request->getPost('daerah'),
                'negeri' => $this->request->getPost('negeri'),
                'total_amount' => $this->get_cart_total_amount(),
                'qty' => $this->get_cart_qty(),
                'items' => $this->get_cart_items(),
                'status' => 'pending payment'
            ];

            $order_id = $this->orders_model->insert($payment_data);
            // $qty = $this->request->getPost('qty');

            $payment_data['order_id'] = $order_id;
            $payment_data['items'] = [];

            foreach( $_SESSION['cart']['items'] as $item ) {
                $order_item = [
                    'order_id' => $order_id,
                    'produk_id' => $item['id'],
                    'harga' => $item['harga'],
                    'qty' => $item['qty']
                ];

                $payment_data['items'][] = $order_item;

                $this->order_items_model->insert($order_item);
            }

            $payment_gateway = $this->request->getPost('payment_gateway');
            $this->payments_model->insert([
                'payment_gateway' => $payment_gateway,
                'data' => date('Y-m-d H:i:s')."\n".json_encode($payment_data)."\n",
                'order_no' => $order_no,
                'status' => 'pending'
            ]);

            $payment_data['redirect_url'] = site_url('checkout/redirect/'.$payment_gateway);
            $payment_data['callback_url'] = site_url('checkout/callback/'.$payment_gateway);

            switch($payment_gateway) {
                case 'securepay' :
                    $sp = new \App\Libraries\Payments\SecurePay('sandbox');
                    $sp->go($payment_data);
                    break;
            }

        } else {
            // echo "please complete form";

            $_SESSION['form_data'] = $_POST;
            $_SESSION['form_errors'] = $validation->getErrors();
            $_SESSION['form_failed'] = true;

            $this->session->markAsFlashdata('form_data');    
            $this->session->markAsFlashdata('form_errors');    
            $this->session->markAsFlashdata('form_failed');    

            return redirect()->back();

        }

    }

    function redirect( $payment_gateway = '' ) {
        if ($payment_gateway == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        switch( $payment_gateway) {
            case 'securepay' :
                $sp = new \App\Libraries\Payments\SecurePay('development');
                $order_no = $this->request->getPost('order_number');
                $payment_status = $this->request->getPost('payment_status');
                break;
        }

        if ($sp->verify()) {

            $payment = $this->payments_model->where('order_no', $order_no )->first();
            $order = $this->orders_model->where('order_no', $order_no )->first();

            if($payment_status == 'true') {
                $payment['status'] = 'success';
                $order['status'] = 'success';
            } else {
                $payment['status'] = 'failed';
                $order['status'] = 'failed';
            }

            $payment['data'] .= "\n".date('Y-m-d H:i:s')."\n".json_encode($_POST)."\n";

            $this->payments_model->update($payment['id'], $payment);
            $this->orders_model->update($order['id'], $order);

        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($payment_status == 'true') {
            return redirect()->to('/checkout/thankyou/'.$order_no);
        } 

        return redirect()->to('/cart');


        // echo "<pre>";
        // echo $payment_gateway;
        // var_dump($_POST);
        // echo "</pre>";
    }

    function thankyou($order_no = '') {
        $this->data['page_title'] = "Thank you for your purchase";

        if ($order_no == '') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->data['order'] = $this->orders_model->where('order_no', $order_no )->first();

        if ((!$this->data['order']) || ($this->data['order']['status'] != 'success')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->data['order_items'] = $this->order_items_model->where('order_id', $this->data['order']['id'] )->findAll();

        $produk_ids = [];
        foreach($this->data['order_items'] as $items) {
            $produk_ids[] = $items['produk_id'];
        }

		$produk_model = new \App\Models\ProdukModel();

        $produks = $produk_model->find($produk_ids);

        $produk2 = [];
        foreach($produks as $p) {
            $produk2[ $p['id'] ] = $p;
        }

        $this->data['produk'] = $produk2;

        return view('thankyou', $this->data);

    }

}