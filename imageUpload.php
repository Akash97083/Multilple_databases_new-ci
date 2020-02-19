<?php 
echo "Here";
if(isset($_FILES['upload']['name'])){
	$file = $_FILES['upload']['tmp_name'];
	$file_name = $_FILES['upload']['name'];
	$file_name_array = explode(".",$file_name);
	$extenstion = end($file_name_array);
	$new_image_name = rand() .".".$extenstion;
	chmod('uploads',0777);
	$allowed_extension = array("jpg","gif","png");
	if(in_array($extenstion, $allowed_extension)){

		move_uploaded_file($file, 'uploads/cms/',$new_image_name);
		$function_number = $_GET['CKEditorFuncNum'];
		$url = 'uploads/cms/'.$new_image_name;
		$message = '';
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number,'$url','$message');</script>";


	}


}

?>