<?php
class Users_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_users()
    {
    $query = $this->db->get('users');
    return $query->result_array();
    }

    public function create_user()
    {
    $this->load->helper('url');

    $data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'email' => $this->input->post('email'),
		'phone_number' => $this->input->post('phone_number')
    );

    return $this->db->insert('users', $data);
    }

	public function update_user($user_id)
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'phone_number' => $this->input->post('phone_number')
		);

		$this->db->where('id', $user_id);
		return $this->db->update('users', $data);
	}

	public function get_user($user_id)
	{
		$query = $this->db->where('id', $user_id)->get('users');
		return $query->row();
	}

	public function delete_user($user_id)
	{
		return $this->db->where('id', $user_id)->delete('users');
	}

	public function all_delete_users($selected_users)
	{
		/**
		 *  execute query to delete all the selected users
		 * @access public
		 */

		foreach ($selected_users as $user) {
			intval($user);
			$this->db->where('id', $user)->delete('users');
		}

		//I think the progaram above can delete all the users whose id is conttained in $selected_users
		// if writing in reffering to Query builder, which you told in Trello card,
		// I can write the code like below 
		// return $this->db->where_in('id', $selected_users)->delete('users');
	}
}
