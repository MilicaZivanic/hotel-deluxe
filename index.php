<?php
  session_start();
  require_once "config/connection.php";
  include "views/fixed/head.php";
  include "views/fixed/nav.php";

  if(isset($_GET['page'])){
    switch($_GET['page'])
    {
      case 'home':
        include "views/pages/home.php";
        break;
      case 'rooms':
        include "views/pages/rooms.php";
        break;
      case 'room-single':
        include "views/pages/room-single.php";
        break;
      case 'restaurant':
        include "views/pages/restaurant.php";
        break;
      case 'about':
        include "views/pages/about.php";
        break;
      case 'contact':
        include "views/pages/contact.php";
        break;
      case 'register':
        include "views/pages/register.php";
        break;
      case 'login':
        include "views/pages/login.php";
        break;
      case 'logout':
        include "models/logout.php";
        break;
    }
  } else {
    include "views/pages/home.php";
  }
  include "views/fixed/instagram.php";
  include "views/fixed/footer.php";
?>
