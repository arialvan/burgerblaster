<?php
include"userotentifikasi.php";
include "crud/class_crud.php";
$db = new crud();
if(isset($_SESSION['IDPES'])){
            
            $tabel = "order_first";
            $fild  = $_SESSION['IDPES'];
            $where = "id_pes='".$fild."'"; 
            $status= 1;
            $data = array( 'status' => $status );
            $db->update($tabel,$data,$where);
            
            $tabel2 = "order_detail";
            $fild2  = $_SESSION['IDPES'];
            $where2 = "id_pes='".$fild2."'"; 
            $data2  = array( 'status_detail' => $status );
            $db->update($tabel2,$data2,$where2);
    // Unset Session IDPES
            unset($_SESSION['IDPES']);
            
            echo"<h3>Order Success</h3>";
            
    //Penentuan session_role
            $table_ses = "session_menu";
            $fild_ses  = "*"; 
            $where_ses = "id_outlet='$_SESSION[IDOT]'";
            $db->select($table_ses,$fild_ses,NULL,$where_ses);
            $hasil_ses=($db->getResult());
            foreach($hasil_ses as $key_ses);
            if($key_ses['role_session']==2){
                $url="order_bill_role.php";
                echo "<meta http-equiv=\"REFRESH\" content=\"0;url=$url\">";
            }else{
                $url="order_bill.php";
                echo "<meta http-equiv=\"REFRESH\" content=\"0;url=$url\">";
            }
}else{
    echo "No SESSION";
}

?>

