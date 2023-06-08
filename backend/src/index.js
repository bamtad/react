function validate(event) {
    event.preventDefault();
    let email = document.getElementById("email");
    let username = document.getElementById("username");
    let pass1 = document.getElementById("pass1");
    let pass2 = document.getElementById("pass2");
    console.log(email)


    if (username.value.trim() == "") {
        alert("Username cannot be empty");
        return false;
    }
    const emailRegex = /^\S+@\S+\.\S+$/;

    if (!emailRegex.test(email.value)) {
        alert("Enter Valid email");
        return false;


    }

    if (pass1.value.length < 6) {
        alert("password too short it should be min 6 character");
        return false;


    }
    if (pass1.value != pass2.value) {
        alert("Confirm password does not match")
        return false;
    }
    event.target.submit()
}
document.getElementById("form1").addEventListener('submit', validate)