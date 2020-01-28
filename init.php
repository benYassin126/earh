<?php



 include  "connect.php"; // connect to database

 

 if (isset($_SESSION['UserPhoneSession']) && isset($_SESSION['UserNameSession']) && !isset($_COOKIE["AutoLoginFullName"]) && !isset($_COOKIE["AutoLogiPhone"])){

     

       	 $cookie_name = "AutoLoginFullName";


		$cookie_value = $_SESSION['UserNameSession'];


		setcookie($cookie_name, $cookie_value, time() + (8640000 * 30), "/"); // 86400 = 1 day

		$cookie_name1 = "AutoLogiPhone";

		$cookie_value1 = $_SESSION['UserPhoneSession'];

		setcookie($cookie_name1, $cookie_value1, time() + (8640000 * 30), "/"); // 86400 = 1



		$cookie_name2 = "AutoLoginID";

		$cookie_value2 = $_SESSION['UserIDSession'];

		setcookie($cookie_name2, $cookie_value2, time() + (8640000 * 30), "/"); // 86400 = 1


 }

 

 if (!isset($_SESSION['UserPhoneSession']) && !isset($_SESSION['UserNameSession']) && isset($_COOKIE["AutoLoginFullName"]) && isset($_COOKIE["AutoLogiPhone"])) {

     

         $_SESSION['UserPhoneSession'] = $_COOKIE["AutoLogiPhone"];

         $_SESSION['UserNameSession'] = $_COOKIE["AutoLoginFullName"];

         $_SESSION['UserIDSession'] = $_COOKIE["AutoLoginID"];

 }





//sort diroctry



$tmpl = "include/tamplate/";

$lang = "include/languges/";

$func = "include/functions/";

$css = "layout/css/";

$js = "layout/js/";







//include important file



 include $func .'function.php';

 include $tmpl . "header.php"; // heder

 include $lang . 'english.php';









 // check if not $navbar no set navbar

 if(!isset($nonavbar)) {

 	 

 	 include $tmpl . "navbar.php";



 	}







?>