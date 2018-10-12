<?php
$type1=$_FILES['file1']['type'];
$size1=$_FILES['file1']['size'];
$name1=$_FILES['file1']['name'];
$tmp_name1=$_FILES['file1']['tmp_name'];

$type2=$_FILES['file2']['type'];
$size2=$_FILES['file2']['size'];
$name2=$_FILES['file2']['name'];
$tmp_name2=$_FILES['file2']['tmp_name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上傳結果</title>
</head>

<body>
<?php
$sizemb1=round($size/1024000,2);
echo "檔案類型：".$type1."</br>";
echo "檔案大小：".$sizemb1."MB</br>";
echo "檔案名稱：".$name1."</br>";
echo "暫存名稱：".$tmp_name1."</br>";
if($type1=="text/plain"){
 if($sizemb1 < 3){
  if(file_exists("uploadfiles/".$name1)){
   $file1=explode(".",$name1);
   //echo $file[0];/*主檔名*/
   //echo $file[1];/*副檔名*/
   $new_name1=$file1[0]."-".date(ymdhis)."-".rand(0,10);
   echo "</br>已修改為新檔名:".$new_name1."後上傳成功";
   move_uploaded_file($tmp_name1,"uploadfiles/".$new_name.".".$file1[1]);

   header("Location: index.php");

  }else{
   move_uploaded_file($tmp_name1,"uploadfiles/".$name1);
   echo "上傳成功";

   header("Location: index.php");

  }
 }else{
  echo "檔案太大，上傳失敗";
 }
}else{
 echo "檔案格式錯誤，上傳失敗";
}
?>


<?php
$sizemb2=round($size/1024000,2);
echo "檔案類型：".$type2."</br>";
echo "檔案大小：".$sizemb2."MB</br>";
echo "檔案名稱：".$name2."</br>";
echo "暫存名稱：".$tmp_name2."</br>";
if($type2=="audio/wav"){
 if($sizemb2 < 3){
  if(file_exists("uploadfiles/".$name2)){
   $file2=explode(".",$name2);
   //echo $file[0];/*主檔名*/
   //echo $file[1];/*副檔名*/
   $new_name2=$file2[0]."-".date(ymdhis)."-".rand(0,10);
   echo "</br>已修改為新檔名:".$new_name2."後上傳成功";
   move_uploaded_file($tmp_name2,"uploadfiles/".$new_name2.".".$file2[1]);

   header("Location: index.php");

  }else{
   move_uploaded_file($tmp_name2,"uploadfiles/".$name2);
   echo "上傳成功";

   header("Location: index.php");

  }
 }else{
  echo "檔案太大，上傳失敗";
 }
}else{
 echo "檔案格式錯誤，上傳失敗";
}
?>
</body>
</html>
