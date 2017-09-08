<?php
/**
 * Created by PhpStorm.
 * User: liukaiyang
 * Date: 2017/9/8
 * Time: 16:56
 */

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->model('result_model');
        $result = $this->result_model;
        $username = $this->input->get('username');
        if ($username==null) {
            $result->msg = "非法参数";
            $result->code = 10400;
        }else{
            $user = $this->user_model->get_model();
            if ($username==null||$user == null) {
                $result->msg = "该用户不存在";
                $result->code = 10404;
            } else {
                $password = $this->input->get('password');
                if ($user['password'] !== $password) {
                    $result->msg = "输入密码不正确";
                    $result->code = 10405;
                }
            }
        }
        $this->output
            ->set_content_type('application/json;charset=utf-8')
            ->set_output(json_encode($result));
    }
}