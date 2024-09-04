<?php
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Information</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 id="main-title">CRUD App in PHP</h1>
    <div class="container mt-5">
        <h1>Update Student Information</h1>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Corrected SQL query: removed single quotes around the column name
            $query = "SELECT * FROM students WHERE id = '$id'";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($connection));
            } else {
                $row = mysqli_fetch_assoc($result);
                //mysqli_fetch_assoc(): This function fetches a result row as an associative array. The keys of the array will be the column names from the result set.
                if (!$row) {
                    die("No record found for the given ID.");
                }
            }
        }
        if (isset($_POST['update_students'])) {
            $idnew = $_POST['id'];

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
                        // This part of the code checks if $age is a valid integer and if it falls within the range from 1 to 120.
                        //filter_var: This function filters a variable with a specified filter. It can be used to validate or sanitize input.
                        //FILTER_VALIDATE_INT: This filter validates that the input is an integer.
                        echo "<script>alert('Age must be a valid integer between 1 and 120.')
    window.location.href = 'index.php';
    </script>";
                    } else {

                        // Validate phoneNumber
                        if (empty($phoneNumber)) {
                            echo "<script>alert('Phone number is required.')
    window.location.href = 'index.php';
    </script>";
                        } elseif (!preg_match("/^\d{10}$/", $phoneNumber)) {    //perform pattern match

                            echo "<script>alert('Phone number must be 10 digits long.')
  window.location.href = 'index.php';
    </script>";
                        } else {





                            // Corrected SQL query
                            $query = "UPDATE students SET firstName='$firstName', lastName='$lastName', age='$age', phoneNumber='$phoneNumber' WHERE id='$idnew'";

                            $result = mysqli_query($connection, $query);

                            if (!$result) {
                                die("Query failed: " . mysqli_error($connection));
                            } else {
                                header('location:./index.php?update_msg=You have successfully updated the data');
                            }
                        }
                    }
                }
            }
        }
        ?>

        <form action="update_link.php?id_new=<?php echo $id; ?>" method="post" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $row['firstName']; ?>" required>
                <span class="error text-danger" id="firstNameError"></span>
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $row['lastName']; ?>" required>
                <span class="error text-danger" id="lastNameError"></span>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" id="age" name="age" class="form-control" value="<?php echo $row['age']; ?>" required>
                <span class="error text-danger" id="ageError"></span>
            </div>

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="<?php echo $row['phoneNumber']; ?>" required>
                <span class="error text-danger" id="phoneNumberError"></span>
            </div>

            <input type="submit" class="btn btn-success" name="update_students" value="Update">
        </form>
    </div>
    <script>
         function validateForm() {
        console.log("Validation function triggered");
        // Get form elements
               const firstName = document.getElementById('firstName').value;
               const lastName = document.getElementById('lastName').value.trim();
               const age = document.getElementById('age').value.trim();
               const phoneNumber = document.getElementById('phoneNumber').value.trim();

               const firstNameError = document.getElementById('firstNameError');
               // Basic validation
               if (!firstName || !lastName || !age || !phoneNumber) {
                   alert('All fields are required!');
                   return false; // Prevent form submission
               }

               
               // First Name Validation
               // const firstName = document.getElementById('firstName').value;
               if (firstName.length < 2) {
                document.getElementById('firstNameError').innerHTML  = 'First name must be at least 2 characters long.';
                   return false;
               } else{
                document.getElementById('firstNameError').innerHTML  = '';

               }
               var regex = /^[a-zA-Z\s]+$/;
                 
                   var errorElement = document.getElementById('firstNameError');

                   if (!regex.test(firstName)) {
                       errorElement.textContent = 'First name can only contain letters and spaces.';
                       return false; // Prevent form submission
                   }else{
                    document.getElementById('firstNameError').innerHTML = '';
                   }
               
               // Last Name Validation
               // const lastName = document.getElementById('lastName').value;
               const lastNameError = document.getElementById('lastNameError');
               if (lastName.length < 2) {
                   lastNameError.textContent = 'Last name must be at least 2 characters long.';
                   return false;
                }else{
                document.getElementById('lastNameError').innerHTML  = '';

               }
               if (!regex.test(lastName)) {
                lastNameError.textContent = 'Last name can only contain letters and spaces.';
                       return false; // Prevent form submission
                   }else{
                    document.getElementById('lastNameError').innerHTML = '';
                   }


                // Age Validation
                //const age = document.getElementById('age').value;
               const ageError = document.getElementById('ageError');
               if (age < 1 || age > 120) {
                   ageError.textContent = 'Age must be between 1 and 120.';
                   return false;
                } else{
                document.getElementById('ageError').innerHTML  = '';

               }
                
               // Phone Number Validation
               //const phoneNumber = document.getElementById('phoneNumber').value;
               const phoneNumberError = document.getElementById('phoneNumberError');
               const phoneNumberPattern = /^[0-9]{10}$/;
               if (!phoneNumberPattern.test(phoneNumber)) {
                   phoneNumberError.textContent = 'Phone number must be a 10-digit number.';
                   return false;
                } else{
                document.getElementById('phoneNumberError').innerHTML  = '';

               }
               

               

               // Validate age (e.g., must be a positive number)
               if (age <= 0) {
                   alert('Age must be a positive number!');
                   return false; // Prevent form submission
               }
               
               // Validate phone number (basic validation)  
               const phonePattern = /^[0-9]{10}$/; // Adjust pattern as needed
               if (!phonePattern.test(phoneNumber)) {
                    alert('Invalid phone number format! It should be a 10-digit number.');
                   return false; // Prevent form submission
               }
               
            //    // If all validations pass, form is submitted


               console.log(firstName);
               console.log(lastName);
               console.log(age);
               console.log(phoneNumber);
               
               return true;
            }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>