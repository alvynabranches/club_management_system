<?php
    define('DEBUG',TRUE);
    error_reporting(0);
    date_default_timezone_set('Asia/Kolkata');
    session_start();
    $company_name='Club Management System';
    $company_address='';
    $company_phone=array('+91 98765 43210','+91 99887 76655');
    $company_email=array('companyname@gmail.com','companyname@outlook.com');
    function console_log($m){echo "<script>console.log('$m')</script>";}
    function console_warn($m){echo "<script>console.warn('$m')</script>";}
    function console_error($m){echo "<script>console.error('$m')</script>";}
    function console_info($m){echo "<script>console.info('$m')</script>";}
    function alert($m){echo "<script>alert('$m');</script>";}
    function set_company_name($company_name){echo "<script>document.getElementById('company_name').innerHTML='$company_name'</script>";}
    function redirect(string $redirect_non_signed_in_page,string $redirect_customer_page,string $redirect_admin_page,string $redirect_trainer_page){if(!isset($_COOKIE['PHPSESSID'])){session_start();}if($_SESSION==null){header("Location: $redirect_non_signed_in_page");}else{if($_SESSION['user_type']=='customer'){header("Location: $redirect_customer_page");}else if($_SESSION['user_type']=='admin'){header("Location: $redirect_admin_page");}else if($_SESSION['user_type']=='trainer'){header("Location: $redirect_trainer_page");}else{session_unset();header("Location: $redirect_index_page");}}}
    function exec_query(string $sql,string $host='localhost',string $username='root',string $password='',string $db='club_management_system'){$con=new mysqli($host,$username,$password,$db);$result=mysqli_query($con,$sql);$con->close();return $result;}
    
    // Customer
    function customer_signin(){if(isset($_POST['username'])&&isset($_POST['password'])){if(!isset($_COOKIE['PHPSESSID'])){session_start();}$user=$_POST['username'];$pwd = $_POST['password'];$result=exec_query("SELECT customer_id AS cid, customer_address AS ca, username AS un, customer_phone_no AS cpn, membership_id AS mid, customer_email AS ce, customer_name AS cn, password AS pd FROM customer WHERE username='$user';");if($result->num_rows==1){while($row=mysqli_fetch_assoc($result)){$cid=$row['cid'];$cn=$row['cn'];$pd=$row['pd'];$cpn=$row['cpn'];$ce=$row['ce'];$ca=$row['ca'];$un=$row['un'];if(DEBUG){console_info('Username Found!');}if(password_verify($pwd, $pd)){$_SESSION['id']=$cid;$_SESSION['name']=$cn;$_SESSION['username']=$user;$_SESSION['customer_phone_no']=$cpn;$_SESSION['customer_address']=$ca;$_SESSION['customer_email']=$ce;$_SESSION['username']=$un;$_SESSION['membership_id']=$row['mid'];$_SESSION['user_type']='customer';if(DEBUG){console_log('Logged In Successfully!');}redirect('./index.php', './user.php', '../admin/index.php', '../trainer/index.php');}else{if(DEBUG){console_warn('Password Incorrect!');}alert('Password Incorrect!');}}}else{if(DEBUG){console_warn('User Not Found!');}}}else{if(DEBUG){console_error("Form Empty!");}}}
    function customer_signup() {if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['name'])&&isset($_POST['phone'])&&isset($_POST['address'])&&isset($_POST['email'])){if(!isset($_COOKIE['PHPSESSID'])){session_start();}$username=$_POST['username'];$password=password_hash($_POST['password'],PASSWORD_DEFAULT);$customer_name=$_POST['name'];$customer_address=$_POST['address'];$customer_email=$_POST['email'];$customer_phone=$_POST['phone'];console_info("Signup Successful");if(exec_query("INSERT INTO customer (customer_name, customer_address, customer_phone_no, customer_email, username, password) VALUES ('$customer_name', '$customer_address', '$customer_phone', '$customer_email', '$username', '$password')")===TRUE){if(DEBUG){console_info('Sign Up Successful');}$result=exec_query("SELECT customer_id AS cid, username AS un, customer_address AS ca, customer_phone_no AS cpn, membership_id AS mid, customer_email AS ce, customer_name AS cn, password AS pd FROM customer WHERE username='$username';");if($result->num_rows==1){while($row=mysqli_fetch_assoc($result)){$_SESSION['id']=$row['cid'];$_SESSION['name']=$row['cn'];$_SESSION['customer_phone_no']=$row['cpn'];$_SESSION['customer_email']=$row['ce'];$_SESSION['customer_address']=$row['ca'];$_SESSION['username']=$row['un'];$_SESSION['membership_id']=$row['mid'];}}$_SESSION['username']=$username;$_SESSION['user_type']='customer';redirect('./index.php','./user.php','../admin/index.php','../trainer/index.php');}else{if(DEBUG){console_info('Sign Up Failed');}alert('Sign Up Failed');}}else{if(DEBUG){console_error("Form Empty!");}}}
    function logout(){if(isset($_GET['action'])){if($_GET['action']=='logout'){if(!isset($_COOKIE['PHPSESSID'])){session_start();}session_unset();if(DEBUG){console_info('Logged Out Successfully!');}redirect('./index.php','','../admin/index.php','../trainer/index.php');}}}
    function get_membership($m_id){$result=exec_query("SELECT membership_type AS mt FROM membership WHERE id=$m_id");if($result->num_rows==1){while($row=mysqli_fetch_assoc($result)){$mt=$row['mt'];}}else{console_error('Not Single Entity in Membership. '.$result->num_rows.'records found.');}return $mt;}
    function get_service_name($s_id){$result=exec_query("SELECT service_name AS sn FROM services WHERE id=$s_id");if($result->num_rows==1){while($row=mysqli_fetch_assoc($result)){$sn=$row['sn'];}}return $sn;}
    function get_customer_services($c_id){$result=exec_query("SELECT sid, expiry_date AS idt FROM customer_services WHERE cid=$c_id");$data=array('service_name'=>array(),'expiry_date'=>array());if($result->num_rows>=1){while($row=mysqli_fetch_assoc($result)){array_push($data['service_name'],get_service_name($row['sid']));array_push($data['expiry_date'],$row['idt']);}if(count($data['service_name'])!=count($data['expiry_date'])){console_error("Inconsistency in data!");}return $data;}else{if(DEBUG){console_log('No data found.');}}return $data;}
    function get_wallet_balance($c_id){$result=exec_query("SELECT wallet FROM customer WHERE customer_id=$c_id;");if($result->num_rows==1){while($row=mysqli_fetch_assoc($result)){$w=$row['wallet'];}}return $w;}
    
    function set_wallet_balance($c_id,$bal){
        $w=get_wallet_balance($c_id);
        if($w>=$bal){
            $rem=$w-$bal;
            if(exec_query("UPDATE customer SET wallet=$rem WHERE customer_id=$c_id")===TRUE){
                console_info('Wallet Updated Successfully!');
            }else{console_error('Wallet Not Updated Successfully!');}
        }else{console_error('Balance Insufficient!');}
    }

    function get_all_services(){
        $result=exec_query("SELECT id, service_name AS sn, service_price AS sp FROM services;");
        $data=array('id'=>array(),'sn'=>array(),'sp'=>array());
        if($result->num_rows>=1){
            while($row=mysqli_fetch_assoc($result)){
                array_push($data['id'],$row['id']);
                array_push($data['sn'],$row['sn']);
                array_push($data['sp'],$row['sp']);
            }
        }else{console_error("No Records Found");}
        return $data;
    }

    function memberships_php(){
        $mt = $_SESSION['customer_membership_type'];
        // echo "<script>document.getElementById('customer_membership_type').innerHMTL='<strong>$mt</strong><br />'</script>";
        $data=get_all_services();
        $html = "";
        foreach($data['id'] as $i->$id){
            $sn=$data['sn'][$i];
            $html .= "<option value='$id'>$sn</option>";
        }
        echo "<script>document.getElementById('services').innerHTML=$html;</script>";
    }
    
    // set_company_name($company_name); // All Pages
    // membership_php(); // memberships.php
?>