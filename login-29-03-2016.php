<?php
include"header.php";
?>

    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2>BLASTER BURGER</h2>
               
                <h5>( Login yourself to get access )</h5>
                 <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>   Enter Details To Login </strong>  
                            </div>
                            <div class="panel-body">
                                <form action="loginsys.php" method="post" >
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" name="username" class="form-control" placeholder="Your Username " />
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="password" class="form-control"  placeholder="Your Password" />
                                        </div>
                                    <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" /> Remember me
                                            </label>
                                            <!--<span class="pull-right">
                                                   <a href="#" >Forget password ? </a> 
                                            </span>-->
                                        </div>
                                     
                                     <input type="submit" class="btn btn-primary" value="Login Now">
                                    <hr />
                                    <!-- Not register ? <a href="registeration.html" >click here</a> -->
                                    <small class="text-success">Blaster the real experts Burger & Dimsum</small>
                                    </form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>
<?php
include"footer.php";
?>
