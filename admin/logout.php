<?php

session_start();
session_unset();
session_destroy();

    echo "<script type='text/javascript'>
    
      		    window.setTimeout(function(){
                window.location.href = 'index.php';

    }, 2000);
    
    </script>"; 
    exit;

?>