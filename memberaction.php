<?php 
include ('connection.php');

if(isset($_POST['add'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $duedate = $_POST['duedate'];
    $priority = $_POST['priority'];

    $query = "INSERT INTO details(title,description,duedate,priority) VALUES('$title','$description','$duedate','$priority')";
	$result=mysqli_query($con,$query);
    if($result){
        header("location: index.php");
    }else{
        echo "Connection Error: ".mysqli_connect_error();
    }
}

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duedate = $_POST['duedate'];
    $priority = $_POST['priority'];

    $query = "UPDATE details SET title='$title',description='$description',duedate='$duedate',priority='$priority' WHERE id=$id";
	$result=mysqli_query($con,$query);
    if($result){
        header("location: index.php");
    }else{
       echo "Error updating data: "  .mysqli_connect_error();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM details WHERE id=$id";
	$result=mysqli_query($con,$query);
    if ($result) {
        header("location: index.php");
    } else {
        echo "Error: " .mysqli_connect_error();
    }
}
?>