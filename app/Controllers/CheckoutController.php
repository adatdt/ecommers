<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CheckoutModel;

class CheckoutController extends BaseController
{    
    public function __construct()
    {
        $this->checkout = new CheckoutModel();
        $this->db = db_connect();
        date_default_timezone_set('Asia/Jakarta');
    }    
    public function index()
    {

        $data['content'] ='checkout/index';
        $data["typeMenu"] = 1;
        $data['title'] ='Checkout';
        return view('template', $data);
    }
    public function getData(){
        $data = json_decode($this->request->getpost("data"));
        $whereId = implode(",",array_column($data,"id"));
        $product = $this->checkout->select_data("master.product", "  id,  price ", " where id in ($whereId) ")->getResult();
        $masterPrice = array_combine(array_column($product,"id"),array_column($product,"price") );

        $returnData = [];
        foreach ($data as $key => $value) {
            $value->price = @$masterPrice[$value->id];
            $value->total_price = $value->price * $value->qty;
            $returnData[] = $value;
        }

        echo json_encode($returnData);
                
    }
    public function savePayment(){
        $id = $this->request->getpost("id[]");
        $qty = $this->request->getpost("qty[]");
        $expedition = $this->request->getpost("expedition");
        $payment = $this->request->getpost("payment");
        $address = $this->request->getpost("address");
        $fare_expedition = $this->request->getpost("fare_expedition");
        

        $whereId = implode(",",$id);
        $product = $this->checkout->select_data("master.product", "  id,  price ", " where id in ($whereId) ")->getResult();
        $masterPrice = array_combine(array_column($product,"id"),array_column($product,"price") );
        $transactionCode = "trx_".date("YmdHis");
        $dataDetail = [];
        $grandTotal = 0;
        foreach ($id as $key => $value) {
            $total_price = $qty[$key] * $masterPrice[$value];
            $grandTotal += $total_price;
            $detail = array(
                    "transaction_code" =>$transactionCode,
                    "id_product" => $value,
                    "qty" => @$qty[$key],
                    "total_price" => $total_price,
                    "status" => 1,
                    "created_on" =>date("Y-m-d H:i"),
                    "created_by" => "Customer"
            );
             $dataDetail[] = $detail;
        }
        $dataTrx = array(
                    "transaction_code" =>$transactionCode,
                    "expedition" => $expedition,
                    "fare_expedition" => $fare_expedition,
                    "payment_type" => $payment,
                    "address" => $address,
                    "grand_total" => $grandTotal + $fare_expedition,
                    "status" => 1,
                    "created_on" =>date("Y-m-d H:i"),
                    "created_by" => "Customer"
            );  

        $this->db->transBegin();        
        $this->checkout->insert_data("trx.t_transaction",$dataTrx);
        $this->checkout->insert_data_batch("trx.t_transaction_detail",$dataDetail);
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $return = array("code"=>0, "messege"=>"gagal");
        } else {
            $this->db->transCommit();
            $return = array("code"=>1, "messege"=>"ssuccess");
        }            
         echo json_encode($return);
    }
}
