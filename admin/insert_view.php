<?php
    if(isset($_POST['insert_view'])){
        $room_view = $_POST['room_view'];

        $errors = [];

        if(empty($room_view)){
            $errors[] = 1;
        }
        if(count($errors) > 0){
            http_response_code(404);   
        }else{
            $queryInsert = "INSERT INTO view
                        VALUES(null, :room_view )";
            $prepare = $conn->prepare($queryInsert);
            $prepare->bindParam(":room_view", $room_view);
            try{
            $result = $prepare->execute();
            echo "<script>alert('View has been inserted sucessfully')</script>";
            echo "<script>window.open('index.php?view_views','_self')</script>";
            }catch(PDOException $ex){
                $_SESSION['errorInserted'] = "The view with this name already exists!";
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
                   <i class="fa fa-money fa-fw"></i> Insert Room View                
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
                      <label class="col-md-3 control-label"> View: </label>                     
                      <div class="col-md-6">                        
                          <input name="room_view" id="roomview" type="text" class="form-control">                        
                      </div>                     
                   </div>  
                   <div class="form-group">                      
                       <label class="col-md-3 control-label"></label>                      
                       <div class="col-md-6">                         
                           <input name="insert_view" value="Insert Room Type" type="submit" class="btn btn-primary form-control">                          
                       </div>                      
                    </div>         
               </form>              
           </div>       
        </div>      
    </div>   
</div>