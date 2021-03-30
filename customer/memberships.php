<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.0/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top navigation-clean-button" style="height: 80px;background-color: transparent;color: #000000;">
        <div class="container"><a class="navbar-brand" href=""><?php require_once('../config.php'); echo $company_name; redirect('./index.php', '', '../admin/index.php', '../trainer/index.php'); ?></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" style="color: #000000;font-weight: bold;" href="index.php"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: #000000;font-weight: bold;" href="events.php">Events</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: #000000;font-weight: bold;" href="contact.php">Contact Us</a></li>
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link btn btn-rounded" aria-expanded="false" data-toggle="dropdown" href="#" style="color: black;font-weight: bold;">Username</a>
                            <div class="dropdown-menu"><a class="dropdown-item" href="user.php">Profile</a><a class="dropdown-item" href="">Settings</a><a class="dropdown-item" href="membership.php?action=logout">Logout<?php require_once('../config.php'); logout(); ?></a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div data-bss-parallax-bg="true" style="height: 85%;background-image: url(https://unsplash.it/1800/900?image=1051);background-position: center;background-size: cover;color: rgb(46,112,160);">
        <div class="sidebar" style="/*padding-top: 20vh;*/">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xl-2 side-col" style="border-width: 2px;border-color: black;border-style: solid;position: relative;max-height: 485px;/*scroll-behavior: smooth;*/overflow-x: hidden;overflow-y: hidden;"><a href="memberships.php">Memberships</a><a href="attendance.php">Attendance</a><a href="history.php">History</a><a href="achievements.php">Achievements</a><a href="wallet.php">My Wallet</a></div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xl-10 side-content" style="max-height: 485px;overflow-y: scroll;-ms-overflow-style: none;scrollbar-width: none;">
                        <div><strong style="display: inline-block;">Membership Type:&nbsp;&nbsp;<br></strong>
                            <p id="customer_membership_type" style="display: inline;"><strong><?php require_once('../config.php'); echo $_SESSION['customer_membership_type']; ?></strong><br></p>
                        </div>
                        <article class="cur-services"><strong>My Services:&nbsp;<br></strong>
                            <p id="customer_services">Paragraph</p>
                            <?php
                                    include_once('../config.php');
                                    $data = get_customer_services($_SESSION['id']);
                                    if(count($data['service_name']) >= 1) {
                                        echo "<table>";
                                            echo "<tr><th class='data0'>Service Name</th><th class='data1'>Valid Till</th></tr>";
                                            foreach($data['service_name'] as $i => $sn) {
                                                $idt = $data['expiry_date'][$i];
                                                echo "<tr><td class='data0'>$sn</td><td class='data1'>$idt</td></tr>";
                                            }
                                        echo "</table>";
                                    }
                                    else {
                                        echo "No Data Found!";
                                    }
                                ?>
                        </article>
                        <div>
                            <form>
                                <div class="form-group"><select class="form-control" id="services">
                                        <option value="" selected="">Services</option>
                                            
                                    </select></div>
                                <div class="form-group"><input class="form-control" type="text"></div>
                                <div class="btn-group d-lg-flex justify-content-lg-center align-items-lg-center btn-rounded" role="group"><button class="btn btn-secondary" type="submit">Add</button><button class="btn btn-light" type="reset">Clear</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer style="background-color: transparent;">
        <div class="container">
            <div class="row" style="background-color: inherit;">
                <div class="col-md-6 col-lg-8 mx-auto" style="background-color: initial;">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item"><a href="#"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
                        <li class="list-inline-item"><a href="#"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
                        <li class="list-inline-item"><a href="#"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x fa-inverse"></i></span></a></li>
                        <li class="list-inline-item"><a href="#"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-stack-1x fa-inverse"></i></span></a></li>
                    </ul><p class="copyright text-muted text-center">Copyright &copy; Your Company 2018 | Web Design by Designer</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
    <?php
                                            include_once('../config.php');
                                            memberships_php();
                                        ?>
</body>

</html>