<?php

include('connect.php');

if (isset($_POST['add_students'])) {
    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $age = isset($_POST['age']) ? trim($_POST['age']) : '';
    $phoneNumber = isset($_POST['phoneNumber']) ? trim($_POST['phoneNumber']) : '';


    // Validate firstName
    if (empty($firstName)) {
        echo "<script>alert('Fill the form first!')
    window.location.href = 'index.php';
    </script>";
        //$errors[] = 'First name is required.';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $firstName)) {
        echo "<script>alert('First name can only contain letters and spaces.')
    window.location.href = 'index.php';
    </script>";
    } elseif (strlen($firstName) > 50) {
        echo "<script>alert( 'First name should not exceed 50 characters.')
    window.location.href = 'index.php';
    </script>";
    } else {

        // Validate lastName
        if (empty($lastName)) {
            echo "<script>alert('Last name is required.')</script>";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lastName)) {
            echo "<script>alert('Last name can only contain letters and spaces.')
    window.location.href = 'index.php';
    </script>";
        } elseif (strlen($lastName) > 50) {
            echo "<script>alert('Last name should not exceed 50 characters.')
    window.location.href = 'index.php';
    </script>";
        } else {


            // Validate age
            if (empty($age)) {

                echo "<script>alert('Age is required.')</script>";
            } elseif (!filter_var($age, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1, "max_range" => 120)))) {
                echo "<script>alert('Age must be a valid integer between 1 and 120.')
    window.location.href = 'index.php';
    </script>";
            } else {

                // Validate phoneNumber
                if (empty($phoneNumber)) {
                    echo "<script>alert('Phone number is required.')
    window.location.href = 'index.php';
    </script>";
                } elseif (!preg_match("/^\d{10}$/", $phoneNumber)) {

                    echo "<script>alert('Phone number must be 10 digits long.')
  window.location.href = 'index.php';
    </script>";
                } else {




                    //  $query ="insert into students  ('firstName','lastName','age','phoneNumber' ) values('$firstName','$lastName','$age','$phoneNumber')";
                    $query = "INSERT INTO students (firstName, lastName, age, phoneNumber) VALUES ('$firstName', '$lastName', '$age', '$phoneNumber')";


                    $result = mysqli_query($connection, $query);
                    if (!$result) {
                        die("query failed" . mysqli_error($connection));
                    } else {
                        header('location:./index.php?insert_msg=your data has been added successfully');
                    }
                }
            }
        }
    }
}
