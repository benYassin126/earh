<?php



SESSION_START();







if (isset($_SESSION['UserPhoneSession'])) {



	# code...



$PageTitle = " إضافة كتاب ";







include 'init.php';





if($_SERVER['REQUEST_METHOD'] == "POST") {







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





		$UserID = $_SESSION['UserIDSession'];



		$erorrArray = array();



		$screet = "6LcXu7UUAAAAAANIxk1lYPpuEbZjoDHbsnGTXb9G";



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







 	if ($bookImgSize > 1048576) {



			$erorrArray [] = "حجم الصورة غير مناسب ,, هناك عدة اقتراحات لقبول حجم الصورة";









			



		}





   	if (empty($bookImgName)) {



 		



 		$erorrArray [] =  'تأكد من رفع صورة الكتاب  ... يمكنك الإستعانبة بــ' . '<a href="https://www.google.com.sa/imghp" target="_blank"  > صور قوقل </a> ';



 	}















  	if (!in_array($LastIndexForBookImg , $arrayExtinson)) {







 		$erorrArray [] =  'تاكد من صيغة الصورة' ;



	



 	}







 	if (empty($resp['success'])) {



 		



 		$erorrArray [] = " تاكد من وضع علاة صح امام تحقق الروبوت ";



 }





 	if (empty($erorrArray)) {







 			$BookImage = rand(0 , 10000) . "__" . $bookImgName;



	 		move_uploaded_file($bookImgTemp, "upload/Item/" . $BookImage );



 		







 				// update new value







			 	$stmt = $db->prepare("



			 		INSERT INTO  



			 		books



			 		(BookName , Category ,City, Time , Book_img , UserID , Date)



			 		VALUES 



			 		(? , ? , ? ,  ? , ? ,?  ,  now()) 



			 		");







			 	$stmt->execute(array($BookName ,$Category  , $City , $Time , $BookImage ,  $UserID)); //execute statment



		



			 	$count = $stmt->rowCount(); // return number of colume that executed







				//sucsess Massege 	



		echo "<div class='loginErorrs'>";



			echo "<div class='container alert alert-success'>  <i class='far fa-check-circle'></i>  تمت اضافة كتاب 	 " . $BookName ."	بنجاح   </div>";



		echo "</div>";







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







<h1 class="text-center">إضافة كتاب</h1>



<hr class="LineTitle">















	<div class="container">



		<div class="row">



			<div class="BackLogin">



				<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST"enctype="multipart/form-data">







		 			<div class="input-group LogGroup">



					  <span class="input-group-addon " id="basic-addon1"><i class="fas fa-book"></i> <label> اسم الكتاب    <span class="alstrx">*</span></label></span>



					  <input type="text" placeholder="" value="<?php if(isset($BookName)) { echo $BookName; } ?>" class="form-control BookName" name="BookName"  autofocus="true"  required="required" ">







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



                          <input type="range" min="1" max="12" value="<?php if(isset($Time)) {echo $Time;}else {echo "3"; }	?>" class="slider" id="myRangeToAmount" name="Time">











                       </div>



					 </div>







		 			<div class="input-group LogGroup">



					 



                       <span>صورة الكتاب :</span>   <input type="file" name="bookImg" required="required" id="file"> 



					 </div>



					 <p> * إذا لم تتوفر عندك صورة الكتاب يمكنك تنزيلها من  <span> <a href="https://www.google.com.sa/imghp" target="_blank"  > صور قوقل </a><span></p>











					<div class="g-recaptcha" data-sitekey="6LcXu7UUAAAAAOIHD5H4IOSBGaNsCARJTyxmHIZc">



						



					</div>











					<div class="input-group btnLogo">



						<input type="submit" value=" إضافة الكتاب"  class="btn btn-success btn-lg ">



					</div>







				</form>







			</div>



		</div>



	</div>



<script>



document.forms[0].addEventListener('submit', function( evt ) {



    var file = document.getElementById('file').files[0];



    if(file && file.size > 1048576) { // 10 MB (this size is in bytes)

    	 alert("حجم الصورة كبير فضلا حاول تحميل الصورة من صور قوقل او قم بتصغيرها ثم ارفعها من جديد");   

        //Prevent default and display error

        evt.preventDefault();

           

    } 



}, false);

</script>





<script src='https://www.google.com/recaptcha/api.js'></script>



<?php







include $tmpl . 'footer.php';







}else {







	header('Location:login.php');



	exit();



}











 ?>