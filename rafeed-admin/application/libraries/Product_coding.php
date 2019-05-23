<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class product_coding {

    function __construct()
    {
    	
    }

    public function get_premium_code($product_type_code,$family_name,$power,$dimension_serial,$collection_serial)
    {
        if(!(empty($product_type_code) && empty($family_name) && empty($power) && empty($dimension_serial) && empty($collection_serial)) )
            return "PR-".$product_type_code."-".strtoupper(substr($family_name, 0, 3)).
                $power."-".str_pad($dimension_serial, 2, '0', STR_PAD_LEFT).
                "-".str_pad($collection_serial, 5, '0', STR_PAD_LEFT);
        else
            return "";
    }
}