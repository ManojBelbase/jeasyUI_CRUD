<?php
include("db.php"); 

$response = array( 
    'status' => 0, 
    'msg' => 'Some problems occurred, please try again.' 
);

if (!empty($_REQUEST['firstname']) && !empty($_REQUEST['lastname']) && !empty($_REQUEST['email']) && !empty($_REQUEST['phone'])) { 
    $firstname = $_REQUEST['firstname']; 
    $lastname = $_REQUEST['lastname']; 
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email']; 
    
    if (!empty($_REQUEST['id'])) {
        $id = intval($_REQUEST['id']); 
        $sql = "UPDATE jeasytable SET firstname='$firstname', lastname='$lastname', phone='$phone', email='$email' WHERE id = $id"; 
        $update = $conn->query($sql); 
        
        if ($update) { 
            $response['status'] = 1; 
            $response['msg'] = 'User data has been updated successfully!';
        } else {
            $response['msg'] = 'Database update failed!';
        }
    } 
} else { 
    $response['msg'] = 'Please fill all the mandatory fields.'; 
}

echo json_encode($response); 
?>
