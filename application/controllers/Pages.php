<?php
/**
 * Created by PhpStorm.
 * User: liukaiyang
 * Date: 2017/8/29
 * Time: 16:16
 */

class Pages extends CI_Controller
{

    public function index()
    {
        $this->load->view('pages/index.html');
    }

    public function login(){
        $this->load->view('pages/login.html');
    }

    public function customer($page = 'index')
    {
        if ($page == 'index') {
            $this->load->view('pages/customer/customer-index.html');
        } else if ($page == 'insert') {
            $this->load->view('pages/customer/customer-insert.html');
        } else if ($page == 'update') {
            $this->load->model('customer_model');
            $data['customer'] = $this->customer_model->get_model();
            $this->load->view('pages/customer/customer-update.html', $data);
        } else {
            show_404();
        }
    }


    public function bill($page = 'index')
    {

        if ($page == 'index') {
            $this->load->view('pages/bill/bill-index.html');
        } else if ($page == 'insert') {
            $this->load->view('pages/bill/bill-insert.html');
        } else if ($page == 'update') {
            $this->load->model('bill_model');
            $data['bill'] = $this->bill_model->get_model();
            $this->load->view('pages/bill/bill-update.html',$data);
        } else {
            show_404();
        }
    }
    public function goods($page = 'index')
    {

        if ($page == 'index') {
            $this->load->view('pages/goods/goods-index.html');
        } else if ($page == 'insert') {
            $this->load->view('pages/goods/goods-insert.html');
        } else if ($page == 'update') {
            $this->load->model('goods_model');
            $data['goods'] = $this->goods_model->get_model();
            $this->load->view('pages/goods/goods-update.html',$data);
        } else {
            show_404();
        }
    }
}