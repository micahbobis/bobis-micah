<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {

    public function __construct()
    {
        parent::__construct();
        // Walang ibang logic dito para maiwasan ang redeclare
    }

    public function profile($username, $name)
    {
        $data['username'] = $username;
        $data['name'] = $name;
        $this->call->view('ViewProfile', $data);
    }

    public function show()
    {
        // dito na lahat ng pagination code
        $page = 1;
        if (isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if (isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['students'] = $all['records'];
        $total_rows = $all['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page,'user/show?q='.$q);

        $data['page'] = $this->pagination->paginate();
        $this->call->view('user/show', $data);
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
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to delete data.';
        }
    }

    public function soft_delete($id)
    {
        if ($this->UserModel->soft_delete($id)) {
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to delete data.';
        }
    }

    public function restore($id)
    {
        if ($this->UserModel->restore($id)) {
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to restore data.';
        }
    }
}
