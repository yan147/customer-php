<?php
/**
 * Created by PhpStorm.
 * User: liukaiyang
 * Date: 2017/8/29
 * Time: 21:08
 */

class Bill extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bill_model');
    }


    public function lists()
    {
        echo $this->bill_model->get_list();
    }

    public function delete()
    {
        echo $this->bill_model->delete();
    }

    public function update()
    {
        echo $this->bill_model->update();
    }

    public function insert()
    {
        echo $this->bill_model->insert();
    }
}