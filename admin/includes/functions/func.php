<?php
    function title(){
        GLOBAL $title;
        if (isset($title)){
            echo $title;
        } else {
            echo 'Furniture';
        }
    }