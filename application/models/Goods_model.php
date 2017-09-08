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
    public $price;
    public $name;
    public $unit;
    public $inventory;
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
        $name = $this->input->get('name');

        //结果处理
        $this->load->model('page_model');
        $page = $this->page_model;

        if ($name != null) {
            $this->db->like('name', $name);
        }

        $query=$this->db->get('bill_goods',$limit, $offset);
        $page->count = $this->db->count_all_results();
        $page->data = ($query->result());
        $this->output
            ->set_content_type('application/json;charset=utf-8')
            ->set_output(json_encode($page));
    }

    public function get_model()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $query = $this->db->get('bill_goods');
        return $query->row_array();
    }

    public function update()
    {

        $name = $this->input->post('name');
        if ($name != null) {
            $this->db->set('name', $name);
        }
        $price = $this->input->post('price');
        if ($price != null) {
            $this->db->set('price', $price);
        }
        $inventory = $this->input->post('inventory');
        if ($inventory != null) {
            $this->db->set('inventory', $inventory);
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
        $this->db->delete('bill_goods');
        return $this->db->affected_rows();
    }

    public function insert()
    {
        $object = new Bill_model;
        $object->price = $this->input->post('price');
        $object->name = $this->input->post('name');
        $object->inventory = $this->input->post('inventory');
        $object->extra = $this->input->post('extra');
        $object->unit = $this->input->post('unit');

//        date_default_timezone_set('Asia/Shanghai');
        $object->create_date =  date('Y-m-d H:i:s');
        $this->db->insert('bill_goods', $object);
        return $this->db->affected_rows();
    }
}