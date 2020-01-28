<?php
session_start();
session_unset();
session_destroy();


if (isset($_COOKIE["AutoLoginFullName"]) && isset($_COOKIE["AutoLogiPhone"]) ){


	    unset($_COOKIE['AutoLoginFullName']); 
    	setcookie('AutoLoginFullName', null, -1, '/');
    	
 	    unset($_COOKIE['AutoLogiPhone']); 
    	setcookie('AutoLogiPhone', null, -1, '/');  

}




include 'init.php';

echo "<div class='loginErorrs'>";
echo "<div class='container alert alert-success'>  <i class='far fa-check-circle'></i> تم تسجيل خروجك بنجاح </div>";
echo "</div>";




  		
    echo "<script type='text/javascript'>
    
      		    window.setTimeout(function(){
                window.location.href = 'index.php';

    }, 2000);
    
    </script>"; 
    exit;
    
include $tmpl . 'footer.php';
 ?>