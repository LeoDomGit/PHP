<?php
    require_once('pdo.php');
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    session_start();
    $conn= pdo_get_connection();
    if(isset($_GET['action'])){
        switch ($_GET['action']) {
            case 'createRole':
                if(!isset($_POST['rolename'])||$_POST['rolename']==''){
                    echo "Thiếu tên loại tài khoản";
                }else{
                    $sql="SELECT * FROM userroles where rolename='".$_POST['rolename']."'";
                    $result=pdo_query($sql);
                    $check= count($result);
                    if($check!=0){
                        echo "Đã tồn tại loại tài khoản";
                    }else{
                        $sql = "INSERT INTO userroles(rolename,created_at) VALUES('".$_POST['rolename']."','".date("Y-m-d H:i:s")."')";
                        pdo_execute($sql);
                        header('location:users2.php');
                    }
                }
                break;
            case 'createUser':
                if(!isset($_POST['username'])||!isset($_POST['password'])||!isset($_POST['password2'])){
                    echo "Thiếu thông tin tài khoản";
                }else if($_POST['username']==''||$_POST['password']==''||$_POST['password2']==''){
                    echo 'Bạn phải nhập đủ tên tài khoản và 2 lần mật khẩu';
                }else if($_POST['password']!=$_POST['password2']){
                    echo "Mật khẩu 2 không trùng với mật khẩu ban đầu";
                }else{
                    $password=md5($_POST['password']);
                    $sql = "INSERT INTO users(username,password,created_at) VALUES('".$_POST['username']."','".$password."','".date("Y-m-d H:i:s")."')";
                    pdo_execute($sql);
                    header('location:login.php');
                }
                break;
            case 'checkLogin':
                if(!isset($_POST['username'])||!isset($_POST['password'])){
                    echo "Thiếu thông tin tài khoản";
                }else if($_POST['username']==''||$_POST['password']==''){
                    echo 'Bạn phải nhập đủ tên tài khoản hoặc mật khẩu';
                }else{
                    $password=md5($_POST['password']);  
                    $sql="SELECT * FROM users where username='".$_POST['username']."' and password='".$password."'";
                    $result=pdo_query($sql);
                    $check=count($result);
                    if($check==0){
                        echo "Sai tên đăng nhập hoặc mật khẩu";
                    }else{
                        $_SESSION['username']=$_POST['username'];
                        header('location:user.php');
                    }
                }
                break;
            default:
                # code...
                break;
        }
    }
?>