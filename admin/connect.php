<?php



    $dsn = "mysql:host=localhost;dbname=eaarzocg_earh"; //For Data Source Name We Will Use It As Parameter



    $user ="eaarzocg_earhUser"; // For User We Will Use It As Parameter



    $pass="0543925157"; // if We Have Pass We Will Use It As Parameter



    $options = array (



        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" // For Ababic DataBase



         ); // Colliction Of Optaions For Good Connect



    try {



            $db = new PDO ($dsn , $user , $pass , $options); // Start Connect To DataBase



            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // Set Exception Mode





    } catch (PDOException $e) {



        echo  $e->getMessage(); // print Erorr Message

    }



 ?>