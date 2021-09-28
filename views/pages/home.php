

    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image:url(assets/images/bg_1.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-12 ftco-animate text-center">
          	<div class="text mb-5 pb-3">
	            <h1 class="mb-3">Welcome To Paradise</h1>
	            <h2>Hotels &amp; Resorts</h2>
            </div>
          </div>
        </div>
        </div>
      </div>

      <div class="slider-item" style="background-image:url(assets/images/bg_2.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-12 ftco-animate text-center">
          	<div class="text mb-5 pb-3">
	            <h1 class="mb-3">Enjoy A Luxury Experience</h1>
	            <h2>Join With Us</h2>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>

    <section class="ftco-booking">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-12">
    				<form action="#" method="GET" class="booking-form">
	        		<div class="row">
	        			<div class="col-md-3 d-flex">
	        				<div class="form-group p-4 align-self-stretch d-flex align-items-end">
	        					<div class="wrap">
				    					<label for="#">Check-in Date</label>
										<input type="text" class="form-control checkin_date" placeholder="Check-in date" id="checkIn">
										<p class="errorCheckIn"></p>
								</div>
			    			</div>
	        			</div>
	        			<div class="col-md-3 d-flex">
	        				<div class="form-group p-4 align-self-stretch d-flex align-items-end">
	        					<div class="wrap">
				    					<label for="#">Check-out Date</label>
										<input type="text" class="form-control checkout_date" placeholder="Check-out date" id="checkOut">
										<p class="errorCheckOut"></p>
			    				</div>
			    				</div>
	        			</div>
	        			<div class="col-md d-flex">
	        				<div class="form-group p-4 align-self-stretch d-flex align-items-end">
	        					<div class="wrap">
			      					<label for="#">Room</label>
			      					<div class="form-field">
			        					<div class="select-wrap">
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
				            	</div>
		              		</div>
	        			</div>
	        			<div class="col-md d-flex">
	        				<div class="form-group p-4 align-self-stretch d-flex align-items-end">
	        					<div class="wrap">
			      					<label for="#">Customer</label>
			      					<div class="form-field">
			        					<div class="select-wrap">
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
													<?php endif;endforeach; ?>
											</select>
										</div>
									  </div>
									  <p class="errorNumPeople"></p>
				            	</div>
		              		</div>
	        			</div>
	        			<div class="col-md d-flex">
	        				<div class="form-group d-flex align-self-stretch">
			              <input type="button" id="check" value="Check Availability" class="btn btn-primary py-3 px-4 align-self-stretch">
			            </div>
	        			</div>
	        		</div>
	        	</form>
	    		</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section bg-light" id="scroll">
    	<div class="container">
				<div class="row justify-content-center mb-5 pb-3">
          			<div class="col-md-7 heading-section text-center ftco-animate">
            			<h2 class="mb-4">Our Rooms</h2>
          			</div>
        		</div>    		
    		<div class="row" id="rooms">
				<?php
					$page = 0;
					if(isset($_GET['p'])){
						$page = ($_GET['p'] - 1) * 6;
					}
					$query = "SELECT r.id AS idRoom, r.number, v.name AS view, r.size, r.num_people, r.num_beds, r.coverImage, p.price, rt.name from room_type rt 
							  INNER JOIN room r ON rt.id=r.id_room_type INNER JOIN price p ON r.id=p.id_room INNER JOIN view v ON v.id=r.id_view 
							  WHERE p.price = (SELECT MAX(price) FROM price WHERE id_room = r.id)
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
							<h3 class="mb-3"><a href="index.php?page=room-single&id=<?= $r->id ?>"><?= $r->name ?></a></h3>
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
							<li class="<?= (!isset($_GET['p']))? 'active': ''; ?>"><a href="index.php">1</a></li>
								<?php
									$numOfRooms = "SELECT count(*) AS num FROM room";
									$result = $conn->query($numOfRooms)->fetch();
									$rooms = $result->num;
									//var_dump($rooms);
									$paginationNum = ceil($rooms/6);
									for($i=2; $i<=$paginationNum; $i++):
								?>
								<li class="<?= ($_GET['p']==$i)? 'active': ''; ?>"><a href="index.php?p=<?= $i ?>"><?= $i ?></a></li>
									<?php endfor;?>
							</ul>
						</div>
					</div>
    			</div>
			</div>
    	</div>
	</section>
	<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(assets/images/bg_2.jpg);">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10">
		    		<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="50000">0</strong>
		                <span>Happy Guests</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="3000">0</strong>
		                <span>Rooms</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="1000">0</strong>
		                <span>Staffs</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="100">0</strong>
		                <span>Destination</span>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
	</section>
    <section class="ftco-section testimony-section bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 ftco-animate">
          	<div class="row ftco-animate">
		          <div class="col-md-12">
		            <div class="carousel-testimony owl-carousel ftco-owl">
		              <div class="item">
		                <div class="testimony-wrap py-4 pb-5">
		                  <div class="user-img mb-4" style="background-image: url(assets/images/person_1.jpg)">
		                    <span class="quote d-flex align-items-center justify-content-center">
		                      <i class="icon-quote-left"></i>
		                    </span>
		                  </div>
		                  <div class="text text-center">
		                    <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
		                    <p class="name">Nathan Smith</p>
		                    <span class="position">Guests</span>
		                  </div>
		                </div>
		              </div>
		              <div class="item">
		                <div class="testimony-wrap py-4 pb-5">
		                  <div class="user-img mb-4" style="background-image: url(assets/images/person_2.jpg)">
		                    <span class="quote d-flex align-items-center justify-content-center">
		                      <i class="icon-quote-left"></i>
		                    </span>
		                  </div>
		                  <div class="text text-center">
		                    <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
		                    <p class="name">Nathan Smith</p>
		                    <span class="position">Guests</span>
		                  </div>
		                </div>
		              </div>
		              <div class="item">
		                <div class="testimony-wrap py-4 pb-5">
		                  <div class="user-img mb-4" style="background-image: url(assets/images/person_3.jpg)">
		                    <span class="quote d-flex align-items-center justify-content-center">
		                      <i class="icon-quote-left"></i>
		                    </span>
		                  </div>
		                  <div class="text text-center">
		                    <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
		                    <p class="name">Nathan Smith</p>
		                    <span class="position">Guests</span>
		                  </div>
		                </div>
		              </div>
		              <div class="item">
		                <div class="testimony-wrap py-4 pb-5">
		                  <div class="user-img mb-4" style="background-image: url(assets/images/person_1.jpg)">
		                    <span class="quote d-flex align-items-center justify-content-center">
		                      <i class="icon-quote-left"></i>
		                    </span>
		                  </div>
		                  <div class="text text-center">
		                    <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
		                    <p class="name">Nathan Smith</p>
		                    <span class="position">Guests</span>
		                  </div>
		                </div>
		              </div>
		              <div class="item">
		                <div class="testimony-wrap py-4 pb-5">
		                  <div class="user-img mb-4" style="background-image: url(assets/images/person_1.jpg)">
		                    <span class="quote d-flex align-items-center justify-content-center">
		                      <i class="icon-quote-left"></i>
		                    </span>
		                  </div>
		                  <div class="text text-center">
		                    <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
		                    <p class="name">Nathan Smith</p>
		                    <span class="position">Guests</span>
		                  </div>
		                </div>
		              </div>
		            </div>
		          </div>
		        </div>
          </div>
        </div>
      </div>
	</section>

