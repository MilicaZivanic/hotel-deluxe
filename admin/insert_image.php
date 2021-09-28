<?php

    if(isset($_POST['insert_image'])){
        $room_id = $_POST['room'];
        $room_image = $_FILES['room_image']['name'];
        $temp_name = $_FILES['room_image']['tmp_name'];
        move_uploaded_file($temp_name,"../images/$room_image");

        $imageRexeg = "/[\/.](gif|jpg|jpeg|tiff|png)$/";

        $errors = [];

        if(!preg_match($imageRexeg, $room_image) || (empty($room_image))){
            $errors[] = 1;
        }
        if($room_id == "0"){
            $errors[] = 1;
        }
        if(count($errors) > 0){
            http_response_code(404);   
        }else{
            $queryInsert = "INSERT INTO room_images
                        VALUES(null, :room_image, :room_id )";
            $prepare = $conn->prepare($queryInsert);
            $prepare->bindParam(":room_image", $room_image);
            $prepare->bindParam(":room_id", $room_id);
            try{
            $result = $prepare->execute();
            echo "<script>alert('Room Image has been inserted sucessfully')</script>";
            echo "<script>window.open('index.php?view_images','_self')</script>";
            }catch(PDOException $ex){
                //
            }
        }

    }

?>

<div class="row">
    <div class="col-lg-12">       
        <ol class="breadcrumb">          
            <li class="active">               
                <i class="fa fa-dashboard"></i> Dashboard / Insert Room Image              
            </li>
        </ol>   
    </div>  
</div>       
<div class="row">   
    <div class="col-lg-12">       
        <div class="panel panel-default">           
           <div class="panel-heading">              
               <h3 class="panel-title">                  
                   <i class="fa fa-money fa-fw"></i> Insert Image                
               </h3>             
           </div>          
           <div class="panel-body">              
               <form method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>" onSubmit="return insertImage();" class="form-horizontal" enctype="multipart/form-data">            
                   <div class="form-group">                      
                      <label class="col-md-3 control-label"> Room Number: </label>                     
                      <div class="col-md-6">                        
                          <select name="room" class="form-control" id="room">                            
                              <option value="0"> Select A Room </option> 
                              <?php
                                $query = "SELECT * from room";
                                $result = $conn->query($query)->fetchAll(); 
                                foreach($result as $r):                         
                              ?>
                              <option value="<?= $r->id ?>"> <?= $r->number ?> </option> 
                                <?php endforeach; ?>                                                                                                                                                                                                 
                          </select>                        
                      </div>                     
                   </div> 
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Image </label>                     
                      <div class="col-md-6">                        
                        <input  id="roomimage" name="room_image" type="file" class="form-control"/>                        
                      </div>                     
                    </div>
                    <div class="form-group">                      
                       <label class="col-md-3 control-label"></label>                      
                       <div class="col-md-6">                         
                           <input name="insert_image" value="Insert Image" type="submit" class="btn btn-primary form-control">                          
                       </div>                      
                    </div>           
               </form>              
           </div>       
        </div>      
    </div>   
</div>