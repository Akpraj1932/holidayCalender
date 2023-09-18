<?php
include 'conn.php';
$sql = "SELECT * FROM calenderpdf";
$res = mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Calender Pdf retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Calender Pdf not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>