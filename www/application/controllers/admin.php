<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    /**
     * [__construct constructor]
     * @return [void]
     */
    public function __construct()
    {
        parent::__construct();

        # load dependencies
        $this->load->helper('store_helper');
        $this->load->helper('url');
        $this->load->model('store_m');

        # start the session if not available
        $this->load->library('session');
        $this->load->library('StoreEmail');
        $sess = $this->session->sess_read();
        if (empty($sess)) {
            $this->session->sess_create();
        }
    }

    /**
     * [index main page for admin.  log the user in]
     * @return [void]
     */
	public function index()
	{
        # if the user is already logged in, redirect to customers
        if ($this->isAdminLoggedIn()) {
            redirect("/admin");
        } else {
            # show the login form, or process the login
            $data = array();

            # did the user input an email and password yet?
            $admin_login = $this->input->post('admin_login');
            $password = $this->input->post('password');

            # if info was entered, verify it and login.  else return with an 'invalid login' message
            if (!empty($password)) {
                $user = $this->store_m->verifyAdminLogin($admin_login, $password);
                if (!empty($user)) {
                    # login
                    $this->session->set_userdata(
                       array('admin_user_id' => $user->id)
                    );
                    # redirect to customers since we are now logged in
                    redirect("/admin");
                } else {
                    # login was invalid, return an error and sticky the email
                    $data['invalid_login'] = true;
                    $data['admin_login'] = $admin_login;
                }
            }

            # render login page unless we were redirected to /customers
            $this->renderUI("admin_login", $data);
        }
	}

    /**
     * [admin shows a list of admin options to be performed]
     * @return [type] [description]
     */
    public function admin()
    {
        die('asdf');
    }

    /**
     * [isAdminLoggedIn is an admin logged in?]
     * @return bool [true if an admin is logged in, false if not]
     */
    private function isAdminLoggedIn()
    {
        $admin_user_id = $this->session->userdata('admin_user_id');
        return !empty($admin_user_id);
    }

    /**
     * [loadHeader grabs the required data and loads the header]
     * @return [void]
     */
    private function loadHeader()
    {
        # data to pass to the view
        $data = array();

        # get header counts
        $data['customer_count'] = $this->store_m->getCustomerCount();
        $data['purchased_count'] = $this->store_m->getPurchasedCount();

        # get last purchased
        $item = $this->store_m->getLastPurchased();
        $data['last_purchase'] = prettyTime(strtotime($item->created_at));

        # get the email
        if ($this->isAdminLoggedIn()) {
            $data['email'] = $this->session->userdata('email');
        } else {
            $data['email'] = false;
        }

        # get the cart
        $data['cart'] = $this->session->userdata('cart');

        # set our data and load the header
        $this->load->view('header', $data);
    }

    /**
     * [loadFooter grabs the required data and loads the footer]
     * @return [void]
     */
    private function loadFooter()
    {
        $this->load->view('footer');
    }

    /**
     * [renderUI loads the header view, footer view, and the input content view]
     * @param  [string] $content_name [the view name to load for content]
     * @param  [array] $data         [the data to be loaded into the content view]
     * @return [type]               [description]
     */
    private function renderUI($content_name, $data = array())
    {
        if (empty($content_name)) {
            return false;
        }

        $this->loadHeader();
        $this->load->view($content_name, $data);
        $this->loadFooter();
    }
}
