<?php  
 $connect = mysqli_connect("localhost", "root", "", "testing");  
 if($_POST["postId"] != '')  
 {  
      //update post  
      $sql = "UPDATE tbl_post SET post_title = '".$_POST["postTitle"]."', post_description = '".$_POST["postDescription"]."' WHERE post_id = '".$_POST["postId"]."'";  
      mysqli_query($connect, $sql);  
 }  
 else  
 {  
      //insert post  
      $sql = "INSERT INTO tbl_post(post_title, post_description, post_status) VALUES ('".$_POST["postTitle"]."', '".$_POST["postDescription"]."', 'draft')";  
      mysqli_query($connect, $sql);  
      echo mysqli_insert_id($connect);  
 }  
 ?>  