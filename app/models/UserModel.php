<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 */
class UserModel extends Model {
    protected $table = 'students';       // updated table
    protected $primary_key = 'id';
    protected $allowed_fields = ['last_name', 'first_name', 'email', 'Role']; // optional: define allowed fields

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Paginate students with optional search
     *
     * @param string $q Search query
     * @param int|null $records_per_page Number of records per page
     * @param int|null $page Current page
     * @return array ['total_rows' => int, 'records' => array]
     */
    public function page($q = '', $records_per_page = null, $page = null)
    {
        // return all if no page is provided
        if (is_null($page)) {
            return [
                'total_rows' => $this->db->table($this->table)->count_all(),
                'records'    => $this->db->table($this->table)->get_all()
            ];
        }

        $query = $this->db->table($this->table);

        // optional search filter
        if (!empty($q)) {
            $query->like('last_name', '%'.$q.'%')
                  ->or_like('first_name', '%'.$q.'%')
                  ->or_like('email', '%'.$q.'%');
        }

        // clone query to count total rows
        $countQuery = clone $query;
        $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

        // fetch paginated records
        $data['records'] = $query->pagination($records_per_page, $page)->get_all();

        return $data;
    }
}
