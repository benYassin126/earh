<?php

SESSION_START();



$PageTitle = "إدارة الكتب";



include 'init.php';



if (!isset($_SESSION['UserPhoneSession'])) {

	header('Location:login.php');

	exit();

}

if (isset($_GET['do']) && $_GET['do'] == "delete" ) {

	







	if (isset($_GET['BookID'])  && is_numeric($_GET['BookID'])) {



		$BookID = $_GET['BookID'];

		$UserID = $_SESSION['UserIDSession'];





	 	//query for unblock

		$statment = $db->prepare("DELETE FROM books  WHERE BookID = ? AND UserID = ?");

	 	$statment->execute(array($BookID,$UserID)); //execute statment

	 	$count = $statment->rowCount(); // return number of colume that executed



	 	if ($count > 0) {



	 	//Seccess Msg

		echo "<div class='loginErorrs'>";

			echo "<div class='container alert alert-success'>  <i class='far fa-check-circle'></i>  تم حذف الكتاب بنجاح </div>";

		echo "</div>";

		

		  		

    echo "<script type='text/javascript'>

    

      		    window.setTimeout(function(){

                window.location.href = 'managebook.php';



    }, 2000);

    

    </script>"; 

    exit;



	 		

	 	}else {

 			echo "<div class='loginErorrs'>";

 				echo "<div class='container alert alert-danger'>  <i class='fa fa-times'></i> الكتاب غير موجود أو ليس لك !</div>";

 			echo "</div>";

	 	//Redairct After Done Update

    echo "<script type='text/javascript'>

    

      		    window.setTimeout(function(){

                window.location.href = 'managebook.php';



    }, 2000);

    

    </script>"; 

    exit;

    

	 	}







	 }else {



	 	//if do= not number or do not exist

		 $msg = "ID Undifened";

		Redirect ($msg ,'', $seconds = 3);

	 }





}elseif (isset($_GET['do']) && $_GET['do'] == "edit") {



		

		$BookID = $_GET['BookID'];

		$UserID = $_SESSION['UserIDSession'];



		$statment = $db->prepare("SELECT * FROM books WHERE BookID = ? AND UserID = ? ");

	 	$statment->execute(array($BookID , $UserID)); //execute statment

	 	$row = $statment->fetch(); // Get Data In Array

	 	$count = $statment->rowCount(); // return number of colume that executed



	 	if ($count > 0) {



	 		?>





<h1 class="text-center">تعديل الكتاب</h1>

<hr class="LineTitle">







	<div class="container">

		<div class="row">

			<div class="BackLogin">

				<form action = "?do=update" method = "POST"enctype="multipart/form-data">



		 			<div class="input-group LogGroup">

					  <span class="input-group-addon " id="basic-addon1"><i class="fas fa-book"></i> <label> اسم الكتاب    <span class="alstrx">*</span></label></span>

					  <input type="text" placeholder="" value="<?php if(isset($row['BookName'])) { echo $row['BookName']; } ?>" class="form-control BookName" name="BookName"  autofocus="true"  required="required" ">

					  <input type="hidden" name="BookID"  value="<?php if(isset($row['BookID'])) { echo $row['BookID']; } ?>">



					 </div>



		 			<div class="input-group LogGroup">

					  <span class="input-group-addon " id="basic-addon1"><i class="fas fa-book"></i> <label> هل تمت إعارة الكتاب ؟     <span class="alstrx">*</span></label></span>

					 <input type="radio" name="Status" value="1" <?php if(isset($row['Status']) && $row['Status'] == 1 ) {echo 'checked';} ?> >نعم

					  <input type="radio" name="Status" value="0" <?php if(isset($row['Status']) && $row['Status'] == 0 ) {echo 'checked';} ?> >لا

			



					 </div>



		 			<div class="input-group">

					  <span class="input-group-addon" id="basic-addon1"><i class="fas fa-paste"></i> <label>تصنيف الكتاب  <span class="alstrx">*</span></label></span>

					  <select name="Category" class="Category">

					  		<option <?php if (isset($Category) && $Category == 0) {echo "selected";}?> value="0"></option>

						 	<option <?php if (isset($Category) && $Category == "جامعي") {echo "selected";}?> value="جامعي">جامعي</option>

						 	<option <?php if (isset($Category) && $Category == "اسلامي") {echo "selected";}?> value="اسلامي">اسلامي</option>

						 	<option <?php if (isset($Category) && $Category == "تطوير ذات") {echo "selected";}?> value="تطوير ذات">تطوير ذات</option>

						 	<option <?php if (isset($Category) && $Category == "اطفال") {echo "selected";}?> value="اطفال">اطفال</option>

						 	<option <?php if (isset($Category) && $Category == "ادبي") {echo "selected";}?> value="ادبي">ادبي</option>

						 	<option <?php if (isset($Category) && $Category == "علمي") {echo "selected";}?> value="علمي">علمي</option>

						 	<option <?php if (isset($Category) && $Category == "قصص وروايات") {echo "selected";}?> value="قصص وروايات">قصص وروايات</option>

						 	<option <?php if (isset($Category) && $Category == "اخرى") {echo "selected";}?> value="اخرى">اخرى</option>

					  </select>

					</div>



		 			<div class="input-group">

					  <span class="input-group-addon" id="basic-addon1"><i class="fas fa-globe"></i> <label> مدينة الإعارة  <span class="alstrx">*</span></label></span>

					  <select name="City" class="City">

					  	<option <?php if (isset($City) && $City == 0) {echo "selected";}?>  value="0"></option>

					  	<option <?php if (isset($City) && $City == "تبوك") {echo "selected";}?>  value="تبوك">تبوك</option>

					  	<option <?php if (isset($City) && $City == "الرياض") {echo "selected";}?>  value="الرياض">الرياض</option>

					  	<option <?php if (isset($City) && $City == "مكة المكرمة") {echo "selected";}?>  value="مكة المكرمة">مكة المكرمة</option>

					  	<option <?php if (isset($City) && $City == "المدينة المنورة") {echo "selected";}?>  value="المدينة المنورة">المدينة المنورة</option>

					  	<option <?php if (isset($City) && $City == "جدة") {echo "selected";}?>  value="جدة">جدة</option>

					  	<option <?php if (isset($City) && $City == "الطائف") {echo "selected";}?>  value="الطائف">الطائف</option>

					  	<option <?php if (isset($City) && $City == "القصيم") {echo "selected";}?>  value="القصيم">القصيم</option>

					  	<option <?php if (isset($City) && $City == "الدمام") {echo "selected";}?>  value="الدمام">الدمام</option>

					  	<option <?php if (isset($City) && $City == "الاحساء") {echo "selected";}?>  value="الاحساء">الاحساء</option>

					  	<option <?php if (isset($City) && $City == "ابها") {echo "selected";}?>  value="ابها">ابها</option>

					  	<option <?php if (isset($City) && $City == "حائل") {echo "selected";}?>  value="حائل">حائل</option>

					  	<option <?php if (isset($City) && $City == "نجران") {echo "selected";}?>  value="نجران">نجران</option>

					  	<option <?php if (isset($City) && $City == "الباحة") {echo "selected";}?>  value="الباحة">الباحة</option>

					  	<option <?php if (isset($City) && $City == "الجوف") {echo "selected";}?>  value="الجوف">الجوف</option>

					  </select>
					</div>



		 			<div class="input-group LogGroup CusInpMarg">

					  <span class="input-group-addon " id="basic-addon1"><i class="fas fas fa-clock"></i> <label> مدة الإعارة     <span class="alstrx">*</span></label></span>

					 <div class="slidecontainer">

					 	 <span id="Amount" class="text-center"></span>

                          <input type="range" min="1" max="12" value="<?php if(isset($row['Time'])) {echo $row['Time'];}else {echo "3"; }	?>" class="slider" id="myRangeToAmount" name="Time">





                       </div>

					 </div>



		 			<div class="input-group LogGroup">

					  <span class="input-group-addon" id="basic-addon1"><i class="fas fa-camera"></i> <label> صورة الكتاب      <span class="alstrx">*</span></label></span>



					  	

                          <input type="file" name="bookImg"  value="<?php echo $row['Book_img'];  ?>" >

                          

					 </div>

					 <p> * إذا لم تتوفر عندك صورة الكتاب يمكنك تنزيلها من  <span> <a href="https://www.google.com.sa/imghp" target="_blank"  > صور قوقل </a><span></p>





					<div class="g-recaptcha" data-sitekey="6Lddba8UAAAAAPvBwGnSOsqwvCGRY2hvSYnwn0T5">

						

					</div>





					<div class="input-group btnLogo">

						<input type="submit" value=" تعديل الكتاب"  class="btn btn-success btn-lg ">

					</div>



				</form>

			</div>

		</div>

	</div>



<script src='https://www.google.com/recaptcha/api.js'></script>







	 		<?php

	 	}else {



 			echo "<div class='loginErorrs'>";

 				echo "<div class='container alert alert-danger'>  <i class='fa fa-times'></i> الكتاب غير موجود أو ليس لك !</div>";

 			echo "</div>";



    echo "<script type='text/javascript'>

    

      		    window.setTimeout(function(){

                window.location.href = 'managebook.php';



    }, 2000);

    

    </script>"; 

    exit;

	 	}







}elseif (isset($_GET['do']) && $_GET['do'] == "update") {



	if ($_SERVER['REQUEST_METHOD'] == "POST"){





		$bookkImg = $_FILES['bookImg'];

		$BookName = filter_var($_POST['BookName'],FILTER_SANITIZE_STRING);

		$Category = $_POST['Category'];

		$City = $_POST['City'];

		$Time = $_POST['Time'];

		





		$bookImgName = 	$_FILES['bookImg']['name'];

		$bookImgSize = 	$_FILES['bookImg']['size'];

		$bookImgType = 	$_FILES['bookImg']['type'];

		$bookImgTemp = 	$_FILES['bookImg']['tmp_name'];

		$arrayExtinson = array("jpeg","png","jpg","gif");



		$bookImgExtainoson = explode('.', $bookImgName);

		$LastIndexForBookImg = strtolower(end($bookImgExtainoson));





		$BookID = $_POST['BookID'];

		$Status = $_POST['Status'];

		$UserID = $_SESSION['UserIDSession'];

		$erorrArray = array();

		$screet = "6Lddba8UAAAAAPQHYOs3jDKvrbWeEBoF_8h6sieY";

		$resopnse = $_POST['g-recaptcha-response'];

		$userIP = $_SERVER['REMOTE_ADDR'];

		$url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $screet . "&response=" .$resopnse . "&remoteip=" .$userIP ;

		$resp = file_get_contents($url);

		$resp = json_decode($resp,TRUE);







 	if (empty($BookName) || $Category === 0 || $City === 0) {



 		$erorrArray [] = "الرجاء ملأ كل الحقول المطلوبة";

 		# code...

 	}





 	if (strlen($BookName) <= 3 ) {



 		$erorrArray [] = "اسم الكتاب لايمكن ان يكون اقل من 3 حروف ";

 		

 	}



 	if ($bookImgSize > 5242880) {

			$erorrArray [] = "Size Of Img Must Be Less Than 5MB";

			

		}







  	if (!empty($bookImgName) && !in_array($LastIndexForBookImg , $arrayExtinson)) {



 		$erorrArray [] =  'تاكد من صيغة الصورة' ;



 		

 	}









 	if (empty($resp['success'])) {

 		

 		$erorrArray [] = " تاكد من وضع علاة صح امام تحقق الروبوت ";

 }





 	if (empty($erorrArray)) {





 			if (!empty($bookImgName)) {



 			$BookImage = rand(0 , 10000) . "__" . $bookImgName;

	 		move_uploaded_file($bookImgTemp, "upload/Item/" . $BookImage );



 			



 		



 				// update new value



			 	$stmt = $db->prepare("

			 		UPDATE 

			 		books

			 		SET

			 		BookName = ? , Category = ? ,City = ?, Time = ? , Status = ? , Book_img = ? , UserID = ? , Date = now()

			 		WHERE

			 		BookID = ?



			 		");





			 	$stmt->execute(array($BookName ,$Category  , $City , $Time , $Status, $BookImage ,  $UserID  , $BookID )); //execute statment

		

			 	$count = $stmt->rowCount(); // return number of colume that executed

			 }else {



			 	#if not uplode new pic uplded without img



			 	$stmt = $db->prepare("

			 		UPDATE 

			 		books

			 		SET

			 		BookName = ? , Category = ? ,City = ?, Time = ? ,  Status = ? ,  UserID = ? , Date = now()

			 		WHERE

			 		BookID = ?



			 		");





			 	$stmt->execute(array($BookName ,$Category  , $City , $Time , $Status ,  $UserID  , $BookID )); //execute statment

		

			 	$count = $stmt->rowCount(); // return number of colume that executed





			 }

				//sucsess Massege 	

		echo "<div class='loginErorrs'>";

			echo "<div class='container alert alert-success'>  <i class='far fa-check-circle'></i>  تم التعديل على كتاب	 " . $BookName ."	بنجاح   </div>";

		echo "</div>";



    echo "<script type='text/javascript'>

    

      		    window.setTimeout(function(){

                window.location.href = 'managebook.php';



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



    echo "<script type='text/javascript'>

    

      		    window.setTimeout(function(){

             history.go(-1);



    }, 2000);

    

    </script>"; 

    exit;

 	}







	}else {

			#IF COME FROM URL

 			echo "<div class='loginErorrs'>";

 				echo "<div class='container alert alert-danger'>  <i class='fa fa-times'></i> لا يمكنك الدخول هنا مباشرة !</div>";

 			echo "</div>";





    echo "<script type='text/javascript'>

    

      		    window.setTimeout(function(){

                window.location.href = 'index.php';



    }, 2000);

    

    </script>"; 

    exit;





	}









} elseif (!isset($_GET['do'])) {

	

	#Mange Page





?> 



<h1 class="text-center">جميع كتبي</h1>

<hr class="LineTitle">



		<?php		

		$USERSES = $_SESSION['UserIDSession'];

			 	$stmt = $db->prepare("
					SELECT books.* , users.FullName 
					FROM 
					books
					INNER JOIN 
					users
					ON
					users.UserID = books.UserID
					WHERE 
					users.UserID = ?
					ORDER BY books.BookID DESC
					");


					$stmt->execute(array($USERSES)); //execute statment

					$AllUsers = $stmt->fetchAll(); // Get Data In Array

					$count = $stmt->rowCount(); // return number of colume that executed

					if ($count > 0 ) {



					?>

		<div class="container manageTable">

			<div class="table-resposive">

				<table class="main-table text-center table table-bordered table-striped table-dark">

					<tr>

						<td style="width: 10%;">رقم الكتاب</td>

						<td>اسم الكتاب </td>

						<td>حالة الإعارة</td>

						<td>التحكم</td>

					</tr>



					<?php	 





						foreach ($AllUsers as  $OneBook) {

							echo "<tr>";

								echo "<td> " . $OneBook['BookID'] ."</td>";

								echo "<td> " . $OneBook['BookName'] ."</td>";

								if ($OneBook['Status'] == 0) {

									

									echo "<td style='color:green;'> متاح للإعارة </td>";



								}else {



									echo "<td style='color:red;'> غير متاح للإعارة </td>";

								}

								



								echo "<td>





								<a data-toggle='tooltip'  title=' تعديل الكتاب' href='?do=edit&BookID=" . $OneBook['BookID'] . "'><i class='fa fa-edit'></i> </a>

								<a data-toggle='tooltip'  title=' حذف الكتاب' href='?do=delete&BookID=" . $OneBook['BookID'] . "'><i class='confirm fa fa-trash '></i> </a> ";

								

								



							 	 echo "</td>"; 



							echo "</tr>";

							

						}

					}else { 

						echo "<div class='notBook'>";

							echo "<p class='container text-center alert alert-danger'>* لم تقم برفع كتاب حتى الأن ! </p>";

						echo "</div>";

					}





					 ?>







				</table>

			</div>

			<hr class="LineTitle">

			<div class="bunss text-center">

				<a href="addbook.php" class="btn btn-success"> <i style="padding-left:3px;" class='fa fa-plus'></i> إضافة كتاب جديد </a>

				<a href="profile.php" class="btn btn-primary"> <i class='fa fa-edit'></i>  إدارة الملف الشخصي</a>

			</div>	

		</div>







<?php

}





include $tmpl . 'footer.php';





 ?>