<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * 
 * Automatically generated via CLI.
 */
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
        $data ['students'] = $this->UserModel->all();
        $this->call->view('Showdata', $data);
    }

    public function create()
    {
        if($this->io->method() == 'post')
        {
            $last_name = $this->io->post('last_name');
            $first_name = $this->io->post('first_name');
            $email = $this->io->post('email');
            $role = $this->io->post('role');
            $data = array(
                'last_name' => $last_name,
                'first_name' => $first_name,
                'email' => $email,
                'Role' => $role
            );
            if($this->UserModel->insert($data))
            {
               redirect('/user/show');
            }else{
                echo 'Failed to insert data.';
            }
            }else{
                    $this->call->view('Create');
            }
        }

        public function update($id)
        {
            $data ['students'] = $this->UserModel->find($id);
            if($this->io->method() == 'post')
            {
                $last_name = $this->io->post('last_name');
                $first_name = $this->io->post('first_name');
                $email = $this->io->post('email');
                $role = $this->io->post('role');
                $data = array(
                    'last_name' => $last_name,
                    'first_name' => $first_name,
                    'email' => $email,
                    'Role' => $role
                );
                if($this->UserModel->update($id, $data))
                {
                   redirect('user/show');
                }else{
                    echo 'Failed to update data.';
                }
            }
            $this->call->view('Update', $data);
        }

        public function delete($id)
        {
            if($this->UserModel->delete($id))
            {
                redirect('user/show');
            }else{
                echo 'Failed to delete data.';
            }
        }

        public function soft_delete($id)
        {
            if($this->UserModel->soft_delete($id))
            {
                redirect('user/show');
            }else{
                echo 'Failed to delete data.';
            }
        }

        public function restore($id)
        {
            if($this->UserModel->restore($id))
            {
                redirect('user/show');
            }else{
                echo 'Failed to restore data.';
            }
        }
    }
