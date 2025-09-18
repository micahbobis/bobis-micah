<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 * 
 * Automatically generated via CLI.
 */
class UserModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

            public function page($q, $records_per_page = null, $page = null) {
            if (is_null($page)) {
                return $this->db->table('students')->get_all();
            } else {
                $query = $this->db->table('students');
                
                // Build LIKE conditions
                $query->like('id', '%'.$q.'%')
                    ->or_like('last_name', '%'.$q.'%')
                    ->or_like('first_name', '%'.$q.'%')
                    ->or_like('email', '%'.$q.'%')
                    ->or_like('Role', '%'.$q.'%')
                    ->or_like('deleted_at', '%'.$q.'%');

                // Clone before pagination
                $countQuery = clone $query;

                $data['total_rows'] = $countQuery->select_count('*', 'count')
                                                ->get()['count'];

                $data['records'] = $query->pagination($records_per_page, $page)
                                        ->get_all();

                return $data;
            }
        }

    public function __construct()
    {
        parent::__construct();
    }
    
}