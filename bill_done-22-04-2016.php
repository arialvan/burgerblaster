<?php
include"userotentifikasi.php";
if($_SERVER['REQUEST_METHOD']=='GET'){
include "crud/class_crud.php";
include "connection.php";
$db = new crud();           

$tabel = "order_first";
$tabel2 = "order_detail";
$tabel3 = "meja";

            $fild  = $_GET['id'];
            $where = "id_pes='".$fild."'"; 
            $status= 3;
            $data = array( 'status' => $status );
            $db->update($tabel,$data,$where);
            
            
            $where2 = "id_pes='".$fild."'"; 
            $data2  = array( 'status_detail' => $status );
            $db->update($tabel2,$data2,$where2);

//=========================
// Perkalian Quantity
//========================= 
$fild_order  = "product_code";
        $where_order = "id_pes='$fild' ";
        $db->select($tabel2,$fild_order,NULL,$where_order);
        $hasil_order=$db->getResult();
        foreach ($hasil_order as $key_order){
                 $id_product[]=$key_order['product_code']; // order_detail=product_code
        }
        
        foreach ($id_product as $key_pro => $values){   
            $id_pro=$id_product[$key_pro];
            
            $order_detail  ="order_detail";
            $product_detail="product_detail";
            $outlet_stock="outlet_stock";
            $material    ="material";
            
            $join  ="$order_detail join $product_detail ON $order_detail.product_code=$product_detail.id_product";
            $fields=" *, ($order_detail.qty*$product_detail.stock_qty) AS Perkalian";  
            $wheres="$product_detail.id_product='$id_pro' AND $order_detail.id_pes='$fild'";
            $db->select($join,$fields,NULL,$wheres);
            $hasils=$db->getResult();
            foreach($hasils as $key_detail){
            $x=$key_detail['Perkalian']; // hasil perkalian quantity
                    
//=========================
// Pengurangan Stok
//========================= 
                $sql = $con->exec("UPDATE $outlet_stock SET qty_stock_outlet=qty_stock_outlet-$x WHERE id_stock_outlet='$key_detail[id_stock_outlet]'");  
                
//=========================
// Pengeluaran 
//=========================    
                                $join_out  ="$material join $outlet_stock ON $material.id_material=$outlet_stock.id_material";
                                $fields_out=" *, ($material.price*$x) AS Total";  
                                $wheres_out="$material.id_material='$key_detail[id_material]'";
                                $db->select($join_out,$fields_out,NULL,$wheres_out);
                                $hasils_out=$db->getResult(); 
                                foreach($hasils_out as $key_out){
                                        $total_mp[]=$key_out['Total'];
                                 
                                }
                                
                            }
                            
                        }
                       echo $ex= array_sum($total_mp);
                        $material_purchase="material_purchase";
                                $date=date('Y-m-d');
                                $data = array( 'tgl_mp' => $date,
                                               'total_mp' => $ex
				  );
                                $db->insert($material_purchase, $data);
            
            


//=========================
//Save to table order done
//=========================          
$table5 = "order_detail JOIN product ON order_detail.product_code=product.id_product";
        $fild5  = "*,DATE(order_detail.date_time) AS Tgl";
        $where5 = "order_detail.id_pes='$_GET[id]'";
        $db->select($table5,$fild5,NULL,$where5);
        $hasil5=$db->getResult();
        foreach ($hasil5 as $key5){
            $id_ot=$key5['id_outlet'];
            $id_pro=$key5['product_code'];
            $qty=$key5['qty'];
            $date_od=$key5['Tgl'];
            $prices=$key5['unit_price'];
            
            $totalharga=($qty*$prices);
                  
        //Insert ke tabel order done
                    $tabels="order_done";
                    $datas = array( 'id_ordone' => $key5['id_index_pes'],
                                    'id_product' => $id_pro, 
                                    'id_outlet' => $id_ot,
                                    'date_done' => $date_od,
                                    'qty_done' => $qty,
                                    'price_done' => $prices,
                                    'total' => $totalharga );
                    $db->insert($tabels, $datas);
                      
        }
//Update Status Meja
$id_meja=$_GET['id_meja'];
$sts_meja=0;
    $where3= "id_meja='$id_meja'";
    $data3 = array( 'status' => $sts_meja );
    $db->update($tabel3,$data3,$where3);
    
          echo"Success";
	  $url="order_bill_role.php";
	  echo "<meta http-equiv=\"REFRESH\" content=\"0;url=$url\">";
}else{
    echo "No Data Get";
}

?>

