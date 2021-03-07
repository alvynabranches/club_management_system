<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>customer_ui</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.2/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top navigation-clean-button" style="height: 80px;background-color: transparent;color: #000000;">
        <div class="container-fluid"><a class="navbar-brand" href="#"><?php require_once('../config.php'); echo $company_name; ?></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" style="color: #000000;font-weight: bold;" href="index.php"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: #000000;font-weight: bold;" href="events.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link active" style="color: #000000;font-weight: bold;" href="contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: #000000;font-weight: bold;" href="signin.php">Sign In</a></li>
                    <li class="nav-item"><a class="nav-link" href="signup.php" style="color: #000000;font-weight: bold;">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div data-bs-parallax-bg="true" class="form-div" style="height:100%;background-image:url(https://unsplash.it/1800/900?image=1051);background-position:center;background-size:cover;">
        <div class="form-div container">
            <article>
                <p style="color: rgb(0,0,0);text-align: center;font-size: 40px;">Contact Us</p>
            </article>
            <form>
                <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name"></div>
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                <div class="form-group"><input class="form-control" type="tel" name="phone" placeholder="Phone"></div>
                <div class="form-group"><input class="form-control" type="text" name="subject" placeholder="Subject"></div>
                <div class="form-group"><textarea class="form-control" name="message" placeholder="Message"></textarea></div>
                <div class="btn-group d-xl-flex justify-content-xl-center align-items-xl-center" role="group"><button class="btn btn-secondary btn-rounded" type="submit">Submit</button><button class="btn btn-light btn-rounded" type="reset">Clear</button></div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
</body>

</html>