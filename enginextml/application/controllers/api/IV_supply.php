<?php 
use Restserver\Libraries\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestServer/RestController.php';
require APPPATH . 'libraries/RestServer/Format.php';
class IV_supply extends RestController{
 function __construct()
 {
       parent::__construct();
      $this->load->model(array('IV_supply_model','Users_model','IV_inventory_model'));
 } 
 /*
* Listing of IV_supply
 */
function checktoken()
{
   $token = $_SERVER['HTTP_TOKEN'];
   $user = $this->Users_model->checktoken($token);
   if($user && $user != null)
   {
     return $user['user_id'];
   }
   return 0;
}
public function get_all_post()
{
  try{
  $data['IV_supply'] = $this->IV_supply_model->get_all_IV_supply();
     if($data['IV_supply'] && $data['IV_supply']!=null){
       $IV_supply_ar = array();
       foreach($data['IV_supply'] as $I)
       {
       $I_ar = array();
       $I_ar['supply_id'] = $I['supply_id'];
       $I_ar['description'] = $I['description'];
       $I_ar['amount'] = $I['amount'];
       $I_ar['created_at'] = $I['created_at'];
       $I_ar['updated_at'] = $I['updated_at'];
       $IV_supply_ar[] = $I_ar;
       }
       $response = array(
       'status' => 200,
       'message' => 'get all data Succesfully',
       'data' => $IV_supply_ar,
       );
       $this->response($response, RestController::HTTP_OK);
     }
     else{
       $response = array(
      'status' => 400,
      'message' => 'Detail is not found'
        );
       $this->response($response, RestController::HTTP_OK); 
        }
       } catch (Exception $ex) {
             throw new Exception('IV_supply controller_name : Error in get_all_post function - ' . $ex);
        }  
}
 /*
  * Adding a new IV_supply
  */
 function addnew_post()
 {  
  try{
    $id = $this->checktoken();
    if($id ==0)
    {
      $response = array(
        'status' => 401,
        'message' => 'Authentication failed',
        'data' => new stdClass(),
        );
        $this->response($response, RestController::HTTP_FORBIDDEN);  
    }
      $params = array(
       'description'=> $this->input->post('description'),
       'amount'=> $this->input->post('amount'),
       'owner_id' =>$id,
       'created_at'=> $this->input->post('created_at')
        );
       if(isset($_POST) && count($_POST) > 0)     
        {  
            $supply_id= $this->IV_supply_model->add_IV_supply($params);
            if($supply_id)
            {
              $products =json_decode($this->input->post('products'),true);
              foreach($products as $p)
              {
                $product = $this->db->query('select product_id from iv_products where product_id = "' .addslashes($p['product_id']) . '"')->row_array();
                if($product)
                {
                $params = array(
                  'product_id'=> $product["product_id"],
                  'quantity'=> $p['quantity'],
                  'unitprice'=> $p['rate'],
                  'quantity_supplied'=> $p['quantity'],
                  'owner_id' =>$id,
                  'created_at'=> $this->input->post('created_at'),
                  'supply_id'=> $supply_id,
                   );
                   $inventory_id= $this->IV_inventory_model->add_IV_inventory($params);
                  }
              }
              $data['IV_supply'] = $this->IV_supply_model->get_IV_supply($supply_id);
            $response = array(
            'status' => 200,
            'message' => 'Succesfully Added',
            'data' => $params,
             );
           $this->response($response, RestController::HTTP_OK);
            }
            else
            { 
           $response = array(
            'status' => 400,
            'message' => 'Not Added try again',
            'data' => ''
             );
           $this->response($response, RestController::HTTP_OK);
          }
        }
       } catch (Exception $ex) {
             throw new Exception('IV_supply controller_name : Error in new IV_supply function - ' . $ex);
       }  
 }  
  /*
  * Editing a IV_supply
 */
  function edit_post($supply_id)
 {   
  try{
   $data['IV_supply'] = $this->IV_supply_model->get_IV_supply($supply_id);
       $this->load->library('upload');
       $this->load->library('form_validation');
     if(isset($data['IV_supply']['supply_id']))
      {
        $params = array(
           'description'=> $this->input->post('description'),
           'amount'=> $this->input->post('amount'),
           'created_at'=> $this->input->post('created_at'),
           'updated_at'=> $this->input->post('updated_at'),
        );
          if(isset($_POST) && count($_POST) > 0)     
           {  
           $this->IV_supply_model->update_IV_supply($supply_id,$params);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Updated',
            'data' => $supply_id
             );
           $this->response($response, RestController::HTTP_OK);
           }
           else
          {
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $supply_id
             );
           $this->response($response, RestController::HTTP_OK);
          }
  }
       } catch (Exception $ex) {
             throw new Exception('IV_supply controller_name : Error in edit_post function - ' . $ex);
        }  
} 
/*
  * Deleting IV_supply
  */
  function remove_post($supply_id)
   {
  try{
      $IV_supply = $this->IV_supply_model->get_IV_supply($supply_id);
  // check if the IV_supply exists before trying to delete it
       if(isset($IV_supply['supply_id']))
       {
         $this->IV_supply_model->delete_IV_supply($supply_id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Removed',
            'data' => $supply_id
             );
           $this->response($response, RestController::HTTP_OK);
       }
       else
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $supply_id
             );
           $this->response($response, RestController::HTTP_OK);
       } catch (Exception $ex) {
             throw new Exception('IV_supply controller_name : Error in remove_post function - ' . $ex);
        }  
  }
 }