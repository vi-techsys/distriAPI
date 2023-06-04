<?php 
class IV_account_model extends CI_Model 
{ 
     function __construct()
      {
          parent::__construct();
      }
      /*
        * Get IV_account by account_id 
      */ 
      function get_IV_account($account_id)
      {
        try{
           return $this->db->get_where('IV_account',array('account_id'=>$account_id))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_account_model Model : Error in get_IV_account function - ' . $ex);
           }  
      }
      /*
        * Get IV_account by  column name
      */ 
      function get_IV_accountbyclm_name($clm_name,$clm_value)
      {
        try{
           return $this->db->get_where('IV_account',array($clm_name=>$clm_value))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_account_model Madel : Error in get_IV_accountbyclm_name function - ' . $ex);
           }  
      }
     /*
        * Get All IV_account count 
      */ 
      function get_all_IV_account_count($id=null)
      {
        try{
           $this->db->from('IV_account');
           return $this->db->count_all_results();
           } catch (Exception $ex) {
             throw new Exception('IV_account_model model : Error in get_all_IV_account_count function - ' . $ex);
           }  
      }
     /*
        * Get All with associated tables join IV_accountcount 
      */ 
      function get_all_with_asso_IV_account()
      {
        try{
           $this->db->select('*');
           $this->db->from('IV_account a  ' );
            $this->db->join('IV_customers b', 'b.id=a. customer_id','left');
          $query = $this->db->get(); 
            if($query->num_rows() != 0){
               return $query->result_array();
            }else{
                return false;
            }
           } catch (Exception $ex) {
             throw new Exception('IV_account_model model : Error in get_all_with_asso_IV_account function - ' . $ex);
           }  
      }
      /*
          * Get all IV_account 
      */ 
      function get_debit($id)
      {
        $debit = $this->db->query("SELECT sum(amount) as debit FROM `iv_account` WHERE customer_id = ".addslashes($id)."  and type ='D'")->row_array();
        return $debit;
      }
      function get_all_IV_account($id=null)
      {
        try{
              $this->db->order_by('account_id', 'desc');
              $this->db->join('iv_customers', 'IV_account.customer_id = iv_customers.id', 'inner');
              if($id!=null){
               $this->db->where('IV_account.owner_id',$id);
              }
               return $this->db->get('IV_account')->result_array();
           } catch (Exception $ex) {
             throw new Exception('IV_account_model model : Error in get_all_IV_account function - ' . $ex);
           }  
      } 
      /*
         * function to add new IV_account 
      */
      function add_IV_account($params)
      {
        try{
          $this->db->insert('IV_account',$params);
        return $this->db->insert_id();
           } catch (Exception $ex) {
             throw new Exception('IV_account_model model : Error in add_IV_account function - ' . $ex);
           }  
      }
      /* 
          * function to update IV_account 
      */
      function update_IV_account($account_id,$params)
      {
        try{
            $this->db->where('account_id',$account_id);
        return $this->db->update('IV_account',$params);
           } catch (Exception $ex) {
             throw new Exception('IV_account_model model : Error in update_IV_account function - ' . $ex);
           }  
       }
     /* 
          * function to delete IV_account 
      */
       function delete_IV_account($account_id)
       {
        try{
             return $this->db->delete('IV_account',array('account_id'=>$account_id));
           } catch (Exception $ex) {
             throw new Exception('IV_account_model model : Error in delete_IV_account function - ' . $ex);
           }  
       }
      /*
        * Get IV_account by  column name where not in particular id
      */ 
      function get_IV_accountbyclm_name_not_id($clm_name,$clm_value,$where_cond)
      {
        try{
            $this->db->where('account_id!=', $where_cond);
           return $this->db->get_where('IV_account',array($clm_name=>$clm_value))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_account_model model : Error in get_IV_accountbyclm_name_not_id function - ' . $ex);
           }  
      }
     /*
        * Get All with associated tables join IV_accountcount 
      */ 
      function get_all_with_asso_IV_account_by_cat($column_name=null,$value_id=null,$params=array())
      {
        try{
           $this->db->select('*');
           $this->db->from('IV_account a  ' );
              //$this->db->where($column_name, $value_id);
            $this->db->join('IV_customers b', 'b.id=a. customer_id','left');
              $this->db->where('a.'.$column_name, $value_id);
          $query = $this->db->get(); 
            if($query->num_rows() != 0){
               return $query->result_array();
            }else{
                return false;
            }
           } catch (Exception $ex) {
             throw new Exception('IV_account_model model : Error in get_all_with_asso_IV_account_by_cat function - ' . $ex);
           }  
      }
      /*
          * Get all IV_account_by_cat 
      */ 
      function get_all_IV_account_by_cat($column_name=null,$value_id=null,$params=array())
      {
        try{
              $this->db->order_by('account_id', 'desc');
              $this->db->where($column_name, $value_id);
              if(isset($params) && !empty($params)){
               $this->db->limit($params['limit'], $params['offset']);
              }
               return $this->db->get('IV_account')->result_array();
           } catch (Exception $ex) {
             throw new Exception('IV_account_model model : Error in get_all_IV_account_by_cat function - ' . $ex);
           }  
      } 
 }
