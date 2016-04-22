<?php

if(isset($_POST['submit']))
{
	echo $_FILES["file"]["tmp_name"]; exit;
	
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
     	 echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
     	 move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
      }
}
?> 
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html> 