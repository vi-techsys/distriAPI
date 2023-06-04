<?php 
use Restserver\Libraries\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestServer/RestController.php';
require APPPATH . 'libraries/RestServer/Format.php';
class IV_account extends RestController{
 function __construct()
 {
       parent::__construct();
      $this->load->model('IV_account_model');
 } 
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
 /*
* Listing of IV_account
 */
public function get_all_post()
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
  $data['IV_account'] = $this->IV_account_model->get_all_IV_account($id);
     if($data['IV_account'] && $data['IV_account']!=null){
       $IV_account_ar = array();
       foreach($data['IV_account'] as $I)
       {
       $I_ar = array();
       $I_ar['account_id'] = $I['account_id'];
       $I_ar['customer_id'] = $I['customer_id'];
       $I_ar['amount'] = $I['amount'];
       $I_ar['type'] = $I['type'];
       $I_ar['created_at'] = $I['created_at'];
       $I_ar['updated_at'] = $I['updated_at'];
       $IV_account_ar[] = $I_ar;
       }
       $response = array(
       'status' => 200,
       'message' => 'get all data Succesfully',
       'data' => $IV_account_ar,
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
             throw new Exception('IV_account controller_name : Error in get_all_post function - ' . $ex);
        }  
}
 /*
  * Adding a new IV_account
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
       'customer_id'=> $this->input->post('customer_id'),
       'amount'=> $this->input->post('amount'),
       'type'=> $this->input->post('type'),
       'owner_id'=>$id,
       'created_at'=> $this->input->post('created_at'),
       'updated_at'=> $this->input->post('updated_at'),
        );
       $this->load->library('upload');
       $this->load->library('form_validation');
       if(isset($_POST) && count($_POST) > 0)     
        {  
            $account_id= $this->IV_account_model->add_IV_account($params);
            $IV_account = $this->IV_account_model->get_IV_account($account_id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Added',
            'data' => $data,
            'uuid'=>$IV_account['uuid'],
            'key'=>'account'
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
             throw new Exception('IV_account controller_name : Error in new IV_account function - ' . $ex);
       }  
 }  
  /*
  * Editing a IV_account
 */
  function edit_post($account_id)
 {   
  try{
   $data['IV_account'] = $this->IV_account_model->get_IV_account($account_id);
       $this->load->library('upload');
       $this->load->library('form_validation');
     if(isset($data['IV_account']['account_id']))
      {
        $params = array(
           'customer_id'=> $this->input->post('customer_id'),
           'amount'=> $this->input->post('amount'),
           'type'=> $this->input->post('type'),
           'created_at'=> $this->input->post('created_at'),
           'updated_at'=> $this->input->post('updated_at'),
        );
          if(isset($_POST) && count($_POST) > 0)     
           {  
           $this->IV_account_model->update_IV_account($account_id,$params);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Updated',
            'data' => $account_id
             );
           $this->response($response, RestController::HTTP_OK);
           }
           else
          {
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $account_id
             );
           $this->response($response, RestController::HTTP_OK);
          }
  }
       } catch (Exception $ex) {
             throw new Exception('IV_account controller_name : Error in edit_post function - ' . $ex);
        }  
} 
/*
  * Deleting IV_account
  */
  function remove_post($account_id)
   {
  try{
      $IV_account = $this->IV_account_model->get_IV_account($account_id);
  // check if the IV_account exists before trying to delete it
       if(isset($IV_account['account_id']))
       {
         $this->IV_account_model->delete_IV_account($account_id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Removed',
            'data' => $account_id
             );
           $this->response($response, RestController::HTTP_OK);
       }
       else
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $account_id
             );
           $this->response($response, RestController::HTTP_OK);
       } catch (Exception $ex) {
             throw new Exception('IV_account controller_name : Error in remove_post function - ' . $ex);
        }  
  }
 }
1