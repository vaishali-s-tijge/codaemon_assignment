<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Model {

	Private $c_name  = '';
	Private $c_email = '';
	Private $c_address = ''; 
	Private $c_zip = '';
	Private $c_telephone = '';
	Private $c_dob = '';

    function __construct(){
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
	
	/*
	FUNCTION TO PERFORM THE FOLLOWING THINGS ON CUSTOMERS
	1. Search / sort data from db
	2. Perform various bulk actions like active / inactive / delete
	*/
	function getCustomerList()
	{  
		$where = array(); 
		$param = array();
		$ROW_PER_PAGE = 5;
		$where_condition = '';
		$action_message = '';
		$action_message_class = '';
		$page = (int)$this->uri->segment(3);

		/* SET DEFAULT ASC/DESC ORDER OR Assign default values */
		$txt_column = (strlen(trim($this->input->get("txt_column"))) > 0 ? trim($this->input->get("txt_column")) : "c_id");
		$txt_order_type = (strlen(trim($this->input->get("txt_order_type"))) > 0 ? trim($this->input->get("txt_order_type")) : "DESC");
		$action = (strlen(trim($this->input->get("action"))) > 0 ? trim($this->input->get("action")) : "");
		
		/* COLLECT IDS HERE AND THEN
		 * CODE WILL PERFORM FOLLOWING ACTIONS
		 * 1. DELETE
		 * 2. ACTIVE
		 * 3. INACTIVE
		 */
		if(is_array($this->input->get('id')) && sizeof($this->input->get('id')) > 0){
			$ids_arr = $this->input->get('id');
			$this->ids_count = (int)sizeof($ids_arr);
			$ids = implode(",", $ids_arr);
	
			switch($action){
				case "delete":
					$action_message = $this->deleteRecords($ids);
					$action_message_class = "alert-success";
				break;
				case "active":
					$action_message = $this->activeRecords($ids);
					$action_message_class = "alert-success";
				break;
				case "inactive":
					$action_message = $this->inactiveRecords($ids);
					$action_message_class = "alert-success";
				break;
			}// end switch
		} // end if
	
		/* SEARCH CONDITION FOR PAGINATION QUERY */
		if(strlen($this->input->get('c_id')) > 0){
			$where[] = " and c.c_id like ?";
			$param[] = '%'.$this->input->get('c_id').'%';
		}
		if(strlen($this->input->get('name')) > 0){
			$cname = $this->input->get('name');
			$where[] = " and (c.c_name like '%".$cname."%')";
			
		}
		if(strlen($this->input->get('email')) > 0){
			$where[] = " and c.c_email like ?";
			$param[] = '%'.$this->input->get('email').'%';
		}
		if(strlen($this->input->get('address')) > 0){
			$where[] = " and c.c_address like ?";
			$param[] = '%'.$this->input->get('address').'%';
		}
		if(strlen($this->input->get('zip')) > 0){
			$where[] = " and c.c_zip like ?";
			$param[] = '%'.$this->input->get('zip').'%';
		}
		if(strlen($this->input->get('telephone')) > 0){
			$where[] = " and c.c_telephone like ?";
			$param[] = '%'.$this->input->get('telephone').'%';
		}
		if(strlen($this->input->get('dob')) > 0){
			$where[] = " and c.c_dob like ?";
			$param[] = '%'.$this->input->get('dob').'%';
		}
		if(strlen($this->input->get('is_active')) > 0){
			$where[] = " and c.c_is_active like ?";
			$param[] = '%'.$this->input->get('c_is_active').'%';
		}
		if(strlen($this->input->get('added_date')) > 0){
			$where[] = " and c.c_added_date like ?";
			$param[] = '%'.$this->input->get('added_date').'%';
		}
	
		if(is_array($where) && sizeof($where) > 0){
			$where_condition  = implode("", $where);
		}
		
		$order_by = (strlen(trim($txt_column." ".$txt_order_type)) > 0 ? trim($txt_column." ".$txt_order_type) : "" );
		$sql = "SELECT SQL_CALC_FOUND_ROWS *, c.c_id, c.c_name, c.c_email, c.c_address, c.c_zip, c.c_telephone, c.c_dob, c.c_is_active, c.c_added_date FROM customer as c where c.c_is_deleted=0 ".$where_condition." order by ".$order_by." limit ".$page.", ".$ROW_PER_PAGE." ";
		
		$query = $this->db->query($sql, $param);
	
		$sql_tr = "SELECT FOUND_ROWS() as total_rows";
		$query_tr = $this->db->query($sql_tr);
		$row_tr = $query_tr->result(); 
			
		return array("query"=>$query, "row_tr"=>$row_tr, "action_message" => $action_message, "action_message_class"=>$action_message_class);
	} // end function getCustomerList
	
	
	function deleteRecords($ids){
		if(strlen(trim($ids)) > 0){
			$data['c_is_deleted'] = 1;
			$this->db->where("c_id in (".$ids.")");
			$this->db->update("customer", $data);
			return "Total of ".$this->ids_count." record(s) were successfully deleted";
		}
	} // end function deleteRecords
	
	function activeRecords($ids){
		if(strlen(trim($ids)) > 0){
			$data['c_is_active'] = 1;
			$this->db->where("c_id in (".$ids.")");
			$this->db->update("customer", $data);
			return "Total of ".$this->ids_count." record(s) were successfully activated";
		}
	} // end function activeRecords
	
	function inactiveRecords($ids){
		if(strlen(trim($ids)) > 0){
			$data['c_is_active'] = 0;
			$this->db->where("c_id in (".$ids.")");
			$this->db->update("customer", $data);
			return "Total of ".$this->ids_count." record(s) were successfully inactivated";
		}
	} // end function inactiveRecords
	
	function getCustomerDetails($id){
			$query = $this->db->get_where('customer', array('c_id' => $id,'c_is_deleted' =>'0'));
			return $query->row();
	} // end function getCustomerData
	
}