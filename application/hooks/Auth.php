<?php
/**
 * Created by PhpStorm.
 * User: liukaiyang
 * Date: 2017/9/8
 * Time: 14:53
 */

class Auth
{
    var $CI;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    //检测是否登录,未登录跳转至登录页面
    public function check()
    {
        $this->CI->load->helper('url');
        if (strpos(uri_string(), "login")===FALSE) {// 需要进行权限检查的URL
            $this->CI->load->library('session');
            if ($this->CI->session->username == null) {        // 用户未登陆
                redirect('/index.php/pages/login');
                return;
            }
        }

    }
}