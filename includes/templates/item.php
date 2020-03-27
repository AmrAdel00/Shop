<?php
    $item = new items($con);
if (isset($_GET['id'])){

//    echo 'item';
//    if (isset($_GET['id'])){
        $id = $_GET['id'];

        if($item -> check($id) > 0){
            $itemPage = $item -> itemInfo($id);
            ?>
            <div class="container">

                    <p><?php echo $itemPage['name'] ?></p>
                    <p><?php echo $itemPage['price'] ?></p>
                    <p><?php echo $itemPage['dept'] ?>:<?php echo $itemPage['dept_ID'] ?></p>
                    <p><?php echo $itemPage['user_ID']; ?></p>
                <a href="index.php?go=buy&id=<?php echo $itemPage['ID']; ?>" class="btn btn-light w-100 bg-light">Buy</a>
            </div>
            <?php
        } else {
            header('location: index.php');
            exit();
        }
//    } else {
//        header('location: index.php');
//        exit();
//    }

}