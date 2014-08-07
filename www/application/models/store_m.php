<?php

class Store_m extends CI_Model
{
    /**
     * [$tbl table name storage]
     * @var array
     */
    private $tbl = array(
        'store' => 'store_entries'
    );

    /**
     * [__construct constructor]
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [getStoreEntries returns all store entry data or data for the input item id]
     * @param  [type] $id [item id to return, else return all]
     * @return [type]     [description]
     */
    public function getStoreEntries($id = null)
    {
        $this->db->from($this->tbl['store']);

        # specified an id?
        if (!empty($id)) {
            $this->db->where('id', $id);
        }

        # order by
        $this->db->order_by('id', 'desc');

        # grab data
        $query = $this->db->get();
        return $query->result_object();
    }
}
