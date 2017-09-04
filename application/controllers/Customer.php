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

    public function page_list()
    {
        echo $this->customer_model->get_list();
    }

    /**
     * 暂时供账单新增,下拉选择使用接口
     * 返回 id,real_name字段
     */
    public function select_list()
    {
        echo $this->customer_model->get_select_list();
    }

    public function delete()
    {
        echo $this->customer_model->delete();
    }

    public function update()
    {
        echo $this->customer_model->update();
    }

    public function insert()
    {
        echo $this->customer_model->insert();
    }
}