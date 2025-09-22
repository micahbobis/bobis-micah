<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // Paginated search for active users
    public function page($q, $records_per_page = null, $page = null) {
        if (is_null($page)) {
            return $this->db->table('students')->where('deleted_at', null)->get_all();
        } else {
            $query = $this->db->table('students')->where('deleted_at', null);

            $query->like('id', '%'.$q.'%')
                ->or_like('last_name', '%'.$q.'%')
                ->or_like('first_name', '%'.$q.'%')
                ->or_like('email', '%'.$q.'%')
                ->or_like('Role', '%'.$q.'%');

            $countQuery = clone $query;
            $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];
            $data['records'] = $query->pagination($records_per_page, $page)->get_all();
            return $data;
        }
    }

    // Insert new user
    public function insert($data) {
        return $this->db->table('students')->insert($data);
    }

    // Find user by ID
    public function find($id) {
        return $this->db->table('students')->where('id', $id)->get();
    }

    // Update user
    public function update($id, $data) {
        return $this->db->table('students')->where('id', $id)->update($data);
    }

    // Hard delete
    public function delete($id) {
        return $this->db->table('students')->where('id', $id)->delete();
    }

    // Soft delete (mark deleted_at)
    public function soft_delete($id) {
        return $this->db->table('students')
            ->where('id', $id)
            ->update(['deleted_at' => date('Y-m-d H:i:s')]);
    }

    // Paginated list of deleted users
    public function restore_page($q, $records_per_page = null, $page = null) {
        if (is_null($page)) {
            return $this->db->table('students')->where_not_null('deleted_at')->get_all();
        } else {
            $query = $this->db->table('students')->where_not_null('deleted_at');

            $query->like('id', '%'.$q.'%')
                ->or_like('last_name', '%'.$q.'%')
                ->or_like('first_name', '%'.$q.'%')
                ->or_like('email', '%'.$q.'%')
                ->or_like('Role', '%'.$q.'%')
                ->or_like('deleted_at', '%'.$q.'%');

            $countQuery = clone $query;
            $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];
            $data['records'] = $query->pagination($records_per_page, $page)->get_all();
            return $data;
        }
    }

    // Restore a soft-deleted user
    public function restore($id) {
        return $this->db->table('students')
            ->where('id', $id)
            ->update(['deleted_at' => null]);
    }
}
