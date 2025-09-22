<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * 
 * Reformatted to match CrudController style.
 */
class UserController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // Profile view
    public function profile($username, $name)
    {
        $data['username'] = $username;
        $data['name'] = $name;
        $this->call->view('ViewProfile', $data);
    }

    // Read / Show users with pagination
    public function show()
    {
        $page = 1;
        if(isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && !empty($_GET['q'])) {
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
        $this->pagination->set_theme('custom'); // or bootstrap, tailwind
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'user/show?q='.$q);

        $data['page'] = $this->pagination->paginate();
        $this->call->view('user/show', $data);
    }

    // Create user
    public function create()
    {
        if($this->io->method() == 'post') {
            $data = [
                'last_name'  => $this->io->post('last_name'),
                'first_name' => $this->io->post('first_name'),
                'email'      => $this->io->post('email'),
                'Role'       => $this->io->post('role')
            ];

            if($this->UserModel->insert($data)) {
                redirect(site_url('user/show'));
            } else {
                echo 'Failed to insert data.';
            }
        } else {
            $this->call->view('Create');
        }
    }

    // Update user
    public function update($id)
    {
        $data['students'] = $this->UserModel->find($id);

        if($this->io->method() == 'post') {
            $update_data = [
                'last_name'  => $this->io->post('last_name'),
                'first_name' => $this->io->post('first_name'),
                'email'      => $this->io->post('email'),
                'Role'       => $this->io->post('role')
            ];

            if($this->UserModel->update($id, $update_data)) {
                redirect(site_url('user/show'));
            } else {
                echo 'Failed to update data.';
            }
        }

        $this->call->view('Update', $data);
    }

    // Hard delete
    public function delete($id)
    {
        if($this->UserModel->delete($id)) {
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to delete data.';
        }
    }

    // Soft delete
    public function softdelete($id)
    {
        if($this->UserModel->soft_delete($id)) {
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to delete data.';
        }
    }

    // Show deleted / restore page
    public function restore()
    {
        $page = 1;
        if(isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        // Call a model function for restore listing
        $all = $this->UserModel->restore_page($q, $records_per_page, $page);
        $data['students'] = $all['records'];
        $total_rows = $all['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('custom'); // or bootstrap, tailwind
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'user/restore?q='.$q);

        $data['page'] = $this->pagination->paginate();
        $this->call->view('user/restore', $data);
    }

    // Restore a deleted record
    public function retrieve($id)
    {
        if($this->UserModel->restore($id)) {
            redirect(site_url('user/show'));
        } else {
            echo 'Error restoring data.';
        }
    }
}
