<?php

/**
 * Amazon S3 Upload PHP class
 *
 * @version 0.1
 */
class S3_upload {

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('s3');

		$this->CI->config->load('s3', TRUE);
		$s3_config = $this->CI->config->item('s3');
		$this->bucket_name = $s3_config['bucket_name'];
		$this->folder_name = $s3_config['folder_name'];
		$this->s3_url = $s3_config['s3_url'];
	}

	function upload_file($file_path, $destination_path)
	{
		// generate unique filename
		$file = pathinfo($file_path);
		//print_r($file);
		$s3_file = $file['filename'].'.'.$file['extension'];
		
		$mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);
		
		$saved = $this->CI->s3->putObjectFile(
			$file_path,
			$this->bucket_name,
			$this->folder_name . $destination_path.$s3_file,
			S3::ACL_PUBLIC_READ,
			array(),
			$mime_type
		);
		
		if ($saved) {
			return $this->s3_url.$this->bucket_name .'/'.$this->folder_name . $destination_path. $s3_file;
		}
	}
	function getObjectFile($file_path)
	{
		
		$file = $this->CI->s3->getObject($this->bucket_name, $this->folder_name . $file_path, $saveTo = false);
		
		if($file->code != "200"){
			echo $file->error;
		}else{
			//print_r($file);die();
			header("Content-Type:". $file->headers["type"] ."");
			header('Content-Disposition: filename="' . basename($file_path) . '"');
			echo $file->body;
		} 
		
	}
}