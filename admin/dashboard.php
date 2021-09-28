<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Welcome <?= $user->first_name ?> </h1>
        <ol class="breadcrumb">
            <li class="active">     
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">  
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">            
                        <i class="fa fa-bed fa-5x"></i>                      
                    </div>               
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT COUNT(*) AS numRooms from room";
                        $result = $conn->query($query)->fetch();
                    ?>
                        <div class="huge"> <?= $result->numRooms ?> </div>                  
                        <div> Rooms </div>       
                    </div>
                </div>
            </div>   
            <a href="index.php?view_rooms">
                <div class="panel-footer">      
                    <span class="pull-left">
                        View Details 
                    </span>     
                    <span class="pull-right">
                        <i class="fa fa-arrow-circle-right"></i> 
                    </span>   
                    <div class="clearfix"></div>              
                </div>
            </a>
            
        </div>
    </div>
   
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">           
                        <i class="fa fa-tags fa-5x"></i>                    
                    </div>   
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT COUNT(*) AS numRoomTypes from room_type";
                        $result = $conn->query($query)->fetch();
                    ?>
                        <div class="huge"> <?= $result->numRoomTypes ?> </div>                       
                        <div> Room Types </div>      
                    </div>    
                </div>
            </div>
            <a href="index.php?view_customers">
                <div class="panel-footer">     
                    <span class="pull-left">
                        View Details 
                    </span>  
                    <span class="pull-right">
                        <i class="fa fa-arrow-circle-right"></i> 
                    </span>             
                    <div class="clearfix"></div>              
                </div>
            </a> 
        </div>
    </div>
   
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-orange">   
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">                   
                        <i class="fa fa-users fa-5x"></i>                       
                    </div>                 
                    <div class="col-xs-9 text-right">
                    <?php
                        $id = 2;
                        $query = "SELECT COUNT(*) AS numUsers from user WHERE id_role = :id";
                        $prepare = $conn->prepare($query);
                        $prepare->bindParam(":id", $id);
                        $result = $prepare->execute();
                        if($result){
                            $num = $prepare->fetch();
                        }
                    ?>
                        <div class="huge"> <?= $num->numUsers; ?> </div>                           
                        <div> Customers </div>                       
                    </div>             
                </div>
            </div>          
            <a href="index.php?view_p_cats">
                <div class="panel-footer">                 
                    <span class="pull-left">
                        View Details 
                    </span>                  
                    <span class="pull-right">
                        <i class="fa fa-arrow-circle-right"></i> 
                    </span>                    
                    <div class="clearfix"></div>                   
                </div>
            </a>        
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">           
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">                      
                        <i class="fa fa-shopping-cart fa-5x"></i>                      
                    </div>                
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT COUNT(*) AS numBookings from booking";
                        $result = $conn->query($query)->fetch();
                    ?>
                        <div class="huge"> <?= $result->numBookings ?> </div>                         
                        <div> Bookings </div>                      
                    </div>            
                </div>
            </div>           
            <a href="index.php?view_orders">
                <div class="panel-footer">             
                    <span class="pull-left">
                        View Details 
                    </span>                 
                    <span class="pull-right">
                        <i class="fa fa-arrow-circle-right"></i> 
                    </span>                 
                    <div class="clearfix"></div>                   
                </div>
            </a>          
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">                  
                    <i class="fa fa-money fa-fw"></i> Newest Bookings                  
                </h3>
            </div>            
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">                       
                        <thead>                         
                            <tr>                         
                                <th> Bookind No: </th>
                                <th> Customer Email: </th>
                                <th> Room Number: </th>
                                <th> Check In Date: </th>
                                <th> Check Out Date: </th>
                                <th> Num of People: </th>
                                <th> Booked at: </th>
                            </tr>                          
                        </thead>                      
                        <tbody>   
                        <?php
                            $query = "SELECT *, b.id AS bookingNo, b.num_people AS numPeople FROM booking b LEFT OUTER JOIN room r on r.id=b.id_room INNER JOIN user u ON u.id=b.id_user ORDER BY b.booked_at DESC LIMIT 0,6";
                            $result = $conn->query($query)->fetchAll();
                            foreach($result as $r):
                        ?>                      
                            <tr>                             
                                <td> <?= $r->bookingNo  ?> </td>
                                <td> <?= $r->email  ?> </td>
                                <td> <?= $r->number ?> </td>
                                <td> <?= $r->check_in ?> </td>
                                <td> <?= $r->check_out ?> </td>
                                <td> <?= $r->numPeople ?> </td>
                                <td> <?= $r->booked_at ?> </td>
                                <td>                               
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
