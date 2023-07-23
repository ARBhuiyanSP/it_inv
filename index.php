<?php
session_start();
include 'connection/connect.php';
include 'function/login_process.php';

if(isset($_SESSION['logged'])&&!empty($_SESSION['logged'])){
   header("Location: dashboard.php");
   exit();
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RLP Management System | Log in</title>
        <link rel="shortcut icon" type="image/x-icon" href="images/icon/port.png" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="vendor/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="vendor/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="vendor/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="vendor/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="vendor/plugins/iCheck/square/blue.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/login.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
    </head>
    <body class="login-block">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 login-sec">
                        <h2 class="text-center">RLP Management Login</h2>
                        <form action="" method="post">
                            <div class="form-group has-feedback">
                                <input type="text" name="email" class="form-control" placeholder="User Name">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                <?php if (isset($_SESSION['error_message']['email_empty']) && !empty($_SESSION['error_message']['email_empty'])) { ?>
                                    <div class="text-danger">
                                        <strong>Warning!</strong> <?php echo $_SESSION['error_message']['email_empty']; ?>
                                    </div>
                                    <?php
                                    unset($_SESSION['error_message']['email_empty']);
                                }
                                ?>
                                <?php if (isset($_SESSION['error_message']['email_valid']) && !empty($_SESSION['error_message']['email_valid'])) { ?>
                                    <div class="text-danger">
                                        <strong>Warning!</strong> <?php echo $_SESSION['error_message']['email_valid']; ?>
                                    </div>
                                    <?php
                                    unset($_SESSION['error_message']['email_valid']);
                                }
                                ?>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                <?php if (isset($_SESSION['error_message']['password_empty']) && !empty($_SESSION['error_message']['password_empty'])) { ?>
                                    <div class="text-danger">
                                        <strong>Warning!</strong> <?php echo $_SESSION['error_message']['password_empty']; ?>
                                    </div>
                                    <?php
                                    unset($_SESSION['error_message']['password_empty']);
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="submit" name="login_submit" class="btn btn-block btn-login" value="Login">
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8 login-background">
                        <h2 style="margin: 25%; color: white; text-align:center;">SAIF POWER GROUP</h2>
                    </div>
                </div>
            </div>
        </section>
        <div class="development_credit">Designed & Developed by 88 Innovations Ltd</div>

        <!-- jQuery 3 -->
        <script src="vendor/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="vendor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="vendor/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });
        </script>
    </body>
</html>
