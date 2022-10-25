<?php
    function mynl2br($text) { 
        return strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />')); 
     } 
?>