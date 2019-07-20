<?php

class Pdf {

    function __construct()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }

    function load($param = NULL) {
        require_once APPPATH .'third_party/mpdf/mpdf.php';

        if ($param == NULL) {
            $param = '"en-GB-x","A4", "Helvetica-Neue-Light-ar","",10,10,10,10,6,3';
            //$param = '"ar","A4","","",10,10,10,10,6,3';
            
        }
        return new mPDF($param);
    }

}

/*if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'/third_party/mpdf60/mpdf.php';

class Pdf {

    public $param;
    public $pdf;
    public function __construct($param = "'c', 'A4-L'")
    {
        $this->param =$param;
        $this->pdf = new mPDF($this->param);
    }
}*/