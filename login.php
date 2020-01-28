<?php

SESSION_START();

$PageTitle = "تسجيل دخول";



include 'init.php';



if (isset($_SESSION['UserPhoneSession'])) {



	header("location:index.php");

	exit();

}


if($_SERVER['REQUEST_METHOD'] == "POST") {



	$phone = filter_var($_POST['PhoneNumber'],FILTER_SANITIZE_NUMBER_INT);

	$pass = sha1($_POST['Password']);



	

	$statment = $db->prepare("SELECT * FROM users WHERE NumberPhone = ? AND Password = ? LIMIT 1");

 	$statment->execute(array($phone , $pass)); //execute statment

 	$row = $statment->fetch(); // Get Data In Array

 	$count = $statment->rowCount(); // return number of colume that executed



 	if  ($count > 0 ) {



		echo "<div class='loginErorrs'>";

			echo "<div class='container alert alert-success'>  <i class='far fa-check-circle'></i> مرحبا بك	 " . $row['FullName'] ."	لقد تم تسجيل دخولك بنجاح    </div>";

		echo "</div>";

 		$_SESSION['UserPhoneSession'] = $row['NumberPhone'];

  		$_SESSION['UserNameSession'] = $row['FullName'];

  		$_SESSION['UserIDSession'] = $row['UserID'];




  		

    echo "<script type='text/javascript'>

    

      		    window.setTimeout(function(){

                window.location.href = 'index.php';



    }, 2000);

    

    </script>"; 

    exit;

    

    

    



 		}else {

 			echo "<div class='loginErorrs'>";

 				echo "<div class='container alert alert-danger'>  <i class='fa fa-times'></i> خطأ في رقم الجوال او الرقم السري  </div>";

 			echo "</div>";

 		}

}







?> 



<h1 class="text-center TitleText">تسجيل دخول  </h1>

<hr class="LineTitle">



<div class="loginPage">

	<div class="container">

		<div class="row">

			<div class="BackLogin">

				<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST">

		 			<div class="input-group LogGroup">

					  <span class="input-group-addon " id="basic-addon1"><i class="fas fa-phone"></i> <label>رقم الجوال   <span class="alstrx">*</span></label></span>

					  <input type="text" class="input-lg form-control" pattern="[0-9]{10}" title="لابد ان تكون مكونة من 10 ارقام" name="PhoneNumber" required="required"">

					 </div>



		 			<div class="input-group">

					  <span class="input-group-addon" id="basic-addon1"><i class="fas fa-lock"></i> <label>الرقم السري <span class="alstrx">*</span></label></span>

					  <input type="Password" class="input-lg form-control" name="Password" autocomplete="new-password">

					</div>



					<div class="input-group btnLogo">

						<input type="submit" value="تسجيل دخول"  class="btn btn-primary btn-lg ">

					</div>

				</form>

				<hr class="LineTitle">

				<a href="register.php"><p style="display: inline-block;">لا تملك حساب ؟ تسجيل حساب جديد</p></a>

				<a href='register.php' class='btn btn-success'>  <i class="fas fa-user-plus"></i> تسجيل جديد  </a>

			</div>

		</div>

	</div>

</div>





<?php



include $tmpl . 'footer.php';





 ?>