<?php 

use App\Models\User;

    function getUsername($user_id){
        return User::find($user_id)->username;
    }

    function getFirstname($fullname){
        $name = explode(" ", $fullname);
        return $name[0];
    }

    function formatDate($date){
        return date('d M, Y', strtotime($date));
    }

    function formatCedisAmount($amount){
        echo '<span>&#x20B5;</span>'.number_format($amount, 2);
        return;
    }