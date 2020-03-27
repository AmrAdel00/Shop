<?php
    $dept = new department($con);
    $items = new items($con);
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        if ($dept -> check($id) > 0){
            $itemDept = $items -> itemDept($id);
            $deptName = $dept -> view($id);
            ?>
                <div class="container">
                    <h1 class="text-center text-capitalize my-2"><?php echo $deptName['name']; ?></h1>
                    <div class="row">
                        <?php
                            if(empty($itemDept)){
                                echo '<p class="alert alert-light">There`s no Items To Show In This Department</p>';
                            } else {
                                foreach ($itemDept as $item){
                                    ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
<!--                                        <a href="index.php?go=item&id=--><?php //echo $item['ID']; ?><!--" class="text-decoration-none text-dark">-->
<!--                                            <div class="card ">-->
<!--                                              <img src="--><?php //echo $itemPath . $item['img']; ?><!--" class="card-img-top" alt="--><?php //echo $item['name']; ?><!--">-->
<!--                                              <div class="card-body">-->
<!--                                                <h5 class="card-title">--><?php //echo $item['name']; ?><!--</h5>-->
<!--                                                <p class="card-text">--><?php //echo $item['description']; ?><!--</p>-->
<!--                                              </div>-->
<!--                                            </div>-->
                                            <div class="card   card-edit mt-2" style="width: 18rem;">
                                                <img src="<?php echo $itemPath . $item['img']; ?>" class="card-img-top img-card">
                                                <div class="card-body">
                                                    <h2 class="card-title head">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <?php echo $item['name']; ?>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fa-pull-right">$<?php echo $item['price']; ?></span>
                                                            </div>
                                                        </div>
                                                    </h2>
                                                    <p class="card-text text"><?php echo $item['description']; ?></p>
                                                    <a href="index.php?go=item&id=<?php echo $item['ID']; ?>" class="btn show-more"> Show More....</a>
                                                </div>
                                            </div>
<!--                                        </a>-->
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            <?php
        } else {
            header('location: index.php');
            exit();
        }

    } else {
        ?>
        <div class="container">
            <div class="row">
                <?php
                    $depts = $dept -> viewAll();
                    foreach ($depts as $dept){
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="index.php?go=dept&id=<?php echo $dept['ID']; ?>" class="text-decoration-none text-dark">
                                <div class="card my-2">
                                    <img src="<?php echo $deptPath . $dept['img'] ?>" class="card-img-top" alt="<?php echo $dept['name']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $dept['name']; ?></h5>
                                        <p class="card-text"><?php echo $dept['description']; ?></p>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        <?php
    }