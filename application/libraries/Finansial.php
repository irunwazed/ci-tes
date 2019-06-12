<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finansial {

    private static $CI;
    private $table;

    public function __construct()
    {
        self::$CI = & get_instance();
    }

}