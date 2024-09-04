function validateForm() {

    console.log("validatio triggers");
    
    // Get form elements
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const age = document.getElementById('age').value.trim();
    const phoneNumber = document.getElementById('phoneNumber').value.trim();


    const firstNameError = document.getElementById('firstNameError');

    // First Name Validation
   // const firstName = document.getElementById('firstName').value;
    if (firstName.length < 2) {
        firstNameError.textContent = 'First name must be at least 2 characters long.';
        return  false;
    } else {
        firstNameError.textContent = '';
     }

    // Last Name Validation
   // const lastName = document.getElementById('lastName').value;
    const lastNameError = document.getElementById('lastNameError');
    if (lastName.length < 2) {
        lastNameError.textContent = 'Last name must be at least 2 characters long.';
        return  false;
    } else {
        lastNameError.textContent = '';
    }

    // Age Validation
    //const age = document.getElementById('age').value;
    const ageError = document.getElementById('ageError');
    if (age < 1 || age > 120) {
        ageError.textContent = 'Age must be between 1 and 120.';
        return false;
    } else {
        ageError.textContent = '';
    }

    // Phone Number Validation
    //const phoneNumber = document.getElementById('phoneNumber').value;
    const phoneNumberError = document.getElementById('phoneNumberError');
    const phoneNumberPattern = /^[0-9]{10}$/;
    if (!phoneNumberPattern.test(phoneNumber)) {
        phoneNumberError.textContent = 'Phone number must be a 10-digit number.';
       return false;
    } else {
        phoneNumberError.textContent = '';
    }


    // // Basic validation
    // if (!firstName || !lastName || !age || !phoneNumber) {
    //     alert('All fields are required!');
    //     return false; // Prevent form submission
    // }

    // // Validate age (e.g., must be a positive number)
    // if (age <= 0) {
    //     alert('Age must be a positive number!');
    //     return false; // Prevent form submission
    // }

    // // Validate phone number (basic validation)
    // const phonePattern = /^[0-9]{10}$/; // Adjust pattern as needed
    // if (!phonePattern.test(phoneNumber)) {
    //     alert('Invalid phone number format! It should be a 10-digit number.');
    //     return false; // Prevent form submission
    // }

    // If all validations pass, form is submitted
    return true;
}