<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Notes extends MX_Controller
{
    public function __construct()
    {
        // Construct our parent class
        parent::__construct();
        User::logged_in();
        $this->load->model(array('App'));
    }

    public function index($id = null)
    {
        
    }

    public function get_notes()
    {
        $owner = User::get_id();
        $notes = $this->db->where('owner', $owner)->get('notes')->result();
        echo json_encode($notes);
        exit;
    }

    public function get_note($id = null)
    {
        $note = $this->db->where('id', $id)->get('notes')->row();
        echo json_encode($note);
        exit;
    }

    public function add_note()
    {
        $note = json_decode(file_get_contents('php://input'));
        $user = User::get_id();
        $data = array('name' => $note->name,
                      'description' => $note->description,
                      'date' => $note->date,
                      'owner' => $user,
                        );
        $this->db->insert('notes', $data);
        $note->id = $this->db->insert_id();
        echo json_encode($note);
        exit;
    }

    public function update_note($id = null)
    {
        $note = json_decode(file_get_contents('php://input'));
        $user = User::get_id();
        $data = array('name' => $note->name,
                      'description' => $note->description,
                      'date' => $note->date,
                      'owner' => $user,
                );
        $this->db->where('id', $id)->update('notes', $data);
        echo json_encode($note);
        exit;
    }

    public function delete_note($id = null)
    {
        $sql = "DELETE FROM fx_notes WHERE id='$id'";
        $this->db->query($sql);
    }

    public function getConnection()
    {
        $dbhost = $this->db->hostname;
        $dbuser = $this->db->username;
        $dbpass = $this->db->password;
        $dbname = $this->db->database;
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbh;
    }
}
// End of notes API
