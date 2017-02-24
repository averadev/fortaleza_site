<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('getLang'))
{
    function getLang(){
        $CI =& get_instance();
        return $CI->session->userdata('LANG');
    }
}