<?php
        // Pengeluaran Query
         $stmt1=$con->prepare("SELECT SUM(total) AS income,MONTH(date_done) AS Month FROM order_done where id_outlet='$outlet' GROUP BY MONTH(date_done) ASC");
            $stmt1->execute();
            $stmt1->setFetchMode(PDO::FETCH_ASSOC);	
            while($key = $stmt1->fetch()){
                  $y[] = $key['Month'];
                  $a[] = $key['income'];
            }
        
        $stmt=$con->prepare("SELECT SUM(total_mp) AS spend FROM material_purchase where id_outlet='$outlet' GROUP BY MONTH(tgl_mp) ASC
                            ");
        
        //$stmt->bindValue(':id_outlet', $outlet, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);	
        while($key = $stmt->fetch()){
              $b[]=ceil($key['spend']);
        }
        
        $json_data=array();
        foreach ($y as $rec => $var)
                {
                    $json_array['y']=$y[$rec];
                    $json_array['a']=$a[$rec];
                    $json_array['b']=$b[$rec];
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
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Penjualan', 'Bahan Baku'],
                resize: true
            });
    </script>