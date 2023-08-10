<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row h-100">
            <div class="col-md-4">
                <img class="w-100 h-100"
                    src="https://media.istockphoto.com/id/1341408852/video/colored-smoke-on-a-dark-background-blue-and-red-light-with-smoke.jpg?s=640x640&k=20&c=v2DQUY8IVbli_6FH_9KAs6YWRXlDdYiBJHfp7JFh7NY="
                    alt="">
            </div>
            <div class="col-md">
                <form action="userController.php?action=checkLogin" method="post">
                    <div class="d-flex">
                        <p class="icon"><i class='bx bx-user'></i></p> 
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="d-flex">
                        <p class="icon"><i class='bx bx-lock-open-alt' ></i></p> 
                        <input type="password"  name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="row">
                        <div class="col-md-4 d-flex">
                            <button class="btn btn-primary" type="submit">Đăng nhập</button>
                            <a class="btn btn-warning" href="register.php">Đăng ký</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>