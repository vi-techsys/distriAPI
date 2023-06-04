<?php 
use Restserver\Libraries\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestServer/RestController.php';
require APPPATH . 'libraries/RestServer/Format.php';
class IV_customers extends RestController{
 function __construct()
 {
       parent::__construct();
      $this->load->model(array('Users_model','IV_customers_model'));
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
* Listing of IV_customers
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
  $data['IV_customers'] = $this->IV_customers_model->get_all_IV_customers($id);
     if($data['IV_customers'] && $data['IV_customers']!=null){
       $IV_customers_ar = array();
       foreach($data['IV_customers'] as $I)
       {
       $I_ar = array();
       $I_ar['id'] = $I['id'];
       $I_ar['firstname'] = $I['firstname'];
       $I_ar['lastname'] = $I['lastname'];
       $I_ar['phone'] = $I['phone'];
       $I_ar['email'] = $I['email'];
       $I_ar['address'] = $I['address'];
       $I_ar['created_at'] = $I['created_at'];
       $I_ar['updated_at'] = $I['updated_at'];
       $IV_customers_ar[] = $I_ar;
       }
       $response = array(
       'status' => 200,
       'message' => 'get all data Succesfully',
       'data' => $IV_customers_ar,
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
             throw new Exception('IV_customers controller_name : Error in get_all_post function - ' . $ex);
        }  
}
 /*
  * Adding a new IV_customers
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
       'firstname'=> $this->input->post('firstname'),
       'lastname'=> $this->input->post('lastname'),
       'phone'=> $this->input->post('phone'),
       'email'=> $this->input->post('email'),
       'address'=> $this->input->post('address'),
       'owner_id'=> $id,
       'uuid'=> $this->input->post('uuid'),
       'created_at'=> $this->input->post('created_at'),
       'updated_at'=> $this->input->post('updated_at'),
        );
       $this->load->library('upload');
       $this->load->library('form_validation');
       if(isset($_POST) && count($_POST) > 0)     
        {  
            $cid= $this->IV_customers_model->add_IV_customers($params);
            $IV_customers = $this->IV_customers_model->get_IV_customers($cid);
            $data['customers'] = $this->IV_customers_model->get_all_IV_customers($id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Added',
            'data' => $data,
            'uuid'=>$IV_customers['uuid'],
            'key'=>'customers'
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
             throw new Exception('IV_customers controller_name : Error in new IV_customers function - ' . $ex);
       }  
 }  
  /*
  * Editing a IV_customers
 */
  function edit_post($id)
 {   
  try{
   $data['IV_customers'] = $this->IV_customers_model->get_IV_customers($id);
       $this->load->library('upload');
       $this->load->library('form_validation');
     if(isset($data['IV_customers']['id']))
      {
        $params = array(
           'firstname'=> $this->input->post('firstname'),
           'lastname'=> $this->input->post('lastname'),
           'phone'=> $this->input->post('phone'),
           'email'=> $this->input->post('email'),
           'address'=> $this->input->post('address'),
           'created_at'=> $this->input->post('created_at'),
           'updated_at'=> $this->input->post('updated_at'),
        );
          if(isset($_POST) && count($_POST) > 0)     
           {  
           $this->IV_customers_model->update_IV_customers($id,$params);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Updated',
            'data' => $id
             );
           $this->response($response, RestController::HTTP_OK);
           }
           else
          {
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $id
             );
           $this->response($response, RestController::HTTP_OK);
          }
  }
       } catch (Exception $ex) {
             throw new Exception('IV_customers controller_name : Error in edit_post function - ' . $ex);
        }  
} 
/*
  * Deleting IV_customers
  */
  function remove_post($id)
   {
  try{
      $IV_customers = $this->IV_customers_model->get_IV_customers($id);
  // check if the IV_customers exists before trying to delete it
       if(isset($IV_customers['id']))
       {
         $this->IV_customers_model->delete_IV_customers($id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Removed',
            'data' => $id
             );
           $this->response($response, RestController::HTTP_OK);
       }
       else
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $id
             );
           $this->response($response, RestController::HTTP_OK);
       } catch (Exception $ex) {
             throw new Exception('IV_customers controller_name : Error in remove_post function - ' . $ex);
        }  
  }
 }