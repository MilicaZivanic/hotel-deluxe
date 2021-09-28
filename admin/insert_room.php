<?php

    if(isset($_POST['insert_room'])){
        $room_number = $_POST['room_number'];
        $room_size = $_POST['room_size'];
        $num_people = $_POST['num_people'];
        $num_beds = $_POST['num_beds'];
        $room_cover = $_FILES['room_cover']['name'];
        $temp_name = $_FILES['room_cover']['tmp_name'];
        move_uploaded_file($temp_name,"../images/$room_cover");
        $room_type = $_POST['room_type'];
        $view = $_POST['view'];
        $desc = $_POST["description"];

        $numRegex = "/^[0-9]*$/";
        $imageRexeg = "/[\/.](gif|jpg|jpeg|tiff|png)$/";

        $errors = [];

        if(!preg_match($numRegex, $room_number) || (empty($room_number))){
            $errors[] = 1;
        }
        if(!preg_match($numRegex, $room_size) || (empty($room_size))){
            $errors[] = 1;
        }
        if(!preg_match($numRegex, $num_people) || (empty($num_people))){
            $errors[] = 1;
        }
        if(!preg_match($numRegex, $num_beds) || (empty($num_beds))){
            $errors[] = 1;
        }
        if(!preg_match($imageRexeg, $room_cover) || (empty($room_cover))){
            $errors[] = 1;
        }
        if($room_type == "0"){
            $errors[] = 1;
        }
        if($view == "0"){
            $errors[] = 1;
        }
        if(empty($desc)){
            $errors[] = 1;
        }
        if(count($errors) > 0){
            http_response_code(404);   
        }else{
            $queryInsert = "INSERT INTO room 
                        VALUES(null, :room_number, :room_size, :num_people, :num_beds, :room_cover, :desc, :view, :room_type )";
            $prepare = $conn->prepare($queryInsert);
            $prepare->bindParam(":room_number", $room_number);
            $prepare->bindParam(":room_size", $room_size);
            $prepare->bindParam(":num_people", $num_people);
            $prepare->bindParam(":num_beds", $num_beds);
            $prepare->bindParam(":room_cover", $room_cover);
            $prepare->bindParam(":desc", $desc);
            $prepare->bindParam(":view", $view);
            $prepare->bindParam(":room_type", $room_type);
            try{
            $result = $prepare->execute();
            echo "<script>alert('Room has been inserted sucessfully')</script>";
            echo "<script>window.open('index.php?view_rooms','_self')</script>";
            }catch(PDOException $ex){
                $_SESSION['errorInserted'] = "The room with this number already exists";
            }
        }

    }

?>

<div class="row">
    <div class="col-lg-12">       
        <ol class="breadcrumb">          
            <li class="active">               
                <i class="fa fa-dashboard"></i> Dashboard / Insert Room               
            </li>
        </ol>   
    </div>  
</div>       
<div class="row">   
    <div class="col-lg-12">       
        <div class="panel panel-default">           
           <div class="panel-heading">              
               <h3 class="panel-title">                  
                   <i class="fa fa-money fa-fw"></i> Insert Room                 
               </h3>             
           </div>          
           <div class="panel-body">              
               <form method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>" onSubmit="return insertUpdateRoom();" class="form-horizontal" enctype="multipart/form-data">
                    <?php
                        if(isset($_SESSION['errorInserted'])):?>
                        <div class="form-group">                     
                            <div class="col-md-12" style="text-align:center">                        
                                <h3 class=""><?php echo ($_SESSION['errorInserted']); ?></h3>                        
                            </div>                     
                        </div>   
                        <?php 
                        unset($_SESSION['errorInserted']);
                        endif;?>             
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Room Number: </label>                     
                      <div class="col-md-6">                        
                          <input name="room_number" id="room_number" type="text" class="form-control">                        
                      </div>                     
                   </div>
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Room Size: m2 </label>                     
                      <div class="col-md-6">                        
                          <input name="room_size" id="room_size" type="text" class="form-control">                    
                      </div>                     
                   </div>
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Max Number Of People: </label>                     
                      <div class="col-md-6">                        
                          <input name="num_people" id="num_people" type="text" class="form-control">                        
                      </div>                     
                   </div>                       
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Number Of Beds: </label>                    
                      <div class="col-md-6">                        
                        <input name="num_beds" id="num_beds" type="text" class="form-control">                                            
                      </div>                      
                   </div> 
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Room Cover Image: </label>                     
                      <div class="col-md-6">                        
                          <input  id="room_cover" name="room_cover" type="file" class="form-control"/>                        
                      </div>                    
                   </div>                   
                   <div class="form-group">                      
                      <label class="col-md-3 control-label"> Room Type: </label>                     
                      <div class="col-md-6">                         
                          <select name="room_type" class="form-control" id="roomtype">                             
                              <option value="0"> Select A Type </option> 
                              <?php
                                $query = "SELECT * from room_type";
                                $result = $conn->query($query)->fetchAll(); 
                                foreach($result as $r):                         
                              ?>
                                <option value="<?= $r->id ?>"> <?= $r->name ?> </option> 
                                <?php endforeach;?>                                                                                                                                                                      
                          </select>                         
                      </div>                      
                   </div>                 
                   <div class="form-group">                      
                      <label class="col-md-3 control-label"> Room View: </label>                     
                      <div class="col-md-6">                        
                          <select name="view" class="form-control" id="view">                            
                              <option value="0"> Select A View </option> 
                              <?php
                                $query = "SELECT * from view";
                                $result = $conn->query($query)->fetchAll(); 
                                foreach($result as $r):                         
                              ?>
                              <option value="<?= $r->id ?>"> <?= $r->name ?> </option> 
                                <?php endforeach; ?>                                                                                                                                                                                                 
                          </select>                        
                      </div>                     
                   </div>  
                   <div class="form-group">                      
                       <label class="col-md-3 control-label"> Product Desc: </label>                      
                       <div class="col-md-6">                         
                           <textarea cols="19" rows="6" class="form-control" name="description" id="desc"></textarea>                         
                       </div>                      
                    </div> 
                    <div class="form-group">                      
                       <label class="col-md-3 control-label"></label>                      
                       <div class="col-md-6">                         
                           <input name="insert_room" value="Insert Room" type="submit" class="btn btn-primary form-control">                          
                       </div>                      
                    </div>           
               </form>              
           </div>       
        </div>      
    </div>   
</div>