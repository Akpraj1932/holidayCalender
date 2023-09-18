<?php
include 'conn.php';
$sql = "SELECT * FROM academic";
$res = mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Academic Calender retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Academic Calender not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>