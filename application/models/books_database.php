<?php

Class Books_Database extends CI_Model
{
    private $table = "books";
    public function addbook($data)
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
    
    public function editBook($data, $id)
    {
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
    }
    
	public function getWhere($where)
	{        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();
        
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return [];
        }
	}
	
    public function getBook($id)
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
	
	public function searchBooks($query)
	{
        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->or_like(['name' => $query, 'author' => $query, 'pub_year' => $query]);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
	}
    
}
