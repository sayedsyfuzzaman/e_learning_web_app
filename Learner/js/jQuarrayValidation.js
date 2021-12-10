$(function() {
    $("#name-error").hide();
    $("#email-error").hide();
    $("#highest_degree-error").hide();
    $("#dob-error").hide();
    $("#gender-error").hide();
    $("#picture-error").hide();

    var name_error = false;
    var email_error = false;
    var highest_degree_error = false;
    var dob_error = false;
    var gender_error = false;
    var picture_error = false;

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
        console.log("Called");
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


    function validatePicture() {
        var img = document.getElementById("fileToUpload");
        var valid_ext = ["jpeg", "jpg", "png"];

        if (img.value == "") {
            $("#picture-error").html("Please Select an Image First.");
            $("#picture-error").show();
            picture_error = true;
            document.forms["primaryForm"]["fileToUpload"].value = '';
        } else {
            valid_ext = ["jpg","png","jpeg","JPG"]
            var image_ext = img.value.substring(img.value.lastIndexOf('.') + 1);
            var result = valid_ext.includes(image_ext);
            if (result == false) {
                $("#picture-error").html("Only JPEG, PNG and JPG is allowed.");
                $("#picture-error").show();
                picture_error = true;
                document.forms["primaryForm"]["fileToUpload"].value = '';

            } else if (parseFloat(img.files[0].size / (1024 * 1024)) >= 50) {
                $("#picture-error").html("Maximum File Size is 50 MB.");
                $("#picture-error").show();
                picture_error = true;
                document.forms["primaryForm"]["fileToUpload"].value = '';
            } else {
                $("#picture-error").hide();
                if (img.files && img.files[0]) {
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $('#picture')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(img.files[0]);
                }

                picture_error = false;
            }

        }

    }

    $("#regForm").submit(function() {
        if (name_error === false && email_error === false && highest_degree_error === false && dob_error === false && gender_error === false) {
            return true;
        } else {
            return false;
        }
    });
});