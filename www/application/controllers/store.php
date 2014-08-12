<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

    /**
     * [__construct constructor]
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
        $sess = $this->session->sess_read();
        if (empty($sess)) {
            $this->session->sess_create();
        }

        # load the header for every store page
        $this->loadHeader();
    }

    /**
     * [index main page / store -- listing of items]
     */
	public function index()
	{
        # load the store
        $items = $this->store_m->getStoreEntries();
        $this->load->view('items', array('items' => $items));

        $this->loadFooter();
	}

    /**
     * [about right, what's all this then?]
     */
    public function about()
    {
        $this->load->view('about');
        $this->loadFooter();
    }

    /**
     * [customers redirects back to login if not logged in, otherwise to the customer section]
     */
    public function customers()
    {
        $this->loadFooter();
    }

    /**
     * [addToCart creates a cart session for the user and adds the passed item (via post)]
     */
    public function addToCart()
    {
        # get the data.
        $item_id = $this->input->post('item_id');
        $price = $this->input->post('price');
        $name = $this->store_m->getItemNameById($item_id); // get from DB rather than POST
        $price = money_format("%i", $price);

        # if we have an item id, proceed.  else show the cart
        if (!empty($item_id)) {
            # start the cart
            $cart = $this->session->userdata('cart');
            if (empty($cart)) {

                # create the cart if it was empty
                $this->session->set_userdata(
                    array("cart" =>
                        array($item_id =>
                            array("price" => $price, "name" => $name)
                        )
                    )
                );
            } else {
                # insert into or update the item in the cart
                $cart[$item_id] = array("price" => $price, "name" => $name);
                $this->session->set_userdata(array("cart" => $cart));
            }
        }

        # show the cart after we add an item to it
        redirect("/showCart");
    }

    public function showCart()
    {
        $data['cart'] = $this->session->userdata('cart');
        $data['subtotal'] = $this->calculateCartTotal();
        $data['paypal_test'] = false;
        $data['admin_email'] = "alanmarcero@gmail.com";

        # show the cart
        $this->load->view("cart", $data);
        $this->loadFooter();
    }

    /**
     * [removeFromCart removes the item from the cart that is passed via post]
     */
    public function removeFromCart()
    {
        $remove_this_id = $this->input->post('item_id');
        # if we have an item_id, remove it from the cart if the item is in there
        if (!empty($remove_this_id)) {
            # go through the cart and unset the id if we find it
            $cart = $this->session->userdata('cart');

            foreach ($cart as $id => $item) {
                # typecase to int for comparison
                if ((int)$id === (int)$remove_this_id) {
                    unset($cart[$remove_this_id]);
                } else {
                    echo $id . " " . $remove_this_id;
                }
            }

            # now re-write the cart
            $this->session->set_userdata(array("cart" => $cart));
        }

        # show the cart after we removed an item to it
        redirect("/showCart");
    }

    /**
     * [freePurchase displays the email form to signup a user to receive free items]
     * @return [type] [description]
     */
    public function freePurchase()
    {
        # if the user is not logged in, ask for their email
        $data['email'] = $this->session->userdata('email');

        $this->load->view('free_purchase', $data);
        $this->loadFooter();
    }

    /**
     *
     * PRIVATE METHODS
     *
     */

    /**
     * [calculateCartTotal goes through the session cart and calculates the subtotal]
     * @return [float] [the total price for all items in the cart]
     */
    private function calculateCartTotal()
    {
        $cart = $this->session->userdata('cart');
        $subtotal = 0.00;

        # if the cart isn't empty, go through and tally the total
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $subtotal += $item['price'];
            }
        }

        return money_format("%i", $subtotal);
    }

    /**
     * [loadHeader grabs the required data and loads the header]
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
        $data['email'] = $this->session->userdata('email');

        # set our data and load the header
        $this->load->view('header', $data);
    }

    /**
     * [loadFooter grabs the required data and loads the footer]
     */
    private function loadFooter()
    {
        $this->load->view('footer');
    }
}
