   <div class="hero-wrap" style="background-image: url('assets/images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home</a></span> <span>Login</span></p>
	            <h1 class="mb-4 bread">Login</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row block-7">
        <div class="col-md-3 order-md-last d-flex"></div>  
          <div class="col-md-6 order-md-last d-flex">
            <form action="models/login.php" method="POST" class="bg-white p-5 contact-form" onSubmit="return login();">
            <div class="form-group">
                <p><?php 
                    if(isset($_SESSION["errorLogin"])){
                      echo $_SESSION["errorLogin"];
                      unset($_SESSION["errorLogin"]);
                    }       
                    if(isset($_SESSION["successRegister"])){
                        echo $_SESSION["successRegister"];
                        unset($_SESSION["successRegister"]);
                    }
                ?></p>
            </div>  
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" name="email" id="emailLog">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="pass" id="passLog">
              </div>
              <div class="form-group">
                <input type="submit" value="Login" class="btn btn-primary py-3 px-5" name="btnLogin" id="btnLogin">
              </div>
            </form>
          
          </div>
          <div class="col-md-3 order-md-last d-flex"></div>  

    </div>

