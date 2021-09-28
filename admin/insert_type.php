<?php
    if(isset($_POST['insert_type'])){
        $room_type = $_POST['room_type'];

        $errors = [];

        if(empty($room_type)){
            $errors[] = 1;
        }
        if(count($errors) > 0){
            http_response_code(404);   
        }else{
            $queryInsert = "INSERT INTO room_type
                        VALUES(null, :room_type )";
            $prepare = $conn->prepare($queryInsert);
            $prepare->bindParam(":room_type", $room_type);
            try{
            $result = $prepare->execute();
            echo "<script>alert('Room type has been inserted sucessfully')</script>";
            echo "<script>window.open('index.php?view_types','_self')</script>";
            }catch(PDOException $ex){
                $_SESSION['errorInserted'] = "The room type with this name already exists!";
            }
        }

    }

?>
<div class="row">
    <div class="col-lg-12">       
        <ol class="breadcrumb">          
            <li class="active">               
                <i class="fa fa-dashboard"></i> Dashboard / Insert Room Type              
            </li>
        </ol>   
    </div>  
</div>       
<div class="row">   
    <div class="col-lg-12">       
        <div class="panel panel-default">           
           <div class="panel-heading">              
               <h3 class="panel-title">                  
                   <i class="fa fa-money fa-fw"></i> Insert Room Type                
               </h3>             
           </div>          
           <div class="panel-body">              
               <form method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>" onSubmit="return insertType();" class="form-horizontal" enctype="multipart/form-data">
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
                          <input name="room_type" id="roomtype" type="text" class="form-control">                        
                      </div>                     
                   </div>  
                   <div class="form-group">                      
                       <label class="col-md-3 control-label"></label>                      
                       <div class="col-md-6">                         
                           <input name="insert_type" value="Insert Room Type" type="submit" class="btn btn-primary form-control">                          
                       </div>                      
                    </div>         
               </form>              
           </div>       
        </div>      
    </div>   
</div>