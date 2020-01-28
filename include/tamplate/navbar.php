

<nav class="navbar">
  <div class="container">
    <div class="navContent">
      <ul class="nav navbar-nav">

        <?php
          if (!isset($_SESSION['UserPhoneSession'])) {

              echo  "<li>";
                echo " <a href='login.php' class='btn btn-Secondary'>  <i class='fas fa-sign-in-alt'></i>دخول </a>";
              echo " </li>";
            # code...
          }else {

       echo "<li>";
        echo"<a  data-toggle='tooltip'  title='تسجيل خروج' href='logout.php'> <i class='fas fa-sign-out-alt'></i> </a>";
       echo " </li>";
       echo "<li>";
        echo"<a  data-toggle='tooltip'  title=' تعديل الملف الشخصي' href='profile.php'> <i class='fas fa-cog'></i> </a>";
       echo " </li>";



          }


         ?>


        <li>
           <a onclick="openNav()" data-toggle="tooltip" title="إضافة كتاب" href="#"><i  class="fas fa-plus"></i></a>
       </li>

      </ul>
      <ul class="logo nav navbar-right">
        <li><a href="index.php"><h1> إعارة</h1> </a> </li>
      </ul>
      
    </div>
  </div>
</nav>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="ManageBooks text-center">
    <h1>إعارة || Earh</h1>
    <hr class="LineTitle">
    <a href='addbook.php' class='btn btn-Secondary btn-lg'>  <i  class="fas fa-plus"></i> إضافة كتاب  </a>
     <a href='managebook.php' class='btn btn-Secondary btn-lg'>  <i class='fas fa-cog'></i> إدارة كتبي  </a>
     <a href='profile.php' class='btn btn-Secondary btn-lg'>  <i class='fas fa-user-circle'></i> ملفي الشخصي   </a>

  </div>
</div>

<div onclick="closeNav()">
  




