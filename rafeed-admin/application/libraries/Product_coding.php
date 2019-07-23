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
                "-".str_pad($collection_serial, 6, '0', STR_PAD_LEFT);
        else
            return "";
    }

    public function get_premium_number($product_type_num,$family_num,$power,$CCT,$CRI,$collection_serial)
    {
        if(!(empty($product_type_num) && empty($family_num) && empty($power) && empty($collection_serial)) ){
            switch ($CCT) {
                case -1:
                    $CCT_code = "01";
                    break;
                case -2:
                    $CCT_code = "02";
                    break;
                case -3:
                    $CCT_code = "03";
                    break;
                default:
                    if (is_null($CCT)) {
                        $CCT_code = "00";
                    }
                    else
                        $CCT_code= substr(strval($CCT), 0, 2);
                    break;
            }
            $CRI_code= is_null($CRI)? "00" : (string)$CRI;
            return "1".str_pad($product_type_num, 2, '0', STR_PAD_LEFT).str_pad($family_num, 3, '0', STR_PAD_LEFT).
                str_pad($power, 4, '0', STR_PAD_LEFT).$CCT_code.$CRI_code.str_pad($collection_serial, 6, '0', STR_PAD_LEFT);
        }
        else
            return "";
    }

    public function get_economic_number($family_shortcut,$CCT,$collection_serial,$developed_product_id)
    {
        if(!(empty($family_shortcut) && empty($CCT) && empty($collection_serial)) )
            return strtoupper($family_shortcut).substr(strval($CCT), 0, 1).str_pad($collection_serial, 4, '0', STR_PAD_LEFT);
        else
            return "";
    }
}