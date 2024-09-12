<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;

    protected $allowedFields = ['nama'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    function dropdown() {
        $kategori = $this->findAll();
        $to_return = [ '' => '[ -- Sila pilih kategori -- ]' ];
        foreach($kategori as $kat) {
            $to_return[ $kat['id'] ] = $kat['nama'];
        }

        return $to_return;
    }
}