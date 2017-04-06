<?php
        // Pengeluaran Query
         $stmt12=$con->prepare("SELECT date_done, SUM(total) AS Masuk FROM order_done where id_outlet='$outlet' GROUP BY DAY(date_done) ASC");
            $stmt12->execute();
            $stmt12->setFetchMode(PDO::FETCH_ASSOC);	
            while($key2 = $stmt12->fetch()){
                  $y2[] = $key2['date_done'];
                  $a2[] = $key2['Masuk'];
            }
        
        $stmt3=$con->prepare("SELECT SUM(total_mp) AS ttmp FROM material_purchase where id_outlet='$outlet' GROUP BY DAY(tgl_mp) ASC");
        
        //$stmt->bindValue(':id_outlet', $outlet, PDO::PARAM_STR);
        $stmt3->execute();
        $stmt3->setFetchMode(PDO::FETCH_ASSOC);	
        while($key3 = $stmt3->fetch()){
              $b3[]=ceil($key3['ttmp']);
        }
        
        $json_data2=array();
        foreach ($y2 as $rec3 => $var3)
                {
                    $json_array2['xx']=$y2[$rec3];
                    $json_array2['a']=$a2[$rec3];
                    $json_array2['b']=$b3[$rec3];
                    array_push($json_data2, $json_array2);
                }
            $json2=json_encode($json_data2);
    ?>
    <script type="text/javascript">
         /*====================================
            MORRIS BAR CHART Y=bulan a=pendapatan
         ======================================*/
            Morris.Line({
                element: 'morris-line-chart',
                data: <?php echo $json2; ?>,
                xkey: 'xx',
                ykeys: ['a', 'b'],
                labels: ['Penjualan', 'Bahan Baku'],
                resize: true
            });
            
    </script>