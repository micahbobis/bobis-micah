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

    if ($this->io->method() === 'post') {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        // Login function returns user array on success
        $user = $this->auth->login($username, $password);

        if ($user) {
            // Set session (for controller & view)
            $this->session->set_userdata([
                'user_id'  => $user['id'],
                'username' => $user['username'],
                'role'     => $user['role'], // 'admin' or 'user'
                'logged_in'=> true
            ]);

            // Optional: para magamit sa plain PHP views
            $_SESSION['role'] = $user['role'];

            redirect('/users/view'); // pareho page for admin & user
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
