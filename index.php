   <?php
    include('connect.php');
    ?>

   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Document</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
       <link rel="stylesheet" href="style.css">
   </head>

   <body>
       <h1 id="main-title">CRUD App in PHP</h1>
       <div class="container">
           <div class="box1">
               <h2>All Students</h2>
               <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Students</button>

           </div>
           <table class="table table-hover table-bordered table-striped">
               <thead>

                   <th>first name</th>
                   <th>Last name</th>
                   <th>age</th>
                   <th>phone Nmber</th>

               </thead>
               <tbody>
                   <?php
                    $query = "SELECT * FROM students";

                    $result = mysqli_query($connection, $query);
                    if (!$result) {
                        die("query failed");
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {


                    ?>
                           <tr>
                               <td><?php echo $row['firstName']; ?></td>
                               <td><?php echo $row['lastName']; ?></td>
                               <td><?php echo $row['age']; ?></td>
                               <td><?php echo $row['phoneNumber']; ?></td>
                               <td class="text-center"><a href="update_link.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Update</a></td>
                               <!-- <td><a href="confirm_delete.php?id=<?php echo $row['id']; ?>"  class="btn btn-danger" > Delete</a></td> -->
                               <td class="text-center">
                                   <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                               </td>

                           </tr>
                   <?php
                        }
                    }
                    ?>

               </tbody>
           </table>


           <!-- <?php
                //if(isset($_GET['insert_msg'])){
                //    echo "<h6>".$_GET['insert_msg']."</h6>";
                //}
                ?> -->

           <?php
            if (isset($_GET['insert_msg']) && !empty($_GET['insert_msg'])) {
                echo "<h6>" . $_GET['insert_msg'] . "</h6>";
            }
            ?>

           <?php
            if (isset($_GET['delete_msg'])) {
                echo "<h6>" . $_GET['delete_msg'] . "</h6>";
            }
            ?>
           <?php
            if (isset($_GET['update_msg'])) {
                echo "<h6>" . $_GET['update_msg'] . "</h6>";
            }
            ?>



           <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <div class="modal-body">

                           <!-- //form -->
                           <form action="insert_data.php" method="post" onsubmit="return validateForm()" id="myForm">
                               <div class="mb-3">
                                   <label for="firstName" class="form-label">First Name</label>
                                   <input type="text" id="firstName" name="firstName" class="form-control" value="">
                                   <span class="error text-danger" id="firstNameError"></span>
                               </div>
                               <div class="mb-3">
                                   <label for="lastName" class="form-label">Last Name</label>
                                   <input type="text" id="lastName" name="lastName" class="form-control">
                                   <span class="error text-danger" id="lastNameError"></span>
                               </div>
                               <div class="mb-3">
                                   <label for="age" class="form-label">Age</label>
                                   <input type="number" id="age" name="age" class="form-control">
                                   <span class="error text-danger" id="ageError"></span>
                               </div>
                               <div class="mb-3">
                                   <label for="phoneNumber" class="form-label">Phone Number</label>
                                   <input type="text" id="phoneNumber" name="phoneNumber" class="form-control">
                                   <span class="error text-danger" id="phoneNumberError"></span>
                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                   <input type="submit" id="submit" class="btn btn-success" name="add_students" value="Add">
                               </div>

                           </form>

                       </div>
                   </div>
               </div>
           </div>

       </div>


       <!-- Delete Confirmation Modal -->
       <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="deleteConfirmLabel">Confirm Deletion</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       Are you sure you want to delete this item?
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="rejectDeleteBtn">No</button>
                       <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
                   </div>
               </div>
           </div>
       </div>
       <!-- //delete student record logic    -->
       <script>
           let deleteId = null;

           function confirmDelete(id) {
               deleteId = id;
               var deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
               console.log("Delete button clicked, ID:", deleteId);
               deleteConfirmModal.show();
           }

           document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
               if (deleteId !== null) {
                   window.location.href = 'delete_link.php?id=' + deleteId;
               }
           });
           document.getElementById('rejectDeleteBtn').addEventListener('click', function() {
               window.location.href = './index.php';
           });
       </script>





       <!-- <script src="./try_back.js"></script> -->
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
                   document.getElementById('firstNameError').innerHTML = 'First name must be at least 2 characters long.';
                   return false;
               }  else {
                   document.getElementById('firstNameError').innerHTML = '';
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
               } else {
                   document.getElementById('lastNameError').innerHTML = '';

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
               } else {
                   document.getElementById('ageError').innerHTML = '';

               }

               // Phone Number Validation
               //const phoneNumber = document.getElementById('phoneNumber').value;
               const phoneNumberError = document.getElementById('phoneNumberError');
               const phoneNumberPattern = /^[0-9]{10}$/;
               if (!phoneNumberPattern.test(phoneNumber)) {
                   phoneNumberError.textContent = 'Phone number must be a 10-digit number.';
                   return false;
               } else {
                   document.getElementById('phoneNumberError').innerHTML = '';

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
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
       
   </body>

   </html>