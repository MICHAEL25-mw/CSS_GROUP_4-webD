<?php

      $conn = new mysqli('localhost', 'root','');
         if($conn->connect_error){
            die ('failed to connect : '. $conn->connect_error);
         }
         
         $database = $conn->query('create database if not exists allocation');
         if(!$database){
            die (' failed to create db : '. $conn->connect_error);
         }
         $dbConn = new mysqli('localhost','root','','allocation');
         if($dbConn->connect_error){
            die ('failed to connect to db : '. $dbConn->connect_error);
         }

         
         
            
