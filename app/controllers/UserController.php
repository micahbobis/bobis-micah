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
        // kunin current page
        $page = 1;
        if ($this->io->get('page')) {
            $page = (int) $this->io->get('page');
        }

        // kunin search query
        $q = '';
        if ($this->io->get('q')) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;

        // kuha data mula model
        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['students']  = $all['records'];
        $total_rows        = $all['total_rows'];

        // setup pagination
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize(
            $total_rows,
            $records_per_page,
            $page,
            site_url('user/show').'?q='.$q
        );

        $data['page'] = $this->pagination->paginate();

        // 👉 siguraduhing ito ang tinatawag na view file
        $this->call->view('Showdata', $data);
    }

    public function create()
    {
        if ($this->io->method() == 'post') {
            $data = [
                'last_name'  => $this->io->post('last_name'),
                'first_name' => $this->io->post('first_name'),
                'email'      => $this->io->post('email'),
                'Role'       => $this->io->post('role')
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

        if ($this->io->method() == 'post') {
            $updateData = [
                'last_name'  => $this->io->post('last_name'),
                'first_name' => $this->io->post('first_name'),
                'email'      => $this->io->post('email'),
                'Role'       => $this->io->post('role')
            ];

            if ($this->UserModel->update($id, $updateData)) {
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
