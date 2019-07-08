<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
	class Landbank_model extends CI_Model{
		function getAllAgency(){
		    $this->load->database();
			$this->db->distinct();
			$this->db->select('Agency');			
			$this->db->from('LandBank');
			$this->db->where('Agency!=',"");
            $query = $this->db->get();
			$this->db->close();
		    return $query->result_array();
		} 
		
		function getLandDetails(){
		    $post=$this->input->post(NULL, TRUE); 
			$str='';
			$i=0;
			$this->load->database();
			foreach ($post as $key=>$value)
			{
				if($key=='district_id' )
				{
					if($post[$key]!='') $this->db->where("LandBank.district_id",$value);//$str.=' LandBank.district_id = '.$value;
				}
				else if($key=='Agency')
				{
					if($post[$key]!='') $this->db->like("Agency",$value);//$str.=" AND LandBank.Agency LIKE '%".$value."%'    "; 
				}
				else if($key=='sqft' )
				{
					if($post[$key]!='') $this->db->where("Allotable_Land_Area >",$value);//$str.='   AND   LandBank.Allotable_Land_Area > '.$value;
				}
				$i++;
			}
			

		        $this->db->select('*');
				$this->db->from('LandBank');
				$this->db->join('districts', 'LandBank.district_id = districts.dist_id');
				$result=$this->db->get();

			$results=$result->result_array();

			$arr=array();
			foreach($results as $row)
			{
				$array_temp=array();
				$array_temp['district']=$row['dist_name'];
				$array_temp['Name_of_the_infrastructure_with_location']=$row['Name_of_the_infrastructure_with_location'];
				$array_temp['industry_type']=$row['industry_type'];
				$array_temp['Allotable_Land_Area']=$row['Allotable_Land_Area'];
				$array_temp['Allotable_shed_area']=$row['Vacant_allottable_shedarea'];
				$array_temp['Agency']=$row['Agency'];
				$array_temp['Link']='<a target="_blank" href="'.base_url().'homepage/viewMap.php?id='.$row['id'].'&district_id='.$row['district_id'].'">View Map</a>';
				$array_temp['Link2']='<a target="_blank" href="'.base_url().'departments/dic/forms/dic_form10.php?Agency='.$row['Agency'].'&Name_of_the_infrastructure_with_location='.$row['Name_of_the_infrastructure_with_location'].'&district_id='.$row['district_id'].' ">Apply</a>';
				$array_temp['Link3']='<a target="_blank" href="'.base_url().'departments/dic/forms/dic_form11.php?Agency='.$row['Agency'].'&Name_of_the_infrastructure_with_location='.$row['Name_of_the_infrastructure_with_location'].'&district_id='.$row['district_id'].' ">Apply</a>';
				array_push($arr,$array_temp);
			}
			//echo $query;
			echo json_encode(array('data'=>$arr));
			
			
		}
		
	}//End of Subdepartments_model				