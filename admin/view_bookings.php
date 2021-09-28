<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">              
                <i class="fa fa-dashboard"></i> Dashboard / View Customers           
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">             
                   <i class="fa fa-tags"></i>  View Customers             
               </h3>
            </div>       
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">                       
                        <thead>
                            <tr>
                                <th> Customer ID: </th>
                                <th> Room ID: </th>
                                <th> Check In: </th>
                                <th> Check Out: </th>
                                <th> Number of people: </th>
                                <th> Booked At: </th>
                                <th> Booking Delete: </th>
                            </tr>
                        </thead>        
                        <tbody>  
                            <?php
                                $query = "SELECT *, b.id_user AS idUser, r.id AS idRoom, b.num_people AS numPeople, b.id AS idBooking FROM booking b INNER JOIN room r ON b.id_room=r.id LEFT OUTER JOIN user u ON u.id=b.id_user";
                                $result = $conn->query($query)->fetchAll(); 
                                foreach($result as $r):                         
                            ?>                       
                            <tr>
                                <td> <?= $r->idUser  ?> </td>
                                <td> <?= $r->idRoom ?> </td>
                                <td> <?= $r->check_in ?> </td>
                                <td> <?= $r->check_out ?> </td>
                                <td> <?= $r->numPeople ?> </td>
                                <td> <?= $r->booked_at ?> </td>
                                <td style="text-align:center; font-size:30px;">                                   
                                     <a href="index.php?delete_booking=<?= $r->idBooking  ?>">                                   
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