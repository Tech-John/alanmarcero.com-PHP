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
     * @return [type] []
     */
    public function getCustomerCount()
    {
        return $this->db->count_all($this->tbl['customers']);
    }

    /**
     * [getPurchasedCount the total count of purchased items]
     * @return [type] []
     */
    public function getPurchasedCount()
    {
        return $this->db->count_all($this->tbl['purchases']);
    }

    /**
     * [getLastPurchased returns the last item purchased]
     * @return [type] []
     */
    public function getLastPurchased()
    {
        $query = "SELECT * FROM {$this->tbl['purchases']} ORDER BY created_at DESC LIMIT 1";
        $result = $this->db->query($query);
        return $result->result_object()[0];
    }

    /**
     * [getStoreEntries returns all store entry data or data for the input item id]
     * @param  [int/string] $id [item id to return, else return all]
     * @return [type]     []
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
     *     if the input email is already in use, the found user is returned]
     * @param  [string] $email [the email address for this user, required]
     * @return [result object]        [the db row of the created user]
     */
    public function createUser($email)
    {
        if (empty($email)) {
            return false;
        }

        # first make sure the user isn't already in the system
        $query = "SELECT * from customers where email = '{$email}' LIMIT 1";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            # create the user
            $query = "INSERT INTO customers set email = '{$email}', password = '" . generateRandPassword(6) . "'";
            $result = $this->db->query($query);

            # return the created user
            $query = "SELECT * from customers where email = '{$email}' LIMIT 1";
            $result = $this->db->query($query);
            return $result->row();
        }
        return false;
    }

    /**
     * [getUserByEmail gets the DB row from the customers table for the input email]
     * @param  [string] $email [the email we are looking up.  required, return false if not input]
     * @return [object/bool]        [one db row from the customers table for this user, false if not found]
     */
    public function getUserByEmail($email)
    {
        if (empty($email)) {
            return false;
        }

        # escape inputs by using active record
        $this->db->select("*")->from($this->tbl['customers']);
        $this->db->where("email", $email);

        # select the data and return
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    /**
     * [verifyLogin used to verify if the input login and password are correct]
     * @param  [string] $email    [the user's email]
     * @param  [string] $password [the user's password]
     * @return [obj/bool]         [a user row object if the data is correct, else false]
     */
    public function verifyLogin($email, $password)
    {
        if (empty($email) || empty($password)) {
            return false;
        }

        # escape inputs by using active record
        $this->db->select("*")->from($this->tbl['customers']);
        $this->db->where("email", $email);
        $this->db->where("password", $password);

        # select the data and return
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    /**
     * [getUserById gets the DB row from the customers table for the input user_id]
     * @param  [type] $user_id [the user_id we are looking up.  required, false if not input]
     * @return [object/bool] [one db row from the customers table for this user, false if not found]
     */
    public function getUserById($user_id)
    {
        if (empty($user_id)) {
            return false;
        }

        $query = "SELECT * FROM {$this->tbl['customers']} WHERE id = '{$user_id}'";
        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }


    /**
     * [purchaseItem adds a record for the input user_id and item_id to the purchased_items table to be 'purchased']
     * @param  [int/string] $user_id  [the user_id this item is being tied to, required]
     * @param  [int/string] $item_id  [the item_id that the user is purchasing, required]
     * @return [void]        []
     */
    public function purchaseItem($user_id, $item_id)
    {
        if (empty($user_id) || empty($item_id)) {
            return false;
        }

        # first see if this item has already been purchased
        $query = "SELECT * FROM {$this->tbl['purchases']}
            WHERE customer_id = '{$user_id}' AND store_entry_id = '{$item_id}'";
        $result = $this->db->query($query);
        $already_purchased = $result->num_rows();

        if ($already_purchased) {
            # just update the date
            $query = "UPDATE {$this->tbl['purchases']} SET created_at = now()
                WHERE customer_id = '{$user_id}' AND store_entry_id = '{$item_id}' LIMIT 1";
            $this->db->query($query);
        } else {
            # not already purchased, purchase it
            $query = "INSERT INTO {$this->tbl['purchases']}
                SET created_at = now(), customer_id = '{$user_id}', store_entry_id = '{$item_id}'";
            $this->db->query($query);
        }
    }

    /**
     * [getPurchasesByUserId takes the input user_id and gets all of that users purchased items]
     * @param  [type] $user_id [the user_id we are looking for items]
     * @return [array]          [an array of item objects.  the array will be empty if nothing is found]
     */
    public function getPurchasesByUserId($user_id)
    {
        if (empty($user_id)) {
            return false;
        }

        # get all the items this user has purchased
        $query = "SELECT * from {$this->tbl['purchases']}
            JOIN {$this->tbl['store']} ON {$this->tbl['purchases']}.store_entry_id = {$this->tbl['store']}.id
            WHERE customer_id = '{$user_id}'";
        $result = $this->db->query($query);
        return $result->result_object();
    }
}
