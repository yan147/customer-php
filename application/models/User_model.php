<?php
/**
 * Created by PhpStorm.
 * User: liukaiyang
 * Date: 2017/8/29
 * Time: 21:08
 */

class User_model extends CI_Model
{
    public $id;
    public $username;
    public $password;
    public $role;
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

        $username = $this->input->get('username');

        //结果处理
        $this->load->model('page_model');
        $page = $this->page_model;

        if ($username != null) {
            $this->db->where('username', $username);
        }

        $query=$this->db->get('bill_user',$limit, $offset);
        $page->count = $this->db->count_all_results();
        $page->data = ($query->result());
        $this->output
            ->set_content_type('application/json;charset=utf-8')
            ->set_output(json_encode($page));
    }

    public function get_model()
    {

        $username = $this->input->get('username');
        if($username!=null){
            $this->db->where('username', $username);
        }
        $id = $this->input->get('id');
        if($id!=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get('bill_user');
        return $query->row_array();
    }

    public function update()
    {

        $username = $this->input->post('username');
        if ($username != null) {
            $this->db->set('username', $username);
        }
        $password = $this->input->post('password');
        if ($password != null) {
            $this->db->set('password', $password);
        }
        $extra = $this->input->post('extra');
        if ($extra != null) {
            $this->db->set('extra', $extra);
        }
//        $this->db->set('update_date', mdate('%Y-%m-%d %h:%i:%s'));
        $this->db->set('update_date', 'now()',false);

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->update('bill_user');
        return $this->db->affected_rows();
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('bill_user');
        return $this->db->affected_rows();
    }

    public function insert()
    {
        $object = new Bill_model;
        $object->password = $this->input->post('password');
        $object->username = $this->input->post('username');
        $object->role = $this->input->post('role');
//        date_default_timezone_set('Asia/Shanghai');
        $object->create_date =  date('Y-m-d H:i:s');
        $this->db->insert('bill_user', $object);
        return $this->db->affected_rows();
    }
}