<?php 
/*
   Generated by Manuigniter v2.0 
   www.manuigniter.com
*/
class IV_categories_model extends CI_Model 
{ 
     function __construct()
      {
          parent::__construct();
      }
      /*
        * Get IV_categories by category_id 
      */ 
      function get_IV_categories($category_id)
      {
        try{
           return $this->db->get_where('IV_categories',array('category_id'=>$category_id))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model Model : Error in get_IV_categories function - ' . $ex);
           }  
      }
      /*
        * Get IV_categories by  column name
      */ 
      function get_IV_categoriesbyclm_name($clm_name,$clm_value)
      {
        try{
           return $this->db->get_where('IV_categories',array($clm_name=>$clm_value))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model Madel : Error in get_IV_categoriesbyclm_name function - ' . $ex);
           }  
      }
     /*
        * Get All IV_categories count 
      */ 
      function get_all_IV_categories_count()
      {
        try{
           $this->db->from('IV_categories');
           return $this->db->count_all_results();
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model model : Error in get_all_IV_categories_count function - ' . $ex);
           }  
      }
     /*
        * Get All with associated tables join IV_categoriescount 
      */ 
      function get_all_with_asso_IV_categories()
      {
        try{
          $query = $this->db->get(); 
            if($query->num_rows() != 0){
               return $query->result_array();
            }else{
                return false;
            }
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model model : Error in get_all_with_asso_IV_categories function - ' . $ex);
           }  
      }
      /*
          * Get all IV_categories 
      */ 
      function get_all_IV_categories($params = array())
      {
        try{
              $this->db->order_by('category_id', 'desc');
              if(isset($params) && !empty($params)){
               $this->db->limit($params['limit'], $params['offset']);
              }
               return $this->db->get('IV_categories')->result_array();
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model model : Error in get_all_IV_categories function - ' . $ex);
           }  
      } 
      /*
         * function to add new IV_categories 
      */
      function add_IV_categories($params)
      {
        try{
          $this->db->insert('IV_categories',$params);
        return $this->db->insert_id();
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model model : Error in add_IV_categories function - ' . $ex);
           }  
      }
      /* 
          * function to update IV_categories 
      */
      function update_IV_categories($category_id,$params)
      {
        try{
            $this->db->where('category_id',$category_id);
        return $this->db->update('IV_categories',$params);
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model model : Error in update_IV_categories function - ' . $ex);
           }  
       }
     /* 
          * function to delete IV_categories 
      */
       function delete_IV_categories($category_id)
       {
        try{
             return $this->db->delete('IV_categories',array('category_id'=>$category_id));
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model model : Error in delete_IV_categories function - ' . $ex);
           }  
       }
      /*
        * Get IV_categories by  column name where not in particular id
      */ 
      function get_IV_categoriesbyclm_name_not_id($clm_name,$clm_value,$where_cond)
      {
        try{
            $this->db->where('category_id!=', $where_cond);
           return $this->db->get_where('IV_categories',array($clm_name=>$clm_value))->row_array();
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model model : Error in get_IV_categoriesbyclm_name_not_id function - ' . $ex);
           }  
      }
     /*
        * Get All with associated tables join IV_categoriescount 
      */ 
      function get_all_with_asso_IV_categories_by_cat($column_name=null,$value_id=null,$params=array())
      {
        try{
          $query = $this->db->get(); 
            if($query->num_rows() != 0){
               return $query->result_array();
            }else{
                return false;
            }
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model model : Error in get_all_with_asso_IV_categories_by_cat function - ' . $ex);
           }  
      }
      /*
          * Get all IV_categories_by_cat 
      */ 
      function get_all_IV_categories_by_cat($column_name=null,$value_id=null,$params=array())
      {
        try{
              $this->db->order_by('category_id', 'desc');
              $this->db->where($column_name, $value_id);
              if(isset($params) && !empty($params)){
               $this->db->limit($params['limit'], $params['offset']);
              }
               return $this->db->get('IV_categories')->result_array();
           } catch (Exception $ex) {
             throw new Exception('IV_categories_model model : Error in get_all_IV_categories_by_cat function - ' . $ex);
           }  
      } 
 }
