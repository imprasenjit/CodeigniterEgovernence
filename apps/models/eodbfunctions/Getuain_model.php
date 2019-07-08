<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Getuain_model extends CI_Model{
    public function uain($dept_code, $form_table, $form_id){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($form_table); 
        $dept_db->where("form_id", $form_id ); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else
    }//End of uain()
}//End of Getuain_model