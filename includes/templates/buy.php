<?php

    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $item = new items($con);
        $client = new client($con);

        if($item -> check($id) > 0){
            $itemBuy = $item -> itemInfo($id);
            if (isset($_SESSION['id'])){
                if ($_SESSION['id'] === $itemBuy['user_ID']){
                    header('location:index.php');
                    exit();
                }
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $client -> create($_POST['name'],$_POST['address'],$_POST['phone'],$_POST['email'],$id,$itemBuy['user_ID'],$itemBuy['dept_ID']);
            }

            ?>
            <div class="container">
                <h1 class="text-center"><?php echo $itemBuy['name']; ?></h1>
                <form class="w-100" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?go=buy&id=<?php echo $id; ?>">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <input class="form-control" type="text" id="name" name="name" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <input class="form-control" type="text" id="address" name="address" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <label for="phone">Phone</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <input class="form-control" type="text" id="phone" name="phone" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <label for="email">E-Mail</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <input class="form-control" type="text" id="email" name="email" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input class="form-control" type="submit" name="buy" />
                        </div>
                    </div>
                </form>
            </div>
            <?php
        } else {
            header('location: index.php');
            exit();
        }
    }
?>

