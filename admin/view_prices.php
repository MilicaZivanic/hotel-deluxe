<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">              
                <i class="fa fa-dashboard"></i> Dashboard / View Prices          
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">             
                   <i class="fa fa-tags"></i>  View Prices             
               </h3>
            </div>       
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">                       
                        <thead>
                            <tr>
                                <th> Room Number: </th>
                                <th> Room Price: </th>
                                <th> Price Date: </th>
                                <th> Room Delete: </th>
                            </tr>
                        </thead>        
                        <tbody>  
                            <?php
                                $query = "SELECT *, p.id AS idPrice FROM room r INNER JOIN price p ON r.id=p.id_room ORDER BY r.id ASC, p.date DESC";
                                $result = $conn->query($query)->fetchAll(); 
                                foreach($result as $r):                         
                            ?>                       
                            <tr>
                                <td> <?= $r->number  ?> </td>
                                <td> <?= $r->price ?> </td>
                                <td> <?= $r->date ?> </td>
                                <td style="text-align:center; font-size:30px;">                                   
                                     <a href="index.php?delete_price=<?= $r->idPrice  ?>">                                   
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