<?php

    $header       = 'includes/templates/header.php' ;
    $nav          = 'includes/templates/navbar.php' ;
    $footer       = 'includes/templates/footer.php' ;
    $func         = 'includes/functions/func.php';
    $user         = 'includes/objects/user.php';
    $department   = 'includes/objects/department.php';


    include $func;
    include $header;
    if (!isset($noNav)){
        include $nav;
    }
    include $footer;
    include $user;
    include $department;