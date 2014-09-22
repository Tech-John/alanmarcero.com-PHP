<?php

class Admin_m extends CI_Model
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
     * [verifyAdminLogin description]
     * @param  [type] $login    [description]
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    public function verifyAdminLogin($login, $password)
    {
        if (empty($login) || empty($password)) {
            return false;
        } else {
            # santiize our inputs
            $login = $this->db->escape($login);
            $password = $this->db->escape($password);
        }

        $query = "SELECT * FROM {$this->tbl['admins']} WHERE login = {$login} and password = md5({$password})";

        # select the data and return
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    /**
     * [removeStrandedPurchases removes records in the purchases table that are tied to un-known customer IDs]
     * @return [type] [description]
     */
    public function remove_StrandedPurchases()
    {
        # how many records will we be deleting?
        $query = "SELECT * FROM {$this->tbl['purchases']} WHERE {$this->tbl['purchases']}.customer_id NOT IN (SELECT id from {$this->tbl['customers']}) LIMIT 5";
        $result = $this->db->query($query);
        $result = $result->num_rows();

        # delete the records
        $query = "DELETE FROM {$this->tbl['purchases']} WHERE {$this->tbl['purchases']}.customer_id NOT IN (SELECT id from {$this->tbl['customers']}) LIMIT 5";
        $this->db->query($query);

        return $result;
    }

    /**
     * [removeTestAccounts deletes all customers with an email like '%marcero%']
     * @return [type] [description]
     */
    public function remove_TestAccounts()
    {
        # how many records will we be deleting?
        $query = "SELECT * FROM {$this->tbl['customers']} WHERE {$this->tbl['customers']}.email LIKE '%marcero%' LIMIT 5";
        $result = $this->db->query($query)->result_object();

        # delete the records
        $query = "DELETE FROM {$this->tbl['customers']} WHERE {$this->tbl['customers']}.email LIKE '%marcero%' LIMIT 5";
        $this->db->query($query);

        return $result;
    }

    /**
     * [removeTestPromos deletes all promo email records with an email like '%marcero%']
     * @return [type] [description]
     */
    public function remove_TestPromos()
    {
        # how many records will we be deleting?
        $query = "SELECT * FROM {$this->tbl['promo_emails']} WHERE {$this->tbl['promo_emails']}.email LIKE '%marcero%' LIMIT 5";
        $result = $this->db->query($query)->result_object();

        # delete the records
        $query = "DELETE FROM {$this->tbl['promo_emails']} WHERE {$this->tbl['promo_emails']}.email LIKE '%marcero%' LIMIT 5";
        $this->db->query($query);

        return $result;
    }

    /**
     * [stats_SalesCountsSinceLastRelease description]
     * @return [object] [result object]
     */
    public function stats_SalesCountsSinceLastRelease()
    {
        $query = "SELECT count(*) as count, {$this->tbl['store']}.name FROM {$this->tbl['purchases']}
            JOIN {$this->tbl['store']} ON {$this->tbl['purchases']}.store_entry_id = {$this->tbl['store']}.id
            WHERE {$this->tbl['purchases']}.created_at >=
                (SELECT max({$this->tbl['store']}.first_sale) FROM {$this->tbl['store']})
            GROUP BY store_entry_id ORDER BY count(*) DESC";

        $result = $this->db->query($query);
        return $result->result_object();
    }

    /**
     * [stats_PercentFreePurchases description]
     * @return [object] [result object]
     */
    public function stats_PercentFreePurchases()
    {
        $query = "SELECT round((sum(free_purchase) /
            (SELECT count(*) FROM {$this->tbl['purchases']} WHERE free_purchase IS NOT NULL)) * 100) as percent
            FROM {$this->tbl['purchases']}";

        $result = $this->db->query($query);
        return $result->result_object();
    }

    /**
     * [stats_AvgPricePaid description]
     * @return [object] [result object]
     */
    public function stats_AvgPricePaid()
    {
        $query = "SELECT avg(amount_paid) as amount
            FROM {$this->tbl['purchases']}
            WHERE amount_paid > 0";

        $result = $this->db->query($query);
        return $result->result_object();
    }

    /**
     * [stats_AvgPricePaidByItem description]
     * @return [object] [result object]
     */
    public function stats_AvgPricePaidByItem()
    {
        $query = "SELECT round(avg(amount_paid), 2) AS avg_paid, name
            FROM {$this->tbl['purchases']}
            JOIN {$this->tbl['store']} ON {$this->tbl['store']}.id = {$this->tbl['purchases']}.store_entry_id
            WHERE amount_paid > 0 GROUP BY {$this->tbl['purchases']}.store_entry_id";

        $result = $this->db->query($query);
        return $result->result_object();
    }

    /**
     * [stats_TotalIncomeByItem description]
     * @return [object] [result object]
     */
    public function stats_TotalIncomeByItem()
    {
        $query = "SELECT round(sum(amount_paid), 2) AS avg_paid, name
            FROM {$this->tbl['purchases']}
            JOIN {$this->tbl['store']} ON {$this->tbl['store']}.id = {$this->tbl['purchases']}.store_entry_id
            WHERE amount_paid > 0 GROUP BY {$this->tbl['purchases']}.store_entry_id";

        $result = $this->db->query($query);
        return $result->result_object();
    }

    /**
     * [stats_TotalPurchasesByMonth description]
     * @return [object] [result object]
     */
    public function stats_TotalPurchasesByMonth()
    {
        $query = "SELECT count(*) AS purchases, left(created_at, 7) AS month
            FROM {$this->tbl['purchases']}
            GROUP BY month ORDER BY month";

        $result = $this->db->query($query);
        return $result->result_object();
    }

    /**
     * [stats_TotalIncomeByMonth description]
     * @return [object] [result object]
     */
    public function stats_TotalIncomeByMonth()
    {
        $query = "SELECT sum(amount_paid) AS total_income, left(created_at, 7) AS month
            FROM {$this->tbl['purchases']}
            WHERE amount_paid IS NOT NULL
            GROUP BY month ORDER BY month";

        $result = $this->db->query($query);
        return $result->result_object();
    }

    /**
     * [getPromoEmails returns a single dimension array of all promo emails]
     * @return [array] [array of emails]
     */
    public function getPromoEmails()
    {
        # get the emails
        $query = "SELECT email FROM {$this->tbl['promo_emails']}";
        $result = $this->db->query($query)->result_array();

        # make into a single dimension
        $emails = array();
        foreach ($result as $row) {
            $emails[] = $row['email'];
        }

        return $emails;
    }
}
