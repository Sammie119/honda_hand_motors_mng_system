<?php

use App\Models\Item;
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

    function getItemNamesImplode(array $item_ids)
    {
        $item_names = [];

        foreach ($item_ids as $item) {
            $item_names[] = Item::find($item)->item;
        }

        return implode(", ", $item_names);
    }