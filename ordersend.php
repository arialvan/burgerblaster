<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* ===========================================================================
 * BURGER MINI 
 * ===========================================================================
*/
if(isset($_POST['mini'])){ 
    @$mini    = $_POST['mini'];
    $qty0     = $_POST['qty0'];
    foreach(@$mini as $key => $value){
                echo @$mini[$key]; echo '<br />';
                echo $qty0[$key];
            }           
}
/* ===========================================================================
 * BURGER MEDIUM
 * ===========================================================================
*/
if(isset($_POST['medium'])){
    @$medium  = $_POST['medium'];
    $qty1     = $_POST['qty1'];
    foreach(@$medium as $key => $value){
                echo @$medium[$key]; echo '<br />';
                echo @$qty1[$key];
            }           
}

/* ===========================================================================
 * BURGER JUMBO
 * ===========================================================================
*/
if(isset($_POST['jumbo'])){
    @$jumbo   = $_POST['jumbo']; 
    @$qty2     = $_POST['qty2'];
    foreach(@$jumbo as $key => $value){
                echo @$jumbo[$key]; echo '<br />';
                echo @$qty2[$key];
            }           
}

/* ===========================================================================
 * DIMSUM
 * ===========================================================================
*/
if(isset($_POST['dimsum'])){         
    @$dimsum  = $_POST['dimsum'];
    $qty3     = $_POST['qty3'];
    foreach(@$dimsum as $key => $value){
                echo @$dimsum[$key]; echo '<br />';
                echo @$qty3[$key];
            }           
}


/* ===========================================================================
 * minuman panas
 * ===========================================================================
*/
    if(isset($_POST['panas'])){
        @$panas=$_POST['panas'];
        $qty4     = $_POST['qty4'];
        foreach(@$panas as $key => $value){   
            echo @$panas[$key]; echo '<br />';
            echo $qty4[$key];
        }
    }

/* ===========================================================================
 * minuman dingin
 * ===========================================================================
*/
    if(isset($_POST['dingin'])){
        @$dingin=$_POST['dingin'];
        $qty5     = $_POST['qty5'];
        foreach(@$dingin as $key => $value){
            echo @$dingin[$key]; echo '<br />';
            echo $qty5[$key];
        }
    }
    
/* ===========================================================================
 * minuman botol
 * ===========================================================================
*/
    if(isset($_POST['botol'])){
        @$botol=$_POST['botol'];
        $qty6     = $_POST['qty6'];
        foreach(@$botol as $key => $value){
            echo @$botol[$key]; echo '<br />';
            echo $qty6[$key];
        }
    }

/* ===========================================================================
 * Pesan
 * ===========================================================================
*/echo @$pesan=$_POST['pesan'];
    
?>
