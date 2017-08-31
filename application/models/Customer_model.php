<?php
/**
 * Created by PhpStorm.
 * User: liukaiyang
 * Date: 2017/8/29
 * Time: 21:08
 */

class Customer_model extends CI_Model
{
    public $id;
    public $real_name;
    public $mobile;
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

        $mobile = $this->input->get('mobile');
        if ($mobile != null) {
            $this->db->like('mobile', $mobile);
        }
        $real_name = $this->input->get('real_name');
        if ($real_name != null) {
            $this->db->like('real_name', $real_name);
        }
        $query = $this->db->get('bill_customer', $limit, $offset);
        //结果处理
        $this->load->model('page_model');
        $page = $this->page_model;

        $this->db->from('bill_customer');
        $page->count = $this->db->count_all_results();
        $page->data = ($query->result());
        $this->output
            ->set_content_type('application/json;charset=utf-8')
            ->set_output(json_encode($page));
    }

    public function get_model()
    {
        $id = $this->input->get('id');
        $column = 'id,real_name,mobile,extra,create_date,update_date';
        $query = $this->db->query("SELECT " . $column . " FROM `bill_customer` where id=" . $id);

        return $query->row_array();
    }

    public function update()
    {
        $mobile = $this->input->post('mobile');
        if ($mobile != null) {
            $this->db->set('mobile', $mobile);
        }
        $real_name = $this->input->post('real_name');
        if ($real_name != null) {
            $this->db->set('real_name', $real_name);
        }
        $extra = $this->input->post('extra');
        if ($extra != null) {
            $this->db->set('real_name', $extra);
        }

        $this->db->where('id', 2);
        $this->db->update('bill_customer');

        return $this->db->affected_rows();
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('bill_customer');
        return $this->db->affected_rows();
    }

    public function insert()
    {
        $object = new Customer_model;
        $object->real_name = $this->input->post('real_name');
        $object->mobile = $this->input->post('mobile');
        $object->extra = $this->input->post('extra');
        $this->db->insert('bill_customer', $object);
        return $this->db->affected_rows();
    }
}