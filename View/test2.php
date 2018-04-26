<?php 
    $originalDate = "03/08/2018";
    $originalDate = ltrim($originalDate);
    $originalDate = rtrim($originalDate);
    $nums = explode('/', $originalDate);
    print_r(strlen($nums[2]));
?>