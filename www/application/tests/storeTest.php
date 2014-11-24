<?php

class StoreTest extends PHPUnit_Framework_TestCase {

  private $CI; # CodeIgniter instance

  public function __construct()
  {
    parent::__construct();

    $this->CI = &get_instance();
  }

  public function testTest()
  {
    $this->assertEquals(1, true);
  }
}
