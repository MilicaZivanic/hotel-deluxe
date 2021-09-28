<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">              
                <i class="fa fa-dashboard"></i> Dashboard / View Admins          
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">             
                   <i class="fa fa-tags"></i>  View Admins            
               </h3>
            </div>       
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">                       
                        <thead>
                            <tr>
                                <th> Admin ID: </th>
                                <th> First Name: </th>
                                <th> Last Name: </th>
                                <th> Email: </th>
                                <th> Password: </th>
                                <th> Created Date: </th>
                                <th> Admin Edit: </th>
                            </tr>
                        </thead>        
                        <tbody>  
                            <?php
                                $query = "SELECT *, u.id AS idUser FROM user u INNER JOIN role r ON u.id_role=r.id WHERE r.name='Admin'";
                                $result = $conn->query($query)->fetchAll(); 
                                foreach($result as $r):                         
                            ?>                       
                            <tr>
                                <td> <?= $r->idUser  ?> </td>
                                <td> <?= $r->first_name ?> </td>
                                <td> <?= $r->last_name ?> </td>
                                <td> <?= $r->email ?> </td>
                                <td> <?= $r->password ?> </td>
                                <td> <?= $r->created_at ?> </td>
                                <td style="text-align:center; font-size:30px;">                                   
                                     <a href="index.php?edit_admin=<?= $r->idUser  ?>"
                                     <?php
                                         if(isset($_SESSION["user"])){
                                            $user = $_SESSION["user"];
                                            if($r->idUser != $user->id){
                                                echo "class='disabled'";
                                            }
                                        }
                                     ?>
                                        ><i class="fa fa-pencil" style="color:#7B6233;"></i>                              
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