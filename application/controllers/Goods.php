<?php
/**
 * Created by PhpStorm.
 * User: liukaiyang
 * Date: 2017/8/29
 * Time: 22:03
 */

class Goods extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('goods_model');
    }

    public function page_list()
    {
        echo $this->goods_model->get_list();
    }

    public function delete()
    {
        echo $this->goods_model->delete();
    }

    public function update()
    {
        echo $this->goods_model->update();
    }

    public function insert()
    {
        echo $this->goods_model->insert();
    }
}