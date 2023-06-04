<?php 
use Restserver\Libraries\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestServer/RestController.php';
require APPPATH . 'libraries/RestServer/Format.php';
class IV_categories extends RestController{
 function __construct()
 {
       parent::__construct();
      $this->load->model('IV_categories_model');
 } 
 /*
* Listing of IV_categories
 */
public function get_all_post()
{
  try{
  $data['IV_categories'] = $this->IV_categories_model->get_all_IV_categories();
     if($data['IV_categories'] && $data['IV_categories']!=null){
       $IV_categories_ar = array();
       foreach($data['IV_categories'] as $I)
       {
       $I_ar = array();
       $I_ar['category'] = $I['category'];
       $I_ar['parent'] = $I['parent'];
       $I_ar['category_id'] = $I['category_id'];
       $IV_categories_ar[] = $I_ar;
       }
       $response = array(
       'status' => 200,
       'message' => 'Got all data Succesfully',
       'data' => $IV_categories_ar,
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
             throw new Exception('IV_categories controller_name : Error in get_all_post function - ' . $ex);
        }  
}
 /*
  * Adding a new IV_categories
  */
 function addnew_post()
 {  
  try{
      $params = array(
       'category'=> $this->input->post('category'),
       'parent'=> $this->input->post('parent'),
       'uuid'=>$this->input->post('uuid')
        );
       $this->load->library('upload');
       $this->load->library('form_validation');
       if(isset($_POST) && count($_POST) > 0)     
        {  
            $category_id= $this->IV_categories_model->add_IV_categories($params);
            $IV_categories = $this->IV_categories_model->get_IV_categories($category_id);
            $data['categories'] = $this->IV_categories_model->get_all_IV_categories();
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Added',
            'data' => $data,
            'uuid'=>$IV_categories["uuid"],
            'key'=>'categories'
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
             throw new Exception('IV_categories controller_name : Error in new IV_categories function - ' . $ex);
       }  
 }  
  /*
  * Editing a IV_categories
 */
  function edit_post($category_id)
 {   
  try{
   $data['IV_categories'] = $this->IV_categories_model->get_IV_categories($category_id);
       $this->load->library('upload');
       $this->load->library('form_validation');
     if(isset($data['IV_categories']['category_id']))
      {
        $params = array(
           'category'=> $this->input->post('category'),
           'parent'=> $this->input->post('parent'),
        );
          if(isset($_POST) && count($_POST) > 0)     
           {  
           $this->IV_categories_model->update_IV_categories($category_id,$params);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Updated',
            'data' => $category_id
             );
           $this->response($response, RestController::HTTP_OK);
           }
           else
          {
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $category_id
             );
           $this->response($response, RestController::HTTP_OK);
          }
  }
       } catch (Exception $ex) {
             throw new Exception('IV_categories controller_name : Error in edit_post function - ' . $ex);
        }  
} 
/*
  * Deleting IV_categories
  */
  function remove_post($category_id)
   {
  try{
      $IV_categories = $this->IV_categories_model->get_IV_categories($category_id);
  // check if the IV_categories exists before trying to delete it
       if(isset($IV_categories['category_id']))
       {
         $this->IV_categories_model->delete_IV_categories($category_id);
           $response = array(
            'status' => 200,
            'message' => 'Succesfully Removed',
            'data' => $category_id
             );
           $this->response($response, RestController::HTTP_OK);
       }
       else
           $response = array(
            'status' => 400,
            'message' => 'Not Updated Try again',
            'data' => $category_id
             );
           $this->response($response, RestController::HTTP_OK);
       } catch (Exception $ex) {
             throw new Exception('IV_categories controller_name : Error in remove_post function - ' . $ex);
        }  
  }
 }