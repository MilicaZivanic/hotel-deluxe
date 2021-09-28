
<div class="hero-wrap" style="background-image: url('assets/images/bg_1.jpg');">
<div class="overlay"></div>
<div class="container">
  <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
    <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
      <div class="text">
        <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home</a></span> <span>Register</span></p>
        <h1 class="mb-4 bread">Register</h1>
      </div>
    </div>
  </div>
</div>
</div>

<div class="row block-7">
  <div class="col-md-3 order-md-last d-flex"></div>  
    <div class="col-md-6 order-md-last d-flex">
      <form action="models/register.php" method="POST" class="bg-white p-5 contact-form" onSubmit="return register()">
        <div class="form-group">
            <p><?php 
                if(isset($_SESSION["errorRegister"])){
                    echo $_SESSION["errorRegister"];
                    unset ($_SESSION["errorRegister"]);
                }
            ?></p>
        </div>  
        <div class="form-group">
          <input type="text" class="form-control" placeholder="First Name" name="fName" id="fName">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Last Name" name="lName" id="lName">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Email" name="email" id="email">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" name="pass" id="pass">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Confirm password" name="passConfirm" id="passConfirm">
        </div>
        <div class="form-group">
          <input type="submit" value="Register" class="btn btn-primary py-3 px-5" name="btnRegister" id="btnRegister">
        </div>
      </form>
    
    </div>
    <div class="col-md-3 order-md-last d-flex"></div>  

</div>

