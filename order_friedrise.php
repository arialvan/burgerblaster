<div class="table-responsive tab-pane fade" id="friedrise">        
                    <div class="panel-body">
                        
                             <div class="row"> 
                                  <?php
                                    $id=$_SESSION['IDOT'];
                                    $no=0;
                                    $stmt=$con->prepare("SELECT * FROM product where id_outlet=:id_outlet AND jenis=12 ");
                                    $stmt->bindValue(':id_outlet', $id, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                    $jumData=$stmt->rowCount();
                                   while($key = $stmt->fetch()){ 
                                       
                                   ?>  
                                 
                                    <div class="col-sm-6 col-md-4">
                                        <div class="panel panel-default">
                                                <label class="btn btn-primary"><img src="blester/<?php echo $key['product_foto'] ?>"  class="img-rounded img-check" width="280" height="230" />
                                                    <input type="checkbox" id="item4" value="<?php echo $key['id_product']; ?>" class="hidden" autocomplete="off" />
                                                    <input type="text" name="id_product[]" id="item4" value="<?php echo $key['id_product']; ?>" class="hidden" autocomplete="off" />
                                                </label>

                                                <div class="caption ">
                                                    <h5 class="text-danger"><?php echo $key['product_name'] ?></h5>
                                                    <h5 class="text-danger"><?php echo rupiah($key['unit_price']); ?></h5>                                      
                                                </div>
                                                    <span class="text-center">Add Quantity</span>
                                                        <div class="input-group text-center">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-white btn-minuse" type="button">-</button>
                                                            </span>
                                                            <input type="text" name="qty[]" class="form-control no-padding add-color text-center height-25" value="0" /> 
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-red btn-pluss" type="button">+</button>
                                                            </span>
                                                        </div> 
                                        </div>
                                    </div>
                            <?php } ?>
                            </div> 
                            <span class="top-link-block" class="hidden">
                                <a href="#top" class="well well-sm"  onclick="$('html,body').animate({scrollTop:0},'fast');return false;">
                                    <i class="glyphicon glyphicon-chevron-up"></i> Back to Top
                                </a>
                            </span>
                        </div>
                    </div>