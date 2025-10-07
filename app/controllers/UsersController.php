<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UsersController
 */

class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->call->model('UsersModel');

        // Check kung may naka-login
        if (!isset($_SESSION['user'])) {
            redirect('/auth/login');
            exit;
        }

        // Kunin info ng naka-login na user
        $logged_in_user = $_SESSION['user']; 
        $data['logged_in_user'] = $logged_in_user;

        // Current page
        $page = 1;
        if(isset($_GET['page']) && !empty($_GET['page'])) {
            $page = (int)$this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;

        // Get paginated users
        $users = $this->UsersModel->page($q, $records_per_page, $page);

        $data['user'] = $users['records'];
        $total_rows = $users['total_rows'];

        // Pagination setup
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('custom');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/index', $data);
    }

    public function create()
    {
        if($this->io->method() === 'post'){
            $username = $this->io->post('username');
            $email = $this->io->post('email');  

            $data = [
                'username' => $username,
                'email' => $email
            ];

            if($this->UsersModel->insert($data)){
                redirect('/users');
            } else {
                echo 'Failed to create user.';
            }
        }else{
           $this->call->view('users/create');
        }
    }

    public function update($id)
    {
        $this->call->model('UsersModel');

        // Get logged-in user from session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $logged_in_user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        // Fetch the user to be edited
        $user = $this->UsersModel->get_user_by_id($id);
        if (!$user) {
            echo "User not found.";
            return;
        }

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            // Only allow admin to update role and password
            if (!empty($logged_in_user) && $logged_in_user['role'] === 'admin') {
                $role = $this->io->post('role');
                $password = $this->io->post('password');
                $data = [
                    'username' => $username,
                    'email' => $email,
                    'role' => $role,
                ];

                if (!empty($password)) {
                    $data['password'] = password_hash($password, PASSWORD_BCRYPT);
                }
            } else {
                // Normal users can only update username and email
                $data = [
                    'username' => $username,
                    'email' => $email
                ];
            }

            if ($this->UsersModel->update($id, $data)) {
                redirect('/users');
            } else {
                echo 'Failed to update user.';
            }
        } else {
            // Pass both the user being edited and the logged-in user to the view
            $data['user'] = $user;
            $data['logged_in_user'] = $logged_in_user;
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        $this->call->model('UsersModel');
        if($this->UsersModel->delete($id)){
            redirect('/users');
        } else {
            echo 'Failed to delete user.';
        }
    }

    public function register()
    {
        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);

            $data = [
                'username'   => $username,
                'email'      => $this->io->post('email'),
                'password'   => $password,
                'role'       => $this->io->post('role'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->UsersModel->insert($data)) {
                redirect('/auth/login');
            }
        }

        $this->call->view('/auth/login');
    }

    public function login()
    {
        $error = null;

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            $user = $this->UsersModel->get_user_by_username($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'role'     => $user['role']
                ];

                redirect('/users');
            } else {
                $error = "Invalid username or password!";
            }
        }

        $this->call->view('auth/login', ['error' => $error]);
    }

    public function dashboard()
    {
        $page = !empty($this->io->get('page')) ? $this->io->get('page') : 1;
        $q    = !empty($this->io->get('q')) ? trim($this->io->get('q')) : '';
        $records_per_page = 10;

        $user = $this->UsersModel->page($q, $records_per_page, $page);
        $data['users'] = $user['records'];
        $total_rows   = $user['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/dashboard', $data);
    }

    public function logout()
    {
        unset($_SESSION['users']); // clear session manually
        redirect('auth/login');
    }
} 