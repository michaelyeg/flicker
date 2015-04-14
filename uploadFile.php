<?php

if($_GET['id']=='') {
  $fileElementName = 'testing';
}
else {
  $fileElementName = $_GET['id'];
}
$error = "";
$msg = "";
if(!empty($_FILES[$fileElementName]['error'])) {
  $error = 'The uploaded file was only partially uploaded';
}
elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none') {
  $error = 'The uploaded file exceeds the upload limit';
}
else {
  $fileSize = " File Size: " . floor(@filesize($_FILES[$fileElementName]['tmp_name'])/1024);
  $path_parts = pathinfo($_FILES[$fileElementName]["name"]);
  $extension = strtolower($path_parts['extension']);
  if($extension!='jpg' && $extension!='gif') {
    $rtnData = array(
      "status" => 'error',
      "message" => 'The uploaded file extension is not allowed',
      "fileName" => $_FILES[$fileElementName]["name"],
      "fileSize" =>$fileSize
    );
    echo json_encode($rtnData);die;
  }
  $new_fileName = rand().'.'.$path_parts['extension'];
  if(move_uploaded_file($_FILES[$fileElementName]["tmp_name"], 'uploads/'.$new_fileName)) {
    $rtnData = array(
      "status" => 'success',
      "filePath" => $new_fileName,
      "fileName" => $_FILES[$fileElementName]["name"],
      "fileExt" => $path_parts['extension'],
      "fileSize" =>$fileSize
    );
    echo json_encode($rtnData);die;
  }
  else {
    $rtnData = array(
      "status" => 'error',
      "message" => 'The uploaded file was only partially uploaded',
      "fileName" => $_FILES[$fileElementName]["name"],
      "fileSize" =>$fileSize
    );
    echo json_encode($rtnData);die;
  }
}
$rtnData = array(
  "status" => 'error',
  "message" => $error,
  "filename" => $_FILES[$fileElementName]["name"],
  "fileSize" =>$fileSize
);
echo json_encode($rtnData);die;
?>
