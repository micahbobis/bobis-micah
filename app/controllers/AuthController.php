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

        $user = $this->auth->login($username, $password); // ngayon bumabalik na ang user array

        if ($user) {
            redirect('users/view'); // redirect sa view, session na may role
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
