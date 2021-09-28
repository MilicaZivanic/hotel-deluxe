<?php
    if(isset($_GET['edit_room'])){
        $id = $_GET['edit_room'];
        $query = "SELECT r.*, rt.id AS typeName, v.id AS viewName FROM room r INNER JOIN room_type rt ON r.id_room_type=rt.id 
                  INNER JOIN view v ON r.id_view=v.id WHERE r.id = :id ORDER BY r.id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id", $id);
        $prepare->execute();
        if($prepare->rowCount() == 1){
            $room = $prepare->fetch();
            //var_dump($room);
        }
    }
    if(isset($_POST['update_room'])){
        $id = $_GET['edit_room'];
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
            $query = "UPDATE room SET number = :room_number, size = :room_size, num_people = :num_people,
            num_beds = :num_beds, coverImage = :room_cover, description = :desc, id_view = :view, id_room_type = :room_type
            WHERE id = :id";                     
            $prepare = $conn->prepare($query);
            $prepare->bindParam(":room_number", $room_number);
            $prepare->bindParam(":room_size", $room_size);
            $prepare->bindParam(":num_people", $num_people);
            $prepare->bindParam(":num_beds", $num_beds);
            $prepare->bindParam(":room_cover", $room_cover);
            $prepare->bindParam(":desc", $desc);
            $prepare->bindParam(":view", $view);
            $prepare->bindParam(":room_type", $room_type);
            $prepare->bindParam(":id", $id);
            try{
            $result = $prepare->execute();
            echo "<script>alert('Room has been updated sucessfully')</script>";
            echo "<script>window.open('index.php?view_rooms','_self')</script>";
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
                <i class="fa fa-dashboard"></i> Dashboard / Edit Room               
            </li>
        </ol>   
    </div>  
</div>       
<div class="row">   
    <div class="col-lg-12">       
        <div class="panel panel-default">           
           <div class="panel-heading">              
               <h3 class="panel-title">                  
                   <i class="fa fa-money fa-fw"></i> Edit Room                 
               </h3>             
           </div>          
           <div class="panel-body">              
               <form method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>" onSubmit="return insertUpdateRoom();" class="form-horizontal" enctype="multipart/form-data">           
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Room Number: </label>                     
                      <div class="col-md-6">                        
                          <input name="room_number" id="room_number" type="text" class="form-control" value="<?= $room->number ?>">                        
                      </div>                     
                   </div>
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Room Size: m2 </label>                     
                      <div class="col-md-6">                        
                          <input name="room_size" id="room_size" type="text" class="form-control" value="<?= $room->size ?>">                    
                      </div>                     
                   </div>
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Max Number Of People: </label>                     
                      <div class="col-md-6">                        
                          <input name="num_people" id="num_people" type="text" class="form-control" value="<?= $room->num_people ?>">                        
                      </div>                     
                   </div>                       
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Number Of Beds: </label>                    
                      <div class="col-md-6">                        
                        <input name="num_beds" id="num_beds" type="text" class="form-control" value="<?= $room->num_beds ?>">                                            
                      </div>                      
                   </div> 
                   <div class="form-group">                     
                      <label class="col-md-3 control-label"> Room Cover Image: </label>                     
                      <div class="col-md-6" style="text-align:center">                        
                          <input  id="room_cover" name="room_cover" type="file" class="form-control"/>    
                          <img  style="margin-top:10px" width="250" height="150" src="../images/<?= $room->coverImage ?>"/>                    
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
                                <option value="<?= $r->id ?>"
                                <?php
                                if($r->id == $room->typeName){
                                    echo "selected";
                                }
                                ?>
                                > <?= $r->name ?> </option> 
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
                              <option value="<?= $r->id ?>"
                              <?php
                                if($r->id == $room->viewName){
                                    echo "selected";
                                }
                                ?>
                              > <?= $r->name ?> </option> 
                                <?php endforeach; ?>                                                                                                                                                                                                 
                          </select>                        
                      </div>                     
                   </div>  
                   <div class="form-group">                      
                       <label class="col-md-3 control-label"> Product Desc: </label>                      
                       <div class="col-md-6">                         
                           <textarea cols="19" rows="6" class="form-control" name="description" id="desc"><?= htmlspecialchars($room->description); ?></textarea>                         
                       </div>                      
                    </div> 
                    <div class="form-group">                      
                       <label class="col-md-3 control-label"></label>                      
                       <div class="col-md-6">                         
                           <input name="update_room" value="Update Room" type="submit" class="btn btn-primary form-control">                          
                       </div>                      
                    </div>           
               </form>              
           </div>       
        </div>      
    </div>   
</div>