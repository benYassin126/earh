<?php



SESSION_START();







$PageTitle = "إعارة";







include 'init.php';







if(isset($_GET['bookid']) && is_numeric($_GET['bookid'])) {







	$bookid = $_GET['bookid'];









 	 $stmtForBooksAndUser = $db->prepare("



 			SELECT books.* , users.UserID , users.NumberPhone , users.FullName



	 		FROM 



	 		books



	 		INNER JOIN 



	 		users



	 		ON 



	 		users.UserID = books.UserID



	 	    WHERE books.BookID = ?");







 	$stmtForBooksAndUser->execute(array($bookid)); //execute statment



 	$rowForBooksAndUser = $stmtForBooksAndUser->fetchAll(); // Get Data In Array



 	$count = $stmtForBooksAndUser->rowCount();







 	if ($count > 0) {











 		//if there are book



 		?>











 		<div class="uperConteent">



 			<div class="container">



 				<?php 







 				$BookID = $_GET['bookid'];







 				if (isset( $_SESSION['UserIDSession'])) {







 				$UserID = $_SESSION['UserIDSession'];







 				}else {







 				$UserID = null;



 				}



				



				$statmentt = $db->prepare("SELECT * FROM books WHERE BookID = ? AND UserID = ? ");



			 	$statmentt->execute(array($BookID , $UserID)); //execute statment



			 	$roww = $statmentt->fetch(); // Get Data In Array



			 	$countt = $statmentt->rowCount(); // return number of colume that executed















 				foreach ($rowForBooksAndUser as $book) {



 					 	echo "<img class='img-responsive' alt='NO img' src='upload/Item/".  $book['Book_img'] ."'>";



 					 	echo "<hr class='LineTitle'>";



 					 	if ($countt == 1 ) {



							echo "<h4 class='text-center'> كتاب  [ " .  $book['BookName'] ."	]  || <a href='managebook.php'><i class='fa fa-edit'></i></a>  </h4>";

			 			}else{

								if ($book['Status'] == 1) {

										echo "<h4 class='text-center'> <del>كتاب  [ " .  $book['BookName'] ."	] </del>||  <span style='color:red;font-weight: normal;'>تمت اعارة هذا الكتاب</span> </h4>";

									}else {

										echo "<h4 class='text-center'> كتاب  [ " .  $book['BookName'] ."	] </h4>";

									}

			 				

			 			}







 					 echo "</div>";



 					# code...



 				}



 				?>







 			<div class="downerConntent">



 				<div class="container">







 				<?php







 				foreach ($rowForBooksAndUser as $book) {



 				    



 				    			    



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



				$PrintDate = 'قبل ' . $BookinDays .' يوم';



				}



 					 	echo "<ul>";



 					 		echo "<li><i class='fas fa-globe'></i> في <a href='index.php?city=" .   $book['City']  . "'>   ".  $book['City'] . "</a></li>";



 					 	 	echo "<li><i class='fas fa-clock'></i>اعارة لمدة :" .   $book['Time']  ." اشهر</li>";



 					 	 	



 					 		echo "<li><i class='fas fa-calendar'></i> اضيفت  :" . $PrintDate   ."  </li>";



 					 		echo "<li><i class='fas fa-user'></i>	 " .  $book['FullName']  . " [	 جوال 	<a href='tel:	"  . $book['NumberPhone']   ."'>"  .	$book['NumberPhone']  . 	"</a>	]  



 					 		



 					 		||  <a href='https://api.whatsapp.com/send?phone=966"  .  $book['NumberPhone'] . "'>[ <i class='fab fa-whatsapp'></i>  واتساب  </a>] </li>";



 					 	echo "</ul>";



 					# code...



 				}















 				 ?>



	 				

 		

 				</div>







 			</div>



 		</div>





 <p class="text-center" style="color: #05bbd2;">للحصول على الكتاب تواصل مع صاحبه</p>













 		<?php











 	}else {







 		//if book not found



  		



  		



    echo "<script type='text/javascript'>



    



      		    window.setTimeout(function(){



                window.location.href = 'index.php';







    }, 2000);



    



    </script>"; 



    exit;







 	}







	}else{



		//if $_GET not number or incorrect



  		



  		



    echo "<script type='text/javascript'>



    



      		    window.setTimeout(function(){



                window.location.href = 'index.php';







    }, 2000);



    



    </script>"; 



    exit;



	}







?> 























<?php







include $tmpl . 'footer.php';











 ?>