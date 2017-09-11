<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct(){
        // Call the Controller constructor
        parent::__construct();
		$this->load->database();
		$this->load->model("customers");
		$this->load->library('pagination');
    }

	/**
	 * Index Page for this controller.
	 *
	
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://localhost/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/customer/<method_name>
	 */
	public function index()
	{
		$searchStr = '';
		$data = $this->customers->getCustomerList($searchStr);
		$this->load->view('customer/index', $data);
	}//End of index function

	// Method to display ajax customers list with pagination
	public function gridlist() {
		$searchStr = '';
		$data = $this->customers->getCustomerList($searchStr);
		$this->load->view('customer/list', $data);
    }//End of gridlist function

    //Method to display details of the customer
    public function view()
	{
	   $id = $this->uri->segment(3); 
	   $data['result'] = $this->customers->getCustomerDetails($id); 
	   $this->load->view('customer/view', $data);
	}//End of view function

	//Method to display form of add new customer
	public function add()
	{
		$this->load->view('customer/add');
	}//End of add function

	//Method to insert new customer into database
	public function create()
	{
		$data_error['error'] = "";		
		$data['c_name'] = $this->input->post('customer_name');
		$data['c_email'] = $this->input->post('email');
		$data['c_address'] = $this->input->post('address');
		$data['c_zip'] = $this->input->post('zip');
		$data['c_telephone'] = $this->input->post('telephone');
		$data['c_dob'] = date("Y-m-d",strtotime($this->input->post('dob')));
		$data['c_is_deleted'] = 0;
		$data['c_is_active'] = 1;
		$data['c_added_date'] = date("Y-m-d H:i:s");
		$this->db->insert('customer', $data);
		redirect(base_url() . 'customer/index', 'refresh');
	}// End of create function

}// End of controller
