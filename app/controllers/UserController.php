<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load UserModel once here (if not autoloaded)
        $this->call->model('UserModel');
    }

    /**
     * Sample profile page
     */
    public function profile($username, $name)
    {
        $data = [
            'username' => $username,
            'name'     => $name
        ];
        $this->call->view('ViewProfile', $data);
    }

    /**
     * Show records with search & pagination
     */
    public function show()
    {
        // Current page: force int and minimum of 1
        $page = (int) $this->io->get('page', 1);
        $page = max($page, 1);

        // Search keyword (optional)
        $q = trim($this->io->get('q', ''));

        $records_per_page = 10;

        // Fetch paged records and total rows
        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['students'] = $all['records'];
        $total_rows       = $all['total_rows'];

        // Proper base URL for pagination links
        $base_url = site_url('user/show') . '?q=' . urlencode($q);

        // Pagination settings
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            // always use &page= so search query is preserved
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, $base_url);

        $data['page'] = $this->pagination->paginate();

        $this->call->view('user/show', $data);
    }

    /**
     * Create new record
     */
    public function create()
    {
        if ($this->io->method() === 'post') {
            $data = [
                'last_name'  => trim($this->io->post('last_name')),
                'first_name' => trim($this->io->post('first_name')),
                'email'      => trim($this->io->post('email')),
                'Role'       => trim($this->io->post('role'))
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

    /**
     * Update existing record
     */
    public function update($id)
    {
        $data['students'] = $this->UserModel->find($id);

        if ($this->io->method() === 'post') {
            $update = [
                'last_name'  => trim($this->io->post('last_name')),
                'first_name' => trim($this->io->post('first_name')),
                'email'      => trim($this->io->post('email')),
                'Role'       => trim($this->io->post('role'))
            ];

            if ($this->UserModel->update($id, $update)) {
                redirect(site_url('user/show'));
            } else {
                echo 'Failed to update data.';
            }
        }

        $this->call->view('Update', $data);
    }

    /**
     * Hard delete
     */
    public function delete($id)
    {
        if ($this->UserModel->delete($id)) {
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to delete data.';
        }
    }

    /**
     * Soft delete (mark as deleted)
     */
    public function soft_delete($id)
    {
        if ($this->UserModel->soft_delete($id)) {
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to delete data.';
        }
    }

    /**
     * Restore soft-deleted record
     */
    public function restore($id)
    {
        if ($this->UserModel->restore($id)) {
            redirect(site_url('user/show'));
        } else {
            echo 'Failed to restore data.';
        }
    }
}
