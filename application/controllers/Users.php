<?php
class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // This line will load user model to this controller
        $this->load->model('users_model');

        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->helper('form');
        // Use method get_users of user model to get users list
        $data["users"] = $this->users_model->get_users();

        // declaring page_title variable
        $data["page_title"] = "List Of Users";


        $this->load->view('header', $data); 

        // assign users list to view
        $this->load->view('users/index', $data);
        $this->load->view('footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $data["page_title"] = "Create New User";
        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('email', 'Email', array('required','valid_email'));
        $this->form_validation->set_rules('phone_number', 'Phone number', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header', $data); 
            $this->load->view('users/create', $data);
            $this->load->view('footer');
        } else {
            $this->users_model->create_user();
            redirect(base_url('/'));
        }
    }

    public function update($user_id)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data["user"] = $this->users_model->get_user($user_id);

        $data["page_title"] = "Update User";
        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('email', 'Email', array('required','valid_email'));
        $this->form_validation->set_rules('phone_number', 'Phone number', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header', $data); 
            $this->load->view('users/update', $data);
            $this->load->view('footer');
        } else {
            $this->users_model->update_user($user_id);
            redirect(base_url('/'));
        }
    }

    public function delete($user_id)
    {
        $this->users_model->delete_user($user_id);
        redirect(base_url('/'));
    }

    public function view($user_id)
    {
        /**
         *  showing user's all information
         * @access public
         */

        // Use method get_users of user model to get users list
        $data["user"] = $this->users_model->get_user($user_id);
        // declaring page_title variable
        $data["page_title"] = "information of Users";

        $this->load->view('header', $data); 
        // assign users list to view
        $this->load->view('users/view', $data);
        $this->load->view('footer');
    }

    public function all_delete()
    {
        /**
         *  deleting all the selected users
         * @access public
         */

        $selected_user_ids = $this->input->post('user_ids');
        $this->users_model->all_delete_users($selected_user_ids);
        redirect(base_url('/'));
    }
}
