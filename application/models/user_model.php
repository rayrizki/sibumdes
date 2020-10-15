<?php
defined('BASEPATH') or exit('No direct access script allowed!');

class User_model extends CI_Model
{

    public function getUserLogin()
    {
        $username = $this->input->post('username');

        return $this->db->get_where('x_users', ['username' => $username])->row_array();
    }

    public function createUser()
    {

        date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d H:i:s');

        $data = array(
            'id'             => '',
            'username'       => htmlspecialchars($this->input->post('username', true)),
            'password'       => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'name'           => htmlspecialchars($this->input->post('fullname', true)),
            'user_status_id' => 2,
            'user_role_id'   => 4,
            'is_valid'       => 0,
            'create_date'    => $createdate,
            'phone_number'   => htmlspecialchars($this->input->post('phonenumber', true)),
            'address'        => htmlspecialchars($this->input->post('address', true)),
            'image'          => 'defaultprofilepicture.jpg'
        );

        return $this->db->insert('x_users', $data);
    }
}
