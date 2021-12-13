<!DOCTYPE html>
<html lang="en">

<body>
    <nav id="sidebar" class="sidebar">
        <a class="sidebar-brand" href="dashboard.php">
            Dashboard
        </a>
        <div class="sidebar-content">
            <div class="sidebar-user">
                <img src="<?php echo $_SESSION["image"]; ?>" class="img-fluid rounded-circle mb-2" alt="Image" />
                <div class="font-weight-bold"><?php echo $_SESSION["name"]; ?></div>
                <small><?php echo $_SESSION["usertype"]; ?></small>
            </div>

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#dashboards" data-toggle="collapse" class="sidebar-link">
                        <i class="align-middle mr-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
                    </a>
                    <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-parent="#sidebar">
                        <li class="sidebar-item active"><a class="sidebar-link " href="dashboard.php">Home</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="my-activity.php?id=<?php echo $_SESSION["id"];?>">My Activity</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="view-profile.php">View Profile</a></li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#user" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw ion-ios-person"></i> <span class="align-middle">Users</span>
                    </a>
                    <ul id="user" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                        <li class="sidebar-item "><a class="sidebar-link" href="add-manager.php">Add Manager</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="activity-log.php">Activity Log</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="manager-details.php">Managers Information</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="instructor-details.php">Instructors Information</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="learner-details.php">Learners Information</a></li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#course" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw fa-book"></i> <span class="align-middle">Course</span>
                    </a>
                    <ul id="course" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                        <li class="sidebar-item "><a class="sidebar-link" href="add-course.php">Add Course</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="courses.php">Course List</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>