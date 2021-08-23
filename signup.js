var surname = document.querySelector("#surname");
var phone = document.querySelector("#phone");
var country = document.querySelector("#country");
var city = document.querySelector("#city");
var othernames = document.querySelector("#othernames");
var gender = document.querySelector("#gender");
var state = document.querySelector("#Nigeria");
var address = document.querySelector("#address");
var email = document.querySelector("#email");
var password = document.querySelector("#password");
var confirm = document.querySelector("#confirm");
var submit = document.querySelector("#submit");


// console.log(phone.id)

const setError = (param, message) => {
    let input = document.getElementById(param+"_error");
    input.innerHTML = message;
}

const clearError = (param, message) => {
    let input = document.getElementById(param+"_error");
    input.innerHTML = "";
}

// setError('surname', 'surname is required')


surname.addEventListener('keyup', (event) => {
    //Getting Input
    let val = surname.value;

    if(val.length < 3) {
        submit.setAttribute('disabled', 'disabled');
        surname.className = "form-control is-invalid";
        setError(surname.id, 'Surname is required')
    }
    else{
        submit.removeAttribute('disabled');
        surname.className = "form-control is-valid";
        clearError(surname.id)
    }
});

othernames.addEventListener('keyup', (event) => {
    //Getting Input
    let val = othernames.value;

    if(val.length < 3) {
        submit.setAttribute('disabled', 'disabled');
        othernames.className = "form-control is-invalid";
        setError(othernames.id, 'othernames are required')
    }
    else{
        submit.removeAttribute('disabled');
        othernames.className = "form-control is-valid";
        clearError(othernames.id)
    }
});

phone.addEventListener('keyup', (event) => {
    //Getting Input
    let val = phone.value;

    if(val.length < 11) {
        submit.setAttribute('disabled', 'disabled');
        phone.className = "form-control is-invalid";
        setError(phone.id, 'Phone number is too short')
    }
    else{
        submit.removeAttribute('disabled');
        phone.className = "form-control is-valid";
        clearError(phone.id)
    }
});

gender.addEventListener('change', () => {
    //Getting Input
    let val = gender.value;

    if(val.length < 4) {
        submit.setAttribute('disabled', 'disabled');
        gender.className = "form-control is-invalid";
        setError(gender.id, )
    }
    else{
        submit.removeAttribute('disabled');
        gender.className = "form-control is-valid";
        clearError(gender.id)
    }
});




email.addEventListener('keyup', () => {
    //Getting Input
    let val = email.value;
    var search = val.search("@")

    if(search < 3) {
        submit.setAttribute('disabled', 'disabled');
        email.className = "form-control is-invalid";
        setError(email.id, "Enter a valid email")
    }
    else{
        submit.removeAttribute('disabled');
        email.className = "form-control is-valid";
        clearError(email.id)
    }
});

password.addEventListener('keyup', () => {
    //Getting Input
    let val = password.value;
    console.log(val);

    if(val.length < 6) {
        submit.setAttribute('disabled', 'disabled');
        password.className = "form-control is-invalid";
        setError(password.id, "password is too short")
    }
    else{
        submit.removeAttribute('disabled');
        password.className = "form-control is-valid";
        clearError(password.id)
    }

    if(confirm.value !== '') {
        if(val !== confirm.value) {
            submit.setAttribute('disabled', 'disabled');
            confirm.className = "form-control is-invalid";
            setError(confirm.id, "password does not match")
        }
        else{
            submit.removeAttribute('disabled');
            confirm.className = "form-control is-valid";
            clearError(confirm.id)
        }
    }
});

confirm.addEventListener('keyup', () => {
    //Getting Input
    let pass = password.value; let pass2 = confirm.value;
    if(pass !== pass2) {
        submit.setAttribute('disabled', 'disabled');
        confirm.className = "form-control is-invalid";
        setError(confirm.id, "password does not match")
    }
    else{
        submit.removeAttribute('disabled');
        confirm.className = "form-control is-valid";
        clearError(confirm.id)
    }
});


