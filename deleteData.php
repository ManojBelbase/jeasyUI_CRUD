//deleteData.php
<?php
include"db.php"; 
$response = array( 
    'status' => 0, 
    'msg' => 'Some problems occurred, please try again.'
); 
if(!empty($_REQUEST['id'])){ 
    $id = intval($_REQUEST['id']); 
      
 
    $sql = "DELETE FROM jeasytable WHERE id = $id"; 
    $delete = $conn->query($sql); 
      
    if($delete){ 
        $response['status'] = 1; 
        $response['msg'] = 'User data has been deleted successfully!'; 
    } 
} 
echo json_encode($response);
?>