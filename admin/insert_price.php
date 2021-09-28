<?php

    if(isset($_POST['insert_price'])){
        $room_id = $_POST['room'];
        $price = $_POST['room_price'];
        $errors = [];

        if(empty($price)){
            $errors[] = 1;
        }
        if($room_id == "0"){
            $errors[] = 1;
        }
        if(count($errors) > 0){
            http_response_code(404);   
        }else{
            $queryInsert = "INSERT INTO price
                        VALUES(null, :price, :date, :room_id )";
            $prepare = $conn->prepare($queryInsert);
            $prepare->bindParam(":price", $price);
            $date = date("Y-m-d H:i:s");
            $prepare->bindParam(":date", $date);  
            $prepare->bindParam(":room_id", $room_id);  
            try{
            $result = $prepare->execute();
            echo "<script>alert('Price has been inserted sucessfully')</script>";
            echo "<script>window.open('index.php?view_prices','_self')</script>";
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
                <i class="fa fa-dashboard"></i> Dashboard / Insert Price              
            </li>
        </ol>   
    </div>  
</div>       
<div class="row">   
    <div class="col-lg-12">       
        <div class="panel panel-default">           
           <div class="panel-heading">              
               <h3 class="panel-title">                  
                   <i class="fa fa-money fa-fw"></i> Insert Price              
               </h3>             
           </div>          
           <div class="panel-body">              
               <form method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>" onSubmit="return insertPrice();" class="form-horizontal" enctype="multipart/form-data">            
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
                      <label class="col-md-3 control-label"> Price </label>                     
                      <div class="col-md-6">                        
                        <input  id="roomprice" name="room_price" type="text" class="form-control"/>                        
                      </div>                     
                    </div>
                    <div class="form-group">                      
                       <label class="col-md-3 control-label"></label>                      
                       <div class="col-md-6">                         
                           <input name="insert_price" value="Insert Price" type="submit" class="btn btn-primary form-control">                          
                       </div>                      
                    </div>           
               </form>              
           </div>       
        </div>      
    </div>   
</div>