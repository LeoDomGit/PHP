<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '') {
    // header('location:login.php');
}
require_once 'pdo.php';
$sql = 'SELECT * FROM userroles';
$userroles = pdo_query($sql);
$sql = 'SELECT * FROM users inner join userroles on users.idRole=userroles.id';
$users = pdo_query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/role.css">
    <script src="js/sweetalert2.all.js"></script>
</head>

<body>
    <div class="mainContainer">
        <!-- Modal  -->
        <div class="modal fade" id="LoaiTaiKhoanModal" tabindex="-1" aria-labelledby="LoaiTaiKhoanModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="LoaiTaiKhoanModalLabel">Loại tài khoản</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="userController.php?action=createRole" method="post">
                        <div class="modal-body">
                            <input type="text" placeholder="Tên Loại tài khoản" name="rolename" id="rolename"
                                class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =============================== -->
        <div class="modal fade" id="LoaiTaiKhoanEditModal" tabindex="-1" aria-labelledby="LoaiTaiKhoanEditModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="LoaiTaiKhoanEditModalLabel">Loại tài khoản</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="userController.php?action=updateRole" method="post">
                        <div class="modal-body">
                            <input type="text" placeholder="Tên Loại tài khoản" name="rolenameedit"
                                id="rolenameedit" class="form-control">
                            <input type="hidden" name="idLTK" id="idLTKEdit">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =============================== -->
        <div class="col-md bg-dark">
            <ul class="list-group">
                <li class="list-group-item active" aria-current="true">Tài khoản</li>
                <li class="list-group-item"><a class="urllink" href="logout.php">Đăng xuất</a></li>
            </ul>
        </div>
        <div class="col-md">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" id="addUserRoleBtn"
                                    href="#">Thêm
                                    loại </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" id="addUserBtn" href="#">Thêm
                                    tài
                                    khoản</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled">Disabled</a>
                            </li> -->
                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="row p-3">
                <div class="col-md-5">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Tên loại</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tùy chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($userroles as $key => $value) {?>
                                <tr class="">
                                    <td scope="row">
                                        <b><?= $value['rolename'] ?></b><br>

                                    </td>
                                    <td><?= date('H:i - d/y/20y', strtotime($value['created_at'])) ?></td>
                                    <td> <button class="btn-sm btn-warning editRoleBtn"
                                            data-value="<?= $value['rolename'] ?>"
                                            data-id="<?= $value['id'] ?>">Sửa</button>
                                        <button class="btn-sm btn-danger deleteUserRole"
                                            data-id="<?= $value['id'] ?>">Xóa</button>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Tên tài khoản</th>
                                    <th scope="col">Loại tài khoản</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Tùy chỉnh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $key => $value) {?>
                                    <tr class="">
                                    <td scope="row"><?=$value['username']?></td>
                                    <td><?=$value['rolename']?></td>
                                    <td>
                                        <?php if($value['status']==0){?>
                                                <b class="statususer" data-id="<?=$value['id']?>">Đang khóa</b>
                                        <?php    }else { ?>
                                                <b class="statususer" data-id="<?=$value['id']?>">Đang mở</b>
                                         <?php   } ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning">Sửa</button>
                                        <button class="btn btn-danger">Xóa</button>
                                    </td>
                                </tr>
                               <?php }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md">
                    <form action="userController.php?action=createUser" enctype="multipart/form-data" id="createUserForm" method="post">
                        <div class="row w-100">
                            <div class="col-md">
                                <input type="text" name="username" placeholder="Tên tài khoản"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2 w-100">
                            <div class="col-md">
                                <input type="password" placeholder="Mật khẩu" name="password"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row  mt-2 w-100">
                            <div class="col-md">
                                <select name="idRole" id="" class="form-control">
                                    <?php
                                    foreach ($userroles as $key => $value) {?>
                                    <option value="<?= $value['id'] ?>"><?= $value['rolename'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <input type="file" name="image" id="">
                        </div>
                        <div class="row mt-2 p-2 ">
                            <button type="submit" class="btn btn-primary w-50">Lưu</button>
                        </div>
                        
                </form>
                <form action="userController.php?action=updateUser" enctype="multipart/form-data" id="updateUserForm" method="post">
                        <div class="row w-100">
                            <div class="col-md">
                                <input type="hidden" name="idUser" id="idUser">
                                <input type="text" name="username" placeholder="Tên tài khoản"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2 w-100">
                            <div class="col-md">
                                <input type="password" placeholder="Mật khẩu" name="password"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row  mt-2 w-100">
                            <div class="col-md">
                                <select name="idRole" id="" class="form-control">
                                    <?php
                                    foreach ($userroles as $key => $value) {?>
                                    <option value="<?= $value['id'] ?>"><?= $value['rolename'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <input type="file" name="image" id="">
                        </div>
                        <div class="row mt-2 p-2 ">
                            <button type="submit" class="btn btn-primary w-50">Lưu</button>
                        </div>
                </form>
                </div>

           

                </div>

            </div>
        </div>

    </div>
    </div>
    <script src="js/users2.js"></script>
</body>

</html>
