$(function() {
    $("#name-error").hide();
    $("#email-error").hide();
    $("#highest_degree-error").hide();
    $("#dob-error").hide();
    $("#gender-error").hide();

    var name_error = false;
    var email_error = false;
    var highest_degree_error = false;
    var dob_error = false;
    var gender_error = false;

    $("#name").keyup(function() {
        validate_name();
    });
    $("#name").blur(function() {
        validate_name();
    });

    $("#email").keyup(function() {
        validateemail();
    });
    $("#email").blur(function() {
        validateemail();
    });

    $("#highest_degree").click(function() {
        validatehighest_degree();
    });


    $("#dob").click(function() {
        validatedob();
    });

    $("#dob").change(function() {
        validatedob();
    });

    $("#gender").click(function() {
        validategender();
    });

    $("#fileToUpload").change(function() {
        validatePicture();
    });
    $("#fileToUpload").click(function() {
        validatePicture();
    });


    function validate_name() {
        let name = document.forms["regForm"]["name"].value;
        if (name == "") {
            $("#name-error").html("Name is required.");
            $("#name-error").show();
            $("#name").addClass("form-control form-control-lg is-invalid");
            name_error = true;
        } else if (/[A-Za-z]/.test(name[0]) == false) {
            $("#name-error").html("The name must have start with litter.");
            $("#name-error").show();
            $("#name").addClass("form-control form-control-lg is-invalid");
            name_error = true;
        } else if (name.match(/(\w+)/g).length < 2) {
            $("#name-error").html("The name must have at least two word.");
            $("#name-error").show();
            $("#name").addClass("form-control form-control-lg is-invalid");
            name_error = true;
        } else if (/^[A-Za-z\s._-]+$/.test(name) == false) {
            $("#name-error").html("Name can contain letter,desh,dot and space.");
            $("#name-error").show();
            $("#name").addClass("form-control form-control-lg is-invalid");
            name_error = true;
        } else {
            $("#name-error").hide();
            $("#name").removeClass("form-control form-control-lg is-invalid");
            $("#name").addClass("form-control form-control-lg");
            name_error = false;
        }
    }

    function validateemail() {
        let id = document.forms["primaryForm"]["username"].value;
        let email = document.forms["regForm"]["email"].value;
        if (email == "") {
            $("#email-error").html("Email is required.");
            $("#email-error").show();
            $("#email").addClass("form-control form-control-lg is-invalid");
            email_error = true;
        } else if (/^[a-zA-Z0-9.!#$%&'*+/=?^`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/.test(email) == false) {
            $("#email-error").html("Invalid email format.");
            $("#email-error").show();
            $("#email").addClass("form-control form-control-lg is-invalid");
            email_error = true;
        }
        else if(email != "") {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                if(this.responseText=="found"){
                    $("#email-error").html("Email alrady exiest.");
                    $("#email-error").show();
                    $("#email").addClass("form-control form-control-lg is-invalid");
                    email_error = true;
                }
                else if(this.responseText=="not_found"){
                    $("#email-error").hide();
                    $("#email").removeClass("form-control form-control-lg is-invalid");
                    $("#email").addClass("form-control form-control-lg");
                    email_error = false;
                }
            }
            xhttp.open("GET", "Controller/validEmailCheckControllerUpdate.php?id=" + id + "&email=" + email);
            xhttp.send();
        } 
    }

    function validategender() {
        let gender = document.forms["regForm"]["gender"].value;
        if (gender == "") {
            $("#gender-error").html("Gender is required.");
            $("#gender-error").show();
            $("#gender").addClass("form-control form-control-lg is-invalid")
            gender_error = true;
        } else if (gender != "male" && gender != "female" && gender != "orther") {
            $("#gender-error").html("Gender is not valid.");
            $("#gender-error").show();
            $("#gender").addClass("form-control form-control-lg is-invalid");
            gender_error = true;
        } else {
            $("#gender-error").hide();
            $("#gender").removeClass("form-control form-control-lg is-invalid");
            $("#gender").addClass("form-control form-control-lg");
            gender_error = false;
        }
    }

    function validatedob() {
        let dob = document.forms["regForm"]["dob"].value;
        if (dob == "") {
            $("#dob-error").html("Date of Birth is required.");
            $("#dob-error").show();
            $("#dob").addClass("form-control form-control-lg is-invalid");
            dob_error = true;
        } else {
            $("#dob-error").hide();
            $("#dob").removeClass("form-control form-control-lg is-invalid");
            $("#dob").addClass("form-control form-control-lg");
            dob_error = false;
        }
    }

    function validatehighest_degree() {
        let highest_degree = document.forms["regForm"]["highest_degree"].value;
        if (highest_degree == "") {
            $("#highest_degree-error").html("Degree is required.");
            $("#highest_degree-error").show();
            $("#highest_degree").addClass("form-control form-control-lg is-invalid");
            highest_degree_error = true;
        } else if (highest_degree != "ssc" && highest_degree != "hsc" && highest_degree != "graduate" && highest_degree != "postgraduate") {
            $("#highest_degree-error").html("Degree is not valid.");
            $("#highest_degree-error").show();
            $("#highest_degree").addClass("form-control form-control-lg is-invalid");
            highest_degree_error = true;
        } else {
            $("#highest_degree-error").hide();
            $("#highest_degree").removeClass("form-control form-control-lg is-invalid");
            $("#highest_degree").addClass("form-control form-control-lg");
            highest_degree_error = false;
        }
    }

    $("#regForm").submit(function() {
        if (name_error === false && email_error === false && highest_degree_error === false && dob_error === false && gender_error === false) {
            return true;
        } else {
            return false;
        }
    });

    $("#curr-pass-error").hide();
    $("#new-pass-error").hide();
    $("#verify-pass-error").hide();
    var error_curr = false;
    var error_new = false;
    var error_verify = false;

    $("#curr-pass").keyup(function() {
        check_curr_pass();
    });
    $("#curr-pass").blur(function() {
        check_curr_pass();
    });


    $("#new-pass").keyup(function() {
        check_new_pass();
    });
    $("#new-pass").blur(function() {
        check_new_pass();
    });

    $("#verify-pass").keyup(function() {
        check_verify_pass();
    });
    $("#verify-pass").blur(function() {
        check_verify_pass();
    });


    function check_curr_pass() {
        let id = document.forms["primaryForm"]["username"].value;
        var pass = $("#curr-pass").val();
        if (pass == "") {
            $("#curr-pass-error").html("This field is required.");
            $("#curr-pass-error").show();
            $("#curr-pass").addClass("form-control form-control-lg is-invalid")
            error_curr = true;
        } else if (pass.length < 8) {
            $("#curr-pass-error").html("Cannot contain less than eight character.");
            $("#curr-pass-error").show();
            $("#curr-pass").addClass("form-control form-control-lg is-invalid")
            error_curr = true;
        } else {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                if(this.responseText=="not_valid"){
                    $("#curr-pass-error").html("Invalid Password.");
                    $("#curr-pass-error").show();
                    $("#curr-pass").addClass("form-control form-control-lg is-invalid");
                    error_curr = true;
                }
                else if(this.responseText=="valid"){
                    $("#curr-pass-error").hide();
                    $("#curr-pass").removeClass("form-control form-control-lg is-invalid");
                    $("#curr-pass").addClass("form-control form-control-lg");
                    error_curr = false;
                }
            }
            xhttp.open("GET", "Controller/validPasswordCheckController.php?id=" + id + "&password=" + pass);
            xhttp.send();
        }
    }

    function check_new_pass() {
        var pass = $("#new-pass").val();
        if (pass == "") {
            $("#new-pass-error").html("This field is required.");
            $("#new-pass-error").show();
            $("#new-pass").addClass("form-control form-control-lg is-invalid")
            error_new = true;
        } else if (pass.length < 8) {
            $("#new-pass-error").html("Cannot contain less than eight character.");
            $("#new-pass-error").show();
            $("#new-pass").addClass("form-control form-control-lg is-invalid")
            error_new = true;
        } else if (/[#$%@]/.test(pass) == false) {
            $("#new-pass-error").html("Password have to contain at least one '#' or '$' or '%' or '@'.");
            $("#new-pass-error").show();
            $("#new-pass").addClass("form-control form-control-lg is-invalid")
            error_new = true;
        } else {
            $("#new-pass-error").hide();
            $("#new-pass").removeClass("form-control form-control-lg is-invalid");
            $("#new-pass").addClass("form-control form-control-lg");
        }
    }

    function check_verify_pass() {
        var pass = $("#new-pass").val();
        var verify_pass = $("#verify-pass").val();
        if (verify_pass == "") {
            $("#verify-pass-error").html("This field is required.");
            $("#verify-pass-error").show();
            $("#verify-pass").addClass("form-control form-control-lg is-invalid")
            error_verify = true;
        } else if (pass != verify_pass) {
            $("#verify-pass-error").html("Password does not matched.");
            $("#verify-pass-error").show();
            $("#verify-pass").addClass("form-control form-control-lg is-invalid")
            error_verify = true;
        } else {
            $("#verify-pass-error").hide();
            $("#verify-pass").removeClass("form-control form-control-lg is-invalid");
            $("#verify-pass").addClass("form-control form-control-lg");
        }
    }

    $("#changePass").submit(function() {
        error_curr = false;
        error_new = false;
        error_verify = false;
        check_curr_pass();
        check_new_pass();
        check_verify_pass();


        if (error_curr === false && error_new == false && error_verify == false) {
            return true;
        } else {
            alert("Please Fill the form Correctly");
            return false;
        }
    });

});