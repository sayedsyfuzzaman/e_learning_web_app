
//Regestration validation
function validate_name() {
    let name = document.forms["regForm"]["name"].value;
    let error;
    if (name == "") {
        error = "Name is required.";
        document.getElementById("name-error").innerHTML = error;
        document.getElementById('name').className = "form-control form-control-lg is-invalid";
        return false;
    } else if (/[A-Za-z]/.test(name[0]) == false) {
        error = "The name must have start with litter.";
        document.getElementById("name-error").innerHTML = error;
        document.getElementById('name').className = "form-control form-control-lg is-invalid";
        return false;
    } else if (name.match(/(\w+)/g).length < 2) {
        error = "The name must have at least two word.";
        document.getElementById("name-error").innerHTML = error;
        document.getElementById('name').className = "form-control form-control-lg is-invalid";
        return false;
    } else if (/^[A-Za-z\s._-]+$/.test(name) == false) {
        error = "Name can contain letter,desh,dot and space.";
        document.getElementById("name-error").innerHTML = error;
        document.getElementById('name').className = "form-control form-control-lg is-invalid";
        return false;
    } else {
        error = "";
        document.getElementById("name-error").innerHTML = error;
        document.getElementById('name').className = "form-control form-control-lg";
        return true;
    }
}

function uniqueEmailCheck(email) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        is_found = this.responseText;
        if (is_found == "found") {
            error = "Email alrady exiest.";
            document.getElementById("email-error").innerHTML = error;
            document.getElementById('email').className = "form-control form-control-lg is-invalid";
        }
        else {
            error = "";
            document.getElementById("email-error").innerHTML = error;
            document.getElementById('email').className = "form-control form-control-lg";
        }
    }
    xhttp.open("GET", "Controller/validEmailCheckController.php?email=" + email);
    xhttp.send();

}

function validateemail() {
    let email = document.forms["regForm"]["email"].value;
    let error;
    if (email == "") {
        error = "Email is required.";
        document.getElementById("email-error").innerHTML = error;
        document.getElementById('email').className = "form-control form-control-lg is-invalid";
        return false;
    } else if (/^[a-zA-Z0-9.!#$%&'*+/=?^`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/.test(email) == false) {
        error = "Invalid email format.";
        document.getElementById("email-error").innerHTML = error;
        document.getElementById('email').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else if (email != "") {
        this.uniqueEmailCheck(email);
        if(document.getElementById("email-error").innerHTML==""){
            return true;
        }
        else if(document.getElementById("email-error").innerHTML!=""){
            return false;
        }
    }
    else {
        error = "";
        document.getElementById("email-error").innerHTML = error;
        document.getElementById('email').className = "form-control form-control-lg";
        return true;
    }
}

function validatepassword() {
    let password = document.forms["regForm"]["password"].value;
    let error;
    if (password == "") {
        error = "Password is required.";
        document.getElementById("password-error").innerHTML = error;
        document.getElementById('password').className = "form-control form-control-lg is-invalid";
        return false;
    } else if (password.length < 9) {
        error = "Password must contain at least 8 character.";
        document.getElementById("password-error").innerHTML = error;
        document.getElementById('password').className = "form-control form-control-lg is-invalid";
        return false;
    } else if (/[#$%@]/.test(password) == false) {
        error = "Password have to contain at least one '#' or '$' or '%' or '@'.";
        document.getElementById("password-error").innerHTML = error;
        document.getElementById('password').className = "form-control form-control-lg is-invalid";
        return false;
    } else {
        error = "";
        document.getElementById("password-error").innerHTML = error;
        document.getElementById('password').className = "form-control form-control-lg";
        return true;
    }
}

function validateconfirm_password() {
    let confirm_password = document.forms["regForm"]["confirm_password"].value;
    let password = document.forms["regForm"]["password"].value;
    let error;
    if (confirm_password == "") {
        error = "Confirm password is required.";
        document.getElementById("confirm_password-error").innerHTML = error;
        document.getElementById('confirm_password').className = "form-control form-control-lg is-invalid";
        return false;
    } else if (password != confirm_password) {
        error = "Password are not matched.";
        document.getElementById("confirm_password-error").innerHTML = error;
        document.getElementById('confirm_password').className = "form-control form-control-lg is-invalid";
        return false;
    } else {
        error = "";
        document.getElementById("confirm_password-error").innerHTML = error;
        document.getElementById('confirm_password').className = "form-control form-control-lg";
        return true;
    }
}

function validategender() {
    let gender = document.forms["regForm"]["gender"].value;
    let error;
    if (gender == "") {
        error = "Gender is required.";
        document.getElementById("gender-error").innerHTML = error;
        document.getElementById('gender').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else if(gender!="male" && gender!="female" && gender!="orther"){
        error = "Gender is not valid.";
        document.getElementById("gender-error").innerHTML = error;
        document.getElementById('gender').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else {
        error = "";
        document.getElementById("gender-error").innerHTML = error;
        document.getElementById('gender').className = "form-control form-control-lg";
        return true;
    }
}

function validatehighest_degree() {
    let highest_degree = document.forms["regForm"]["highest_degree"].value;
    let error;
    if (highest_degree == "") {
        error = "Degree is required.";
        document.getElementById("highest_degree-error").innerHTML = error;
        document.getElementById('highest_degree').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else if(highest_degree!="ssc" && highest_degree!="hsc" && highest_degree!="graduate" && highest_degree!="postgraduate"){
        error = "Degree is not valid.";
        document.getElementById("highest_degree-error").innerHTML = error;
        document.getElementById('highest_degree').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else{
        error = "";
        document.getElementById("highest_degree-error").innerHTML = error;
        document.getElementById('highest_degree').className = "form-control form-control-lg";
        return true;
    }
}

function validatedob() {
    let dob = document.forms["regForm"]["dob"].value;
    let error;
    if (dob == "") {
        error = "Date of Birth is required.";
        document.getElementById("dob-error").innerHTML = error;
        document.getElementById('dob').className = "form-control form-control-lg is-invalid";
        return false;
    } else {
        error = "";
        document.getElementById("dob-error").innerHTML = error;
        document.getElementById('dob').className = "form-control form-control-lg";
        return true;
    }
}


function validate_reg_form() {
    let correctName = validate_name();
    let correctEmail = validateemail();
    let correctGender = validategender();
    let correctDegree = validatehighest_degree();
    let correctDob = validatedob();
    let correctPassword = validatepassword();
    let correctConfirm_password = validateconfirm_password();
    if (correctName && correctGender && correctEmail && correctDegree && correctDob && correctPassword && correctConfirm_password) {
        return true;
    } else {
        return false;
    }
}

//Login validation

function validateusername(){
    let id = document.forms["loginForm"]["username"].value;
    let error;

    if(id==""){
        error = "Id is required.";
        document.getElementById("username-error").innerHTML = error;
        document.getElementById('username').className = "form-control form-control-lg is-invalid";
        return false;

    }
    else if(id.length!=11){
        error = "ID must have 11 character.";
        document.getElementById("username-error").innerHTML = error;
        document.getElementById('username').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else if(/^[0-9-]+$/.test(id)== false){
        error = "ID can contain letter, hyphens(-).";
        document.getElementById("username-error").innerHTML = error;
        document.getElementById('username').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else if(id!=""){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            if(this.responseText=="false"){
                error = "ID not matched.";
                document.getElementById("username-error").innerHTML = error;
                document.getElementById('username').className = "form-control form-control-lg is-invalid";
                return false;
            }
            else if(this.responseText=="true"){
                error = "";
                document.getElementById("username-error").innerHTML = error;
                document.getElementById('username').className = "form-control form-control-lg";
                return true;
            }
        }
        xhttp.open("GET", "Controller/validUsernameCheckController.php?username=" + id);
        xhttp.send();
    }
}

function validateLoginpassword(){
    let password = document.forms["loginForm"]["password"].value;
    let id = document.forms["loginForm"]["username"].value;
    let error;
    

    if(id==""){
        error = "Fill id first.";
        document.getElementById("password-error").innerHTML = error;
        document.getElementById('password').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else if(password==""){
        error = "Password is required.";
        document.getElementById("password-error").innerHTML = error;
        document.getElementById('password').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else if(password.length<9){
        error = "Password must contain at least 8 character.";
        document.getElementById("password-error").innerHTML = error;
        document.getElementById('password').className = "form-control form-control-lg is-invalid";
        return false;
    }
    else if (/[#$%@]/.test(password) == false) {
        error = "Password have to contain at least one '#' or '$' or '%' or '@'.";
        document.getElementById("password-error").innerHTML = error;
        document.getElementById('password').className = "form-control form-control-lg is-invalid";
        return false;
    } 
    else if(password!="" && id!="") {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            if(this.responseText=="false"){
                error = "Password not matched.";
                document.getElementById("password-error").innerHTML = error;
                document.getElementById('password').className = "form-control form-control-lg is-invalid";
                return false;
            }
            else if(this.responseText=="true"){
                error = "";
                document.getElementById("password-error").innerHTML = error;
                document.getElementById('password').className = "form-control form-control-lg";
                return true;
            }
        }
        xhttp.open("GET", "Controller/validPasswordCheckController.php?username=" + id + "&password=" + password);
        xhttp.send();
    }
}


function validate_login_form(){
    let correctID = validateusername();
    let correctPassword = validateLoginpassword();
    console.log(correctPassword);

    if(correctID!=false && correctPassword!=false){
        return true;
    }
    else{
        return false;
    }
}