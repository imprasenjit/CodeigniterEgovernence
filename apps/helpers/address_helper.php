<?php
	defined("BASEPATH") OR exit("No direct script access allowed");
	/**
		* address helper
		* @this helper provides acc
	*/
	if (!function_exists("getAllStates")) {
		function getAllStates() {
			$ci = & get_instance();
			$ci->load->database();
			$ci->db->select("*");
			$ci->db->from("states");
			$ci->db->order_by("state_name", "ASC");
			$query = $ci->db->get();
			return $query->result();
		}
	}
	
	if (!function_exists("getState")) {
		function getState($state_id) {
			$ci = & get_instance();
			$ci->load->database();
			$ci->db->from("states");
			$ci->db->where("state_id",$state_id);
			$query = $ci->db->get();
			return $query->row();
		}
	}
	
	if (!function_exists("getDistrict")) {
		function getDistrict($dist_id) {
			$ci = & get_instance();
			$ci->load->database();
			$ci->db->from("districts");
			$ci->db->where("dist_id",$dist_id);
			$query = $ci->db->get();
			return $query->row();
		}
	}
	
	
	
	if (!function_exists("show_address")) {
		function show_address($name = NULL, $address = NULL) {
			echo '<div class = "form-group">
			<label class = "col-md-3 col-sm-6">
			Address <font class = "mandatory_field">*</font> :
			</label>
			<div class = "col-md-3 col-sm-6">
			<textarea class = "form-control requiredinput" name="' . $name . '_address" id="' . $name . '_address"data-error = "Please enter Address." >' . ($address != NULL ? $address->address : '') . '</textarea>
			</div>
			<label class = "col-md-3 col-sm-6">
			Pin Code <font class = "mandatory_field">*</font> :
			</label>
			<div class = "col-md-3 col-sm-6">
			<input type="text" class="form-control requiredinput"  name="' . $name . '_pin" id="' . $name . '_pin" value="' . ($address != NULL ? $address->pin : '') . '" placeholder = "6-digit PIN" maxlength = "6" data-error = "Please enter pin code."/>
			</div>
			</div>
			<div class = "form-group">
			<label class = "col-md-3 col-sm-6">
			State <font class = "mandatory_field">*</font> :
			</label>
			<div class = "col-md-3 col-sm-6">
			<select class = "form-control requiredinput" name="' . $name . '_state"  id="' . $name . '_state" data-error = "Please select state.">
			<option value = "">Select State</option>';
			foreach (getAllStates() as $row) {
				if ($address != NULL) {
					if ($address->state === $row->state_id) {
						echo '<option value="' . $row->state_id . '" selected>' . $row->state_name . '</option>';
						} else {
						echo '<option value="' . $row->state_id . '" >' . $row->state_name . '</option>';
					}
					} else {
					echo '<option value="' . $row->state_id . '" >' . $row->state_name . '</option>';
				}
			}
			echo '</select></div>
			<label class="col-md-3 col-sm-6">
			District <font class="mandatory_field">*</font> :
			</label>
			<div class="col-md-3 col-sm-6" id="app_dist_div">
			<select class="form-control requiredinput" name="' . $name . '_dist" id="' . $name . '_dist" data-error="Please select District.">';
			if ($address != NULL) {
				echo '<option value="' . $address->dist_id . '" >' . $address->dist_name . '</option>';
			}
			echo '</select>
			</div>
			</div>';
			echo '<script>'
			. '$("#' . $name . '_state").change(function () {
			var state = $(this) . val();
			$("#entp_dist").empty().append("<option >Loading...</option>")
			$.ajax( {
            type: "POST",
            url: "' . base_url() . 'ajax/site/get_district_of_state/",
            data: {
			state: state},
			beforeSend: function () {},
			success: function (res) {
			$("#' . $name . '_dist").empty().append("<option>Select</option>").append(res);
			}
			}); //End of ajax()
            });
			</script>'
			;
		}
	}
	if (!function_exists("view_address")) {
		/**
			* This function is only for view 
			* @param type $address
		*/
		function view_address($address) {
			//print_r($address);
			
			$dist=getDistrict($address->dist);
			$state=getState($address->state);
			echo '<h4>' . $address->address . '
            <br>' . $dist->dist_name . '
            <br>' . $state->state_name . '-' . $address->pin . '</h4>';
		}
	}
	
	if (!function_exists("get_district_by_state")) {
		
		/**
			* 
			* @param type $state
		*/
		function get_district_by_state($state = NULL) {
			
				$ci = & get_instance();
				$ci->load->database();
				$ci->db->select("*");
				$ci->db->from("districts");
				if ($state != NULL) {
				$ci->db->where("state_id",$state);
				}
				$query = $ci->db->get();
				return $query->result();
				
		}
	}
	
	if (!function_exists("get_address")) {
		function get_address($addressid) {
			$ci = & get_instance();
			$ci->load->database();
			$ci->db->select("*");
			$ci->db->from("address");
			$ci->db->where("id", $addressid);
			$query = $ci->db->get();
			//print_r($address);
			return $query->row();
		}
	}
	if (!function_exists("show_address_assam")) {
		function show_address_assam($name = NULL, $address = NULL) {
			echo '<div class = "form-group">
			<label class = "col-md-3 col-sm-6">
			Address <font class = "mandatory_field">*</font> :
			</label>
			<div class = "col-md-3 col-sm-6">
			<textarea class = "form-control requiredinput" name="' . $name . '_address" id="' . $name . '_address"data-error = "Please enter Address." >' . ($address != NULL ? $address->address : '') . '</textarea>
			</div>
			<label class = "col-md-3 col-sm-6">
			Pin Code <font class = "mandatory_field">*</font> :
			</label>
			<div class = "col-md-3 col-sm-6">
			<input type="text" class="form-control requiredinput"  name="' . $name . '_pin" id="' . $name . '_pin" value="' . ($address != NULL ? $address->pin : '') . '" placeholder = "6-digit PIN" maxlength = "6" data-error = "Please enter pin code."/>
			</div>
			</div>
			<div class = "form-group">
			<label class = "col-md-3 col-sm-6">
			State <font class = "mandatory_field">*</font> :
			</label>
			<div class = "col-md-3 col-sm-6">
			<select class = "form-control requiredinput" name="' . $name . '_state"  id="' . $name . '_state" data-error = "Please select state.">
			<option value = "4">Assam (AS)</option>';
			echo '</select></div>
			<label class="col-md-3 col-sm-6">
			District <font class="mandatory_field">*</font> :
			</label>
			<div class="col-md-3 col-sm-6" id="app_dist_div">
			<select class="form-control requiredinput" name="' . $name . '_dist" id="' . $name . '_dist" data-error="Please select District.">';
			foreach (get_district_by_state(4) as $row) {
				echo '<option value="' . $row->dist_id . '" >' . $row->dist_name . '</option>';
			}
			echo '</select>
			</div>
			</div>';
		}
		}			