<?php

namespace App\Controllers;

class Produk extends BaseController
{

    var $produk_img_location = 'img/produk/';

	function __construct() {
		$this->session = session();
		$this->produk_model = new \App\Models\ProdukModel();
		$this->kategori_model = new \App\Models\KategoriModel();
	}

    public function homepage() {

		$kategori = $this->kategori_model->dropdown();
		$data = [
			'produk' => $this->produk_model->orderBy('id', 'desc')->paginate(10),
			'pager' => $this->produk_model->pager,
			'produk_img_location' => $this->produk_img_location,
			'kategori' => $kategori
		];

		$this->data = array_merge( $this->data, $data );

		return view('produk_homepage', $this->data);
    }

	public function index()
	{

		$kategori = $this->kategori_model->dropdown();
        $data = [
            'produk' => $this->produk_model->orderBy('id', 'desc')->paginate(10),
            'pager' => $this->produk_model->pager,
			'kategori' => $kategori
        ];

		return view('admin_produk/listing', $data );
	}

	function edit($id) {

		$produk = $this->produk_model->find( $id );
		$kategori = $this->kategori_model->dropdown();

		return view('admin_produk/edit', [ 
			'kategori' => $kategori,
            'produk' => $produk,
            'produk_img_location' => $this->produk_img_location
        ]);
	}

    function slug($slug) {
        $produk = $this->produk_model->where('slug', $slug)->first();
		return view('admin_produk/edit', [ 
            'produk' => $produk,
            'produk_img_location' => $this->produk_img_location
        ]);
    }

	function save_edit($id) {
		$data = [
			'nama' => $this->request->getPost('nama'),
			'keterangan' => $this->request->getPost('keterangan'),
			'harga' => $this->request->getPost('harga')
		];

		if ($this->request->getPost('kategori_id') != '0') {
			$data['kategori_id'] = $this->request->getPost('kategori_id');
		}

		$file = $this->request->getFile('gambar');
        //dd($file);
		// Grab the file by name given in HTML form
		if ($file->isReadable())
		{		
			// Generate a new secure name
			$file_gambar = $file->getRandomName();
		
			// Move the file to it's new home
			$file->move( $this->produk_img_location , $file_gambar);

			$data['gambar'] = $file_gambar;
		
		}

        //dd($data);


		$this->produk_model->update($id, $data);

		$_SESSION['success'] = true;
		$this->session->markAsFlashdata('success');

		return redirect()->to('/produk/edit/'. $id);

	}


	function delete( $id ) {
		$this->produk_model->where('id', $id)->delete();

		$_SESSION['deleted'] = true;
		$this->session->markAsFlashdata('deleted');

		return redirect()->back();
	}

	function add() {		

		$kategori = $this->kategori_model->dropdown();

		return view('admin_produk/add', [ 'kategori' => $kategori ]);
	}

	// untuk save data dari add new form
	function save_new() {
		$data = [
			'nama' => $this->request->getPost('nama'),
			'keterangan' => $this->request->getPost('keterangan'),
			'harga' => $this->request->getPost('harga')
		];

		if ($this->request->getPost('kategori_id') != '0') {
			$data['kategori_id'] = $this->request->getPost('kategori_id');
		}

		$file = $this->request->getFile('gambar');
		// Grab the file by name given in HTML form
		if ($file->isReadable())
		{		
			// Generate a new secure name
			$file_gambar = $file->getRandomName();
		
			// Move the file to it's new home
			$file->move($this->produk_img_location, $file_gambar);

			$data['gambar'] = $file_gambar;
		
		}

		$this->produk_model->insert( $data );

		$_SESSION['success'] = true;
		$this->session->markAsFlashdata('success');

		return redirect()->to('/produk');

		// echo "<h1>HELOO ... saya akan save data</h1>";
	}
}
