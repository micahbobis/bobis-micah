<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model
{
    protected $table       = 'students';
    protected $primary_key = 'id';

    /**
     * Pagination with optional search
     *
     * @param string $q              Search keyword (optional)
     * @param int    $records_per_page  Bilang ng record bawat page (hal. 10)
     * @param int    $page             Current page number (default 1)
     * @return array ['total_rows'=>int,'records'=>array]
     */
    public function page($q = '', $records_per_page = 10, $page = 1)
    {
        // siguraduhin may value ang $page kahit walang ?page= sa URL
        $page = (int) $page ?: 1;

        $query = $this->db->table($this->table);

        if ($q !== '') {
            // LIKE conditions para sa search
            $query->like('id', "%{$q}%")
                  ->or_like('last_name', "%{$q}%")
                  ->or_like('first_name', "%{$q}%")
                  ->or_like('email', "%{$q}%")
                  ->or_like('Role', "%{$q}%")
                  ->or_like('deleted_at', "%{$q}%");
        }

        // Clone bago mag-limit para makuha ang total count
        $countQuery = clone $query;

        $data['total_rows'] = $countQuery
                                ->select_count('*', 'count')
                                ->get()['count'];

        // Kunin lang ang records para sa kasalukuyang page
        $data['records'] = $query
                                ->pagination($records_per_page, $page)
                                ->get_all();

        return $data;
    }
}
