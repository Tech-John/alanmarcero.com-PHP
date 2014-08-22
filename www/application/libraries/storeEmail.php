<?php

/**
 *  A library repository containing information about emails that are sent.
 */
class StoreEmail
{
    # Code Igniter instance
    private $CI;

    /**
     * [__construct get the code igniter instance]
     */
    function __construct ()
    {
        # Get CodeIgniter instance
        $this->CI =& get_instance();

        # load the email helper and set the sender
        $this->CI->load->library('email');
        $this->CI->email->from(ADMIN_EMAIL, 'Alan Marcero');
    }

    /**
     * [purchaseConfirm description]
     * @param  [type] $items     [description]
     * @param  [type] $email    [description]
     * @param  [type] $password [description]
     * @param  [type] $free     [description]
     * @return [type]           [description]
     */
    public function purchaseConfirm($items, $email, $password, $free)
    {
        # set the data
        $data = array();
        $data['items'] = $items;
        $data['email'] = $email;
        $data['password'] = $password;

        # set the subject
        $subject = "Your AlanMarcero.com Purchase";
        $this->CI->email->subject($subject);

        # set the message content
        $content = $this->CI->load->view('/emails/purchase_confirm', $data, true);
        $this->CI->email->message($content);

        # set the recipient
        if (DEV_MODE) {
            # send the email to the admin for dev mode
            $this->CI->email->to(ADMIN_EMAIL);
        } else {
            # send to the input email
            $this->CI->email->to($email);

            # send me a copy if this is not a "free" purchase, for records
            if (!$free) {
                $this->CI->email->cc(ADMIN_EMAIL);
            }
        }

        # send the message
        $this->CI->email->send();
    }

    /**
     * [accountInfo description]
     * @param  [type] $email    [description]
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    public function accountInfo($email, $password)
    {
        # set the data
        $data = array();
        $data['email'] = $email;
        $data['password'] = $password;

        # set the subject
        $subject = "Your AlanMarcero.com Account Information";
        $this->CI->email->subject($subject);

        $content = $this->CI->load->view('/emails/account_information', $data, true);
        $this->CI->email->message($content);

        # set the recipient
        if (DEV_MODE) {
            # send the email to the admin for dev mode
            $this->CI->email->to(ADMIN_EMAIL);
        } else {
            # send to the input email
            $this->CI->email->to($email);
        }

        # send the message
        $this->CI->email->send();
    }

    /**
     * [optOut description]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public function optOut($email)
    {
        $subject = "AlanMarcero.com Product Notification Opt-Out";
    }
}
