<?php 
use Restserver\Libraries\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestServer/RestController.php';
require APPPATH . 'libraries/RestServer/Format.php';
class IV_inventory extends RestController{
 function __construct()
 {
       parent::__construct();
      $this->load->model('IV_inventory_model');
 } 
 /*
* Listing of IV_inventory
 */
public function get_all_post()
{
  try{
  $data['IV_inventory'] = $this->IV_inventory_model->get_all_IV_inventory();
     if($data['IV_inventory'] && $data['IV_inventory']!=null){
       $IV_inventory_ar = array();
       foreach($data['IV_inventory'] as $I)
       {
       $I_ar = array();
       $I_ar['inventory_id'] = $I['inventory_id'];
       $I_ar['product_id'] = $I['product_id'];
       $I_ar['quantity'] = $I['quantity'];
       $I_ar['unitprice'] = $I['unitprice'];
       $I_ar['quantity_supplied'] = $I['quantity_supplied'];
       $I_ar['created_at'] = $I['created_at'];
       $I_ar['updated_at'] = $I['updated_at'];
       $I_ar['supply_id'] = $I['supply_id'];
       $IV_inventory_ar[] = $I_ar;
       }
       $response = array(
       'status' => 200,
       'message' => 'get all data Succesfully',
       'data' => $IV_inventory_ar,
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
             throw new Exception('IV_inventory controller_name : Error in get_all_post function - ' . $ex);
        }  
}
 /*
  * Adding a new IV_inventory
  */
 function addnew_post()
 {  
  try{
      $params = array(
       'product_id'=> $this->input->post('product_id'),
       'quantity'=> $this->input->post('quantity'),
       'unitprice'=> $this->input->post('unitprice'),
       'quantity_supplied'=> $this->input->post('quantity_supplied'),
       'created_at'=> $this->input->post('created_at'),
       'updated_at'=> $this->input->post('updated_at'),
       'supply_id'=> $this->input->post('supply_id'),
        );
       $this->load->library('upload');
       $this->load->library('form_validation');
       if(isset($_POST) && count($_POST) > 0)     
        {  
            $inventory_id= $this->IV_inventory_model->add_IV_inventory($params);
          $data['IV_inventory'] = $this->IV_inventory_model->get_IV_inventory($inventory_id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Added',
            'data' => $data
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
       } catch (Exception $ex) {
             throw new Exception('IV_inventory controller_name : Error in new IV_inventory function - ' . $ex);
       }  
 }  
  /*
  * Editing a IV_inventory
 */
  function edit_post($inventory_id)
 {   
  try{
   $data['IV_inventory'] = $this->IV_inventory_model->get_IV_inventory($inventory_id);
       $this->load->library('upload');
       $this->load->library('form_validation');
     if(isset($data['IV_inventory']['inventory_id']))
      {
        $params = array(
           'product_id'=> $this->input->post('product_id'),
           'quantity'=> $this->input->post('quantity'),
           'unitprice'=> $this->input->post('unitprice'),
           'quantity_supplied'=> $this->input->post('quantity_supplied'),
           'created_at'=> $this->input->post('created_at'),
           'updated_at'=> $this->input->post('updated_at'),
           'supply_id'=> $this->input->post('supply_id'),
        );
          if(isset($_POST) && count($_POST) > 0)     
           {  
           $this->IV_inventory_model->update_IV_inventory($inventory_id,$params);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Updated',
            'data' => $inventory_id
             );
           $this->response($response, RestController::HTTP_OK);
           }
           else
          {
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $inventory_id
             );
           $this->response($response, RestController::HTTP_OK);
          }
  }
       } catch (Exception $ex) {
             throw new Exception('IV_inventory controller_name : Error in edit_post function - ' . $ex);
        }  
} 
/*
  * Deleting IV_inventory
  */
  function remove_post($inventory_id)
   {
  try{
      $IV_inventory = $this->IV_inventory_model->get_IV_inventory($inventory_id);
  // check if the IV_inventory exists before trying to delete it
       if(isset($IV_inventory['inventory_id']))
       {
         $this->IV_inventory_model->delete_IV_inventory($inventory_id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Removed',
            'data' => $inventory_id
             );
           $this->response($response, RestController::HTTP_OK);
       }
       else
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $inventory_id
             );
           $this->response($response, RestController::HTTP_OK);
       } catch (Exception $ex) {
             throw new Exception('IV_inventory controller_name : Error in remove_post function - ' . $ex);
        }  
  }
 }