<?php

class Activity {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function manageAllActivities(){
        $this->db->query('SELECT * FROM activities');

        $results = $this->db->resultSet();

        return $results;

    }

    public function addActivity($data)
    {
        $this->db->query('INSERT INTO activities (act_title, act_desc, act_datetime, user_id) VALUES ( :act_title, :act_desc, :act_datetime, :user_id)');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':act_title', $data['act_title']);
        $this->db->bind(':act_desc', $data['act_desc']);
        $this->db->bind(':act_datetime', $data['act_datetime']);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function findActivityById($act_id)
    {
        $this->db->query('SELECT * FROM activities WHERE act_id = :act_id');
        $this->db->bind(':act_id', $act_id);

        $row = $this->db->single();

        return $row;
    }

    public function updateActivity($data)
    {
        $this->db->query('UPDATE activities SET act_title = :act_title, act_desc = :act_desc WHERE act_id = :act_id');

        $this->db->bind(':act_id', $data['act_id']);
        $this->db->bind(':act_title', $data['act_title']);
        $this->db->bind(':act_desc', $data['act_desc']);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleteActivity($act_id){
        $this->db->query('DELETE FROM activities WHERE act_id = :act_id');

        $this->db->bind(':act_id', $act_id);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }

    }



}


?>