
    <div class="hero-wrap" style="background-image: url('assets/images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>About</span></p>
	            <h1 class="mb-4 bread">Rooms</h1>
            </div>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
				<div class="col-lg-9">
					<div class="row" id="rooms">
					<?php
					$page = 0;
					if(isset($_GET['p'])){
						$page = ($_GET['p'] - 1) * 6;
					}
					$query = "SELECT r.id AS idRoom, r.number, v.name AS view, r.size, r.num_people, r.num_beds, r.coverImage, p.price, rt.name 
							  from room_type rt INNER JOIN room r ON rt.id=r.id_room_type 
							  INNER JOIN price p ON r.id=p.id_room INNER JOIN view v ON v.id=r.id_view 
							  WHERE p.price = (SELECT MAX(price) FROM price WHERE id_room = r.id) ORDER BY r.id
							  LIMIT $page,6";

					$prepare = $conn->prepare($query);
					$result = $prepare->execute();
					if($result):
						$rooms = $prepare->fetchAll();
					foreach($rooms as $r):
				?>
				<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    		<div class="room">
		    			<a href="index.php?page=room-single&id=<?= $r->idRoom ?>" class="img d-flex justify-content-center align-items-center" style="background-image: url(assets/images/<?= $r->coverImage ?>.jpg);">
		    				<div class="icon d-flex justify-content-center align-items-center">
		    					<span class="icon-search2"></span>
		    			 	</div>
		    			</a>
		    			<div class="text p-3 text-center">
							<h3 class="mb-3"><a href="index.php?page=room-single&id=<?= $r->idRoom ?>"><?= $r->name ?></a></h3>
							<p><?= $r->number ?></p>
		    				<p><span class="price mr-2">&#36;<?= $r->price ?>.00</span> <span class="per">per night</span></p>
		    					<ul class="list">
		    						<li><span>Max: </span><?= $r->num_people ?> people</li>
		    						<li><span>Size: </span><?= $r->size ?> m2</li>
		    						<li><span>View: </span><?= $r->view ?></li>
		    						<li><span>Bed:  </span><?= $r->num_beds ?></li>
		    					</ul>
		    					<hr>
		    				<p class="pt-1"><a href="index.php?page=room-single&id=<?= $r->id ?>" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    			</div>
		    		</div>
				</div>
					<?php endforeach; endif; ?>
				<div class="row mt-5">
					<div class="col text-center">
						<div class="block-27">
							<ul>
							<li class="<?= (!isset($_GET['p']))? 'active': ''; ?>"><a href="index.php?page=rooms">1</a></li>
								<?php
									$numOfRooms = "SELECT count(*) AS num FROM room";
									$result = $conn->query($numOfRooms)->fetch();
									$rooms = $result->num;
									//var_dump($rooms);
									$paginationNum = ceil($rooms/6);
									for($i=2; $i<=$paginationNum; $i++):
								?>
								<li class="<?= ($_GET['p']==$i)? 'active': ''; ?>"><a href="index.php?page=rooms&p=<?= $i ?>"><?= $i ?></a></li>
									<?php endfor;?>
							</ul>
						</div>
					</div>
    			</div>
		    </div>
		    	</div>
		    	<div class="col-lg-3 sidebar">
	      		<div class="sidebar-wrap bg-light ftco-animate">
	      			<h3 class="heading mb-4">Advanced Search</h3>
	      			<form action="#" method="POST">
	      				<div class="fields">
		              <div class="form-group">
					  	<input type="text" class="form-control checkin_date" placeholder="Check-in date" id="checkIn">
						<p class="errorCheckIn"></p>		              
					</div>
		              <div class="form-group">
					  	<input type="text" class="form-control checkout_date" placeholder="Check-out date" id="checkOut">
						<p class="errorCheckOut"></p>
		              </div>
		              <div class="form-group">
		                <div class="select-wrap one-third">
							<div class="icon"><span class="ion-ios-arrow-down"></span></div>
								<select name="roomType" id="roomType" class="form-control">
									<?php
										$query = "SELECT * FROM room_type";
										$result = $conn->query($query)->fetchAll();
											foreach($result as $r):
									?>
										<option value=<?= $r->id ?>><?= $r->name ?> room</option>
											<?php endforeach; ?>
								</select>
							</div>
						</div>
		              <div class="form-group">
		                <div class="select-wrap one-third">
							<div class="icon"><span class="ion-ios-arrow-down"></span></div>
							<select name="numPeople" id="numPeople" class="form-control">
								<?php
									$query = "SELECT num_people FROM room GROUP BY num_people";
									$result = $conn->query($query)->fetchAll();
									foreach($result as $r):
										if($r->num_people == 1):
								?>			
									<option value=<?= $r->num_people ?>><?= $r->num_people ?> person</option>
										<?php else: ?>
									<option value=<?= $r->num_people ?>><?= $r->num_people ?> people</option>
									<?php endif; endforeach; ?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<div class="select-wrap one-third">
								<div class="icon"><span class="ion-ios-arrow-down"></span></div>
								<select name="view" id="view" class="form-control">
									<?php
										$query = "SELECT id, name FROM view ";
										$result = $conn->query($query)->fetchAll();
										foreach($result as $r):
									?>
										<option value=<?= $r->id ?>><?= $r->name ?> view</option>
										<?php endforeach; ?>
								</select>
							</div>
						</div>
		              <div class="form-group">
					  <div class="range-slider">
						  <?php
								$query = "SELECT MAX(price) AS max, MIN(price) AS min FROM price";
								$minMax = $conn->query($query)->fetch();
							?>
							<input type="number" class="sliderValue min" data-index="0" value="<?= $minMax->min ?>" disabled/> <span>-</span>
							<input type="number" class="sliderValue max" data-index="1" value="<?= $minMax->max ?>" disabled/>
										
						</div>
						<div id="slider"></div>
		              </div>
		              <div class="form-group">
		                <input type="button" id="search" value="Search" class="btn btn-primary py-3 px-5">
		              </div>
					  <div class="form-group">
                <p><?php 
                    if(isset($_SESSION["successBooking"])){
                      echo $_SESSION["successBooking"];
                      unset($_SESSION["successBooking"]);
                    }       
                ?></p>
            </div> 
		            </div>
	            </form>
	      		</div>
	        </div>
		</div>
    </div>
	</section>
