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
        // --- Ayos na default value para sa pagination ---
        // gamit ang LavaLust I/O helper para hindi mag-warning
        $page = (int) $this->io->get('page', 1);

        // Search query (optional)
        $q = '';
        if ($this->io->get('q')) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;

        // Kunin records at total rows mula sa model
        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['students'] = $all['records'];
        $total_rows = $all['total_rows'];

        // Settings ng pagination links
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('user/show').'?q='.$q);

        // I-pass ang HTML ng pagination sa view
        $data['page'] = $this->pagination->paginate();

        // ✅ siguraduhing pareho ang path ng view sa aktwal mong file
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
