<?php
    if(isset($_GET['edit_view'])){
        $id = $_GET['edit_view'];
        $query = "SELECT * FROM view WHERE id = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id", $id);
        $prepare->execute();
        if($prepare->rowCount() == 1){
            $room = $prepare->fetch();
            //var_dump($room);
        }
    }

    if(isset($_POST['update_view'])){
        $id = $_GET['edit_view'];
        $room_view = $_POST['room_view'];

        $errors = [];

        if(empty($room_view)){
            $errors[] = 1;
        }
        if(count($errors) > 0){
            http_response_code(404);   
        }else{
            $query = "UPDATE view SET name = :room_view
            WHERE id = :id";                     
            $prepare = $conn->prepare($query);
            $prepare->bindParam(":room_view", $room_view);
            $prepare->bindParam(":id", $id);
            try{
            $result = $prepare->execute();
            echo "<script>alert('View has been updated sucessfully')</script>";
            echo "<script>window.open('index.php?view_views','_self')</script>";
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
                <i class="fa fa-dashboard"></i> Dashboard / Edit Room View              
            </li>
        </ol>   
    </div>  
</div>       
<div class="row">   
    <div class="col-lg-12">       
        <div class="panel panel-default">           
           <div class="panel-heading">              
               <h3 class="panel-title">                  
                   <i class="fa fa-money fa-fw"></i> Edit Room View                
               </h3>             
           </div>          
           <div class="panel-body">              
               <form method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>" onSubmit="return insertView();" class="form-horizontal" enctype="multipart/form-data">
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
                      <label class="col-md-3 control-label"> Room Type: </label>                     
                      <div class="col-md-6">                        
                          <input name="room_view" id="roomview" type="text" class="form-control" value="<?= $room->name ?>">                        
                      </div>                     
                   </div>  
                   <div class="form-group">                      
                       <label class="col-md-3 control-label"></label>                      
                       <div class="col-md-6">                         
                           <input name="update_view" value="Update Room View" type="submit" class="btn btn-primary form-control">                          
                       </div>                      
                    </div>         
               </form>              
           </div>       
        </div>      
    </div>   
</div>