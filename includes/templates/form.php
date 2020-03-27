<?php

    if (isset($_SESSION['username'])){
        header('location: index.php');
        exit();
    }

    $user = new  user($con);

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        if (isset($_POST['sign'])){

            $visiter = $user -> checkUser($_POST['name']);

            if ($visiter > 0){
                echo '<p class="container alert bg-transparent" style="border-color:#F90A0A">UserName "' . $_POST['name'] . '" Is Already Exist</p>';
            } else {
                $user -> create($_POST['name'],$_POST['email'],$_POST['pass']);

                $visiter = $user -> checkName($_POST['name']);

                $_SESSION['username'] = $_POST['name'];
                $_SESSION['id'] =   $visiter['ID'];


                header('location: index.php');
                exit();
            }

        } else {

            $visiter = $user -> checkName($_POST['name']);

            if (password_verify($_POST['pass'],$visiter['password'])){

                $_SESSION['username'] = $_POST['name'];
                $_SESSION['id'] =   $visiter['ID'];

                if ($visiter['GroupID'] == 1){

                    header('location: admin/index.php?go=dashboard');
                    exit();

                } else {

                    header('location: index.php');
                    exit();

                }


            } else {
                echo '<p class="container alert bg-transparent" style="border-color:#F90A0A">Please Enter Username And Password Right</p>';
            }

        }
    }

    if (isset($_GET['sign'])){
        ?>
        <div class="container">
            <h1 class="text-center text-capitalize">join us</h1>
            <form class="w-100 my-5" id="registration_form" method="POST"  action="<?php echo $_SERVER['PHP_SELF']; ?>?go=join&sign">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">UserName</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="form_name" name="name"/>
                        <span class="text-danger" id="name_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="form_email" name="email"/>
                        <span class="text-danger" id="email_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-sm-2 col-form-label">PassWord</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="form_password" name="pass"/>
                        <span class="text-danger" id="password_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-sm-2 col-form-label">Re-Type PassWord</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="form_retype_password"/>
                        <span class="text-danger" id="retype_password_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="submit" class="form-control"  name="sign"/>
                    </div>
                </div>
            </form>
            <a href="index.php?go=join&login" >Do You Already Have Account ? </a>
        </div>
        <?php
    } elseif (isset($_GET['login'])){
        ?>
        <div class="container">
            <h1 class="text-center text-capitalize">login in</h1>
            <form class="w-100 my-5"  method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>?go=join&login">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">UserName</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-sm-2 col-form-label">PassWord</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="pass" name="pass"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="submit" class="form-control" />
                    </div>
                </div>
            </form>
            <a href="index.php?go=join&sign" >Do You Want To Create Account ? </a>
        </div>
        <?php
    } else {
        header('location: index.php?go=join&sign');
    }