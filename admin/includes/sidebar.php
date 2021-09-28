<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">      
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">          
            <span class="sr-only">Toggle Navigation</span>           
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>           
        </button>       
        <a href="index.php?dashboard" class="navbar-brand">Admin Area</a>       
    </div>   
    <ul class="nav navbar-right top-nav">   
        <li class="dropdown">            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">  
                <?php
                     if(isset($_SESSION["user"])){
                        $user = $_SESSION["user"];
                    } 
                ?>              
                <i class="fa fa-user"></i> <?= $user->first_name ?> <b class="caret"></b>              
            </a>           
            <ul class="dropdown-menu">
                <li>
                    <a href="index.php?user_profile=<?= $user->id ?>">        
                        <i class="fa fa-fw fa-user"></i> Profile              
                    </a>
                </li>                            
                <li class="divider"></li>               
                <li>
                    <a href="../index.php">                       
                        <i class="fa fa-fw fa-sign-out"></i>Go Back                   
                    </a>
                </li>               
            </ul>          
        </li>
    </ul>
    
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php?dashboard">
                        <i class="fa fa-fw fa-dashboard"></i> Dashboard                    
                </a>
            </li>        
            <li>
                <a href="#" data-toggle="collapse" data-target="#rooms">             
                        <i class="fa fa-fw fa-bed"></i> Rooms
                        <i class="fa fa-fw fa-caret-down"></i>                      
                </a>         
                <ul id="rooms" class="collapse">
                    <li>
                        <a href="index.php?insert_room"> Insert Room </a>
                    </li>
                    <li>
                        <a href="index.php?view_rooms"> View Rooms </a>
                    </li>
                </ul>
                
            </li>
            
            <li>
                <a href="#" data-toggle="collapse" data-target="#room_type">      
                        <i class="fa fa-fw fa-book"></i> Room Types
                        <i class="fa fa-fw fa-caret-down"></i>                     
                </a>
                <ul id="room_type" class="collapse">
                    <li>
                        <a href="index.php?insert_type"> Insert Room Type </a>
                    </li>
                    <li>
                        <a href="index.php?view_types"> View Room Types </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#images">       
                        <i class="fa fa-fw fa-picture-o"></i> Room Images
                        <i class="fa fa-fw fa-caret-down"></i>
                        
                </a>
                <ul id="images" class="collapse">
                    <li>
                        <a href="index.php?insert_image"> Insert Image </a>
                    </li>
                    <li>
                        <a href="index.php?view_images"> View Images </a>
                    </li>
                </ul> 
            </li>       
            <li>
                <a href="#" data-toggle="collapse" data-target="#views">          
                        <i class="fa fa-fw fa-eye"></i> Views
                        <i class="fa fa-fw fa-caret-down"></i>               
                </a>
                
                <ul id="views" class="collapse">
                    <li>
                        <a href="index.php?insert_view"> Insert View </a>
                    </li>
                    <li>
                        <a href="index.php?view_views"> View Views </a>
                    </li>
                </ul>   
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#price">          
                        <i class="fa fa-fw fa-money"></i> Prices
                        <i class="fa fa-fw fa-caret-down"></i>                     
                </a>
                <ul id="price" class="collapse">
                    <li>
                        <a href="index.php?insert_price"> Insert Price </a>
                    </li>
                    <li>
                        <a href="index.php?view_prices"> View Prices </a>
                    </li>
                </ul>
            </li>          
            <li>
                <a href="index.php?view_customers"><!-- a href begin -->
                    <i class="fa fa-fw fa-users"></i> View Customers
                </a>
            </li>
            <li>
                <a href="index.php?view_bookings">
                    <i class="fa fa-fw fa-book"></i> View Bookings
                </a>
            </li>                   
            <li>
                <a href="index.php?view_admins">          
                        <i class="fa fa-fw fa-users"></i> Admins                    
                </a>
            </li> 
        </ul>
    </div>  
</nav>