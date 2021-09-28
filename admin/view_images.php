<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">              
                <i class="fa fa-dashboard"></i> Dashboard / View Images           
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">             
                   <i class="fa fa-tags"></i>  View Images            
               </h3>
            </div>       
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">                       
                        <thead>
                            <tr>
                                <th> Room Number: </th>
                                <th> Images: </th>
                                <th> Link: </th>
                                <th> Room Delete: </th>
                            </tr>
                        </thead>        
                        <tbody>  
                            <?php
                                $query = "SELECT *, ri.id AS idImage FROM room r INNER JOIN room_images ri ON r.id=ri.id_room ORDER BY r.id";
                                $result = $conn->query($query)->fetchAll(); 
                                foreach($result as $r):                         
                            ?>                       
                            <tr>
                                <td> <?= $r->number  ?> </td>
                                <td style="text-align:center"> <img src="../images/<?= $r->link ?>" width="200" height="150"></td>
                                <td> <?= $r->link ?></td>
                                <td style="text-align:center; font-size:30px;">                                   
                                     <a href="index.php?delete_image=<?= $r->idImage ?>">                                   
                                        <i class="fa fa-trash-o" style="color:#7B6233;"></i>                              
                                     </a>                                    
                                </td>
                            </tr> 
                            <?php endforeach; ?>                          
                        </tbody>                     
                    </table>
                </div>
            </div>           
        </div>
    </div>
</div>