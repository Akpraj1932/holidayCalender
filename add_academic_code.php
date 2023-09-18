<?php
include 'conn.php';
// include 'library/functions.php';
// include 'library/crud.php';
$toDate = date('Y-m-d');
$toDateTime = date('Y-m-d H:i:s');
$allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");


if($_POST['academic_calender']=='academic_calender'){
    $date=date('Y-m-d',strtotime($_POST['date']));
    $title=$_POST['title'];
    $state = $_POST['state'];
    $month=$_POST['month'];
    $description=$_POST['description'];
    $filename='';
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "academic_image/".$filename;
    $sql="INSERT INTO  academic(`date`,`title`,`state`,`month`,`description`,`image`) VALUES('$date','$title','$state','$month','$description','$filename')";
    $result=mysqli_query($conn,$sql);
    if($result){
        move_uploaded_file($tempname,$folder);
        $_SESSION['status']="Academic Calender Add Successfully.";
        $_SESSION['status_code']="success";
        header('Location:add_academic.php');
    }
    else{
        $_SESSION['status']="Academic Calender Not Add Successfully.";
        $_SESSION['status_code']="error";
        header('Location:add_academic.php');
    }

}
if($_POST['government_calender']=='government_calender'){
    $date=date('Y-m-d',strtotime($_POST['date']));
    $title=$_POST['title'];
    $state = $_POST['state'];
    $link = $_POST['link'];
    foreach($state as $state_1){
        echo $state_1;
    }
    $month=$_POST['month'];
    $description=mysqli_real_escape_string($conn,$_POST['description']);
    $filename='';
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "government_image/".$filename;
    $i=0;
    foreach($state as $state_1){
        $sql="INSERT INTO  government(`date`,`title`,`state`,`month`,`description`,`link`,`image`) VALUES('".$date."','".$title."','".$state[$i]."','".$month."','".$description."','".$link."','".$filename."')";
        $result=mysqli_query($conn,$sql);
        $i=$i+1;
    }
    if($result){
        move_uploaded_file($tempname,$folder);
        // $img=$fn->upload_file($filename,$folder,$allowedExts);
        
        $_SESSION['status']="Government Calender Add Successfully.";
        $_SESSION['status_code']="success";
       // echo $_SESSION['status'];
       header('Location:add_government.php');
        
    }
    else{
        $_SESSION['status']="Government Calender Not Add Successfully.";
        $_SESSION['status_code']="error";
        // echo $_SESSION['status'];
        header('Location:add_government.php');
    }  
}
if($_POST['pdf_calender']=='pdf_calender'){
    $state = $_POST['state'];
    $filename='';
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "pdf/".$filename;
    $sql1="SELECT * FROM calenderpdf where state='$state'";
    $res = mysqli_query($conn,$sql1);
    if(mysqli_num_rows($res)>0){
        
        $_SESSION['status']=$state." Calender Is Already Added. Please Delete It.";
        $_SESSION['status_code']="error";
        header('Location:add_pdf.php');  
    }else{
    $sql="INSERT INTO calenderpdf(`state`,`pdf`) VALUE ('$state','$filename')";
    $result = mysqli_query($conn,$sql);
    if($result){
        move_uploaded_file($tempname,$folder);
        $_SESSION['status']="Pdf Calender Add Successfully.";
        $_SESSION['status_code']="success";
        header('Location:add_pdf.php');
    }
    else{
        $_SESSION['status']="Pdf Calender Not Add Successfully.";
        $_SESSION['status_code']="error";
        header('Location:add_pdf.php');
    }
    }
}
if($_POST['pdf_academic']=='pdf_academic'){
    $state = $_POST['state'];
    $filename='';
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "academicpdf/".$filename;
    $sql1="SELECT * FROM academicpdf where state='$state'";
    $res = mysqli_query($conn,$sql1);
    if(mysqli_num_rows($res)>0){
        
        $_SESSION['status']=$state." Calender Is Already Added. Please Delete It.";
        $_SESSION['status_code']="error";
        header('Location:academic.php');  
    }else{
    $sql="INSERT INTO academicpdf(`state`,`pdf`) VALUE ('$state','$filename')";
    $result = mysqli_query($conn,$sql);
    if($result){
        move_uploaded_file($tempname,$folder);
        $_SESSION['status']="Pdf Calender Add Successfully.";
        $_SESSION['status_code']="success";
        header('Location:academic.php');
    }
    else{
        $_SESSION['status']="Pdf Calender Not Add Successfully.";
        $_SESSION['status_code']="error";
        header('Location:academic.php');
    }
    }
}
if($_POST['update_government_calender']=='update_government_calender'){
    $id=$_POST['id'];
    $date=$_POST['date'];
    $title=$_POST['title'];
    $state=$_POST['state'];
    $month=$_POST['month'];
    // $description=$_POST['description'];
    $description=mysqli_real_escape_string($conn,$_POST['description']);
    $link = $_POST['link'];
    $filename='';
    if($_FILES["image"]["name"]==''){
        $filename = $_POST['old_image'];
    }else{
        
    
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "government_image/".$filename;
    }
    // if($description!=''){
    // $sql = "UPDATE `government` SET `date`='$date',`title`='$title',`state`='$state',`month`='$month',`description`='$description',`image`='$filename',`link`='$link' WHERE id='$id'";
    // }else{
    //   $sql = "UPDATE `government` SET `date`='$date',`title`='$title',`state`='$state',`month`='$month',`image`='$filename' WHERE id='$id'"; 
    // }
      $sql = "UPDATE `government` SET `date`='$date',`title`='$title',`state`='$state',`month`='$month',`description`='$description',`image`='$filename',`link`='$link' WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        if($_FILES["image"]["name"]!='')
        move_uploaded_file($tempname,$folder);
        $_SESSION['status']="Government Calender Updated Successfully.";
        $_SESSION['status_code']="success";
        header('Location:add_government.php');
    }else{
        $_SESSION['status']="Government Calender Not Updated Successfully.";
        $_SESSION['status_code']="error";
        header('Location:add_government.php');
    }
}
if($_GET['delete_government']==1){
    $id=$_GET['id'];
    $sql="DELETE FROM `government` WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
         
        echo 1;
      
    }else{
       echo 0;
    }
     
}
if($_POST['update_academic']=='update_academic'){
    $id=$_POST['id'];
    $state=$_POST['state'];
    $filename='';
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "academicpdf/".$filename;
    $sql="UPDATE `academicpdf` SET `state`='$state',`pdf`='$filename' WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        move_uploaded_file($tempname,$folder);
        $_SESSION['status']="Academic Calender Updated Successfully.";
        $_SESSION['status_code']="success";
        header('Location:academic.php');
    }
    else{
        $_SESSION['status']="Academic Calender Not Updated Successfully.";
        $_SESSION['status_code']="error";
        header('Location:academic.php');
    }
}
if($_GET['delete_academic']==1){
    $id=$_GET['id'];
    $sql="DELETE FROM `academicpdf` WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
         
        echo 1;
      
    }else{
       echo 0;
    }
     
}
if($_GET['delete_banner']==1){
    $id = $_GET['id'];
    $sql = "DELETE FROM `banner` WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}
if($_POST['update_pdf']=='update_pdf'){
    $id=$_POST['id'];
    $state=$_POST['state'];
    $filename='';
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "pdf/".$filename;
    $sql="UPDATE `calenderpdf` SET `state`='$state',`pdf`='$filename' WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        move_uploaded_file($tempname,$folder);
        $_SESSION['status']="Academic Calender Updated Successfully.";
        $_SESSION['status_code']="success";
        header('Location:add_pdf.php');
    }
    else{
        $_SESSION['status']="Academic Calender Not Updated Successfully.";
        $_SESSION['status_code']="error";
        header('Location:add_pdf.php');
    }
}
if($_GET['delete_pdf']==1){
    $id=$_GET['id'];
    $sql="DELETE FROM `calenderpdf` WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
         
        echo 1;
      
    }else{
       echo 0;
    }
     
}
if(isset($_POST['add_banner']) && $_POST['add_banner']!='null'){
    $url = $_POST['url'];
    $filename='';
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "banner_image/".$filename;
    $sql = "INSERT INTO `banner`(`url`,`image`) VALUES('$url','$filename')";
    $result = mysqli_query($conn,$sql);
    if($result){
        move_uploaded_file($tempname,$folder);
        $_SESSION['status'] = "Banner Integration is Successfull.";
        $_SESSION['status_code'] = "success";
        header("Location:add_banner.php");
    }
    else{
        $_SESSION['status']="Banner Integration is not Successfully.";
        $_SESSION['status_code']="error";
        header('Location:add_banner.php');
    }
    
}
if($_POST['update_banner']=='update_banner'){
    $id=$_POST['id'];
    $url=$_POST['url'];
    $filename='';
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "banner_image/".$filename;
    $sql="UPDATE `banner` SET `url`='$url',`image`='$filename' WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        move_uploaded_file($tempname,$folder);
        $_SESSION['status']="Banner Updated Successfully.";
        $_SESSION['status_code']="success";
        header('Location:add_banner.php');
    }
    else{
        $_SESSION['status']="Banner Not Updated Successfully.";
        $_SESSION['status_code']="error";
        header('Location:add_banner.php');
    }
}
if (isset($_GET['delete_multiple']) && $_GET['delete_multiple'] == 1) {
    $ids = $_GET['ids'];
    $table = $_GET['sec'];

    $sql = "DELETE FROM `" . $table . "` WHERE `id` in ( " . $ids . " ) ";
    
    if (mysqli_query($conn,$sql)) {
        echo 1;
    } else {
        echo 0;
    }
}
?>