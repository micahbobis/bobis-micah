<?php
class AuthController extends Controller
{
    public function register()
{
    $this->call->library('auth');

    if ($this->io->method() == 'post') {
        $username = $this->io->post('username');
        $email    = $this->io->post('email');
        $password = $this->io->post('password');
        $role     = $this->io->post('role') ?? 'user';

        if ($this->auth->register($username, $email, $password, $role)) {
            redirect('/users/view');
        } else {
            echo "Registration failed. Please try again.";
        }
    }

    $this->call->view('auth/register');
}

    public function login()
    {
        $this->call->library('auth');

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($this->auth->login($username, $password)) {
                // check role and redirect accordingly
                if ($this->auth->has_role('admin')) {
                    redirect('/users/view'); // full access page
                } else {
                    redirect('auth/login'); // user view-only page
                }
            } else {
                echo 'Login failed!';
            }
        }

        $this->call->view('auth/login');
    }

  
    public function logout()
    {
        $this->call->library('auth');
        $this->auth->logout();
        redirect('auth/login');
    }
}
