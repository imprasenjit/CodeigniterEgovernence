<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Appsreports_model extends CI_Model {
    
    function tot_rows($dept_code){        
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("applications_up");
        $query = $dept_db->get(); 
        $dept_db->close();
        return $query->num_rows();
    }//End of tot_rows()
    
    
    function tot_processrows($dept_code, $process){        
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("process", $process );
        $dept_db->from("applications_up");
        $query = $dept_db->get(); 
        $dept_db->close();
        return $query->num_rows();
    }//End of tot_processrows()
    
    function tot_officerows($dept_code, $office_id){        
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("office_id", $office_id );
        $dept_db->from("applications_up");
        $query = $dept_db->get(); 
        $dept_db->close();
        return $query->num_rows();
    }//End of tot_officerows()
    
    function get_officerows($dept_code, $office_id){        
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("office_id", $office_id );
        $dept_db->from("applications_up");
        $query = $dept_db->get();
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_officerows()
    
    function tot_officeprocessrows($dept_code, $office_id, $process){        
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("office_id", $office_id );
        $dept_db->where("process", $process );
        $dept_db->from("applications_up");
        $query = $dept_db->get(); 
        $dept_db->close();
        return $query->num_rows();
    }//End of tot_officeprocessrows()
    
    function get_officeprocessrows($dept_code, $office_id, $process){        
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("office_id", $office_id );
        $dept_db->where("process", $process );
        $dept_db->from("applications_up");
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_officeprocessrows()
    
    function get_row($dept_code, $id){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("applications_up");
        $dept_db->where("id", $id); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
}//End of Appsreports_model
