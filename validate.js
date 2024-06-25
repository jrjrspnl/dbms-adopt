function validateForm() {
    var firstName = document.getElementById('name').value;
    var lastName = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var gender = document.getElementById('gender').value;

    if (firstName === "<?php echo $name; ?>" && 
        lastName === "<?php echo $lastname; ?>" && 
        email === "<?php echo $email; ?>" && 
        gender === "<?php echo $gender; ?>") {
        alert("No changes detected. Please make some changes to update.");
        return false;
    }
    return true;
}