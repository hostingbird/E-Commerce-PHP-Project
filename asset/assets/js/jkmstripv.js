function signupFormvalid(){
    let form = document.forms["signupForm"] ? document.forms["signupForm"] : document.getElementById("signupForm");
document.addEventListener("DOMContentLoaded", function () {
    let Name = form['name'] ? form['name'] : document.getElementById('signupName');
    let Phone = form['phone'] ? form['phone'] : document.getElementById('signupPhone');
    let Password = form['password'] ? form['password'] : document.getElementById('signupPassword');
    let condition_check = form['signupTandC'] ? form['signupTandC'] : document.getElementById('flexCheckDefault');
    let term_condition = condition_check.checked ? true : false;
    const passwordRequirements = document.getElementById("passwordRequirements");
    const requirements = {
        uppercase: document.getElementById("uppercaseReq"),
        digit: document.getElementById("digitReq"),
        symbol: document.getElementById("symbolReq"),
        repeat: document.getElementById("repeatReq"),
    };


    function sanitizeName(inputElement) {
        let inputValue = inputElement.value.trim();
        const allowedFormat = /^[A-Za-z\s]+$/;

        if (!allowedFormat.test(inputValue)) {
            inputElement.value = '';
        }
        if (inputElement.value.length > 25) {
            inputElement.style.color = "red";
        } else {
            inputElement.style.color = "#212529";
        }
    }
    function sanitizePhone(inputElement) {
        let inputValue = inputElement.value.trim();
        if (inputElement.value.length !== 10) {
            inputElement.style.color = "red";
        }if(isNaN(inputElement.value)){
            inputElement.style.color = "red";
        }
        else {
            inputElement.style.color = "#212529";
        }
        // let phoneValue = inputElement.value;
        // const isValid = /^\d{10}$/.test(phoneValue);

        // if (!isValid && phoneValue.length > 0) {
        //     phoneInput.setCustomValidity('Please enter a valid 10-digit phone number');
        // } else {
        //     phoneInput.setCustomValidity('');
        // }
    }
    function lengthSanitize() {
        if (Name.value.length < 2 || Name.value == "" || Name.value == null) {
            Name.style.color = "red";
            noti("Name Length Error", `Name must greate then length 2`, "danger");
        }
        else if (Phone.value.length !== 10) {
            Phone.style.color = "red";
            noti("Phone Number Error", `Invalid ${Phone.value.length} digit Phone number`, "danger");
        }
        else if (Password.value.length < 8 || Password.value == "" || Password.value == null) {
            Password.style.color = "red";
            noti("Password Length Error", `Invalid Password must Be greater then 8 value`, "danger");
        }
        else if (!condition_check.checked) {
            condition_check.style.border = "0.5px solid red";
            noti("condition Error", `Please check Terms & condition box`, "danger");
        } else if (Name.value.length > 25) {
            Name.style.color = "red";
            noti("Name Length Error", `Max 25 Length of Name shold allowed Need to Remove ${Name.value.length - 25}`, "danger");
        }
        else {
            return true;
        }
    }
    function passwordSanitise(passwordValue) {
        let password = passwordValue.value.trim();
        const uppercaseRegex = /[A-Z]/;
        const digitRegex = /\d/;
        const symbolRegex = /[!@#$%^&*(),.?":{}|<>]/;
        const repeatedDigitRegex = /(\d)\1{2,}/;

        let valid = true;

        if (uppercaseRegex.test(password)) {
            requirements.uppercase.style.color = "green";
        } else {
            requirements.uppercase.style.color = "red";
            valid = false;
        }

        if (digitRegex.test(password)) {
            requirements.digit.style.color = "green";
        } else {
            requirements.digit.style.color = "red";
            valid = false;
        }

        if (symbolRegex.test(password)) {
            requirements.symbol.style.color = "green";
        } else {
            requirements.symbol.style.color = "red";
            valid = false;
        }

        if (!repeatedDigitRegex.test(password)) {
            requirements.repeat.style.color = "green";
        } else {
            requirements.repeat.style.color = "red";
            valid = false;
        }

        return valid;
    }


    Name.addEventListener('keyup', function (event) {
        sanitizeName(event.target);
    });
    Phone.addEventListener('input', function (event) {
        sanitizePhone(event.target);
    });
    Password.addEventListener('input', function (event) {
        event.target.type = "text";
    });
    Password.addEventListener('blur', function (event) {
        event.target.type = "password";
    });
    function showRequirements() {
        const rect = Password.getBoundingClientRect();
        passwordRequirements.style.display = "block";
        passwordRequirements.style.top = rect.bottom > 250 ? 177 : 330 + "px";
        passwordRequirements.style.left = Math.min(rect.left + window.scrollX, window.innerWidth - passwordRequirements.offsetWidth) + "px";
    }

    function hideRequirements() {
        passwordRequirements.style.display = "none";
    }

    Password.addEventListener("focus", showRequirements);
    Password.addEventListener("blur", hideRequirements);
    Password.addEventListener("keyup", (e) => {
        passwordSanitise(e.target);
    });



    form.addEventListener('submit', (e) => {
        e.preventDefault();
        sanitizeName(Name);
        sanitizePhone(Phone);
        let lengthFun = lengthSanitize();
        let passwordValidate = passwordSanitise(Password);
        if (lengthFun === true && passwordValidate === true) {
            form.submit();
            return true;
        } else {
            // form.reset();
            return false;
        }
    })

});
}

function loginFormvalid(){
    let form = document.forms["signupLogin"] ? document.forms["signupLogin"] : document.getElementById("signupLogin");
     document.addEventListener("DOMContentLoaded", function () {
    let Phone = form['phone'] ? form['phone'] : document.getElementById('loginPhone');
    let Password = form['password'] ? form['password'] : document.getElementById('loginPassword');
    let remeber = form['remeber'] ? form['remeber'] : document.getElementById('checkDefault');
    let remeber2 = remeber.checked ? true : false;

    function lengthSanitize() {
        if (Phone.value.length < 0 || Phone.value == "" || Phone.value == null) {
            Phone.style.color = "red";
            noti("Phone Error", `Please Invalid Phone number`, "danger");
        }
        else if (Password.value.length < 0 || Password.value == "" || Password.value == null) {
            Password.style.color = "red";
            noti("Password Error", `Please Enter Your Password`, "danger");
        }
       else {
            return true;
        }
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const lengthFun = lengthSanitize();
        
        if (lengthFun === true) {
            form.submit();
            return true;
        } else {
            return false;
        }
    });
});
}

