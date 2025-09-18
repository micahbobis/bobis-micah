<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    /**
     * Kunin ang mga records na may optional search at pagination.
     * @param string $q search query
     * @param int    $records_per_page bilang ng records kada page
     * @param int    $page current page number
     * @return array ['records'=>[], 'total_rows'=>int]
     */
    public function page($q = '', $records_per_page = 10, $page = 1)
    {
        // kapag walang page na binigay, lahat ng data lang
        if (is_null($page)) {
            return $this->db->table($this->table)->get_all();
        }

        $query = $this->db->table($this->table);

        // kung may search query, mag-add ng LIKE conditions
        if ($q !== '') {
            $query->like('id', '%'.$q.'%')
                  ->or_like('last_name', '%'.$q.'%')
                  ->or_like('first_name', '%'.$q.'%')
                  ->or_like('email', '%'.$q.'%')
                  ->or_like('Role', '%'.$q.'%')
                  ->or_like('deleted_at', '%'.$q.'%');
        }

        // clone query para kunin total count bago i-limit
        $countQuery = clone $query;
        $total_rows = $countQuery->select_count('*', 'count')->get()['count'];

        $records = $query->pagination($records_per_page, $page)
                         ->get_all();

        return [
            'records'    => $records,
            'total_rows' => $total_rows
        ];
    }

    public function __construct()
    {
        parent::__construct();
    }
}
