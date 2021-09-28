
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">Paradise</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <?php
            if(isset($_SESSION["user"])){
                $user = $_SESSION["user"];
                $id = $user->id_role;
            }else{
                $id = 3;
            }
            $query = "SELECT link, m.name FROM role r INNER JOIN menu_role mr ON r.id=mr.id_role 
                      INNER JOIN menu m ON mr.id_menu=m.id
                      WHERE r.id = :id ORDER BY position";
            $prepare = $conn->prepare($query);
            $prepare->bindParam(":id", $id);
            $prepare->execute();
            $result = $prepare->fetchAll();
            foreach($result as $r):?>

              <li class="nav-item <?= ($_SERVER["QUERY_STRING"]=="page=".strtolower($r->name))?"active" : ""; ?>">
                  <a href="<?= strtolower($r->name)=="adminpanel" ? "admin/index.php" : "index.php?page=".strtolower($r->name) ?>" class="nav-link"><?= $r->name ?></a>
              </li>
            <?php endforeach; ?>
            <?php 
              if(isset($_SESSION["user"])):
                $user = $_SESSION["user"] ?>
              <li class="nav-item active"><a href="#" class="nav-link">Hello <?= $user->first_name ?></a></li>
            <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>