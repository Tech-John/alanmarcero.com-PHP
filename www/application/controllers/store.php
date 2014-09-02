<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

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
     * [index main page / store -- listing of items]
     * @return [void]
     */
	public function index()
	{
        # load the store
        $items = $this->store_m->getStoreEntries();
        $this->renderUI("items", array('items' => $items));
	}

    /**
     * [about right, what's all this then?]
     * @return [void]
     */
    public function about()
    {
        $this->renderUI("about");
    }

    /**
     * [paypal where the user is sent after completing a PayPal purchase
     *     initates a cURL request to PayPal in order to authenticate the response
     *     and receive the purchase details.
     *
     *     IPN will create the user, purchase the items, and email
     *     create the user and purchase the items here as well, but send no email
     *
     *     we want IPN to still process so there is no risk of redirect issues
     *     resulting in a failed purchase.  process the purchase info here so the user
     *     is logged in and can download after returning from paypal
     *
     *     for the purchase, the session cart is processed.  this may not be 100% accurate
     *     as it might be possible for our session to be destroyed as part of the paypal
     *     purchase, but the IPN will for sure process the purchase, this is just for
     *     a seamless UX.  Using the purchaseSessionCart method for simplicity]
     * @return [void]
     */
    public function paypal()
    {
        $tx_token = $this->input->get('tx');
        $auth_token = "_q65lGYIktQWvivbYm6oArwDtn2LZOBntQob4IVKb6S_8EVUn88WZJYp5PW";
        $request = "cmd=_notify-synch&tx={$tx_token}&at={$auth_token}";

        # setup the cURL request to get the user's email
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.paypal.com/cgi-bin/webscr");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Host: www.paypal.com"));

        # send the request and close the cURL
        $response = curl_exec($curl);
        curl_close($curl);

        # create a copy of the cart for the UI
        $data = array('cart' => $this->session->userdata('cart'));
        $data['subtotal'] = $this->calculateCartTotal();

        if (strtolower($response) !== "fail" && !empty($response)) {
            # process the response
            $response_array = explode("\n", $response);
            $response_assoc = array();
            foreach ($response_array as $val) {
                $line_data = explode("=", $val);
                $response_assoc[urldecode($line_data[0])] = urldecode($line_data[1]);
            }

            # all we need is the email
            $email = $response_assoc['payer_email'];

            # create and get the user
            $user = $this->store_m->createUser($email);

            # login
            $this->session->set_userdata(
               array('user_id' => $user->id, 'email' => $user->email, 'password' => $user->password)
            );

            # purchase items
            $this->purchaseSessionCart();
        } else {
            # do nothing
        }

        $this->renderUI("paypal", $data);
    }

    /**
     * [customers redirects back to login if not logged in, otherwise to the customer section]
     * @return [void]
     */
    public function customers()
    {
        # first see if the user is logged in.  redirect to login if they are not
        if (!$this->isLoggedIn()) {
            redirect("/login");
        }

        # if we haven't redirected them, show them their items available for download
        $data = array();
        $user_id = $this->session->userdata('user_id');
        $data['items'] = $this->store_m->getPurchasesByUserId($user_id);

        # show the purchased items
        $this->renderUI("purchased_items", $data);
    }

    /**
     * [login displays and then processes the login form to login if a user is not logged in]
     * @return [void] [description]
     */
    public function login()
    {
        # if the user is already logged in, redirect to customers
        if ($this->isLoggedIn()) {
            redirect("/customers");
        } else {
            # show the login form, or process the login
            $data = array();

            # did the user input an email and password yet?
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            # if info was entered, verify it and login.  else return with an 'invalid login' message
            if (verifyEmail($email) && !empty($password)) {
                $user = $this->store_m->verifyLogin($email, $password);
                if (!empty($user)) {
                    # login
                    $this->session->set_userdata(
                       array('user_id' => $user->id, 'email' => $user->email, 'password' => $user->password)
                    );
                    # redirect to customers since we are now logged in
                    redirect("/customers");
                } else {
                    # login was invalid, return an error and sticky the email
                    $data['invalid_login'] = true;
                    $data['email'] = $email;
                }
            }

            # render login page unless we were redirected to /customers
            $this->renderUI("login", $data);
        }
    }

    /**
     * [getPassword displays and then processes the get password form]
     * @return [void] [description]
     */
    public function getPassword()
    {
        $data = array();

        # did the user input an email yet?
        $email = $this->input->post('email');

        if (verifyEmail($email)) {
            $user = $this->store_m->getUserByEmail($email);
            if (!empty($user)) {
                # send the account info, show the confirmation
                $this->storeemail->accountInfo($user->email, $user->password);
                $data['email_sent'] = true;
                $data['email'] = $email;
            } else {
                # could not find that email, return it to the UI
                $data['not_found'] = true;
                $data['email'] = $email;
            }
        }

        $this->renderUI("get_password", $data);
    }

    /**
     * [addToCart creates a cart session for the user and adds the passed item (via post)]
     * @return [void]
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

    /**
     * [showCart get the data and show the cart]
     * @return [void]
     */
    public function showCart()
    {
        $data['cart'] = $this->session->userdata('cart');
        $data['subtotal'] = $this->calculateCartTotal();

        # show the cart
        $this->renderUI("cart", $data);
    }

    /**
     * [removeFromCart removes the item from the cart that is passed via post]
     * @return [void]
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
     * @return [void]
     */
    public function freePurchase()
    {
        # if the user is not logged in, ask for their email
        $data = array();
        $data['invalid_email'] = false;

        # if the user is not logged in, ask for and verify their email
        if (!$this->isLoggedIn()) {
            # did the user input an email yet?
            $email = $this->input->post('email');

            # verify the email if it was input
            if (verifyEmail($email)) {
                # create the user and login
                $user = $this->store_m->createUser($email);
                $this->session->set_userdata(
                    array('user_id' => $user->id, 'email' => $user->email, 'password' => $user->password)
                );
                # run again since the user is now created and loggedin
                $this->freePurchase();
            } elseif(!empty($email) && !verifyEmail($email)) {
                # if an invalid email was entered, pass it back to the UI
                $data['invalid_email'] = $email;
            } else {
                # the user was not logged in and has not entered an email, ask for their email address
                $this->renderUI("free_purchase", $data);
            }
        } else {
            # the user is logged in, purchase the items and send the email
            $data['cart'] = $this->session->userdata('cart');

            # get the extra data for each purchased item
            $item_ids = array();
            foreach ($data['cart'] as $item_id => $item) {
                $item_ids[] = $item_id;
            }
            $purchased_items = $this->store_m->getStoreEntries($item_ids);

            # need to purchase after setting data since the cart is emptied
            $this->purchaseSessionCart();

            # send the purchase confirm email
            $this->storeemail->purchaseConfirm(
                $purchased_items,
                $this->session->userdata('email'),
                $this->session->userdata('password'),
                true
            );

            $this->renderUI("purchase_confirm", $data);
        }
    }

    /**
     * [logout destroys the session and redirects back to the store]
     * @return [void]
     */
    public function logout()
    {
        $this->session->sess_create();
        redirect("/");
    }

    /**
     * [ipn processes PayPal's end-of-sale API for notifying the app of a store transaction
     *     ipn stands for instant payment notification
     *     this is initiated asynchronously by PayPal after a sale
     *     an implementation of paypal's 'classic api']
     * @return [void]
     */
    public function ipn()
    {
        if (!($this->input->post('num_cart_items'))) {
           # this is not a store transaction, ignore it
           return false;
        }

        # get the item info for what has been purchased
        $item_ids = array();
        $num_cart_items = (int) $this->input->post('num_cart_items');
        for($i = 1; $i <= $num_cart_items; $i++) {
            $item_ids[] = $this->input->post('item_number' . $i);
        }
        $purchased_items = $this->store_m->getStoreEntries($item_ids);

        # get the user's email
        $email = $this->input->post('payer_email');

        # create or get the user
        $user = $this->store_m->createUser($email);

        # purchase each item
        foreach ($item_ids as $item_id) {
            $this->store_m->purchaseItem($user->id, $item_id);
        }

        # send the purchase confirm email
        $this->storeemail->purchaseConfirm(
            $purchased_items,
            $user->email,
            $user->password
        );
    }

    /**
     *
     * PRIVATE METHODS
     *
     */

    /**
     * [purchaseSessionCart goes through the session cart and purchases each item
     *     REQUIRED: the user is logged in with an email]
     * @return [void]
     */
    private function purchaseSessionCart($send_email = true)
    {
        # get the data we need
        $cart = $this->session->userdata('cart');
        $user_id = $this->session->userdata('user_id');

        # verify our data
        if (empty($cart) || empty($user_id)) {
            return false;
        }

        # purchase each item
        foreach ($cart as $item_id => $name) {
            $this->store_m->purchaseItem($user_id, $item_id);
        }

        # empty the cart
        $this->session->set_userdata(array('cart' => false));
    }

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
     * [isLoggedIn is the user logged in?]
     * @return bool [true if the user is logged in, false if not]
     */
    private function isLoggedIn()
    {
        $user_id = $this->session->userdata('user_id');
        return !empty($user_id);
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
        if ($this->isLoggedIn()) {
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
