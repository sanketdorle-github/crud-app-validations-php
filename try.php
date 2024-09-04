<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
</head>
<body>
    <form id="userForm" action="back.php" method="post" onsubmit="return validateForm()">
    <form id="myForm">
        
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName">
    <div id="firstNameError" class="error"></div>
    
    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName">
    <div id="lastNameError" class="error"></div>
    
    <label for="age">Age:</label>
    <input type="number" id="age" name="age">
    <div id="ageError" class="error"></div>
    
    <label for="phoneNumber">Phone Number:</label>
    <input type="text" id="phoneNumber" name="phoneNumber">
    <div id="phoneNumberError" class="error"></div>
        <button type="submit">Submit</button>
    </form>

    <script src="try_back.js"></script>
</body>
</html>
