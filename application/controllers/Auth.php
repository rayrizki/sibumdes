<?php
defined('BASEPATH') or exit('No direct access script allowed!');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['title'] = 'Login';
        $data['bumdes'] = 'BUMDES CIBOGO 2020';

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->login();
        }
    }

    private function login()
    {

        $user     = $this->user_model->getUserLogin();
        $password = $this->input->post('password');

        if ($user) {
            if ($user['is_valid'] == 1) {
                if ($user['user_status_id'] == 1) {
                    if (password_verify($password, $user['password'])) {

                        $data = [
                            'id' => $user['id'],
                            'username'  => $user['username'],
                            'name'      => $user['name'],
                            'user_role_id'   => $user['user_role_id']
                        ];

                        $this->session->set_userdata($data);

                        if ($_SESSION['user_role_id'] == '1') {
                            redirect('admin');
                        } else if ($_SESSION['user_role_id'] == '2') {
                            redirect('user');
                        } else if ($_SESSION['user_role_id'] == '3') {
                            redirect('user');
                        }
                    } else {
                        $this->session->set_flashdata('message', '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Attention!</strong> Username or Password is Wrong
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', ' 
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Attention!</strong> User Is Not Active, Please Contact Administrator
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', ' 
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Attention!</strong> User Has Not Activated, Please Contact Administrator
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', ' 
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Attention!</strong> Username Has Not Registered
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('role_id');

        // $this->session->set_flashdata('message', ' 
        //     <div class="alert alert-success alert-dismissible fade show" role="alert">
        //         You have been logged out, See u soon.
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //         <span aria-hidden="true">&times;</span>
        //         </button>
        //     </div>');
        redirect('auth');
    }

    public function registration()
    {
        $data['title'] = 'User Registration';
        $data['bumdes'] = 'BUMDES 2020';

        $this->form_validation->set_rules(
            'username',
            'Username',
            'trim|required|is_unique[x_users.username]',
            [
                'is_unique' => 'Username already Registered'
            ]
        );
        $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
        $this->form_validation->set_rules(
            'phonenumber',
            'Phone Number',
            'trim|required|integer',
            [
                'integer' => 'Phone Number Must Be Number'
            ]
        );
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|required|min_length[8]',
            [
                'min_length' => 'Password Must Be At Least 8 Characters'
            ]
        );
        $this->form_validation->set_rules(
            'confirmpassword',
            'Confirm Password',
            'trim|required|matches[password]',
            [
                'matches' => 'Password Doesnt Match'
            ]
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $this->user_model->createUser();
            $this->session->set_flashdata('message', ' 
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congratulations!</strong> User Has Been Created Successfully, Please Contact Administrator for Activate
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('auth');
        }
    }

    public function unauthorized()
    {
        $this->load->view('errors/html/error_401.php');
    }
}
