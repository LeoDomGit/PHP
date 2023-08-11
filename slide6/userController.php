<?php
require_once 'pdo.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
$conn = pdo_get_connection();
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'createUser':
            if (!isset($_POST['username']) || $_POST['username'] == '' || !isset($_POST['password']) || $_POST['password'] == '' || !isset($_POST['idRole']) || $_POST['idRole'] == '' || !isset($_FILES['image'])) {
                echo 'Thiếu thông tin tài khoản';
            } else {
                $sql = "SELECT * FROM users where username='" . $_POST['username'] . "'";
                $result = pdo_query($sql);
                $check = count($result);
                if ($check != 0) {
                    echo 'Đã tồn tại tài khoản';
                } else {
                    $password = md5($_POST['password']);
                    $image = $_FILES['image']['name'];
                    $sql = "INSERT INTO users(username,password,image,idRole,created_at) VALUES('" . $_POST['username'] . "','" . $password . "','" . $image . "'," . $_POST['idRole'] . ",'" . date('Y-m-d H:i:s') . "')";
                    pdo_execute($sql);
                    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);
                    header('location:users2.php');
                }
            }

            break;
        case 'updateUsername':
            if (!isset($_POST['username']) || $_POST['username'] == '' || !isset($_POST['id'])) {
                echo 'Thiếu thông tin tài khoản';
            } else {
                $sql = 'SELECT * FROM users where id!=' . $_POST['id'] . " and username='" . $_POST['username'] . "'";
                $result = pdo_query($sql);
                $check = count($result);
                if ($check != 0) {
                    echo 'Đã tồn tại tên tài khoản';
                } else {
                    $sql = "UPDATE users SET username='" . $_POST['username'] . "' where id=" . $_POST['id'];
                    pdo_execute($sql);
                    header('location:users2.php');
                }
            }

            break;
        case 'updatepassword':
            if (!isset($_POST['username']) || $_POST['username'] == '' || !isset($_POST['id'])) {
                echo 'Thiếu thông tin tài khoản';
            } else {
                $sql = 'SELECT * FROM users where id!=' . $_POST['id'] . " and username='" . $_POST['username'] . "'";
                $result = pdo_query($sql);
                $check = count($result);
                if ($check != 0) {
                    echo 'Đã tồn tại tên tài khoản';
                } else {
                    $sql = "UPDATE users SET username='" . $_POST['username'] . "' where id=" . $_POST['id'];
                    pdo_execute($sql);
                    header('location:users2.php');
                }
            }

            break;
        case 'createRole':
            if (!isset($_POST['rolename']) || $_POST['rolename'] == '') {
                echo 'Thiếu tên loại tài khoản';
            } else {
                $sql = "SELECT * FROM userroles where rolename='" . $_POST['rolename'] . "'";
                $result = pdo_query($sql);
                $check = count($result);
                if ($check != 0) {
                    echo 'Đã tồn tại loại tài khoản';
                } else {
                    $sql = "INSERT INTO userroles(rolename,created_at) VALUES('" . $_POST['rolename'] . "','" . date('Y-m-d H:i:s') . "')";
                    pdo_execute($sql);
                    header('location:users2.php');
                }
            }
            break;
        case 'updateRole':
            if (!isset($_POST['rolenameedit']) || $_POST['rolenameedit'] == '' || !isset($_POST['idLTK']) || $_POST['idLTK'] == '') {
                echo 'Thiếu tên loại tài khoản';
            } else {
                $sql = 'SELECT * FROM userroles where id!=' . $_POST['idLTK'] . " and rolename='" . $_POST['rolenameedit'] . "'";
                $result = pdo_query($sql);
                $check = count($result);
                if ($check != 0) {
                    echo 'Đã tồn tại loại tài khoản';
                } else {
                    $sql = "UPDATE userroles SET rolename='" . $_POST['rolenameedit'] . "',updated_at='" . date('Y-m-d H:i:s') . "' WHERE id=" . $_POST['idLTK'];
                    pdo_execute($sql);
                    header('location:users2.php');
                }
            }
            break;
        case 'deleteRole':
            if (!isset($_GET['id']) || $_GET['id'] == '') {
                echo 'Thiếu tên loại tài khoản';
            } else {
                $sql = 'SELECT * FROM users WHERE idRole=' . $_GET['id'];
                $result = pdo_query($sql);
                $check = count($result);
                if ($check != 0) {
                    echo 'Tồn tại tài khoản trong loại';
                } else {
                    $sql = 'DELETE from userroles WHERE id=' . $_GET['id'];
                    pdo_execute($sql);
                    header('location:users2.php');
                }
            }
            break;
        case 'createUser':
            if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['password2'])) {
                echo 'Thiếu thông tin tài khoản';
            } elseif ($_POST['username'] == '' || $_POST['password'] == '' || $_POST['password2'] == '') {
                echo 'Bạn phải nhập đủ tên tài khoản và 2 lần mật khẩu';
            } elseif ($_POST['password'] != $_POST['password2']) {
                echo 'Mật khẩu 2 không trùng với mật khẩu ban đầu';
            } else {
                $password = md5($_POST['password']);
                $sql = "INSERT INTO users(username,password,created_at) VALUES('" . $_POST['username'] . "','" . $password . "','" . date('Y-m-d H:i:s') . "')";
                pdo_execute($sql);
                header('location:login.php');
            }
            break;
        case 'checkLogin':
            if (!isset($_POST['username']) || !isset($_POST['password'])) {
                echo 'Thiếu thông tin tài khoản';
            } elseif ($_POST['username'] == '' || $_POST['password'] == '') {
                echo 'Bạn phải nhập đủ tên tài khoản hoặc mật khẩu';
            } else {
                $password = md5($_POST['password']);
                $sql = "SELECT * FROM users where username='" . $_POST['username'] . "' and password='" . $password . "'";
                $result = pdo_query($sql);
                $check = count($result);
                if ($check == 0) {
                    echo 'Sai tên đăng nhập hoặc mật khẩu';
                } else {
                    $_SESSION['username'] = $_POST['username'];
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
