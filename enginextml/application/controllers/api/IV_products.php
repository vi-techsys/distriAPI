<?php 
use Restserver\Libraries\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestServer/RestController.php';
require APPPATH . 'libraries/RestServer/Format.php';
class IV_products extends RestController{
 function __construct()
 {
       parent::__construct();
      $this->load->model(array('Users_model','IV_products_model'));
 } 
 /*
* Listing of IV_products
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
  $data['IV_products'] = $this->IV_products_model->get_all_IV_products();
     if($data['IV_products'] && $data['IV_products']!=null){
       $IV_products_ar = array();
       foreach($data['IV_products'] as $I)
       {
       $I_ar = array();
       $I_ar['product_id'] = $I['product_id'];
       $I_ar['product_name'] = $I['product_name'];
       $I_ar['category_id'] = $I['category_id'];
       $I_ar['cost_price'] = $I['cost_price'];
       $I_ar['selling_price'] = $I['selling_price'];
       $I_ar['status'] = $I['status'];
       $I_ar['created_at'] = $I['created_at'];
       $I_ar['updated_at'] = $I['updated_at'];
       $IV_products_ar[] = $I_ar;
       }
       $response = array(
       'status' => 200,
       'message' => 'get all data Succesfully',
       'data' => $IV_products_ar,
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
             throw new Exception('IV_products controller_name : Error in get_all_post function - ' . $ex);
        }  
}
 /*
  * Adding a new IV_products
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
       'product_name'=> $this->input->post('product_name'),
       'category_id'=> $this->input->post('category_id'),
       'cost_price'=> $this->input->post('cost_price'),
       'selling_price'=> $this->input->post('selling_price'),
       'status'=> $this->input->post('status'),
       'uuid'=>$this->input->post('uuid'),
       'created_at'=> $this->input->post('created_at'),
       'updated_at'=> $this->input->post('updated_at'),
        );
       $this->load->library('upload');
       $this->load->library('form_validation');
       if(isset($_POST) && count($_POST) > 0)     
        {  
            $product_id= $this->IV_products_model->add_IV_products($params);
            $IV_products = $this->IV_products_model->get_IV_products($product_id);
            $data['products'] = $this->IV_products_model->get_all_IV_products();
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Added',
            'data' => $data,
            'uuid'=>$IV_products['uuid'],
            'key'=>'products'
             );
           $this->response($response, RestController::HTTP_OK);
        }
        else
        { 
           $response = array(
            'status' => 400,
            'message' => 'Not Added try again',
            'data' => '',
            'uuid'=>null,
            'key'=>null
             );
           $this->response($response, RestController::HTTP_OK);
        }
       } catch (Exception $ex) {
             throw new Exception('IV_products controller_name : Error in new IV_products function - ' . $ex);
       }  
 }  
  /*
  * Editing a IV_products
 */
  function edit_post($product_id)
 {   
  try{
   $data['IV_products'] = $this->IV_products_model->get_IV_products($product_id);
       $this->load->library('upload');
       $this->load->library('form_validation');
     if(isset($data['IV_products']['product_id']))
      {
        $params = array(
           'product_name'=> $this->input->post('product_name'),
           'category_id'=> $this->input->post('category_id'),
           'cost_price'=> $this->input->post('cost_price'),
           'selling_price'=> $this->input->post('selling_price'),
           'status'=> $this->input->post('status'),
           'created_at'=> $this->input->post('created_at'),
           'updated_at'=> $this->input->post('updated_at'),
        );
          if(isset($_POST) && count($_POST) > 0)     
           {  
           $this->IV_products_model->update_IV_products($product_id,$params);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Updated',
            'data' => $product_id
             );
           $this->response($response, RestController::HTTP_OK);
           }
           else
          {
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $product_id
             );
           $this->response($response, RestController::HTTP_OK);
          }
  }
       } catch (Exception $ex) {
             throw new Exception('IV_products controller_name : Error in edit_post function - ' . $ex);
        }  
} 
/*
  * Deleting IV_products
  */
  function remove_post($product_id)
   {
  try{
      $IV_products = $this->IV_products_model->get_IV_products($product_id);
  // check if the IV_products exists before trying to delete it
       if(isset($IV_products['product_id']))
       {
         $this->IV_products_model->delete_IV_products($product_id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Removed',
            'data' => $product_id
             );
           $this->response($response, RestController::HTTP_OK);
       }
       else
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $product_id
             );
           $this->response($response, RestController::HTTP_OK);
       } catch (Exception $ex) {
             throw new Exception('IV_products controller_name : Error in remove_post function - ' . $ex);
        }  
  }
 }