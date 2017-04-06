<html>  
      <head>  
           <meta name="viewport" content="initial-scale=1.0, user-scalable=no">  
           <meta charset="utf-8">  
           <title>Webslesson Tutorial</title>  
           <script src="jquery.js"></script>  
           <script src="js/bootstrap.js"></script>  
           <link href="css/bootstrap.css" rel="stylesheet" />  
      </head>  
      <body>  
           <div class="container">  
                <br />  
                <h2 align="center">Auto Save Data using Ajax, Jquery, PHP and Mysql</h2>  
                <br />  
                <div class="form-group">  
                     <label>Enter Post Title</label>  
                     <input type="text" name="post_title" id="post_title" class="form-control" />  
                </div>  
                <div class="form-group">  
                     <label>Enter Post Description</label>  
                     <textarea name="post_description" id="post_description" rows="6" class="form-control"></textarea>  
                </div>  
                <div class="form-group">  
                     <input type="hidden" name="post_id" id="post_id" />  
                     <div id="autoSave"></div>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      function autoSave()  
      {  
           var post_title = $('#post_title').val();  
           var post_description = $('#post_description').val();  
           var post_id = $('#post_id').val();  
           if(post_title != '' && post_description != '')  
           {  
                $.ajax({  
                     url:"save_post.php",  
                     method:"POST",  
                     data:{postTitle:post_title, postDescription:post_description, postId:post_id},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          if(data != '')  
                          {  
                               $('#post_id').val(data);  
                          }  
                          $('#autoSave').text("Post save as draft");  
                          setInterval(function(){  
                               $('#autoSave').text('');  
                          }, 2000);  
                     }  
                });  
           }            
      }  
      setInterval(function(){   
           autoSave();   
           }, 10000);  
 });  
 </script>  