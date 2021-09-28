<?php

    require_once "includes/head.php";
    require_once "includes/sidebar.php";


?>

<div id="page-wrapper">
    <div class="container-fluid">
        
        <?php
        
            if(isset($_GET['dashboard'])){
                
                include("dashboard.php");
                
        }   if(isset($_GET['insert_room'])){
                
                include("insert_room.php");
                
        }   if(isset($_GET['view_rooms'])){
                
                include("view_rooms.php");
                
        }   if(isset($_GET['delete_room'])){
                
                include("delete_room.php");
                
        }   if(isset($_GET['edit_room'])){
                
                include("edit_room.php");
                
        }   if(isset($_GET['insert_type'])){
                
                include("insert_type.php");
                
        }   if(isset($_GET['view_types'])){
                
                include("view_types.php");
                
        }   if(isset($_GET['edit_type'])){
                
                include("edit_type.php");
                
        }   if(isset($_GET['delete_type'])){
                
                include("delete_type.php");
                
        }   if(isset($_GET['insert_image'])){
                
                include("insert_image.php");
                
        }   if(isset($_GET['view_images'])){
                
                include("view_images.php");
                
        }   if(isset($_GET['delete_image'])){
                
                include("delete_image.php");
                
        }   if(isset($_GET['insert_view'])){
                
                include("insert_view.php");
                
        }   if(isset($_GET['view_views'])){
                
                include("view_views.php");
                
        }   if(isset($_GET['delete_view'])){
                
                include("delete_view.php");
                
        }   if(isset($_GET['edit_view'])){
                
                include("edit_view.php");
                
        }   if(isset($_GET['view_prices'])){
                
                include("view_prices.php");
                
        }   if(isset($_GET['delete_price'])){
                
                include("delete_price.php");
                
        }   if(isset($_GET['insert_price'])){
                
                include("insert_price.php");
                
        }   if(isset($_GET['view_customers'])){
                
                include("view_customers.php");
                
        }   if(isset($_GET['delete_customer'])){
                
                include("delete_customer.php");
                
        }   if(isset($_GET['view_bookings'])){
                
                include("view_bookings.php");
                
        }   if(isset($_GET['delete_booking'])){
                
                include("delete_booking.php");//
                
        }   if(isset($_GET['view_admins'])){
                
                include("view_admins.php");
                
        }   if(isset($_GET['edit_admin'])){
                             
                include("edit_admin.php");            
        }   

        ?>      
        </div>
</div>
</div>
<script src="js/mainAdmin.js"></script>     
<script src="js/jquery-331.min.js"></script>     
<script src="js/bootstrap-337.min.js"></script>       
</body>
</html>
