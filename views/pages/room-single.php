

    <div class="hero-wrap" style="background-image: url('assets/images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <p class="breadcrumbs mb-2" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="rooms.html">Room</a></span> <span>Room Single</span></p>
	            <h1 class="mb-4 bread">Room Single</h1>
            </div>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
          	<div class="row">
          		<div class="col-md-12 ftco-animate">
              <?php
                    $id = $_GET["id"];
                    $query = "SELECT r.id AS idRoom, coverImage, name, number FROM room r INNER JOIN room_type rt ON r.id_room_type=rt.id WHERE r.id = :id ";
                    $prepare = $conn->prepare($query);
                    $prepare->bindParam(':id', $id);
                    $result = $prepare->execute();
                    if($result):
                      $image = $prepare->fetch();?>
                <input type="hidden" id="id" data-id="<?= $image->idRoom ?>"/>
          			<h2 class="mb-4"><?= $image->name ?> room No. <?= $image->number ?></h2>
          			<div class="single-slider owl-carousel">
          				<div class="item">
          					<div class="room-img" style="background-image: url(assets/images/<?= $image->coverImage ?>.jpg);"></div>
                  </div>
                      <?php endif;?>
                <?php
                    $id = $_GET["id"];
                    $query = "SELECT rm.link FROM room r INNER JOIN room_images rm ON r.id=rm.id_room WHERE r.id = :id ";
                    $prepare = $conn->prepare($query);
                    $prepare->bindParam(':id', $id);
                    $result = $prepare->execute();
                    if($result):
                      $images = $prepare->fetchAll();
                      foreach($images as $i):?>
          				<div class="item">
          					<div class="room-img" style="background-image: url(assets/images/<?= $i->link ?>.jpg);"></div>
                  </div>
                      <?php endforeach; endif;?>
          			</div>
          		</div>
          		<div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
    						<div class="d-md-flex mt-5 mb-5">
                  <?php
                    $id = $_GET["id"];
          					$query = "SELECT r.id, r.number, r.description, v.name AS view, r.size, r.num_people, r.num_beds, r.coverImage, p.price, rt.name 
                    from room_type rt INNER JOIN room r ON rt.id=r.id_room_type 
                    INNER JOIN price p ON r.id=p.id_room INNER JOIN view v ON v.id=r.id_view WHERE r.id = :id";
                    $prepare = $conn->prepare($query);
                    $prepare->bindParam(':id', $id);
                    $result = $prepare->execute();
                    //var_dump($result);        
                    if($result):
                      $room = $prepare->fetch(); 
                      //var_dump($room);        
                  ?>
    							<ul class="list">
	    							<li><span>Max: </span><?= $room->num_people ?> people</li>
	    							<li><span>Size: </span><?= $room->size ?> m2</li>
	    						</ul>
	    						<ul class="list ml-md-5">
	    							<li><span>View: </span> <?= $room->view ?> View</li>
	    							<li><span>Bed: </span><?= $room->num_beds ?></li>
                  </ul>
                  <ul class="list ml-md-5">
	    							<li><span>Price: </span>&#36;<?= $room->price ?>.00 per night</li>
	    						</ul>
    						</div>
                <p><?= $room->description ?></p>
                <?php endif;?>
          		</div>
          	</div>
          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-wrap bg-light ftco-animate">
            <h3 class="heading mb-4">Booking information</h3>
	      			<form action="#" method="GET">
	      				<div class="fields">              
		              <div class="form-group">
                    <input type="text" class="form-control checkin_date" placeholder="Check-in date" 
                    <?php 
                    if(isset($_SESSION['checkIn'])){
                    echo "value=".$_SESSION['checkIn']."";
                    unset($_SESSION['checkIn']);
                    } ?> 
                    id="checkIn">
                    <p class="errorCheckIn"></p>		              
                  </div>
		              <div class="form-group">
                    <input type="text" class="form-control checkout_date" placeholder="Check-out date" 
                    <?php 
                    if(isset($_SESSION['checkOut'])){
                    echo "value=".$_SESSION['checkOut']."";
                    unset($_SESSION['checkOut']);
                    } ?> 
                    id="checkOut">
                    <p class="errorCheckOut"></p>
		              </div>
		              <div class="form-group">
		                <div class="select-wrap one-third">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="numPeople" id="numPeople" class="form-control">
                          <?php
                            $id = $_GET['id'];
                            $query = "SELECT num_people FROM room WHERE id = :id";
                            $prepare = $conn->prepare($query);
                            $prepare->bindParam(':id', $id);
                            $result = $prepare->execute();
                            if($result):
                              $r = $prepare->fetch();
                              $num = $r->num_people;                   
                              for($i=1; $i<=$num; $i++):
                                if($i == 1):
                              ?>			
                            <option value=<?= $i ?>
                            <?php 
                            if((isset($_SESSION['numPeople'])) && $i == $_SESSION['numPeople']){
                            echo "selected";
                            unset($_SESSION['numPeople']);
                            } ?> 
                            ><?= $i ?> person</option>
                                <?php else: ?>
                            <option value=<?= $i ?>
                            <?php 
                            if((isset($_SESSION['numPeople'])) && $i == $_SESSION['numPeople']){
                            echo "selected";
                            unset($_SESSION['numPeople']);
                            } ?> 
                            ><?= $i ?> people</option>
                                <?php endif; endfor; endif; ?>
                        </select>
                    </div>
                  </div>
		              <div class="form-group">
                    <?php
                    if(isset($_SESSION["user"])):?>
                      <input type="button" id="book" value="Book now" class="btn btn-primary py-3 px-5">
                    <?php else:?>
                      <input type="button" onclick="location.href='login.php';" id="book" value="Please log in first" class="btn btn-primary py-3 px-5">                   
                    <?php 
                      $_SESSION['redirecturl'] = $_SERVER['REQUEST_URI'];
                      endif;?> 
                    <p class="errorBook"></p>                  
		              </div>
		            </div>
	            </form>
            </div>
          </div>
        </div>
      </div>
    </section>		              

   