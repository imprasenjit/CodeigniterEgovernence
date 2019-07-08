<?php
	$var=$this->uri->segment(4);
	$results=$this->getSubDepartment_model->get($var);
	if (!$results) {
		echo '<option value=""> Not Found!</option>';
		} else {
		echo '<option value="">Select Sub Department.</option>';
		foreach ($results as $data) {
			echo '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
		}
	}	