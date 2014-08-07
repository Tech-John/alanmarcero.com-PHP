<?php

class Store_m extends CI_Model
{
    /**
     * [$tbl table name storage]
     * @var array
     */
    private $tbl = array(
        'store' => 'store_entries',
        'customers' => 'customers',
        'purchases' => 'purchased_items',
        'promo_emails' => 'promotional_emails',
        'admins' => 'administrators',
        'ebay' => 'auction_items'
    );

    /**
     * [__construct constructor]
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [getCustomerCount returns the total count of customers is the customers table]
     * @return [type] [description]
     */
    public function getCustomerCount()
    {
        return $this->db->count_all($this->tbl['customers']);
    }

    public function getPurchasesCount()
    {
        return $this->db->count_all($this->tbl['purchases']);
    }

    /**
     * [getStoreEntries returns all store entry data or data for the input item id]
     * @param  [type] $id [item id to return, else return all]
     * @return [type]     [description]
     */
    public function getStoreEntries($id = null)
    {
        $query = "SELECT * from {$this->tbl['store']} ";

        # specified an ID?
        if (!empty($id)) {
            $query .= " WHERE id = {$id} ";
        }

        # order by
        $query .= " ORDER BY id DESC";

        # grab data
        $query = $this->db->get($query);
        return $query->result_object();
    }
}
