<?php
    define('DEBUG', TRUE);
    error_reporting(0);
    date_default_timezone_set('Asia/Kolkata');
    session_start();
    $company_name ='Club Management System';
    $company_address = '';
    $company_phone = array('+91 98765 43210', '+91 99887 76655');
    $company_email = array('companyname@gmail.com', 'companyname@outlook.com');
    function console_log($m){echo "<script>console.log('$m')</script>";}
    function console_warn($m){echo "<script>console.warn('$m')</script>";}
    function console_error($m){echo "<script>console.error('$m')</script>";}
    function console_info($m){echo "<script>console.info('$m')</script>";}
    function alert($m){echo "<script>alert('$m');</script>";}
    function redirect(string $redirect_non_signed_in_page, string $redirect_customer_page, string $redirect_admin_page, string $redirect_trainer_page){if(!isset($_COOKIE['PHPSESSID'])){session_start();}if($_SESSION==null){header("Location: $redirect_non_signed_in_page");}else{if($_SESSION['user_type']=='customer'){header("Location: $redirect_customer_page");}else if($_SESSION['user_type']=='admin'){header("Location: $redirect_admin_page");}else if($_SESSION['user_type']=='trainer'){header("Location: $redirect_trainer_page");}else{session_unset();header("Location: $redirect_index_page");}}}
    function exec_query(string $sql, string $host='localhost', string $username='root', string $password='', string $db='club_management_system'){$con=new mysqli($host,$username,$password,$db);$result=mysqli_query($con,$sql);$con->close();return $result;}
    function logout(){if(isset($_GET['action'])){if($_GET['action'] == 'logout'){session_start();session_unset();redirect('./index.php', '', '../admin/index.php', '../trainer/index.php');if(DEBUG){console_info('Logged Out Successfully!');}}}}
    function customer_signin(){
        if(isset($_POST['username']) && isset($_POST['password'])){
            if(!isset($_COOKIE['PHPSESSID'])){session_start();}
            $user=$_POST['username'];
            $pwd = $_POST['password'];
            $result=exec_query("select customer_id as id, customer_address as ca, customer_phone_no as cpn, customer_email as ce, customer_name as cn, password as pd from customer where username='$user';");
            if($result->num_rows==1){
                while($row=mysqli_fetch_assoc($result)){
                    $id=$row['id'];
                    $cn=$row['cn'];
                    $pd=$row['pd'];
                    $cpn=$row['cpn'];
                    $ce=$row['ce'];
                    $ca=$row['ca'];
                    if(DEBUG){console_info('Username Found!');}
                    if(password_verify($pwd, $pd)){
                        $_SESSION['id']=$id;
                        $_SESSION['name']=$cn;
                        $_SESSION['username']=$user;
                        $_SESSION['customer_phone_no']=$cpn;
                        $_SESSION['customer_address']=$ca;
                        $_SESSION['customer_email']=$ce;
                        $_SESSION['user_type']='customer';
                        if(DEBUG){
                            console_info($_SESSION['id']);
                            console_info($_SESSION['name']);
                            console_info($_SESSION['username']);
                        }
                        if(DEBUG){console_log('Logged In Successfully!');}
                        redirect('./index.php', './user.php', '../admin/index.php', '../trainer/index.php');
                    }else{
                        if(DEBUG){console_warn('Password Incorrect!');}
                        alert('Password Incorrect!');
                    }
                }
            } else{
                if(DEBUG){
                    console_warn('User Not Found!');
                }
            }
        }
        else{
            if(DEBUG){
                console_error("Form Empty!");
            }
        }
    }

    function customer_signup() {
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['email'])){
            if(!isset($_COOKIE['PHPSESSID'])){session_start();}
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $customer_name = $_POST['name'];
            $customer_address = $_POST['address'];
            $customer_email = $_POST['email'];
            $customer_phone = $_POST['phone'];
            console_info("Signup Successful");
            if(exec_query("insert into customer (customer_name, customer_address, customer_phone_no, customer_email, username, password) values ('$customer_name', '$company_address', '$customer_phone', '$customer_email', '$username', '$password')")===TRUE){
                if(DEBUG){
                    console_info('Sign Up Successful');
                }
                $result=exec_query("select customer_id as id, customer_address as ca, customer_phone_no as cpn, customer_email as ce, customer_name as cn, password as pd from customer where username='$username';");
                if($result->num_rows==1){
                    while($row=mysqli_fetch_assoc($result)){
                        $_SESSION['id']=$row['id'];
                        $_SESSION['name']=$row['cn'];
                        $_SESSION['customer_phone_no']=$row['cpn'];
                        $_SESSION['customer_email']=$row['ce'];
                        $_SESSION['customer_address']=$row['ca'];
                    }
                }
                $_SESSION['username']=$username;
                $_SESSION['user_type']='customer';
                redirect('./index.php', './user.php', 'admin/index.php', 'trainer/index.php');
            }
            else {
                if(DEBUG){
                    console_info('Sign Up Failed');
                }
                alert('Sign Up Failed');
            }
        } else {
            console_error("Form Empty!");
        }
    }

    function trainer_login() {
        if(isset($_POST['username']) && isset($_POST['password'])){
            if(!isset($_COOKIE['PHPSESSID'])){session_start();}
            // login code
            console_info("Login Successful");
            // redirect code
        } else {
            if(DEBUG){
                console_error("Username and/or Password Not Entered!");
            }
            alert("Username and/or Password Not Entered!");
        }
    }

    function trainer_signin() {
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['trainer_name']) && isset($_POST['trainer_address']) && isset($_POST['trainer_email'])) {
            if(!isset($_COOKIE['PHPSESSID'])){session_start();}
            // login code
            console_info("Signup Successful");
            // redirect code
        } else {
            console_error("Signup Failed");
        }
    }

    function admin_signin() {
        if(isset($_POST['username']) && isset($_POST['password'])){
            if(!isset($_COOKIE['PHPSESSID'])){session_start();}
            // login code
            console_info("Login in Successful");
            // redirect code
        } else {
            console_error("Login in Failed");
        }
    }
    // session_destroy();
    // session_unset();
    // print_r($_SESSION);
?>