<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Activity Log</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <style>
        hr {
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
</head>

<?php
session_start();
if (!isset($_SESSION['id'])) {
    session_destroy();
    header("location:../sign-in.php");
}
?>

<body>
    <div class="wrapper">
        <?php
        include 'sidebar.php';
        ?>
        <div class="main">
            <?php
            include 'navbar.php';
            ?>
            <main class="content">
                <div class="container-fluid">
                    <div class="header">
                        <h1 class="header-title">
                        My Activity
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Activity</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">My Activity</h5>
									<h6 class="card-subtitle text-muted">If you are using from mobile, click on a particular image to see more.</h6>
								</div>
								<div class="card-body">
									<table id="datatable" class="table table-striped" style="width:100%">
										<thead>
											<td>Title</td>
											<td>Details</td>
											<td>Date</td>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
                </div>
            </main>

            <?php
            include 'footer.php';
            ?>

        </div>

    </div>

    <script src="../js/app.js"></script>

    <script type="text/javascript">
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
        //notification
        var id = getUrlParameter('id');
        $('#datatable').DataTable({
            ajax: {
                url: 'model/getIndividualActivitylog.php',
                method: 'POST',
                data: {
                    id: id
                },
                dataSrc: ''
            },
            columns: [{
                    data: "title"
                },
                {
                    data: "details"
                },
                {
                    data: "date"
                }
            ],
            responsive: true
        });
    </script>


</body>

</html>