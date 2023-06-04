<?php 
use Restserver\Libraries\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestServer/RestController.php';
require APPPATH . 'libraries/RestServer/Format.php';
class Users extends RestController{
 function __construct()
 {
       parent::__construct();
      $this->load->model(array("Users_model", "IV_account_model","IV_categories_model","IV_customers_model","IV_inventory_model","IV_myaccount_model","IV_products_model","IV_supply_model"));
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
 public function get_all_data_post()
 {
    try
    {
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
        $data['account'] = $this->IV_account_model->get_all_IV_account($id);
        $data['categories'] = $this->IV_categories_model->get_all_IV_categories();
        $data['customers'] = $this->IV_customers_model->get_all_IV_customers($id);
        $data['inventory'] = $this->IV_inventory_model->get_all_IV_inventory($id);
        $data['myaccount'] = $this->IV_myaccount_model->get_all_IV_myaccount($id);
        $data['products'] = $this->IV_products_model->get_all_IV_products();
        $data['supply'] = $this->IV_supply_model->get_all_IV_supply($id);
        $response = array(
            'status' => 200,
            'message' => 'Got all data Succesfully',
            'data' => $data,
            );
            $this->response($response, RestController::HTTP_OK);
    }
    catch (Exception $ex) {}
 }
 public function dbkeys_get()
 {
    try{
        $data['keys'] = $this->Users_model->get_all_keys();
           if($data['keys'] && $data['keys']!=null){
             $IV_keys_ar = array();
             foreach($data['keys'] as $I)
             {
             $I_ar = array();
             $I_ar['key_'] = $I['key_'];
             $I_ar['key_id'] = $I['key_id'];
             $IV_keys_ar[] = $I_ar;
             }
             $response = array(
             'status' => 200,
             'message' => 'Got all data Succesfully',
             'data' => $IV_keys_ar,
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
                   throw new Exception('Dbkeys controller_name : Error in get all Dbkeys function - ' . $ex);
              }    
 }
 public function get_keys_post()
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
public function login_post()
{
  try{
    $params = array(
     'email'=> $this->input->post('email'),
     'password'=> $this->input->post('password'),
      );
     if(isset($_POST) && count($_POST) > 0)     
      {  
        $check = $this->Users_model->get_userlogin($params['email'],$params['password']);
        if($check && $check!=null)
        {
          $token = $this->uuid4();
          $this->Users_model->update_User($check['user_id'],['token'=>$token]);
          $response = array(
            'status' => 200,
            'message' => 'Login Successful',
            'data' => ['token'=>$token]
             );
           $this->response($response, RestController::HTTP_OK);
        }
        else
        {
          $response = array(
            'status' => 400,
            'message' => 'Login failed',
            'data' => ['token'=>'']
             );
           $this->response($response, RestController::HTTP_OK);
        }
      }
     } catch (Exception $ex) {
           throw new Exception('Login controller_name : Error in login function - ' . $ex);
     }  
}
function uuid4() {
  /* 32 random HEX + space for 4 hyphens */
  $out = bin2hex(random_bytes(18));

  $out[8]  = "-";
  $out[13] = "-";
  $out[18] = "-";
  $out[23] = "-";

  /* UUID v4 */
  $out[14] = "4";
  
  /* variant 1 - 10xx */
  $out[19] = ["8", "9", "a", "b"][random_int(0, 3)];

  return $out;
}
}