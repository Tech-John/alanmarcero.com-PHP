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
        $this->load->database();
    }

    /**
     * [getCustomerCount returns the total count of customers is the customers table]
     * @return [type] [description]
     */
    public function getCustomerCount()
    {
        return $this->db->count_all($this->tbl['customers']);
    }

    /**
     * [getPurchasedCount the total count of purchased items]
     * @return [type] [description]
     */
    public function getPurchasedCount()
    {
        return $this->db->count_all($this->tbl['purchases']);
    }

    /**
     * [getLastPurchased returns the last item purchased]
     * @return [type] [description]
     */
    public function getLastPurchased()
    {
        $query = "SELECT * FROM {$this->tbl['purchases']} ORDER BY created_at DESC LIMIT 1";
        $result = $this->db->query($query);
        return $result->result_object()[0];
    }

    /**
     * [getStoreEntries returns all store entry data or data for the input item id]
     * @param  [type] $id [item id to return, else return all]
     * @return [type]     [description]
     */
    public function getStoreEntries($id = null)
    {
        $query = "SELECT * FROM {$this->tbl['store']} ";

        # specified an ID?
        if (!empty($id)) {
            $query .= " WHERE id = {$id} ";
        }

        # order by
        $query .= " ORDER BY id DESC";

        # grab data
        $result = $this->db->query($query);
        return $result->result_object();
    }

    /**
     * [getItemNameById lookup the name of an item by its store id]
     * @param  [type] $id [the item_id we're looking up]
     * @return [string]     [the item name]
     */
    public function getItemNameById($id)
    {
        if (empty($id)) {
            return false;
        }

        $query = "SELECT name FROM {$this->tbl['store']} WHERE id = '{$id}' LIMIT 1";
        $result = $this->db->query($query);
        $obj = $result->result_object();
        return $obj[0]->name;
    }

    /**
     * [createUser creates a user with the input email and generates a random password for that user_error()
     *     if the input email is already in use, false is returned]
     * @param  [string] $email [the email address for this user, required]
     * @return [void]        [description]
     */
    public function createUser($email)
    {
        if (empty($email)) {
            return false;
        }
    }

    /**
     * [getUserByEmail gets the user_id and other info from the customers table for the input email]
     * @param  [string] $email [the email we are looking up.  required, return false if not input]
     * @return [array]        [one db row from the customers table for this user]
     */
    public function getUserByEmail($email)
    {
        if (empty($email)) {
            return false;
        }
    }

    /**
     * [purchaseItem adds a record for the input user_id and item_id to the purchased_items table to be 'purchased']
     * @param  [user_id] $email [the user_id this item is being tied to, required]
     * @param  [int] $item_id  [the item_id that the user is purchasing, required]
     * @return [void]        [description]
     */
    public function purchaseItem($user_id, $item_id)
    {
        if (empty($user_id) || empty($item_id)) {
            return false;
        }
    }
}
