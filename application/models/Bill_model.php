<?php
/**
 * Created by PhpStorm.
 * User: liukaiyang
 * Date: 2017/8/29
 * Time: 21:08
 */

class Bill_model extends CI_Model
{
    public $id;
    public $customer_id;
    public $payable;
    public $goods_info;
    public $received;
    public $extra;
    public $create_date;
    public $update_date;

    public function __construct()
    {
        $this->load->database();
    }

    public function get_list()
    {
        //查询参数
        $page = $this->input->get('page');
        $limit = $this->input->get('limit');
        $offset = $limit * ($page - 1);

//        $mobile = $this->input->get('mobile');
//        if ($mobile != null) {
//            $this->db->like('mobile', $mobile);
//        }
        $real_name = $this->input->get('real_name');

        //结果处理
        $this->load->model('page_model');
        $page = $this->page_model;

        $this->db->select('bill_bill.*,bill_customer.real_name');
        $this->db->from('bill_bill');
        $this->db->join('bill_customer','bill_bill.customer_id=bill_customer.id');
        if ($real_name != null) {
            $this->db->like('bill_customer.real_name', $real_name);
        }
        $this->db->limit($limit, $offset);
        $query=$this->db->get();
        $page->count = $this->db->count_all_results();
        $page->data = ($query->result());
        $this->output
            ->set_content_type('application/json;charset=utf-8')
            ->set_output(json_encode($page));
    }

    public function get_model()
    {
        $id = $this->input->get('id');
        $this->db->select('bill_bill.*,bill_customer.real_name');
        $this->db->from('bill_bill');
        $this->db->join('bill_customer','bill_bill.customer_id=bill_customer.id');
        $this->db->where('bill_bill.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update()
    {

        $received = $this->input->post('mobile');
        if ($received != null) {
            $this->db->set('received', $received);
        }
        $payable = $this->input->post('payable');
        if ($payable != null) {
            $this->db->set('payable', $payable);
        }
        $extra = $this->input->post('extra');
        if ($extra != null) {
            $this->db->set('extra', $extra);
        }
//        $this->db->set('update_date', mdate('%Y-%m-%d %h:%i:%s'));
        $this->db->set('update_date', 'now()',false);

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->update('bill_bill');
        return $this->db->affected_rows();
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('bill_bill');
        return $this->db->affected_rows();
    }

    public function insert()
    {
        $object = new Bill_model;
        $object->customer_id = $this->input->post('customer_id');
        $object->payable = $this->input->post('payable');
        $object->received = $this->input->post('received');
        $object->extra = $this->input->post('extra');
        $object->goods_info = $this->input->post('goods_info');

//        date_default_timezone_set('Asia/Shanghai');
        $object->create_date =  date('Y-m-d H:i:s');
        $this->db->insert('bill_bill', $object);
        return $this->db->affected_rows();
    }
}