<!-- //addData.php -->
<?php
include("db.php"); 
$response = array( 
    'status' => 0, 
    'msg' => 'Some problems occurred, please try again.'
); 
if(!empty($_REQUEST['firstname']) && !empty($_REQUEST['lastname']) && !empty( $_REQUEST['email']) && !empty($_REQUEST['phone'])){ 
    $firstname = $_REQUEST['firstname']; 
    $lastname = $_REQUEST['lastname']; 
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email']; 
  
    $sql = "INSERT INTO jeasytable(firstname,lastname,phone,email) VALUES ('$firstname','$lastname','$phone','$email')";
    $insert = $conn->query($sql); 
  
 if($insert){ 
        $response['status'] = 1; 
        $response['msg'] = 'User data has been added successfully!'; 
    } 
}else{ 
    $response['msg'] = 'Please fill all the mandatory fields.'; 
}
echo json_encode($response); 
?>
