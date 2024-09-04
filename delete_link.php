<?php 
include('connect.php');
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            // Corrected SQL query: removed single quotes around the column name
            $query = "DELETE  FROM students WHERE id = '$id'";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($connection));
            } else {
               header('location:./index.php?delete_msg=you have deleted the record.');
            }
        } 

?>