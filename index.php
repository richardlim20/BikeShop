<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bootstrap E-Commerce Template</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Fontawesome core CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--Slide Show Css -->
    <link href="assets/ItemSlider/css/main-style.css" rel="stylesheet" />
    <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><strong>ALICE'S</strong> ELECTRONIC BIKE Shop</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Signup</a></li>
                    <li><a href="chart.php">Cart</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">24x7 Support <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><strong>Call: </strong>+61-000-000-000</a></li>
                            <li><a href="#"><strong>Mail: </strong>info@alicebikeshop.com</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><strong>Address: </strong>
                                <div>
                                    Melbourne,<br />
                                    VIC 3000, AUSTRALIA
                                </div>
                            </a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" placeholder="Enter Keyword Here ..." class="form-control">
                    </div>
                    &nbsp; 
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="container">

        <div class="row">
      
            <div class="col-md-9">
                <div>
                    <ol class="breadcrumb">
                        
                        <li class="active">Computers</li>
                    </ol>
                </div>
                <!-- /.div -->
                <div class="row">
                    <div class="btn-group alg-right-pad">
                        <button type="button" class="btn btn-default"><strong>1235  </strong>items</button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                Sort Products &nbsp;
      <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">By Price Low</a></li>
                                <li class="divider"></li>
                                <li><a href="#">By Price High</a></li>
                                <li class="divider"></li>
                                <li><a href="#">By Popularity</a></li>
                                <li class="divider"></li>
                                <li><a href="#">By Reviews</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
    <!-- First product -->
    <div class="col-md-4 text-center col-sm-6 col-xs-6">
        <div class="thumbnail product-box">
            <img src="assets/img/bronton.jpg" alt="" />
            <div class="caption">
                <h3><a href="#">Bronton</a></h3>
                <p>Price : <strong>$3000</strong></p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="1" />
                    <input type="hidden" name="product_name" value="Bronton" />
                    <input type="hidden" name="product_price" value="3000" />
                    <input type="hidden" name="product_image" value="assets/img/bronton.jpg" />
                    <button type="submit" class="btn btn-success">Add To Cart</button>
                </form>
                <a href="#" class="btn btn-primary" role="button">See Details</a>
            </div>
        </div>
    </div>
    <!-- /.col -->

    <!-- Second product -->
    <div class="col-md-4 text-center col-sm-6 col-xs-6">
        <div class="thumbnail product-box">
            <img src="assets/img/dummyimg.jpg" alt="" />
            <div class="caption">
                <h3><a href="#">E-BMX</a></h3>
                <p>Price : <strong>$2000</strong></p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="2" />
                    <input type="hidden" name="product_name" value="E-BMX" />
                    <input type="hidden" name="product_price" value="2000" />
                    <input type="hidden" name="product_image" value="assets/img/dummyimg.jpg" />
                    <button type="submit" class="btn btn-success">Add To Cart</button>
                </form>
                <a href="#" class="btn btn-primary" role="button">See Details</a>
            </div>
        </div>
    </div>
    <!-- /.col -->

    <!-- Third product -->
    <div class="col-md-4 text-center col-sm-6 col-xs-6">
        <div class="thumbnail product-box">
            <img src="assets/img/f65.jpg" alt="" />
            <div class="caption">
                <h3><a href="#">F-65</a></h3>
                <p>Price : <strong>$700</strong></p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="3" />
                    <input type="hidden" name="product_name" value="F-65" />
                    <input type="hidden" name="product_price" value="700" />
                    <input type="hidden" name="product_image" value="assets/img/f65.jpg" />
                    <button type="submit" class="btn btn-success">Add To Cart</button>
                </form>
                <a href="#" class="btn btn-primary" role="button">See Details</a>
            </div>
        </div>
    </div>
    <!-- /.col -->
</div>
    </div>
    <!-- /.container -->
    

    <!--Footer -->
    <div class="col-md-12 footer-box">


        

            <div class="col-md-4">
                <strong>Our Location</strong>
                <hr>
                <p>
                     Swanston St, Melbourne,<br />
                                    VIC 3000, Australia<br />
                    Call: +61-000-000-000<br>
                    Email: info@alicebikeshop.com<br>
                </p>

                2020 www.alicebikeeshop.com | All Right Reserved
            </div>
          
        </div>
        <hr>
    </div>
    <!-- /.col -->
    <div class="col-md-12 end-box ">
        &copy; 2020 | &nbsp; All Rights Reserved | &nbsp; www.alicebikeshop.com | &nbsp; 24x7 support | &nbsp; Email us: info@alicebikeshop.com
    </div>
    <!-- /.col -->
    <!--Footer end -->
    <!--Core JavaScript file  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--bootstrap JavaScript file  -->
    <script src="assets/js/bootstrap.js"></script>
    <!--Slider JavaScript file  -->
    <script src="assets/ItemSlider/js/modernizr.custom.63321.js"></script>
    <script src="assets/ItemSlider/js/jquery.catslider.js"></script>
    <script>
        $(function () {

            $('#mi-slider').catslider();

        });
		</script>
</body>
</html>
