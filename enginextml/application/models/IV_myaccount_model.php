<?php 
/*
   Generated by Manuigniter v2.0 
   www.manuigniter.com
*/
class IV_myaccount_model extends CI_Model 
{ 
     function __construct()
      {
          parent::__construct();
      }
      /*
        * Get IV_myaccount by myaccount_id 
      */ 
      function get_IV_myaccount($myaccount_id)
      {
        try{
           return $this->db->get_where('IV_myaccount',array('myaccount_id'=>$myaccount_id))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model Model : Error in get_IV_myaccount function - ' . $ex);
           }  
      }
      /*
        * Get IV_myaccount by  column name
      */ 
      function get_IV_myaccountbyclm_name($clm_name,$clm_value)
      {
        try{
           return $this->db->get_where('IV_myaccount',array($clm_name=>$clm_value))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model Madel : Error in get_IV_myaccountbyclm_name function - ' . $ex);
           }  
      }
     /*
        * Get All IV_myaccount count 
      */ 
      function get_all_IV_myaccount_count()
      {
        try{
           $this->db->from('IV_myaccount');
           return $this->db->count_all_results();
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model model : Error in get_all_IV_myaccount_count function - ' . $ex);
           }  
      }
     /*
        * Get All with associated tables join IV_myaccountcount 
      */ 
      function get_all_with_asso_IV_myaccount()
      {
        try{
          $query = $this->db->get(); 
            if($query->num_rows() != 0){
               return $query->result_array();
            }else{
                return false;
            }
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model model : Error in get_all_with_asso_IV_myaccount function - ' . $ex);
           }  
      }
      /*
          * Get all IV_myaccount 
      */ 
      function get_all_IV_myaccount($id=null)
      {
        try{
              $this->db->order_by('myaccount_id', 'desc');
              if($id!=null){
                $this->db->where('owner_id',$id);
               }
               return $this->db->get('IV_myaccount')->result_array();
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model model : Error in get_all_IV_myaccount function - ' . $ex);
           }  
      } 
      /*
         * function to add new IV_myaccount 
      */
      function add_IV_myaccount($params)
      {
        try{
          $this->db->insert('IV_myaccount',$params);
        return $this->db->insert_id();
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model model : Error in add_IV_myaccount function - ' . $ex);
           }  
      }
      /* 
          * function to update IV_myaccount 
      */
      function update_IV_myaccount($myaccount_id,$params)
      {
        try{
            $this->db->where('myaccount_id',$myaccount_id);
        return $this->db->update('IV_myaccount',$params);
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model model : Error in update_IV_myaccount function - ' . $ex);
           }  
       }
     /* 
          * function to delete IV_myaccount 
      */
       function delete_IV_myaccount($myaccount_id)
       {
        try{
             return $this->db->delete('IV_myaccount',array('myaccount_id'=>$myaccount_id));
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model model : Error in delete_IV_myaccount function - ' . $ex);
           }  
       }
      /*
        * Get IV_myaccount by  column name where not in particular id
      */ 
      function get_IV_myaccountbyclm_name_not_id($clm_name,$clm_value,$where_cond)
      {
        try{
            $this->db->where('myaccount_id!=', $where_cond);
           return $this->db->get_where('IV_myaccount',array($clm_name=>$clm_value))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model model : Error in get_IV_myaccountbyclm_name_not_id function - ' . $ex);
           }  
      }
     /*
        * Get All with associated tables join IV_myaccountcount 
      */ 
      function get_all_with_asso_IV_myaccount_by_cat($column_name=null,$value_id=null,$params=array())
      {
        try{
          $query = $this->db->get(); 
            if($query->num_rows() != 0){
               return $query->result_array();
            }else{
                return false;
            }
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model model : Error in get_all_with_asso_IV_myaccount_by_cat function - ' . $ex);
           }  
      }
      /*
          * Get all IV_myaccount_by_cat 
      */ 
      function get_all_IV_myaccount_by_cat($column_name=null,$value_id=null,$params=array())
      {
        try{
              $this->db->order_by('myaccount_id', 'desc');
              $this->db->where($column_name, $value_id);
              if(isset($params) && !empty($params)){
               $this->db->limit($params['limit'], $params['offset']);
              }
               return $this->db->get('IV_myaccount')->result_array();
           } catch (Exception $ex) {
             throw new Exception('IV_myaccount_model model : Error in get_all_IV_myaccount_by_cat function - ' . $ex);
           }  
      } 
 }
