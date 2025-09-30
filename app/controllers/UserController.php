<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
         $this->call->library('auth'); // 🔹 load Auth library

        // Check if user is logged in
        if (!$this->auth->is_logged_in()) {
            redirect('auth/login');
        }
         $role = $_SESSION['role'] ?? 'user';
    $current_method = $this->router->method;

    if ($role !== 'admin' && in_array($current_method, ['create','update','delete'])) {
        redirect('auth/dashboard'); // user can’t modify users
    }


 }

    public function view()
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
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users/view'.'?q='.$q);
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/view', $data);
    }

    public function create()
    {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $imagePath = 'uploads/default-avatar.png'; // default

            // Handle file upload
            if (!empty($_FILES['profile']['name'])) {
                $this->call->library('upload', $_FILES["profile"]);
                $this->upload
                    ->set_dir('public/uploads/') // save inside public so it's accessible
                    ->allowed_extensions(['jpg','jpeg','png','webp'])
                    ->allowed_mimes(['image/jpeg','image/png','image/pjpeg','image/webp'])
                    ->max_size(5)   // 5MB max
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
        $data['user'] = $this->UserModel->find($id);

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $imagePath = $data['user']['image_path']; // keep current image by default

            if (!empty($_FILES['profile']['name'])) {
                $this->call->library('upload', $_FILES["profile"]);
                $this->upload
                    ->set_dir('public/uploads')
                    ->allowed_extensions(['jpg','jpeg','png'])
                    ->allowed_mimes(['image/jpeg','image/png'])
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
            $data['user'] = $this->UserModel->find($id);
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        $user = $this->UserModel->find($id);
        
        // Optional: delete the uploaded file
        if($user && isset($user['image_path']) && $user['image_path'] !== 'uploads/default-avatar.png') {
             $fullPath = __DIR__ . '/../../public/' . $user['image_path']; 
             if (is_file($fullPath)) {
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