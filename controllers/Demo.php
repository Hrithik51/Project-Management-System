<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Demo extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('tank_auth');
        if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) != 'admin') {
            $this->session->set_flashdata('response_status', 'error');
            $this->session->set_flashdata('message', lang('access_denied'));
            redirect('logout');
        }
        $this->load->helper('curl', 'file');
    }

    public function index()
    {
    }

    public function builder()
    {
        $form_id = $_POST['form_id'];
        $fields = json_decode($_POST['formcontent'],true);
        $this->db->where('form_id',$form_id)->delete('fields');

        foreach ($fields['fields'] as $key => $f) {
            $this->db->where('uniqid', $f['uniqid'])->get('fields');
            $id_exist = $this->db->affected_rows();
            $uniqid = ($id_exist == 0) ? Applib::generate_unique_value() : $f['uniqid'];
            $data = array(
                 'label' => $f['label'],
                 'form_id' => $form_id,
                 'uniqid'   => $uniqid,
                 'type'     => $f['field_type'],
                 'required' => $f['required'],
                 'field_options'    => json_encode($f['field_options']),
                 'cid'              => $f['cid']
            );
            ($id_exist == 0) ? $this->db->insert('fields',$data) : $this->db->where('uniqid',$f['uniqid'])->update('fields',$data);

        }
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function init_db()
    {
        $this->load->dbforge();
        $this->load->database();

        $file_content = Applib::remote_get_contents(UPDATE_URL.'folite/db/install_'.config_item('version').'.sql');
        $this->db->query('USE '.$this->db->database.';');
        foreach (explode(";\n", $file_content) as $sql) {
            $sql = trim($sql);
            if ($sql) {
                $this->db->query($sql);
            }
        }
        die('Database initialized');
    }

    public function clean_my_data()
    {
        $this->load->dbforge();
        $this->load->database();

        $file_content = Applib::remote_get_contents(UPDATE_URL.'files/demo.sql');
        $this->db->query('USE '.$this->db->database.';');
        foreach (explode(";\n", $file_content) as $sql) {
            $sql = trim($sql);
            if ($sql) {
                $this->db->query($sql);
            }
        }
        die('Demo data installed');
    }
}

/* End of file updater.php */
