<?php

class AddUnit_model extends CI_Model{
    function get_blocks($district) {
        $this->load->database();        
        $this->db->select('district_blocks.block,id');
        $this->db->from('district_blocks');
        $this->db->where('district',$district);
        $this->db->join('district', 'district_blocks.dist_id = district.dist_id', 'left');
        $query = $this->db->get();
        $results=$query->result();
        $this->db->close();
        if($query->num_rows() == 0) { 
            $values ='<option value=""> Not Found!</option>'; 
        } else { 
            foreach($results as $keys => $rows) {
                $values .='<option value="'. $rows->block .'">'.$rows->block .'</option>';               
            }
        }
        return $values;
        
    }
    function get_pincodes($district) {
        $this->load->database();        
        $this->db->select('district_pincodes.pincode,id');
        $this->db->from('district_pincodes');
        $this->db->where('district',$district);
        $this->db->join('district', 'district_pincodes.dist_id = district.dist_id', 'left');
        $query = $this->db->get();
        $results=$query->result();
        $this->db->close();
        if($query->num_rows() == 0) { 
            $values ='<option value=""> Not Found!</option>'; 
        } else {
            foreach($results as $keys => $rows) {
                $values .='<option value="'. $rows->pincode .'">'.$rows->pincode .'</option>';               
            }
        }
        return $values;
        
    }
    function get_revenues($district) {
        $this->load->database();        
        $this->db->select('district_revenue.revenue_name,revenue_id');
        $this->db->from('district_revenue');
        $this->db->where('district',$district);
        $this->db->join('district', 'district_revenue.dist_id = district.dist_id', 'left');
        $query = $this->db->get();
        $results=$query->result();
        $this->db->close();
        if($query->num_rows() == 0) { 
            $values ='<option value=""> Not Found!</option>'; 
        } else {
            foreach($results as $keys => $rows) {
                $values .='<option value="'. $rows->revenue_name .'">'.$rows->revenue_name .'</option>';               
            }
        }
        return $values;
        
    }
    function get_subdivisions($district) {
        $this->load->database();        
        $this->db->select('district_subdivision.subdivision_name,subdivision_id');
        $this->db->from('district_subdivision');
        $this->db->where('district',$district);
        $this->db->join('district', 'district_subdivision.dist_id = district.dist_id', 'left');
        $query = $this->db->get();
        $results=$query->result();
        $this->db->close();
        if($query->num_rows() == 0) { 
            $values ='<option value=""> Not Found!</option>'; 
        } else {
            foreach($results as $keys => $rows) {
                $values .='<option value="'. $rows->subdivision_name .'">'.$rows->subdivision_name .'</option>';               
            }
        }
        return $values;
        
    }
}
