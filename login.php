<?php session_start() ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login or Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<?php
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['pass'];

        $pdo = new PDO("sqlite:database/todo.db");

        $result = $pdo->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'")->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 1){
            header("Location: login.php");
            return;
        }

        $_SESSION['userId'] = $result[0]['userId'];
        $_SESSION['username'] = $result[0]['username'];

        header("Location: todo.php");
        return;
    }

?>


<body>
    <div class="col-md-3 text-center mx-auto">
    </div>
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-4 m-auto">
                    <div class="card">
                        <div class="card-body" style="width :100%">
                            <form action="./login.php" method="POST">
                                <h1>Login or Register</h1>
                                <input required type="text" name="email" id="" class="form-control my-4 py-2" placeholder="e-mail" />
                                <input required type="password" name="pass" id="" class="form-control my-4 py-2" placeholder="Password" />
                                <div class="text-center mt-3">
                                    <button type="submit" value="login" name="login" class="btn btn-primary">Login</button>
                                    <a href="register.php" class="nav-link">Don't have an account ?</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>