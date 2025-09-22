<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct() {
        parent::__construct();
    }

    // Active users with pagination + search
    public function page($q = '', $records_per_page = null, $page = null) {
        $query = $this->db->table($this->table)->where('deleted_at', null);

        if ($q !== '') {
            $query->like('id', '%'.$q.'%')
                  ->or_like('last_name', '%'.$q.'%')
                  ->or_like('first_name', '%'.$q.'%')
                  ->or_like('email', '%'.$q.'%')
                  ->or_like('Role', '%'.$q.'%');
        }

        if (is_null($page)) {
            return $query->get_all();
        }

        $countQuery = clone $query;
        $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];
        $data['records']    = $query->pagination($records_per_page, $page)->get_all();
        return $data;
    }

    public function insert($data) {
        return $this->db->table($this->table)->insert($data);
    }

    // Keep same signature as parent
    public function find($id, $with_deleted = false) {
        $query = $this->db->table($this->table)->where('id', $id);
        if (!$with_deleted) $query->where('deleted_at', null);
        return $query->get();
    }

    public function update($id, $data) {
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }

    public function delete($id) {
        return $this->db->table($this->table)->where('id', $id)->delete();
    }

    public function soft_delete($id) {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->update(['deleted_at' => date('Y-m-d H:i:s')]);
    }

    // Soft-deleted users with pagination + search
    public function restore_page($q = '', $records_per_page = null, $page = null) {
        $query = $this->db->table($this->table)->where_not_null('deleted_at');

        if ($q !== '') {
            $query->like('id', '%'.$q.'%')
                  ->or_like('last_name', '%'.$q.'%')
                  ->or_like('first_name', '%'.$q.'%')
                  ->or_like('email', '%'.$q.'%')
                  ->or_like('Role', '%'.$q.'%')
                  ->or_like('deleted_at', '%'.$q.'%');
        }

        if (is_null($page)) {
            return $query->get_all();
        }

        $countQuery = clone $query;
        $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];
        $data['records']    = $query->pagination($records_per_page, $page)->get_all();
        return $data;
    }

    public function restore($id) {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->update(['deleted_at' => null]);
    }
}
