<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\HomeProductModel;

class HomeProductController extends BaseController
{
    public function __construct()
    {
        $this->product = new HomeProductModel();
        date_default_timezone_set('Asia/Jakarta');
    }    
    public function index()
    {
        $category = $this->product->select_data("master.category", " color_card, id, name ", " where status = 1 order by name asc ")->getResult();
        
        $data['content'] ='homeProduct/index';
        $data['title'] ='product';
        $data['category'] = $category;
        return view('template', $data);
    }

    public function getProduct()
    {
        $getProduct = $this->product->getProduct();

        $data["data"] = $getProduct;
        $data["code"] = 1;
        $data["message"] = 'success';

        echo json_encode($data);

        
    }
}
