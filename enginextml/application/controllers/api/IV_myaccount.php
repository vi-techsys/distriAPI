<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class IV_myaccount extends REST_Controller{
 function __construct()
 {
       parent::__construct();
      $this->load->model('IV_myaccount_model');
 } 
 /*
* Listing of IV_myaccount
 */
public function get_all_post()
{
  try{
  $data['IV_myaccount'] = $this->IV_myaccount_model->get_all_IV_myaccount();
     if($data['IV_myaccount'] && $data['IV_myaccount']!=null){
       $IV_myaccount_ar = array();
       foreach($data['IV_myaccount'] as $I)
       {
       $I_ar = array();
       $I_ar['myaccount_id'] = $I['myaccount_id'];
       $I_ar['description'] = $I['description'];
       $I_ar['amount'] = $I['amount'];
       $I_ar['type'] = $I['type'];
       $I_ar['balance'] = $I['balance'];
       $I_ar['created_at'] = $I['created_at'];
       $I_ar['updated_at'] = $I['updated_at'];
       $IV_myaccount_ar[] = $I_ar;
       }
       $response = array(
       'status' => 200,
       'message' => 'get all data Succesfully',
       'data' => $IV_myaccount_ar,
       );
       $this->response($response, REST_Controller::HTTP_OK);
     }
     else{
       $response = array(
      'status' => 400,
      'message' => 'Detail is not found'
        );
       $this->response($response, REST_Controller::HTTP_OK); 
        }
       } catch (Exception $ex) {
             throw new Exception('IV_myaccount controller_name : Error in get_all_post function - ' . $ex);
        }  
}
 /*
  * Adding a new IV_myaccount
  */
 function addnew_post()
 {  
  try{
      $params = array(
       'description'=> $this->input->post('description'),
       'amount'=> $this->input->post('amount'),
       'type'=> $this->input->post('type'),
       'balance'=> $this->input->post('balance'),
       'created_at'=> $this->input->post('created_at'),
       'updated_at'=> $this->input->post('updated_at'),
        );
       $this->load->library('upload');
       $this->load->library('form_validation');
       if(isset($_POST) && count($_POST) > 0)     
        {  
            $myaccount_id= $this->IV_myaccount_model->add_IV_myaccount($params);
   $data['IV_myaccount'] = $this->IV_myaccount_model->get_IV_myaccount($myaccount_id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Added',
            'data' => $data
             );
           $this->response($response, REST_Controller::HTTP_OK);
        }
        else
        { 
           $response = array(
            'status' => 400,
            'message' => 'Not Added try again',
            'data' => ''
             );
           $this->response($response, REST_Controller::HTTP_OK);
        }
       } catch (Exception $ex) {
             throw new Exception('IV_myaccount controller_name : Error in new IV_myaccount function - ' . $ex);
       }  
 }  
  /*
  * Editing a IV_myaccount
 */
  function edit_post($myaccount_id)
 {   
  try{
   $data['IV_myaccount'] = $this->IV_myaccount_model->get_IV_myaccount($myaccount_id);
       $this->load->library('upload');
       $this->load->library('form_validation');
     if(isset($data['IV_myaccount']['myaccount_id']))
      {
        $params = array(
           'description'=> $this->input->post('description'),
           'amount'=> $this->input->post('amount'),
           'type'=> $this->input->post('type'),
           'balance'=> $this->input->post('balance'),
           'created_at'=> $this->input->post('created_at'),
           'updated_at'=> $this->input->post('updated_at'),
        );
          if(isset($_POST) && count($_POST) > 0)     
           {  
           $this->IV_myaccount_model->update_IV_myaccount($myaccount_id,$params);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Updated',
            'data' => $myaccount_id
             );
           $this->response($response, REST_Controller::HTTP_OK);
           }
           else
          {
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $myaccount_id
             );
           $this->response($response, REST_Controller::HTTP_OK);
          }
  }
       } catch (Exception $ex) {
             throw new Exception('IV_myaccount controller_name : Error in edit_post function - ' . $ex);
        }  
} 
/*
  * Deleting IV_myaccount
  */
  function remove_post($myaccount_id)
   {
  try{
      $IV_myaccount = $this->IV_myaccount_model->get_IV_myaccount($myaccount_id);
  // check if the IV_myaccount exists before trying to delete it
       if(isset($IV_myaccount['myaccount_id']))
       {
         $this->IV_myaccount_model->delete_IV_myaccount($myaccount_id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Removed',
            'data' => $myaccount_id
             );
           $this->response($response, REST_Controller::HTTP_OK);
       }
       else
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $myaccount_id
             );
           $this->response($response, REST_Controller::HTTP_OK);
       } catch (Exception $ex) {
             throw new Exception('IV_myaccount controller_name : Error in remove_post function - ' . $ex);
        }  
  }
 }