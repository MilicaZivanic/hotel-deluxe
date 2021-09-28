<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">              
                <i class="fa fa-dashboard"></i> Dashboard / View Views          
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">             
                   <i class="fa fa-tags"></i>  View Views             
               </h3>
            </div>       
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">                       
                        <thead>
                            <tr>
                                <th> Room View ID: </th>
                                <th> Room View Name: </th>
                                <th> View Edit: </th>
                                <th> View Delete: </th>
                            </tr>
                        </thead>        
                        <tbody>  
                            <?php
                                $query = "SELECT * FROM view";
                                $result = $conn->query($query)->fetchAll(); 
                                foreach($result as $r):                         
                            ?>                       
                            <tr class="desc">
                                <td> <?= $r->id  ?> </td>
                                <td> <?= $r->name ?> </td>
                                <td style="text-align:center; font-size:30px;">                                     
                                     <a href="index.php?edit_view=<?= $r->id  ?>">                                    
                                        <i class="fa fa-pencil" style="color:#7B6233;"></i>                                
                                     </a>                                     
                                </td>
                                <td style="text-align:center; font-size:30px;">                                   
                                     <a href="index.php?delete_view=<?= $r->id  ?>">                                   
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