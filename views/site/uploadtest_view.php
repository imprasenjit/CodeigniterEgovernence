<!DOCTYPE html>
<html>
<body>

<form action="<?=base_url();?>site/uploadfilestoaws/upload_file" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>