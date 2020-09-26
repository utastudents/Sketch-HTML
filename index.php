<!DOCTYPE html>

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img//apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img//favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Paper Kit by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>
<?php
#python execution using command prompt  
$command = escapeshellcmd('python main.py image\\nice.png');
$output = shell_exec($command);
$arr = json_decode($output); #array is decoded in php
#var_dump($arr); - to check whether it is dumping array or not.
$count = count($arr);
$count_rows = $arr[$count-1][2];
$ctr = $count_rows;
$ct = 0;
$flag=0;

echo('<div class="row">'); #Starting the div
for($i=$count-1;$i>=0;$i--)
{
		if($arr[$i][1]==$ct)
		{
			$msg = $arr[$i][0];#checking the shape name.
			$arrayt = $arr; #copying the array into a variable
			$temp = $arr[$i][2];#no. of shapes in that row.
			call_func($temp,$i,$msg,$arrayt);
			$flag=1;
		}
		else
		{
			#row is completed
			echo "<br>";
			$msg = $arr[$i][0];
			$temp = $arr[$i][2];
			call_func($temp,$i,$msg,$arrayt);
			$flag=0;
			$ct = $ct+ 1; 
		}
		
}

# MAIN FUNCTION TO CALL RECIPE HTML
function call_func($x,$y,$z,$a)
{
	
	for($j=1;$j<=4;$j++)
	{
	if($j==$x)
	{
		if($a[$y][0]=='circle')
		{
			if($j==1){
			$vari = '12';
			}if($j==2){
			$vari = '6';
			}if($j==3){
			$vari = '4';
			}if($j==4){
			$vari = '3';
			}
			$circlea = '
          <div class="col-md-'.$vari.' ml-auto mr-auto">
            <div class="card page-carousel">
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="./assets/img/soroush-karimi.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p>Somewhere</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="./assets/img/federico-beccari.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p>Somewhere else</p>
                    </div>
                  </div>
                  <div class="carousel-item active">
                    <img class="d-block img-fluid" src="./assets/img/joshua-stannard.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p>Here it is</p>
                    </div>
                  </div>
                </div>
                <a class="left carousel-control carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
         
    </div>';
			echo $circlea;
		}
		else
			if($a[$y][0]=='rectangle')
		{
			if($j==1){
			$vari = '12';
			}if($j==2){
			$vari = '6';
			}if($j==3){
			$vari = '4';
			}if($j==4){
			$vari = '3';
			}
			
			$rectanglea = '<nav class="navbar col-md-'.$vari.' navbar-expand-lg bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">COMPANY</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#example-navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar bar1"></span>
      <span class="navbar-toggler-bar bar2"></span>
      <span class="navbar-toggler-bar bar3"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About us</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="#">FAQs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Contact</a>
        </li>
      </ul>
      <form class="form-inline ml-auto">
          <div class="form-group has-white">
            <input type="text" class="form-control" placeholder="Search">
          </div>
      </form>
    </div>
  </div>
</nav>';
			
			echo $rectanglea;
		}
		else
		if($a[$y][0]=='triangle')
		{
			if($j==1){
			$vari = '12';
			}if($j==2){
			$vari = '6';
			}if($j==3){
			$vari = '4';
			}if($j==4){
			$vari = '3';
			}
			
			$trianglea = '
          <div class="col-md-'.$vari.'">
            <div class="info">
              <div class="icon icon-danger">
                <i class="nc-icon nc-album-2"></i>
              </div>
              <div class="description">
                <h4 class="info-title">Beautiful Gallery</h4>
                <p class="description">Spend your time generating new ideas. You dont have to think of implementing.</p>
                <a href="javascript:;" class="btn btn-link btn-danger">See more</a>
              </div>
            </div>
          </div>
		
		';
			
			
			
			echo $trianglea;
		}else
		if($a[$y][0]=='square')
		{
			if($j==1){
			$vari = '12';
			}if($j==2){
			$vari = '6';
			}if($j==3){
			$vari = '4';
			}if($j==4){
			$vari = '3';
			}
			
			$squarea = '
          <div class="card col-md-'.$vari.' mb-5">
            <img class="card-img-top" data-src="holder.js/100px180/" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22320%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20320%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16d79b88335%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16d79b88335%22%3E%3Crect%20width%3D%22320%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22119.0078125%22%20y%3D%2297.2%22%3E320x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            <div class="card-body">
              <h4 class="card-title">Card title</h4>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
		
		';
			
			
			
			echo $squarea;
		}else
		if($a[$y][0]=='hexagon')
		{
			if($j==1){
			$vari = '12';
			}if($j==2){
			$vari = '6';
			}if($j==3){
			$vari = '4';
			}if($j==4){
			$vari = '3';
			}
			
			$hexagona = '
          <div class="col-md-'.$vari.'">
            <div class="card card-profile card-plain">
              <div class="card-avatar">
                <a href="#avatar">
                  <img src="./assets/img/faces/clem-onojeghuo-3.jpg" alt="...">
                </a>
              </div>
              <div class="card-body">
                <a href="#paper-kit">
                  <div class="author">
                    <h4 class="card-title">Henry Ford</h4>
                    <h6 class="card-category text-muted">Product Manager</h6>
                  </div>
                </a>
                <p class="card-description text-center">
                  Teamwork is so important that it is virtually impossible for you to reach the heights of your capabilities or make the money that you want without becoming very good at it.
                </p>
              </div>
              <div class="card-footer text-center">
                <a href="#pablo" class="btn btn-link btn-just-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                <a href="#pablo" class="btn btn-link btn-just-icon btn-dribbble"><i class="fa fa-dribbble"></i></a>
                <a href="#pablo" class="btn btn-link btn-just-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
              </div>
            </div>
          </div>
		
		';
			
			
			
			echo $hexagona;
		}else
		if($a[$y][0]=='pentagon')
		{
			if($j==1){
			$vari = '12';
			}if($j==2){
			$vari = '6';
			}if($j==3){
			$vari = '4';
			}if($j==4){
			$vari = '3';
			}
			
			$pentagona = '
          <footer class="footer col-md-'.$vari.' footer-black  footer-white " style="background:black">
      <div class="container">
        <div class="row">
          <nav class="footer-nav">
            <ul>
              <li>
                <a href="https://www.creative-tim.com" target="_blank">TEAM 007</a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
              </li>
              <li>
                <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
              </li>
            </ul>
          </nav>
          <div class="credits ml-auto">
            <span class="copyright">
              ©
              <script>
                document.write(new Date().getFullYear())
              </script>20192019, made with <i class="fa fa-icon icon"></i> by Akash &amp; Harsh
            </span>
          </div>
        </div>
      </div>
    </footer>
		
		';
			
			
			
			echo $pentagona;
		}else
		{
		}
	}
	}
	
		echo('<hr>');
	
}



?>

<!--   Core JS Files   -->
    <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="./assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="./assets/js/plugins/moment.min.js"></script>
    <script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <script>
      $(document).ready(function() {

        if ($("#datetimepicker").length != 0) {
          $('#datetimepicker').datetimepicker({
            icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
            }
          });
        }

        function scrollToDownload() {

          if ($('.section-download').length != 0) {
            $("html, body").animate({
              scrollTop: $('.section-download').offset().top
            }, 1000);
          }
        }
      });
    </script>