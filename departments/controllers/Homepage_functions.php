<?php
Class Homepage_functions extends DbConnect{
	public function get_sub_department($parentID){
		$all_dept=$this->executeQuery("dicc","SELECT * FROM SubDepartment WHERE ParentID='$parentID' ");
		$masterArray=array();
		$tempArray=array();
		while($result=$all_dept->fetch_assoc()){
			$tempArray=array('id'=>$result['id'],'status'=>$result['status'],'name'=>$result['name'],'dept_code'=>$result['dept_code'],'form_tables'=>$result['form_tables'],'icons'=>$result['icons'],'website'=>$result['website']);     
			array_push($masterArray, $tempArray);
		}				
		return $masterArray;
	}
	public function get_all_department(){

		$all_dept=$this->executeQuery("dicc","SELECT * FROM Department where status='1' ORDER BY id ASC");
        $masterArray=array();
		while($result=$all_dept->fetch_assoc()){
		    $tempArray=array('id'=>$result['id'],'status'=>$result['status'],'name'=>$result['name'],'dept_code'=>$result['dept_code'],'form_tables'=>$result['form_tables'],'icons'=>$result['icons'],'website'=>$result['website']);     
            array_push($masterArray, $tempArray);		
		}				
		return $masterArray;
	}
}
?>