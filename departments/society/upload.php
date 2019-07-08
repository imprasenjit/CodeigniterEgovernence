<?php
$targetFolder = 'uploads/'; 


if (!empty($_FILES)) {
    
        foreach($_FILES as $key => $value)
        {
            $Mykey =$key;
        }
        $tempFile = $_FILES[$Mykey]['tmp_name'];
	$targetPath = dirname(__FILE__) . '/' . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES[$Mykey]['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES[$Mykey]['name']);
	$response = array ();
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		$response['success'] = 1;
		foreach ($_POST as $key => $value){
			$response[$key] = $value;
		}
		echo json_encode($response);
	} else {
		$response['success'] = 0;
		$response['error'] = 'Invalid file type.';
		echo json_encode($response);
	}
}
?>