<?php

namespace App\Controllers;

class Gambar extends BaseController
{


	function __construct() {
		$this->session = session();

	}

	public function index()
	{
		$gambar_model = new \App\Models\GambarModel();

        $data = [
            'gambar' => $gambar_model->orderBy('id', 'desc')->paginate(3),
            'pager' => $gambar_model->pager,
        ];

		return view('admin/listing', $data );
	}

	function edit($id) {
		$gambar_model = new \App\Models\GambarModel();
	 	$rekod = $gambar_model->find( $id );

		return view('admin/edit', [ 'gambar' => $rekod ]);
	}

	function save_edit($id) {
		$gambar_model = new \App\Models\GambarModel();

		$data = [
			'nama' => $this->request->getPost('nama'),
			'keterangan' => $this->request->getPost('keterangan')
		];

		$file = $this->request->getFile('nama_fail');

		// Grab the file by name given in HTML form
		if ($file)
		{		
			// Generate a new secure name
			$nama_fail = $file->getRandomName();
		
			// Move the file to it's new home
			$file->move('img/', $nama_fail);

			$data['nama_fail'] = $nama_fail;
		
		}
		$gambar_model->update($id, $data);

		$_SESSION['success'] = true;
		$this->session->markAsFlashdata('success');

		return redirect()->to('/gambar/edit/'. $id);

	}


	function delete( $id ) {
		$gambar_model = new \App\Models\GambarModel();
		$gambar_model->where('id', $id)->delete();

		$_SESSION['deleted'] = true;
		$this->session->markAsFlashdata('deleted');

		return redirect()->back();
	}

	function add() {		
		return view('admin/add');
	}

	// untuk save data dari add new form
	function save_new() {
		$gambar_model = new \App\Models\GambarModel();

		$data = [
			'nama' => $this->request->getPost('nama'),
			'keterangan' => $this->request->getPost('keterangan')
		];

		$file = $this->request->getFile('nama_fail');

		//dd($files);

		// Grab the file by name given in HTML form
		if ($file)
		{		
			// Generate a new secure name
			$nama_fail = $file->getRandomName();
		
			// Move the file to it's new home
			$file->move('img/', $nama_fail);

			$data['nama_fail'] = $nama_fail;
		
		}

		$gambar_model->insert( $data );

		$_SESSION['success'] = true;
		$this->session->markAsFlashdata('success');

		return redirect()->to('/gambar');

		// echo "<h1>HELOO ... saya akan save data</h1>";
	}
}
