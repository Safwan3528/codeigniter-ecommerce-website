<?php

namespace App\Controllers;

class Bakul extends BaseController
{

    function __construct() {
		$this->produk_model = new \App\Models\ProdukModel();
		$this->session = session();
        $this->data['page_title'] = "My Cart";
    }

    // /bakul --- display items in cart
    public function index() {
        return view('bakul', $this->data);
    }

    // add to cart functionality -- receives POST data 
    function add() {
        // get data from form
        $produk_id = $this->request->getPost('produk_id');
        $qty = $this->request->getPost('qty');

        // find produk from database
        $produk = $this->produk_model->find( $produk_id );

        // if product found, add to cart
        if ($produk) {
            $this->add_cart( $produk['id'], $produk['nama'], $produk['harga'], $qty );
            $_SESSION['success'] = true;
            $this->session->markAsFlashdata('success');    
        }
        return redirect()->back();

    }

    function remove( $id ) {
        foreach($_SESSION['cart']['items'] as $k => $item) {
            if ($item['id'] == $id) {
                unset($_SESSION['cart']['items'][$k]);
            }
        }

        $_SESSION['success'] = true;
        $this->session->markAsFlashdata('success');    
        return redirect()->back();

    }

    function update() {
        //dd($_POST);
        $_SESSION['cart'] = [
            'items' => []
        ];

        $qty = $this->request->getPost('qty');

        if (is_array($qty)) {
            $all_ids = array_keys($qty);

            $produks = $this->produk_model->find( $all_ids );
    
            foreach($produks as $produk) {
                if ($qty[ $produk['id'] ] > 0) {
                    $this->add_cart( $produk['id'], $produk['nama'], $produk['harga'], $qty[ $produk['id'] ] );
                }
            }
    
            $_SESSION['success'] = true;
            $this->session->markAsFlashdata('success');    
    
        } else {
            $_SESSION['empty'] = true;
            $this->session->markAsFlashdata('empty');    

        }

        return redirect()->back();

    }

    // internal function -- add items to session (cart)
    protected function add_cart( $id, $nama, $harga, $qty ) {
        if (!isset($_SESSION['cart']['items'])) {
            $_SESSION['cart'] = [
                'items' => []
            ];
        }

        // see if item alreay in cart
        $found = false;
        foreach( $_SESSION['cart']['items'] as $index => $item) {
            if ($item['id'] == $id) {
                $_SESSION['cart']['items'][$index]['qty'] += $qty;
                $found = true;
            }
        }

        // process if item never added to cart before
        if (!$found) {
            $_SESSION['cart']['items'][] = [
                'id' => $id,
                'nama' => $nama,
                'harga' => $harga,
                'qty' => $qty
            ];
        }

        return true;
    }
}
