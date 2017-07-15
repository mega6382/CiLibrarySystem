<?php

Class Racks_Database extends CI_Model
{
    private $table = "racks";
    public function addRack($data)
    {
        $condition = "name =" . "'" . $data['name'] . "'";
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            
            $this->db->insert($this->table, $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }
    
    public function editRack($data, $id)
    {
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
    }
    
    public function getRack($id)
    {
        
        $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
	
	public function viewRacks()
	{
		$this->db->select('r.*, count(b.id) as books');
		$this->db->from($this->table . ' r');
		$this->db->where("1=1");
		$this->db->join('books b', 'b.rack_id = r.id', 'left');
		$this->db->group_by('r.id'); 
		$this->db->order_by('r.name', 'asc'); 
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
	}
    
    public function fetchAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("1=1");
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
    }
    
}
