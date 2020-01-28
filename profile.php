<?php

SESSION_START();



$PageTitle = "الملف الشخصي";



include 'init.php';



$UserSession = $_SESSION['UserPhoneSession'];





	if (!isset($_SESSION['UserPhoneSession'])) {

		header('Location:login.php');

		exit();

	}



	$stmt = $db->prepare("SELECT * FROM users WHERE NumberPhone = ?");

 	$stmt->execute(array($UserSession)); //execute statment

 	$row = $stmt->fetch(); // Get Data In Array





	if (isset($_GET['do'])) {



		$do = $_GET['do'];



}else {



	$do = "manage";

}



if ($do == "manage" ) {

	# code...



 	$UserID = $row['UserID'];



	$stmt = $db->prepare("SELECT * FROM books WHERE UserID = ?");

 	$stmt->execute(array($UserID)); //execute statment

	$count = $stmt->rowCount(); // return number of colume that executed



	$NumberOfUserBooks = $count;







?> 



<h1 class="text-center">الملف الشخصي</h1>

<hr class="LineTitle">

<div class="informaiton">

	<div class="container">

		<div class="panel panel-default">

			<div class="panel-heading"> معلوماتي</div>

			<div class="panel-body">

				<ul class="list-unstyled">

					<li>

						<i class="fa fa-users"></i>

						<span>الاسم</span> : <?php echo $row['FullName']  ?>

					</li>

					<li>

						<i class="fa fa-phone"></i>

						<span>رقم الجوال</span> : <?php echo $row['NumberPhone']  ?>

					</li>

					<li>

						<i class="fa fa-book"></i>

						<span>عدد الكتب </span> : <a href="managebook.php"> <?php echo $NumberOfUserBooks  ?> </a>

					</li>

					<li>

						<i class="fa fa-calendar"></i>

						<span>تاريخ التسجيل</span> : <?php echo $row['Date']  ?>

					</li>

				</ul>	 

			</div>

		</div>



		<div class="text-center" style="margin-top: 20px;">

			<a href='?do=edit' class='btn btn-primary'>  <i class="fas fa-edit"></i> تعديل البينات </a>

		</div>



<?php



}elseif ($do == "edit") {



?>





<h1 class="text-center">تعديل البينات الشخصية</h1>

<hr class="LineTitle">





	<div class="container">

		<div class="row">

			<div class="BackLogin">

				<form action = "?do=update" method = "POST">





					<input type="hidden"  name="userid" value="<?php echo $row['UserID']; ?>">

		 			<div class="input-group LogGroup">

					  <span class="input-group-addon FullName " id="basic-addon1"><i class="fas fa-user"></i> <label> اسمك    <span class="alstrx">*</span></label></span>

					  <input type="text" value="<?php echo $row['FullName']; ?>" required="required" class=" form-control FullName"  name="FullName">



					 </div>





		 			<div class="input-group">

					  <span class="input-group-addon" id="basic-addon1"><i class="fas fa-lock"></i> <label>الرقم السري <span class="alstrx">*</span></label></span>

					  <input type="Password" class=" form-control Password" name="new-password"   autocomplete="new-password">

					  <input type="hidden"  value="<?php echo $row['Password']; ?>"  class="input-lg form-control" name="old-Password" >

					</div>



		 			<div class="input-group LogGroup">

					  <span class="input-group-addon " id="basic-addon1"><i class="fas fa-phone"></i> <label>رقم الجوال   <span class="alstrx">*</span></label></span>

					  <input type="text" value="<?php echo "0" . $row['NumberPhone']  ?>" required="required" class=" form-control PhoneNumber" pattern="[0-9]{10}" title="لابد ان تكون مكونة من 10 ارقام" name="NumberPhone" placeholder="رقم جوالك الذي يبدأ بـ 05"">

					 </div>

					<div class="input-group btnLogo">

						<input type="submit" value="حفظ وارسال"  class="btn btn-success btn-lg ">

					</div>

						

					</div>









				</form>

			</div>

		</div>

	</div>





<?php

}elseif ($do == "update") {



	if ($_SERVER['REQUEST_METHOD'] == "POST") {



		$UserID = $_POST['userid'];

		$FullName = $_POST['FullName'];

		$oldPassword = $_POST['old-Password'];

		$newPassword = $_POST['new-password'];

		$NumberPhone = $_POST['NumberPhone'];



		$erorrArray = array();



		if (empty($newPassword)) {


			$newPassword = $oldPassword;

		}else {

			$newPassword = sha1($newPassword);
		}



	$statment = $db->prepare("SELECT * FROM users WHERE NumberPhone = ? AND UserID != ?");

 	$statment->execute(array($NumberPhone , $UserID)); //execute statment

 	$count = $statment->rowCount();

 	

 	if ($count > 0) {



 		$erorrArray [] = "رقم الهاتف الذي ادخلته موجود مسبقا";



 	}



 	if (strlen($NumberPhone) != 10) {



 		$erorrArray [] = "رقم الهاتف يجب ان يكون مكون من 10 ارقام";

 		

 	}







 	if (empty($erorrArray)) {



 				 	$stmt = $db->prepare("

			 		UPDATE 

			 		users

			 		SET 

			 		FullName = ? ,Password = ?  , NumberPhone = ? 

			 		WHERE 

			 		UserID = ?");





			 	$stmt->execute(array($FullName ,$newPassword ,  $NumberPhone ,$UserID)); //execute statment

		

			 	$count = $stmt->rowCount(); // return number of colume that executed



				 $_SESSION['UserPhoneSession'] = $NumberPhone;

		  		$_SESSION['UserNameSession'] = $FullName;

		  		$_SESSION['UserIDSession'] = $UserID;



				//sucsess Massege 	

			 	echo "<div class='alert alert-success container'>تم تحديث البينات بنجاح </div>";



						 	
			    echo "<script type='text/javascript'>

			    

			      		    window.setTimeout(function(){

			                window.location.href = 'index.php';



			    }, 2000);

			    

			    </script>"; 

			    exit;


 		



 	}else {



 		//if there are erorr not sent and show erorr

		 foreach ($erorrArray as  $msg) {



		 		echo "<div class='alert alert-danger container'> $msg</div>";

		 }



		 Redirect ('' ,'back', 3);





 	}

		

	}else {

		//if come not REQUEST_METHOD

		echo "<div class='alert alert-danger container'> come not REQUEST_METHOD</div>";



		Redirect ('' , 3);

	}





}





include $tmpl . 'footer.php';





 ?>