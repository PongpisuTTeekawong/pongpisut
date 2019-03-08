<?php session_start(); ?>
<?php
    if ((!empty($_SESSION['login_member'])) OR (!empty($_SESSION['login_admin']))){
header("location:index.php");
exit;
}elseif (!empty($_SESSION['login_personnel'])) {
        header("location:service_pay.php");
exit;
}
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>เข้าสู่ระบบ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.png">

        <!-- App css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/app.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/sweetalert.min.js"></script>

    </head>

    <body class="authentication-bg">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                              <div class="text-center w-75 m-auto">
                                <h2>SURE LINK NETWORK</h2>
                                    <!--a href="index.html">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a-->
                                    <!--p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p-->
                                </div>

                                <form action="" method="post" enctype="multipart/form-data">

                                  <div class="form-group mb-3">
                                    <label for="emailaddress">Username</label>
                                      <input name="username" type="text" required class="form-control" id="username" placeholder="Enter Username">
                                    </div>

                                  <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                      <input name="password" type="password" required class="form-control" id="password" placeholder="Enter password">
                                    </div>

                                    <!--div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div-->

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white">มีปัญหาการใช้งานติดต่อ 081-2878955</p>
                                <p class="text-white">สมัครขอใช้บริการอินเทอร์เน็ต<a href="#" class="text-dark ml-1"><b>ลงทะเบียน</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <!-- App js -->
        <!-- App js -->
        <script src="js/vendor.min.js"></script>
        <script src="js/app.min.js"></script>
        
</body>
</html>
<script type="text/javascript">
    function AlertLoginSucces() {
        swal({
          type: 'success',
          allowOutsideClick: false,
          title: 'เข้าสู่ระบบสำเร็จ',
          text: 'ยินดีต้อนรับสู่ระบบบริหารจัดการข้อมูล',
          showConfirmButton: false,
          timer: 2000,
        }).then((result) => {
          if (
            result.dismiss === swal.DismissReason.timer
          ) {
            location.href = '/surelink/system';
          }
        })
    }
    function AlertLoginSuccesMember() {
        swal({
          type: 'success',
          allowOutsideClick: false,
          title: 'เข้าสู่ระบบสำเร็จ',
          showConfirmButton: false,
          timer: 2000,
        }).then((result) => {
          if (
            result.dismiss === swal.DismissReason.timer
          ) {
            location.href = '/surelink/system';
          }
        })
    }
	function AlertLoginSuccespersonnel() {
        swal({
          type: 'success',
          allowOutsideClick: false,
          title: 'เข้าสู่ระบบสำเร็จ',
		  text: 'ยินดีต้อนรับสู่ระบบหน้าร้าน',
          showConfirmButton: false,
          timer: 2000,
        }).then((result) => {
          if (
            result.dismiss === swal.DismissReason.timer
          ) {
            location.href = '/surelink/system/service_pay.php';
          }
        })
    }

    function AlertLoginFailed() {
        swal({
        title: 'การเข้าสู่ระบบล้มเหลว !',
		text: 'กรุณาตรวจสอบ USERNAME และ PASSWORD อีกครั้ง',
        type: "error",
        
        showConfirmButton: false,
        timer: 3000,
            });
        }
</script>

<?
include "include/connect.php";
$username = $_POST['username'];
$password = $_POST['password'];
$datetime=date('Y-m-d H:i:s');

if(isset($username) and isset($password)){
    $sql = "SELECT * FROM  `sln_member`  WHERE member_username='$username' AND member_password='$password'";
    $rs = mysql_query($sql);
        $num=mysql_num_rows($rs);
    if ($num<=0){   
        echo "<script language=\"JavaScript\">";
        echo "window.onload = AlertLoginFailed();";
        echo "</script>";   
            
    }else{
        $log=mysql_fetch_array($rs);
            if($username!=$log['member_username'] and $password!=$log['member_password']){
            echo "<script language=\"JavaScript\">";
            echo "window.onload = AlertLoginFailed();";
            echo "</script>";
            }else{
                        if($log['member_status']=='1'){
                        $_SESSION['login_member']=$username;
                        $_SESSION['member_id']=$log['member_id'];
						mysql_query("INSERT INTO `sln_userlogs` (`userlog_id` ,`member_id` ,`userlog_datetime` ,`userlog_detail`)VALUES (NULL , '$_SESSION[member_id]', '$datetime', 'เข้าสู่ระบบ')");
                        echo "<script language=\"JavaScript\">";
                        echo "window.onload = AlertLoginSuccesMember();";
                        echo "</script>";
                    
                        }else if($log['member_status']=='2'){
                        $_SESSION['login_personnel']=$username;
                        $_SESSION['member_id']=$log['member_id'];
						mysql_query("INSERT INTO `sln_userlogs` (`userlog_id` ,`member_id` ,`userlog_datetime` ,`userlog_detail`)VALUES (NULL , '$_SESSION[member_id]', '$datetime', 'เข้าสู่ระบบ')");
                        echo "<script language=\"JavaScript\">";
                        echo "window.onload = AlertLoginSuccespersonnel();";
                        echo "</script>";
                        
                        }else if($log['member_status']=='3'){
                        $_SESSION['login_admin']=$username;
                        $_SESSION['member_id']=$log['member_id'];
						mysql_query("INSERT INTO `sln_userlogs` (`userlog_id` ,`member_id` ,`userlog_datetime` ,`userlog_detail`)VALUES (NULL , '$_SESSION[member_id]', '$datetime', 'เข้าสู่ระบบ')");
                        echo "<script language=\"JavaScript\">";
                        echo "window.onload = AlertLoginSucces();";
                        echo "</script>";
                        }
                            
                    }
                
            
    }
}
?>