<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="css/modern.css" rel="stylesheet">
    <script src="js/settings.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" />
    <script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark absolute-top w-100 py-2">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="index.php">
                E-Learning Web App
            </a>
            <a class="btn btn-success btn-pill my-2 ml-2" href="sign-in.php">
                Login
            </a>
        </div>
    </nav>

    <section class="pt-0 pb-5 landing-bg text-white overflow-hidden">
        <div class="container py-2">
        </div>
    </section>

    <div class="py-3 bg-white landing-nav">
        <div class="container text-center">
            <a href="index.php" class="btn btn-lg btn-pill btn-link text-dark">Home</a>
            <a href="about_us.php" class="btn btn-lg btn-pill btn-primary">About Us</a>
            <a target="_blank" href="mailto:sayedsyfuzzaman@gmail.com" class="btn btn-lg btn-pill btn-link text-dark">Support</a>
        </div>
    </div>

    <section class="py-6">
        <div class="container">
            <div class="mb-4 text-center">
                <h2>About Us</h2>
            </div>

            <div class="row pb-3">
                <div class="col-md-6 col-lg-4 text-center">
                </div>
                <div class="col-md-6 col-lg-4 text-center">
                    <a class="mb-3 card overflow-hidden" href="#">
                        <div class="px-2 pt-2">
                            <img id="supervisor_image" src="" height="250px" weight="350px" class="img-fluid card-img-hover landing-img" alt="Machine Learning" />
                        </div>
                        <h5 class="pt-2">Supervisor</h5>
                        <h4 id="supervisor_name" class="pt-2"></h4>
                        <h5 id="developer_details" class="pt-2"></h5>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 text-center">
                </div>
                

                <div class="col-md-6 col-lg-3 text-center">
                    <a class="mb-3 card overflow-hidden" href="#">
                        <div class="px-2 pt-2">
                            <img id="developer_1_image" src="" height="250px" weight="350px" class="img-fluid card-img-hover landing-img" alt="Machine Learning" />
                        </div>
                        <h5 class="pt-2">Developer</h5>
                        <h4 id="developer_1_name" class="pt-2"></h4>
                        <h5 id="developer_1_email" class="pt-2"></h5>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3 text-center">
                    <a class="mb-3 card overflow-hidden" href="#">
                        <div class="px-2 pt-2">
                            <img id="developer_2_image" src="" height="250px" weight="350px" class="img-fluid card-img-hover landing-img" alt="Machine Learning" />
                        </div>
                        <h5 class="pt-2">Developer</h5>
                        <h4 id="developer_2_name" class="pt-2"></h4>
                        <h5 id="developer_2_email" class="pt-2"></h5>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3 text-center">
                    <a class="mb-3 card overflow-hidden" href="#">
                        <div class="px-2 pt-2">
                            <img id="developer_3_image" src="" height="250px" weight="350px" class="img-fluid card-img-hover landing-img" alt="Machine Learning" />
                        </div>
                        <h5 class="pt-2">Developer</h5>
                        <h4 id="developer_3_name" class="pt-2"></h4>
                        <h5 id="developer_3_email" class="pt-2"></h5>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3 text-center">
                    <a class="mb-3 card overflow-hidden" href="#">
                        <div class="px-2 pt-2">
                            <img id="developer_4_image" src="" height="250px" weight="350px" class="img-fluid card-img-hover landing-img" alt="Machine Learning" />
                        </div>
                        <h5 class="pt-2">Developer</h5>
                        <h4 id="developer_4_name" class="pt-2"></h4>
                        <h5 id="developer_4_email" class="pt-2"></h5>
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    $(function() {
        let url = "About_us/data.json";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let developer_data = JSON.parse(this.responseText);
                let count = 1;
                developer_data.forEach(function(row) {
                    if (count == 1) {
                        $("#developer_1_image").attr("src", row["picture"]);
                        $("#developer_1_name").html(row["name"]);
                        $("#developer_1_email").html("Email: " + row["email"]);
                    } else if (count == 2) {
                        $("#developer_2_image").attr("src", row["picture"]);
                        $("#developer_2_name").html(row["name"]);
                        $("#developer_2_email").html("Email: " + row["email"]);
                    }
                    if (count == 3) {
                        $("#developer_3_image").attr("src", row["picture"]);
                        $("#developer_3_name").html(row["name"]);
                        $("#developer_3_email").html("Email: " + row["email"]);
                    }
                    if (count == 4) {
                        $("#developer_4_image").attr("src", row["picture"]);
                        $("#developer_4_name").html(row["name"]);
                        $("#developer_4_email").html("Email: " + row["email"]);
                    }

                    count++;
                })
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();

        url = "About_us/supervisor_data.json";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let supervisor_data = JSON.parse(this.responseText);
                supervisor_data.forEach(function(row) {
                    $("#supervisor_image").attr("src", row["picture"]);
                    $("#supervisor_name").html(row["name"]);
                    $("#developer_details").html(row["post"] + "<br>"+row["university"]+"<br>"+ "Email: " + row["email"]);

                })
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();

    });
</script>

</html>