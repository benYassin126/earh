<?php



SESSION_START();







$PageTitle = "إعارة";



include 'init.php';



























 	if (isset($_GET['city'])){







 		$TheCity = $_GET['city'];



 		







 	 	$stmtForBooks = $db->prepare("



		SELECT books.* , users.FullName AS FullName



		FROM 



		books



		INNER JOIN 



		users



		ON 



		users.UserID = books.UserID



		WHERE books.city = ?



	    ORDER BY bookID DESC");



 	$stmtForBooks->execute(Array($TheCity)); //execute statment



 	$rowForBooks = $stmtForBooks->fetchAll(); // Get Data In Array







 	}else {



 		







 	$stmtForBooks = $db->prepare("



		SELECT books.* , users.FullName AS FullName



		FROM 



		books



		INNER JOIN 



		users



		ON 



		users.UserID = books.UserID



	    ORDER BY bookID DESC");



 	$stmtForBooks->execute(); //execute statment



 	$rowForBooks = $stmtForBooks->fetchAll(); // Get Data In Array







 	}







 	







 	if (isset($_GET['tag']) && !isset($_GET['city'])){







 		$TheTg = $_GET['tag'];



 		



 	$stmtForBooks = $db->prepare("



		SELECT books.* , users.FullName AS FullName



		FROM 



		books



		INNER JOIN 



		users



		ON 



		users.UserID = books.UserID



		WHERE books.Category = ?



	    ORDER BY bookID DESC");



 	$stmtForBooks->execute(Array($TheTg)); //execute statment



 	$rowForBooks = $stmtForBooks->fetchAll(); // Get Data In Array











 	}elseif(!isset($_GET['tag']) && !isset($_GET['city']) || $_GET['city'] == "جميع المدن" ) {



 		



 	$stmtForBooks = $db->prepare("



		SELECT books.* , users.FullName AS FullName



		FROM 



		books



		INNER JOIN 



		users



		ON 



		users.UserID = books.UserID



	    ORDER BY bookID DESC");



 	$stmtForBooks->execute(); //execute statment



 	$rowForBooks = $stmtForBooks->fetchAll(); // Get Data In Array







 	}











?> 











<div class="indexStyle">



	<div class="container">



		<div class="UpContent">



			<div class="ChoseCity">







				<select name="forma" onchange="location = this.value;">



					<option> اختيار المدينة



					</option>



					<option  value="?city=جميع المدن">جميع المدن</option>



					<option value="?city=تبوك"  >تبوك   </option>



					<option value="?city=الرياض">الرياض</option>



					<option value="?city=مكة المكرمة">مكة المكرمة</option>



					<option value="?city=المدينة المنورة">المدينة المنورة</option>



					<option value="?city=جدة"  >جدة</option>



					<option value="?city=الطائف"  >الطائف</option>



					<option value="?city=القصيم">القصيم</option>



					<option value="?city=الدمام" >الدمام</option>



					<option value="?city=الاحساء"  >الاحساء   </option>



					<option value="?city=ابها">ابها</option>



					<option value="?city=حائل">حائل</option>



					<option value="?city=نجران">نجران</option>



					<option value="?city=الباحة">الباحة</option>



					<option value="?city=الجوف">الجوف</option>



				</select>



			</div>







			<div class="SetOfButtns">







				<a href="addbook.php"> <button class="btn btn-success"><i class="fas fa-plus"></i> اضف كتابك   </button></a>



					<ul>



					<li class=''><a href="index.php?tag=جامعي" class="btn btn-default <?php if (isset($_GET['tag']) && $_GET['tag'] == "جامعي"){







					echo "ActiveTag";



					} 





					?>">جامعي</a></li>









					<li><a href="index.php?tag=اسلامي" class="btn btn-default <?php if (isset($_GET['tag']) && $_GET['tag'] == "اسلامي"){







					echo "ActiveTag";



					} 







					?>">اسلامي</a></li>











					<li><a href="index.php?tag=اطفال" class="btn btn-default <?php if (isset($_GET['tag']) && $_GET['tag'] == "اطفال"){







					echo "ActiveTag";



					} 







					?>">اطفال</a></li>









					<li><a href="index.php?tag=ادبي" class="btn btn-default <?php if (isset($_GET['tag']) && $_GET['tag'] == "ادبي"){







					echo "ActiveTag";



					} 





					?>">ادبي</a></li>



					<li><a href="index.php?tag=علمي" class="btn btn-default <?php if (isset($_GET['tag']) && $_GET['tag'] == "علمي"){







					echo "ActiveTag";



					} 







					?>">علمي</a></li>



					<li><a href="index.php?tag=قصص وروايات" class="btn btn-default <?php if (isset($_GET['tag']) && $_GET['tag'] == "قصص وروايات"){







					echo "ActiveTag";



					} 







					?>">قصص وروايات</a></li>



					<li><a href="index.php?tag=تطوير ذات" class="btn btn-default <?php if (isset($_GET['tag']) && $_GET['tag'] == "تطوير ذات"){







					echo "ActiveTag";



					} 







					?>">تطوير ذات</a></li>



				</ul>



			</div>



		</div>







		<?php 







		if (!empty($rowForBooks)) {







			echo "<div class='DownContent'>";



			foreach ($rowForBooks as $book) {



			    



				$BookDate = time() - strtotime($book['Date']) ;



				$BookinDays = secondsToTime($BookDate);



				$PrintDate = $BookinDays;



				



				if ($BookinDays == 0) {	



				$PrintDate = 'اليوم';



				}elseif($BookinDays == 1) {



				$PrintDate = 'امس';



				}elseif ($BookinDays == 2) {



				$PrintDate = "قبل يومين";



				}elseif ($BookinDays >= 3 && $BookinDays <= 10) {



				$PrintDate = "قيل " . $BookinDays . " ايام  ";



				}else{



				$PrintDate = 'قبل ' . $BookinDays .' يوم ';



				}







				



					echo "<div class='oneBook'>";



						echo "<div class='row'>";



							echo "<div class='col-sm-6 pull-left'>";



								echo "<div class='LeftCont'>";



									if ($book['Status'] == 1) {

										echo "<a href='viewbook.php?bookid=" . $book['BookID']  . "  '> <h4> <del>"  .  $book['BookName'] . "</del></h4></a>";

									}else {

										echo "<a href='viewbook.php?bookid=" . $book['BookID']  . "  '> <h4>"  .  $book['BookName'] . "</h4></a>";

									}



									echo "<span class='LocitonofBook'> <a href='index.php?city=" .   $book['City']  . "'>  <i class='fas fa-map-marker-alt'></i>  " .  $book['City'] .  "  </a> </span>";
									echo "<span><i class='fas fa-clock'></i>  " .	$PrintDate  . " </span>";
									echo "<span class='UserSetBook'><i class='fas fa-user'></i>" .  $book['FullName'] . "</span>";



								echo "</div>";



							echo "</div>";







							echo "<div class='col-sm-6'>";



								echo "<div class='RightCont'>";







									echo "<a href='viewbook.php?bookid=" . $book['BookID']  . "  '><img class='spficimg' src='upload/Item/".  $book['Book_img'] ."'></a>";



									//echo "<img src='upload/Item/279__t.gif'>";







								echo "</div>";



							echo "</div>";	



						echo "</div>";



					echo "</div>";



			}



		}else {



			echo "<p class='alert alert-danger text-center'>ليس هنالك كتاب !</p>";



		}















			?>



		</div>



	</div>



</div>







<?php







include $tmpl . 'footer.php';











 ?>