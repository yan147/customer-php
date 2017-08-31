<?php
/**
 * Created by PhpStorm.
 * User: liukaiyang
 * Date: 2017/8/29
 * Time: 22:03
 */

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
    }

    public function lists()
    {
        $this->customer_model->get_list();
    }
    public function delete()
    {
        $this->customer_model->get_list();
    }

    public function update()
    {
        $this->customer_model->update();
    }
}