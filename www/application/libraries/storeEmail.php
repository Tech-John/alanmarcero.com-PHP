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

        # load the email helper
        $this->CI->load->library('email');

    }

    /**
     * [purchaseConfirm description]
     * @param  [type] $cart     [description]
     * @param  [type] $email    [description]
     * @param  [type] $password [description]
     * @param  [type] $free     [description]
     * @return [type]           [description]
     */
    public function purchaseConfirm($cart, $email, $password, $free)
    {
        $subject = "Your AlanMarcero.com Purchase";
        $this->smarty->assign('cart', $cart);
        $this->smarty->assign('email', $email);
        $this->smarty->assign('password', $password);
        $content = $this->smarty->fetch(PATH_TEMPLATES . '/mail/purchase_confirm.html');
        if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
        elseif($free) mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
        else mail($email, $subject, $content, "From: " . ADMIN_EMAIL . "\r\n" . "Cc: " . ADMIN_EMAIL . "\r\n");
    }

    /**
     * [accountInfo description]
     * @param  [type] $email    [description]
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    public function accountInfo($email, $password)
    {
        $subject = "Your AlanMarcero.com Account Information";
        $this->smarty->assign('email', $email);
        $this->smarty->assign('password', $password);
        $content = $this->smarty->fetch(PATH_TEMPLATES . '/mail/account_information.html');
        if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
        else mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
    }

    /**
     * [optIn description]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public function optIn($email)
    {
        $subject = "AlanMarcero.com Product Notification Opt-In";
        $this->smarty->assign('email', $email);
        $content = $this->smarty->fetch(PATH_TEMPLATES . '/mail/opt_in.html');
        if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
        else mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
    }

    /**
     * [optOut description]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public function optOut($email)
    {
        $subject = "AlanMarcero.com Product Notification Opt-Out";
        $this->smarty->assign('email', $email);
        $content = $this->smarty->fetch(PATH_TEMPLATES . '/mail/opt_out.html');
        if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
        else mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
    }

    /**
     * [promoEmail description]
     * @param  [type] $subject [description]
     * @param  [type] $content [description]
     * @param  [type] $email   [description]
     * @return [type]          [description]
     */
    public function promoEmail($subject, $content, $email)
    {
        if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
        else mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
    }
}
