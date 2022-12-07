<?php

function showMessage($msg, $type){
    switch(strtoupper($type)){
        case "ERROR":
            $color = '#ff6565';
            break;
        case "SUCCESS":
            $color = '#0c7a1f';
            break;
        case "INFO":
            $color = '#6f8888';
            break;
    }

    return "
        <span 
            style='
                width: 100%;
                color: ".$color.";
                border: 1px solid ".$color.";
                border-radius: 5px;
                padding: 10px;
                text-align: center;
                margin-bottom: 1rem;
            '>". $msg ."</span>  
    ";
}



