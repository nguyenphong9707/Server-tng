<?php 
    $a=1; 
    $b=2;
    
    setInterval(function() use($a, $b) {
        echo 'a='.$a.'; $b='.$b."\n";
    }, 1000);
?>