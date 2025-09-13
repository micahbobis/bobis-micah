<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function profile($username, $name) {
        $data['username'] = $username;
        $data['name'] = $name;
        $this->call->view('ViewProfile', $data);
    }

    public function show()
    {
        $data['students'] = $this->UserModel->all(); // Ensure 'deleted_at' exists or remove soft-delete query
        $this->call->view('Showdata', $data);
    }

    public function create()
    {
        if($this->io->method() == 'post')
        {
            $data = [
                'last_name' => $this->io->post('last_name'),
                'first_name' => $this->io->post('first_name'),
                'email' => $this->io->post('email'),
                'Role' => $this->io->post('role')
            ];
            if($this->UserModel->insert($data)) {
                redirect('/user/show'); // ✅ absolute path
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

        if($this->io->method() == 'post')
        {
            $update_data = [
                'last_name' => $this->io->post('last_name'),
                'first_name' => $this->io->post('first_name'),
                'email' => $this->io->post('email'),
                'Role' => $this->io->post('role')
            ];
            if($this->UserModel->update($id, $update_data)) {
                redirect('/user/show');
            } else {
                echo 'Failed to update data.';
            }
        }

        $this->call->view('Update', $data);
    }

    public function delete($id)
    {
        if($this->UserModel->delete($id)) {
            redirect('/user/show');
        } else {
            echo 'Failed to delete data.';
        }
    }

    public function soft_delete($id)
    {
        if($this->UserModel->soft_delete($id)) {
            redirect('/user/show');
        } else {
            echo 'Failed to soft-delete data.';
        }
    }

    public function restore($id)
    {
        if($this->UserModel->restore($id)) {
            redirect('/user/show');
        } else {
            echo 'Failed to restore data.';
        }
    }
}
