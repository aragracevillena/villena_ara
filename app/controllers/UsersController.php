<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();

        // ✅ Make sure session is active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // ✅ Display all errors for debugging (you can disable later for production)
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
    }

    public function index()
    {
        $this->call->model('UsersModel');

        // ✅ Check if a user is logged in
        if (!isset($_SESSION['user'])) {
            redirect('/auth/login');
            exit;
        }

        $logged_in_user = $_SESSION['user']; 
        $data['logged_in_user'] = $logged_in_user;

        // ✅ Pagination setup
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $q = isset($_GET['q']) ? trim($_GET['q']) : '';
        $records_per_page = 10;

        // ✅ Fetch paginated users safely
        $users = $this->UsersModel->page($q, $records_per_page, $page);
        $data['user'] = $users['records'] ?? [];
        $total_rows = $users['total_rows'] ?? 0;

        // ✅ Setup pagination
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

        // ✅ Render view
        $this->call->view('users/index', $data);
    }

    public function create()
    {
        $this->call->model('UsersModel');

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            $data = [
                'username' => $username,
                'email' => $email
            ];

            if ($this->UsersModel->insert($data)) {
                redirect('/users');
            } else {
                echo '❌ Failed to create user.';
            }
        } else {
            $this->call->view('users/create');
        }
    }

    public function update($id)
    {
        $this->call->model('UsersModel');

        $logged_in_user = $_SESSION['user'] ?? null;
        $user = $this->UsersModel->get_user_by_id($id);

        if (!$user) {
            echo "❌ User not found.";
            return;
        }

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            // ✅ Admin-only updates
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
                $data = [
                    'username' => $username,
                    'email' => $email
                ];
            }

            if ($this->UsersModel->update($id, $data)) {
                redirect('/users');
            } else {
                echo '❌ Failed to update user.';
            }
        } else {
            $data['user'] = $user;
            $data['logged_in_user'] = $logged_in_user;
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        $this->call->model('UsersModel');
        if ($this->UsersModel->delete($id)) {
            redirect('/users');
        } else {
            echo '❌ Failed to delete user.';
        }
    }

    public function register()
    {
        $this->call->model('UsersModel');

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
            $role = $this->io->post('role');

            $data = [
                'username'   => $username,
                'email'      => $email,
                'password'   => $password,
                'role'       => $role,
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->UsersModel->insert($data)) {
                redirect('/auth/login');
            } else {
                echo '❌ Registration failed.';
            }
        }

        $this->call->view('auth/register');
    }

    public function login()
    {
        $this->call->model('UsersModel');

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
        $this->call->model('UsersModel');

        $page = !empty($this->io->get('page')) ? $this->io->get('page') : 1;
        $q = !empty($this->io->get('q')) ? trim($this->io->get('q')) : '';
        $records_per_page = 10;

        $user = $this->UsersModel->page($q, $records_per_page, $page);
        $data['user'] = $user['records'] ?? [];
        $total_rows = $user['total_rows'] ?? 0;

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

        $this->call->view('user/dashboard', $data);
    }

    public function logout()
    {
        session_destroy();
        redirect('/auth/login');
    }
}
