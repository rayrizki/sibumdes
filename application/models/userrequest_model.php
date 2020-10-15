<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class userrequest_model extends CI_Model
{
    public function addrequestjemputbarang()
    {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d H:i:s');

        $data = array(
            'id'                => '',
            'user_id'           => htmlspecialchars($this->input->post('userid', true)),
            'name'              => htmlspecialchars($this->input->post('name'), true),
            'address'           => htmlspecialchars($this->input->post('address', true)),
            'phone_number'      => htmlspecialchars($this->input->post('phonenumber', true)),
            'request_status_id' => 1,
            'request_type_id'   => htmlspecialchars($this->input->post('requesttypeid', true)),
            'request_date'      => htmlspecialchars($this->input->post('request_date', true)),
            'input_date'        => $createdate
        );

        $this->db->insert('request_pickup_item', $data);
    }

    public function updateapprovalpenjemputanbarang()
    {

        date_default_timezone_set('Asia/Jakarta');
        $approval_date = date('Y-m-d H:i:s');

        $request_id = htmlspecialchars($this->input->post('requestid', true));

        $data = array(
            'request_status_id' => htmlspecialchars($this->input->post('request_status_id', true)),
            'approval_date' => $approval_date,
            'pickup_date' => htmlspecialchars($this->input->post('approval_date', true)),
            'information' => htmlspecialchars($this->input->post('info_tambahan', true))
        );

        $this->db->update('request_pickup_item', $data, array('id' => $request_id));
    }

    public function getDataUser($userid)
    {
        $query = "SELECT a.id, b.id as 'request_type_id', a.username, a.name, a.phone_number, a.address, 
                    b.name as 'request_type_name'
                    FROM x_users a INNER JOIN request_type b
                    ON a.request_type_id = b.id
                    WHERE a.id = $userid";

        return $this->db->query($query)->result_array();
    }
}
