<?php

namespace App\Controllers;

class Kategori extends BaseController
{

	function __construct() {
		$this->session = session();
		$this->kategori_model = new \App\Models\KategoriModel();
	}

	public function index()
	{

        $data = [
            'kategori' => $this->kategori_model->orderBy('id', 'desc')->paginate(10),
            'pager' => $this->kategori_model->pager,
        ];

		return view('admin_kategori/listing', $data );
	}

	function edit($id) {

	 	$kategori = $this->kategori_model->find( $id );

		return view('admin_kategori/edit', [ 
            'kategori' => $kategori
        ]);
	}

    function slug($slug) {
        $kategori = $this->kategori_model->where('slug', $slug)->first();
		return view('admin_kategori/edit', [ 
            'kategori' => $kategori
        ]);
    }

	function save_edit($id) {
		$data = [
			'nama' => $this->request->getPost('nama'),
			'keterangan' => $this->request->getPost('keterangan'),
			'harga' => $this->request->getPost('harga')
		];

		$this->kategori_model->update($id, $data);

		$_SESSION['success'] = true;
		$this->session->markAsFlashdata('success');

		return redirect()->to('/kategori/edit/'. $id);

	}


	function delete( $id ) {
		$this->kategori_model->where('id', $id)->delete();

		$_SESSION['deleted'] = true;
		$this->session->markAsFlashdata('deleted');

		return redirect()->back();
	}

	function add() {		
		return view('admin_kategori/add');
	}

	// untuk save data dari add new form
	function save_new() {
		$data = [
			'nama' => $this->request->getPost('nama'),
			'keterangan' => $this->request->getPost('keterangan'),
			'harga' => $this->request->getPost('harga')
		];

		$this->kategori_model->insert( $data );

		$_SESSION['success'] = true;
		$this->session->markAsFlashdata('success');

		return redirect()->to('/kategori');

		// echo "<h1>HELOO ... saya akan save data</h1>";
	}
}
