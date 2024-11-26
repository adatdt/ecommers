<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeProductModel extends Model
{
    protected $table            = 'homeproducts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

     public function select_data($table, $field, $where)
    {
        $qry = "select $field from $table $where ";            
        $return = $this->db->query($qry);
        return   $return;

    }
     public function getProduct()
    {
        $qryProduct = "SELECT 
                                p.id, 
                                p.name, 
                                p.price,
                                p.minimum_order,
                                p.condition,
                                p.description,
                                p.created_on,
                                c.name as category,
                                p.warranty, 
                                p.brand, 
                                p.stock
                            from master.product p  
                            join master.category c on p.id_category = c.id 
                            where p.status=1 
                            order by p.created_on   desc
                 ";            
        $product = $this->db->query($qryProduct)->getResult();

        $dataProduct = [];
        foreach ($product as $keyProduct => $valuePoduct) {
            $valuePoduct->created_on = date("m-d-Y", strtotime($valuePoduct->created_on));
            $dataProduct[] = $valuePoduct;
        }
        $images = [];
        if($product)
        {
            $idProduct = array_column($product,"id");
            $implode = implode(",", $idProduct);
            $getImages = $this->select_data("master.product_image", " id_product, path"," where id_product in ($implode) ")->getResult();

             foreach ($getImages as $key => $value) {
                $images[$value->id_product][] = $value->path;
             }
        }

        $data = array( "data"=>$dataProduct, "images" => $images);
        return   $data;

    }


}
