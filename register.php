<?php



SESSION_START();







$PageTitle = "تسجيل جديد ";



include 'init.php';











if($_SERVER['REQUEST_METHOD'] == "POST") {



    



 



		$FullName = filter_var($_POST['FullName'],FILTER_SANITIZE_STRING);



		$Password = sha1($_POST['Password']);



		$PhoneNumber = filter_var($_POST['PhoneNumber'],FILTER_SANITIZE_NUMBER_INT);



		$erorrArray = array();



		$screet = "6LcXu7UUAAAAAANIxk1lYPpuEbZjoDHbsnGTXb9G";



		$resopnse = $_POST['g-recaptcha-response'];



		$userIP = $_SERVER['REMOTE_ADDR'];



		$url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $screet . "&response=" .$resopnse . "&remoteip=" .$userIP ;



		$resp = file_get_contents($url);



		$resp = json_decode($resp,TRUE);



		



		



		$statment = $db->prepare("SELECT * FROM users WHERE NumberPhone = ? ");



	 	$statment->execute(array($PhoneNumber)); //execute statment



	 	$countForCheckNumber = $statment->rowCount();







	











	if ($countForCheckNumber > 0) {



 		$erorrArray [] = " عذرا رقم الهاتف موجود من قبل ";

 	}



 	



 	if (empty($FullName) || empty($Password) || empty($PhoneNumber)) {







 		$erorrArray [] = "الرجاء ملأ كل الحقول المطلوبة";



 		# code...



 	}











 	if (strlen($FullName) < 3 ) {







 		$erorrArray [] = "الاسم لايمكن ان يكون اقل من 3 حروف ! ";



 		



 	}







 	if (empty($resp['success'])) {



 		



 		$erorrArray [] = " تاكد من وضع علاة صح امام تحقق الروبوت ";



 }











 	if (empty($erorrArray)) {



 	    



 	    



			 	$stmt = $db->prepare("



			 		INSERT INTO  



			 		users



			 		(FullName , Password  ,NumberPhone, Date)



			 		VALUES 



			 		(? , ? ,?  ,  now()) 



			 		");











			 	$stmt->execute(array($FullName ,$Password  ,$PhoneNumber)); //execute statment



		



 



 



				//sucsess Massege 	



		echo "<div class='loginErorrs'>";



			echo "<div class='container alert alert-success'>  <i class='far fa-check-circle'></i>  تهانينا  	 " . $FullName ."	لقد تم تسجيلك في الموقع بنجاح</div>";



		echo "</div>";















		$statment = $db->prepare("SELECT * FROM users WHERE NumberPhone = ?");



	 	$statment->execute(array($PhoneNumber)); //execute statment



	 	$row = $statment->fetch(); // Get Data In Array







	    $_SESSION['UserPhoneSession'] = $PhoneNumber;



  		$_SESSION['UserNameSession'] = $FullName;



  		$_SESSION['UserIDSession'] = $row['UserID'];



  		

    echo "<script type='text/javascript'>



    



      		    window.setTimeout(function(){



                window.location.href = 'index.php';







    }, 2000);



    



    </script>"; 



    exit;



















 	}else {



 	    



 		// if there are erorr



 		echo "<div class='loginErorrs'>";



 		echo "<div class='container alert alert-danger'>";



			foreach ($erorrArray as  $msg) {



 			



 				echo "<p> <i class='fa fa-times'></i> $msg </p>"; 







			 }



			 echo "</div>";



		echo "</div>";



 	}











	}else {



		//if come not req



	}







?> 







<h1 class="text-center">تسجيل حساب جديد</h1>



<hr class="LineTitle">











	<div class="container">



		<div class="row">



			<div class="BackLogin">



				<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST">







		 			<div class="input-group LogGroup">



					  <span class="input-group-addon FullName " id="basic-addon1"><i class="fas fa-user"></i> <label> اسمك    <span class="alstrx">*</span></label></span>



					  <input type="text" value="<?php if(isset($FullName)) { echo $FullName; } ?>" required="required" class=" form-control FullName"  name="FullName" placeholder="اسمك الأول والأخير  مثال : ناصر علي ">







					 </div>











		 			<div class="input-group">



					  <span class="input-group-addon" id="basic-addon1"><i class="fas fa-lock"></i> <label>الرقم السري <span class="alstrx">*</span></label></span>



					  <input type="Password" class=" form-control Password" name="Password" required="required"  autocomplete="new-password">



					</div>







		 			<div class="input-group LogGroup">



					  <span class="input-group-addon " id="basic-addon1"><i class="fas fa-phone"></i> <label>رقم الجوال   <span class="alstrx">*</span></label></span>



					  <input type="text" value="<?php if(isset($PhoneNumber)) { echo $PhoneNumber; } ?>" required="required" class=" form-control PhoneNumber" pattern="[0-9]{10}" title="لابد ان تكون مكونة من 10 ارقام" name="PhoneNumber" placeholder="رقم جوالك الذي يبدأ بـ 05"">



					 </div>







					<div class="g-recaptcha" data-sitekey="6LcXu7UUAAAAAOIHD5H4IOSBGaNsCARJTyxmHIZc">



						



					</div>











					<div class="input-group btnLogo">



						<input type="submit" value=" تسجيل"  class="btn btn-success btn-lg ">



					</div>







				</form>



			</div>



		</div>



	</div>











<script src='https://www.google.com/recaptcha/api.js'></script>



<?php







include $tmpl . 'footer.php';











 ?>