<?php

    if(isset($_POST["register"]))
    {
        
        $name=$_POST["uname"];
        $email=$_POST["email"];
        $passwd=$_POST["pass"];

        $inc="INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$passwd')";

        $pdo = new PDO("sqlite:database/todo.db");
        $pdo->exec($inc);

        header("Location: login.php");
        return;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
  <div class="col-md-2 mx-auto">                    
		</div>
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-4 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="register.php" method="POST">
                            <h1 class="text-center">Register</h1>
                                <input required type="text" name="uname" id="" class="form-control my-4 py-2" placeholder="Username" />
                                <input required type="email" name="email" id="" class="form-control my-4 py-2" placeholder="Email Address" />
                                <input required type="password" name="pass" id="" class="form-control my-4 py-2" placeholder="Create Password" />
                                <div class="text-center mt-3">
                                <button type="submit" name="register" class="btn btn-primary">Register</button>
                                    
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