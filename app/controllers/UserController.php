<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
        $this->call->library('auth');

        if (!$this->auth->is_logged_in()) {
            redirect('auth/login');
        }
    }

    public function view()
    {
        $page = isset($_GET['page']) ? (int)$this->io->get('page') : 1;
        $q = isset($_GET['q']) ? trim($this->io->get('q')) : '';

        $records_per_page = 5;
        $all = $this->UserModel->page($q, $records_per_page, $page);

        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);

        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users/view?q='.$q);
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/view', $data);
    }

    public function create()
    {
        if ($_SESSION['role'] !== 'admin') {
            redirect('users/view');
            exit;
        }

        if ($this->io->method() === 'post') {
            $username  = $this->io->post('username');
            $email     = $this->io->post('email');
            $imagePath = 'uploads/default-avatar.png'; // relative path para display ok

            if (!empty($_FILES['profile']['name'])) {
                $this->call->library('upload', $_FILES["profile"]);
                $this->upload
                    ->set_dir('public/uploads/')
                    ->allowed_extensions(['jpg', 'jpeg', 'png', 'webp'])
                    ->allowed_mimes(['image/jpeg', 'image/png', 'image/webp'])
                    ->max_size(5)
                    ->is_image()
                    ->encrypt_name();

                if ($this->upload->do_upload()) {
                    $imagePath = 'uploads/' . $this->upload->get_filename();
                } else {
                    echo implode('<br>', $this->upload->get_errors());
                    return;
                }
            }

            $data = [
                'username'   => $username,
                'email'      => $email,
                'image_path' => $imagePath
            ];

            try {
                $this->UserModel->insert($data);
                redirect('users/view');
            } catch (Exception $e) {
                echo 'Something went wrong while creating user: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $this->call->view('users/create');
        }
    }

    public function update($id)
    {
        $role = $_SESSION['role'] ?? 'user';
        $current_user_id = $_SESSION['user_id'] ?? null;

        if ($role !== 'admin' && $current_user_id != $id) {
            redirect('users/view');
            exit;
        }

        $data['user'] = $this->UserModel->find($id);

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email    = $this->io->post('email');
            $oldImage = $data['user']['image_path'] ?? 'uploads/default-avatar.png';
            $imagePath = $oldImage;

            if (!empty($_FILES['profile']['name'])) {
                $this->call->library('upload', $_FILES["profile"]);
                $this->upload
                    ->set_dir('public/uploads/')
                    ->allowed_extensions(['jpg', 'jpeg', 'png', 'webp'])
                    ->allowed_mimes(['image/jpeg', 'image/png', 'image/webp'])
                    ->max_size(5)
                    ->is_image()
                    ->encrypt_name();

                if ($this->upload->do_upload()) {
                    $imagePath = 'uploads/' . $this->upload->get_filename();

                    // delete old image if not default
                    $oldPath = __DIR__ . '/../../public/' . $oldImage;
                if ($oldImage !== 'uploads/default-avatar.png' && file_exists($oldPath)) {
                unlink($oldPath);
}

                } else {
                    echo implode('<br>', $this->upload->get_errors());
                    return;
                }
            }

            $updateData = [
                'username'   => $username,
                'email'      => $email,
                'image_path' => $imagePath
            ];

            try {
                $this->UserModel->update($id, $updateData);
                redirect('users/view');
            } catch (Exception $e) {
                echo 'Something went wrong while updating user: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        $role = $_SESSION['role'] ?? 'user';
        $current_user_id = $_SESSION['user_id'] ?? null;

        if ($role !== 'admin') {
            redirect('users/view');
            exit;
        }

        $user = $this->UserModel->find($id);
        
        if ($user && isset($user['image_path']) && $user['image_path'] !== 'uploads/default-avatar.png') {
            $fullPath = __DIR__ . '/../../public/' . $user['image_path']; 
        if (file_exists($fullPath)) {
         unlink($fullPath);
}

        }

        if ($this->UserModel->delete($id)) {
            redirect('users/view');
        } else {
            echo 'Something went wrong while deleting user';
        }
    }
}
