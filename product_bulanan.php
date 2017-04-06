<?php
        // Pengeluaran Query
         $stmt1=$con->prepare("SELECT product.product_name,order_done.id_product,SUM(order_done.qty_done) AS QTY FROM product JOIN order_done ON
                               product.id_product=order_done.id_product 
                               where order_done.id_outlet='$outlet' AND MONTH(order_done.date_done)='$bulan' AND YEAR(order_done.date_done)='$tahun' GROUP BY order_done.id_product ASC ");
            $stmt1->execute();
            $stmt1->setFetchMode(PDO::FETCH_ASSOC);	
            while($key5 = $stmt1->fetch()){
                  $y5[] = $key5['product_name'];
                  $a5[] = $key5['QTY'];
                  //$b5[] = $key5['product_name'];
            }
        
        $json_data=array();
        foreach ($y5 as $rec5 => $var)
                {
                    $json_array['yy']=$y5[$rec5];
                    $json_array['ay']=$a5[$rec5];
                    //$json_array['by']=$b5[$rec5];
                    array_push($json_data, $json_array);
                }
            $json=json_encode($json_data);
    ?>
    <script type="text/javascript">
         /*====================================
            MORRIS BAR CHART Y=bulan a=pendapatan
         ======================================*/
            Morris.Bar({
                element: 'morris-bar-chart',
                data: <?php echo $json; ?>,
                xkey: 'yy',
                ykeys: ['ay'],
                labels: ['Quantity'],
                resize: true
            });
            
    </script>