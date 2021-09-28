<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">              
                <i class="fa fa-dashboard"></i> Dashboard / View Rooms           
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">             
                   <i class="fa fa-tags"></i>  View Rooms              
               </h3>
            </div>       
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">                       
                        <thead>
                            <tr>
                                <th> Room ID: </th>
                                <th> Room Number: </th>
                                <th> Room Size: </th>
                                <th> Max Number Of People: </th>
                                <th> Number Of Beds: </th>
                                <th> Room Image: </th>
                                <th> Room Type: </th>
                                <th> Room View: </th>
                                <th> Room Desc: </th>
                                <th> Room Edit: </th>
                                <th> Room Delete: </th>
                            </tr>
                        </thead>        
                        <tbody>  
                            <?php
                                $query = "SELECT r.*, rt.name AS typeName, v.name AS viewName FROM room r INNER JOIN room_type rt ON r.id_room_type=rt.id INNER JOIN view v ON r.id_view=v.id ORDER BY r.id";
                                $result = $conn->query($query)->fetchAll(); 
                                foreach($result as $r):                         
                            ?>                       
                            <tr class="desc">
                                <td> <?= $r->id  ?> </td>
                                <td> <?= $r->number ?> </td>
                                <td> <?= $r->size ?>  m2</td>
                                <td> <?= $r->num_people ?> </td>
                                <td> <?= $r->num_beds ?> </td>
                                <td style="text-align:center"> <img src="../images/<?= $r->coverImage ?>" width="100" height="60"></td>
                                <td> <?= $r->typeName ?> </td>
                                <td> <?= $r->viewName ?> </td>
                                <td style="float:left; width:400px; overflow-y:scroll;"> <?= $r->description ?> </td>
                                <td style="text-align:center; font-size:30px;">                                     
                                     <a href="index.php?edit_room=<?= $r->id  ?>">                                    
                                        <i class="fa fa-pencil" style="color:#7B6233;"></i>                                
                                     </a>                                     
                                </td>
                                <td style="text-align:center; font-size:30px;">                                   
                                     <a href="index.php?delete_room=<?= $r->id  ?>">                                   
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