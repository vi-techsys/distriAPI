<?php 
/*
   Generated by Manuigniter v2.0 
   www.manuigniter.com
*/
class IV_customers_model extends CI_Model 
{ 
     function __construct()
      {
          parent::__construct();
      }
      /*
        * Get IV_customers by id 
      */ 
      function get_IV_customers($id)
      {
        try{
           return $this->db->get_where('IV_customers',array('id'=>$id))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model Model : Error in get_IV_customers function - ' . $ex);
           }  
      }
      /*
        * Get IV_customers by  column name
      */ 
      function get_IV_customersbyclm_name($clm_name,$clm_value)
      {
        try{
           return $this->db->get_where('IV_customers',array($clm_name=>$clm_value))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model Madel : Error in get_IV_customersbyclm_name function - ' . $ex);
           }  
      }
     /*
        * Get All IV_customers count 
      */ 
      function get_all_IV_customers_count()
      {
        try{
           $this->db->from('IV_customers');
           return $this->db->count_all_results();
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model model : Error in get_all_IV_customers_count function - ' . $ex);
           }  
      }
     /*
        * Get All with associated tables join IV_customerscount 
      */ 
      function get_all_with_asso_IV_customers()
      {
        try{
          $query = $this->db->get(); 
            if($query->num_rows() != 0){
               return $query->result_array();
            }else{
                return false;
            }
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model model : Error in get_all_with_asso_IV_customers function - ' . $ex);
           }  
      }
      /*
          * Get all IV_customers 
      */ 
      function get_all_IV_customers($id=null)
      {
        try{
              $this->db->order_by('firstname', 'asc');
              if($id!=null){
                $this->db->where('owner_id',$id);
               }
               return $this->db->get('IV_customers')->result_array();
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model model : Error in get_all_IV_customers function - ' . $ex);
           }  
      } 
      /*
         * function to add new IV_customers 
      */
      function add_IV_customers($params)
      {
        try{
          $this->db->insert('IV_customers',$params);
        return $this->db->insert_id();
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model model : Error in add_IV_customers function - ' . $ex);
           }  
      }
      /* 
          * function to update IV_customers 
      */
      function update_IV_customers($id,$params)
      {
        try{
            $this->db->where('id',$id);
        return $this->db->update('IV_customers',$params);
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model model : Error in update_IV_customers function - ' . $ex);
           }  
       }
     /* 
          * function to delete IV_customers 
      */
       function delete_IV_customers($id)
       {
        try{
             return $this->db->delete('IV_customers',array('id'=>$id));
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model model : Error in delete_IV_customers function - ' . $ex);
           }  
       }
      /*
        * Get IV_customers by  column name where not in particular id
      */ 
      function get_IV_customersbyclm_name_not_id($clm_name,$clm_value,$where_cond)
      {
        try{
            $this->db->where('id!=', $where_cond);
           return $this->db->get_where('IV_customers',array($clm_name=>$clm_value))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model model : Error in get_IV_customersbyclm_name_not_id function - ' . $ex);
           }  
      }
     /*
        * Get All with associated tables join IV_customerscount 
      */ 
      function get_all_with_asso_IV_customers_by_cat($column_name=null,$value_id=null,$params=array())
      {
        try{
          $query = $this->db->get(); 
            if($query->num_rows() != 0){
               return $query->result_array();
            }else{
                return false;
            }
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model model : Error in get_all_with_asso_IV_customers_by_cat function - ' . $ex);
           }  
      }
      /*
          * Get all IV_customers_by_cat 
      */ 
      function get_all_IV_customers_by_cat($column_name=null,$value_id=null,$params=array())
      {
        try{
              $this->db->order_by('id', 'desc');
              $this->db->where($column_name, $value_id);
              if(isset($params) && !empty($params)){
               $this->db->limit($params['limit'], $params['offset']);
              }
               return $this->db->get('IV_customers')->result_array();
           } catch (Exception $ex) {
             throw new Exception('IV_customers_model model : Error in get_all_IV_customers_by_cat function - ' . $ex);
           }  
      } 
 }
