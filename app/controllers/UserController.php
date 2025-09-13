<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function profile($username, $name)
    {
        $data['username'] = $username;
        $data['name'] = $name;
        $this->call->view('ViewProfile', $data);
    }

    public function show()
    {
        $data['students'] = $this->UserModel->all();
        $this->call->view('Showdata', $data);
    }

    public function create()
    {
        if ($this->io->method() == 'post')
        {
            $last_name  = $this->io->post('last_name');
            $first_name = $this->io->post('first_name');
            $email      = $this->io->post('email');
            $role       = $this->io->post('role');

            $data = [
                'last_name'  => $last_name,
                'first_name' => $first_name,
                'email'      => $email,
                'Role'       => $role
            ];

            if ($this->UserModel->insert($data)) {
                // 👉 palit: siguradong tama ang URL kahit walang clean rewrite
                redirect(site_url('user/show'));
            } else {
                echo 'Failed to insert data.';
            }
        } else {
            $this->call->view('Create');
        }
    }

    public function update($id)
    {
        $data['students'] = $this->UserModel->find($id);

        if ($this->io->method() == 'post')
        {
            $last_name  = $this->io->post('last_name');
            $first_name = $this->io->post('first_name');
            $email      = $this->io->post('email');
            $role       = $this->io->post('role');

            $data = [
                'last_name'  => $last_name,
                'first_name' => $first_name,
                'email'      => $email,
                'Role'       => $role
            ];

            if ($this->UserModel->update($id, $data)) {
                // 👉 palit dito
                redirect(site_url('user/show'));
            } else {
                echo 'Failed to update data.';
            }
        }

        $this->call->view('Update', $data);
    }

    public function delete($id)
    {
        if ($this->UserModel->delete($id)) {
            // 👉 palit dito
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to delete data.';
        }
    }

    public function soft_delete($id)
    {
        if ($this->UserModel->soft_delete($id)) {
            // 👉 palit dito
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to delete data.';
        }
    }

    public function restore($id)
    {
        if ($this->UserModel->restore($id)) {
            // 👉 palit dito
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to restore data.';
        }
    }
}
