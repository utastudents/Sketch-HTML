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

if (isset($_POST['submit'])) {
	$fileTmpPath = $_FILES['image']['tmp_name'];
	$fileName = $_FILES['image']['name'];
  $fileSize = $_FILES['image']['size'];
  $typeOfImage = $_POST['typeOfImage'];
  $typeOfFigure = $_POST['typeOfFigure'];

	$fileType = $_FILES['image']['type'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$uploadFileDir = './image/';
	$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
	$dest_path = $uploadFileDir . $newFileName;
	if(move_uploaded_file($fileTmpPath, $dest_path))
	{
	  $message ='File is successfully uploaded.';
	}
	else
	{
	  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
	}
}
#python execution using command prompt  
if($typeOfImage == "colored" && $typeOfFigure == "shapes" ){
  $string = "python main.py image/".$newFileName;
  echo "we have entered.";

} else if($typeOfImage == "binary" && $typeOfFigure == "shapes") {
  $string = "python originalMain.py image/".$newFileName;

} else if($typeOfFigure == "number") {
  //$string = "python Numbers/originalMain.py image/".$newFileName;
  $string = "python Numbers/performRecognition.py -c Numbers/digits_cls.pkl -i image/".$newFileName;
} else if($typeOfFigure == "characters") {
  //$string = "python Numbers/originalMain.py image/".$newFileName;
  echo "we have entered characters..";

  $string = "python Characters/segment.py -i image/".$newFileName;
}

$command = escapeshellcmd($string);
$output = system($command);
$arr = json_decode($output); #array is decoded in php
#echo $arr;
#var_dump($arr); #- to check whether it is dumping array or not.
$count = count($arr);
$count_rows = $arr[$count-1][2];
$ctr = $count_rows;
$ct = 0;
$flag=0;

echo('<div class="row" style="padding:4%">'); #Starting the div
for($i=$count-1;$i>=0;$i--)
{
		if($arr[$i][1]==$ct)
		{
			$msg = $arr[$i][0];#checking the shape name.
			$arrayt = $arr; #copying the array into a variable
      $temp = $arr[$i][2];#no. of shapes in that row.
      if($typeOfImage == "colored"){
        $color = $arr[$i][3];
      } else {
        $color = "white";
      }
			call_func($temp,$i,$msg,$arrayt,$color,$typeOfFigure,$typeOfImage);
			$flag=1;
		}
		else
		{
			#row is completed
			echo "<br>";
			$msg = $arr[$i][0];
      $temp = $arr[$i][2];
      if($typeOfImage == "colored"){
        $color = $arr[$i][3];
      } else{
        $color = "white";
      }
			call_func($temp,$i,$msg,$arrayt,$color, $typeOfFigure,$typeOfImage);
			$flag=0;
			$ct = $ct+ 1; 
		}
		
}

# MAIN FUNCTION TO CALL RECIPE HTML
function call_func($x,$y,$z,$a,$color,$typeOfFigure,$typeOfImage)
{

  if($typeOfImage == "colored" && $typeOfFigure == "shapes" ) {
    echo "<style>
    p {
    color:white!important;
    }

    .title, .title a, .card-title, .card-title a, .info-title, .info-title a, .footer-brand, .footer-brand a, .footer-big h5, .footer-big h5 a, .footer-big h4, .footer-big h4 a, .media .media-heading, .media .media-heading a {
    color: white!important;
    font-weight: bold!important;
    }
    </style>";
  }
	
	for($j=1;$j<=4;$j++)
	{
	if($j==$x)
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

    if($a[$y][0] == "circle" or $a[$y][0] == "0" or $a[$y][0] == "10" )

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
			if($a[$y][0]=='rectangle' or $a[$y][0] == "1" or $a[$y][0] == "11")
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
      
      if($typeOfImage == "binary" && $typeOfFigure == "shapes"){
        $color = "darkblue";
        echo "<style>
        .navbar .navbar-brand {
        color:white!important;
        }
        .navbar .navbar-nav .nav-item .nav-link{
        color:white!important;
        }
        </style>";
      }
			
			$rectanglea = '<nav class="navbar col-md-'.$vari.' navbar-expand-lg" style="background-color:'.$color.'; border-top: 1px solid #eee;;margin-bottom:40px">
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
		if($a[$y][0]=='triangle' or $a[$y][0]=="2" or $a[$y][0] == "12")
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
        <div class="mb-6 mt-6 card col-md-'.$vari.'"  style="padding:50px; text-align:center; margin-bottom: 65px;">
          <div class="info" style="background-color:'.$color.'">
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
		if($a[$y][0]=='square' or  $a[$y][0]=="3" or $a[$y][0] == "13")
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
          <div class="card col-md-'.$vari.' mb-5" style="padding:30px">
            <img class="card-img-top" data-src="holder.js/100px180/" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22320%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20320%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16d79b88335%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16d79b88335%22%3E%3Crect%20width%3D%22320%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22119.0078125%22%20y%3D%2297.2%22%3E320x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            <div class="card-body" style="background-color:'.$color.'">
              <h4 class="card-title">Card title</h4>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
		
		';
			
			
			
			echo $squarea;
		}else
		if($a[$y][0] == 'hexagon' or $a[$y][0]=="4" or $a[$y][0] == "14")
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
          <div class="col-md-'.$vari.'" style="padding:30px">
            <div class="card card-profile card-plain">
              <div class="card-avatar">
                <a href="#avatar">
                  <img src="./assets/img/faces/clem-onojeghuo-3.jpg" alt="...">
                </a>
              </div>
              <div class="card-body" style="background-color:'.$color.'">
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
		if($a[$y][0]=='pentagon' or $a[$y][0]=="5" or $a[$y][0] == "15")
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
              </script>20192019, made with <i class="fa fa-icon icon"></i> by  Harsh &nbsp; & Deep;
            </span>
          </div>
        </div>
      </div>
    </footer>
		
		';
			
			
			
			echo $pentagona;
    }
    
    else
     	if($a[$y][0]=="16")
		{
      # Instagram icon
      $sixteen = ' <div class="col-md-'.$vari.'"> 
                      <div class="box-part text-center">
                      <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
                      <div class="title">
                        <h4>Instagram</h4>
                      </div>
                      <div class="text">
                        <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                      </div>
                      <a href="#">Learn More</a>
                      </div>
                  </div>	 
    ';
    echo $sixteen;
    }

    else
     	if($a[$y][0]=="17")
		{

      #Facebook
      $seventeen = ' <div class="col-md-'.$vari.'"> 
                      <div class="box-part text-center">
                      <i class="fa fa-facebook   fa-3x" aria-hidden="true"></i>
                      <div class="title">
                        <h4>Facebook</h4>
                      </div>
                      <div class="text">
                        <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                      </div>
                      <a href="#">Learn More</a>
                      </div>
                  </div>	 
    ';
    echo $seventeen;

    }

    else
     	if($a[$y][0]=="18")
		{
      #Google 
      $eighteen = ' <div class="col-md-'.$vari.'"> 
                      <div class="box-part text-center">
                      <i class="fa fa-google-plus fa-3x" aria-hidden="true"></i>
                      <div class="title">
                        <h4>Google</h4>
                      </div>
                      <div class="text">
                        <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                      </div>
                      <a href="#">Learn More</a>
                      </div>
                  </div>	 
    ';
    echo $eighteen;

    }


    else
     	if($a[$y][0]=="19")
		{
      #Pinterest
      $nineteen = ' <div class="col-md-'.$vari.'"> 
                      <div class="box-part text-center">
                      <i class="fa fa-pinterest-p fa-3x" aria-hidden="true"></i>
                      <div class="title">
                        <h4>Pinterest</h4>
                      </div>
                      <div class="text">
                        <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                      </div>
                      <a href="#">Learn More</a>
                      </div>
                  </div>	 
    ';
    echo $nineteen;

    }


    else
     	if($a[$y][0]=="20")
		{
      #Github
      $twenty = ' <div class="col-md-'.$vari.'"> 
                      <div class="box-part text-center">
                      <i class="fa fa-github fa-3x" aria-hidden="true"></i>
                      <div class="title">
                        <h4>Github</h4>
                      </div>
                      <div class="text">
                        <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                      </div>
                      <a href="#">Learn More</a>
                      </div>
                  </div>	 
    ';
    echo $twenty;

    }


    else
    if($a[$y][0]=="21")
 {
   #Image Card with Description
   $twentyone = ' <div class="col-md-'.$vari.' lib-item" data-category="view">
   <div class="lib-panel">
       <div class="row box-shadow-image">
           <div class="col-md-6">
               <img class="lib-img-show" src="http://lorempixel.com/850/850/?random=256">
           </div>
           <div class="col-md-6">
               <div class="lib-row lib-header">
                   Example library
                   <div class="lib-header-seperator"></div>
               </div>
               <div class="lib-row lib-desc">
                   Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor
               </div>
           </div>
       </div>
   </div>
</div>

 ';
 echo $twentyone;

 }



 else
    if($a[$y][0]=="22")
 {
   #Image Card with Description
   $twentytwo = ' <div class="col-md-'.$vari.' lib-item" data-category="view">
   <div class="lib-panel">
       <div class="row box-shadow-image">
            <div class="col-md-6">
               <div class="lib-row lib-header">
                   Example library
                   <div class="lib-header-seperator"></div>
               </div>
               <div class="lib-row lib-desc">
                   Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor
               </div>
           </div>

           <div class="col-md-6">
               <img class="lib-img-show" src="http://lorempixel.com/850/850/?random=256">
           </div>
           
       </div>
   </div>
</div>

 ';
 echo $twentytwo;

 }


 else
    if($a[$y][0]=="23")
 {
   # Customer Number
   $twentythree = '<div class="col-md-'.$vari.' text-center"  style="margin-top:60px;">
   <div class="counter">
<i class="fa fa-code fa-2x"></i>
<h2 class="timer count-title count-number" data-to="100" data-speed="1500"></h2>
<p class="count-text ">Our Customer</p>
       <p class="count-text "><h2>1000+</h2></p>

</div></div>

 ';
 echo $twentythree;

 }


 else
 if($a[$y][0]=="24")
{
# Happy Clients Number
$twentyfour = '

<div class="col-md-'.$vari.' text-center"  style="margin-top:60px;">
<div class="counter">
<i class="fa fa-coffee fa-2x"></i>
<h2 class="timer count-title count-number" data-to="1700" data-speed="1500"></h2>
<p class="count-text ">Happy Clients</p>
     <p class="count-text "><h2>99+</h2></p>

</div>
</div>

';
echo $twentyfour;

}



else
 if($a[$y][0]=="25")
{
# Project Number
$twentyfive = '

<div class="col-md-'.$vari.' text-center"  style="margin-top:60px;">
<div class="counter">
<i class="fa fa-lightbulb-o fa-2x"></i>
<h2 class="timer count-title count-number" data-to="11900" data-speed="1500"></h2>
<p class="count-text ">Project Complete</p>
  <p class="count-text "><h2>499+</h2></p>
</div></div>

';
echo $twentyfive;

}



else
 if($a[$y][0]=="26")
        {
        # Coffee Number
        $twentysix = '

        <div class="col-md-'.$vari.' text-center" style="margin-top:60px;">
        <div class="counter">
        <i class="fa fa-bug fa-2x"></i>
        <h2 class="timer count-title count-number" data-to="157" data-speed="1500"></h2>
        <p class="count-text ">Coffee With Clients</p>
              <p class="count-text "><h2>699+</h2></p>

        </div>
        </div>

        ';
        echo $twentysix;

        }


else
 if($a[$y][0]=="27")
        {
        # Cars Number
        $twentyseven = '

        <div class="col-md-'.$vari.'" style="
        margin-top:60px;
    display: inline-table;
    padding: 0px;
">
            <div class="card border-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info pb-3 my-card"><i class="fa fa-car icon-fa" aria-hidden="true"></i></div>
                <div class="text-info text-center mt-3"><h4>Cars</h4></div>
                <div class="text-info text-center mt-2"><h1>234</h1></div>
            </div>
        </div>

        ';
        echo $twentyseven;

        }

else
 if($a[$y][0]=="28")
        {
        # Eyes Number
        $twentyeight = '

        <div class="col-md-'.$vari.'" style="        margin-top:60px;

        display: inline-table;
        padding: 0px;
    ">
            <div class="card border-success mx-sm-1 p-3">
                <div class="card border-success shadow text-success p-3 my-card"><i class="fa fa-eye icon-fa" aria-hidden="true"></i></div>
                <div class="text-success text-center mt-3"><h4>Eyes</h4></div>
                <div class="text-success text-center mt-2"><h1>9332</h1></div>
            </div>
        </div>
        ';
        echo $twentyeight;

        }
    



        else
        if($a[$y][0]=="29")
               {
               # Hearts Number
               $twentynine = '
               <div class="col-md-'.$vari.'" style="        margin-top:60px;

               display: inline-table;
               padding: 0px;">
               <div class="card border-danger mx-sm-1 p-3">
                   <div class="card border-danger shadow text-danger p-3 my-card"><i class="fa fa-heart icon-fa" aria-hidden="true"></i></div>
                   <div class="text-danger text-center mt-3"><h4>Hearts</h4></div>
                   <div class="text-danger text-center mt-2"><h1>346</h1></div>
               </div>
           </div>
               ';
               echo $twentynine;
       
               }



               else
               if($a[$y][0]=="30")
                      {
                      # Inbox Number
                      $thirty = '
                      <div class="col-md-'.$vari.'" style="        margin-top:60px;

                      display: inline-table;
                      padding: 0px;">
                      <div class="card border-warning mx-sm-1 p-3">
                          <div class="card border-warning shadow text-warning p-3 my-card"><i class="fa fa-inbox icon-fa" aria-hidden="true"></i></div>
                          <div class="text-warning text-center mt-3"><h4>Inbox</h4></div>
                          <div class="text-warning text-center mt-2"><h1>346</h1></div>
                      </div>
                  </div>
                      ';
                      echo $thirty;
              
                      }




            else
               if($a[$y][0]=="31")
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
                      # Starter Pricing Number
                      $thirtyone = '
                      <div class="col-md-'.$vari.' princing-item red text-center">
                            <div class="pricing-divider ">
                                <h3 class="text-light">STARTER</h3>
                              <h4 class="my-0 text-light font-weight-normal mb-3"><span class="h3">$</span> 120 <span class="h5">/mo</span></h4>
                               <svg class="pricing-divider-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" y="0px">
                            <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
                    c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                            <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
                    c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                            <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
                    H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                            <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
                    c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                          </svg>
                            </div>
                            <div class="card-body bg-white mt-0 shadow">
                              <ul class="list-unstyled mb-5 position-relative">
                                <li><b>10</b> users included</li>
                                <li><b>2 GB</b> of storage</li>
                                <li><b>Free </b>Email support</li>
                                <li><b>Help center access</b></li>
                              </ul>
                              <button type="button" class="btn btn-lg btn-block  btn-custom ">Sign up for free</button>
                            </div>
                          </div>
                      ';
                      echo $thirtyone;
              
                      }







                      else
                      if($a[$y][0]=="32")
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
                             # Business Pricing Number
                             $thirtytwo = '
                             <div class="col-md-'.$vari.' princing-item blue text-center">
                             <div class="pricing-divider ">
                                 <h3 class="text-light">BUSINESS</h3>
                               <h4 class="my-0  text-light font-weight-normal mb-3"><span class="h3">$</span> 250 <span class="h5">/mo</span></h4>
                                <svg class="pricing-divider-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" y="0px">
                             <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
                     c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                             <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
                     c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                             <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
                     H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                             <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
                     c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                           </svg>
                             </div>
                   
                             <div class="card-body bg-white mt-0 shadow">
                               <ul class="list-unstyled mb-5 position-relative">
                                 <li><b>100 </b>users included</li>
                                 <li><b>10 GB</b> of storage</li>
                                 <li><b>Free</b>Email support</li>
                                 <li><b>Help center access</b></li>
                               </ul>
                               <button type="button" class="btn btn-lg btn-block  btn-custom ">Sign up for free</button>
                             </div>
                           </div>
                             ';
                             echo $thirtytwo;
                     
                             }









                             else
                             if($a[$y][0]=="33")
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
                                    # Pro Pricing Number
                                    $thirtythree = '
                                    <div class="col-md-'.$vari.' princing-item green text-center">
                                    <div class="pricing-divider ">
                                        <h3 class="text-light">PRO</h3>
                                      <h4 class="my-0 text-light font-weight-normal mb-3"><span class="h3">$</span> 450 <span class="h5">/mo</span></h4>
                                       <svg class="pricing-divider-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" y="0px">
                                    <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
                            c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                    <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
                            c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                    <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
                            H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                    <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
                            c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                                  </svg>
                                    </div>
                          
                                    <div class="card-body bg-white mt-0 shadow">
                                      <ul class="list-unstyled mb-5 position-relative">
                                        <li><b>300</b> users included</li>
                                        <li><b>20 GB</b> of storage</li>
                                        <li><b>Free</b> Email support</li>
                                        <li><b>Help center access</b></li>
                                      </ul>
                                      <button type="button" class="btn btn-lg btn-block  btn-custom ">Sign up for free</button>
                                    </div>
                                  </div>
                                    ';
                                    echo $thirtythree;
                            
                                    }



                                    else
               if($a[$y][0]=="34")
                      {
                      # Inbox Number
                      $thirtyfour = '
                      <article class="col-md-'.$vari.'" style="border: 1px solid #eee;
                      padding: 15px; margin-bottom:50px">
<a href="" class="float-right btn btn-outline-primary">Sign up</a>
<h4 class="card-title mb-4 mt-1">Sign in</h4>
	 <form>
    <div class="form-group">
    	<label>Your email</label>
        <input name="" class="form-control" placeholder="Email" type="email">
    </div> <!-- form-group// -->
    <div class="form-group">
    	<a class="float-right" href="#">Forgot?</a>
    	<label>Your password</label>
        <input class="form-control" placeholder="******" type="password">
    </div> <!-- form-group// --> 
    <div class="form-group"> 
    <div class="checkbox">
      <label> <input type="checkbox"> Save password </label>
    </div> <!-- checkbox .// -->
    </div> <!-- form-group// -->  
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Login  </button>
    </div> <!-- form-group// -->                                                           
</form>
</article>
                      ';
                      echo $thirtyfour;
              
                      }


                      else
               if($a[$y][0]=="35")
                      {
                      # Inbox Number
                      $thirtyfive = '
                      <article class="col-md-'.$vari.'" style="border: 1px solid #eee;
                      padding: 15px; margin-bottom:50px">
                      <a href="" class="float-right btn btn-outline-primary">Sign up</a>
                      <h4 class="card-title mb-4 mt-1">Sign in</h4>
                      <p>
                        <a href="" class="btn btn-block btn-outline-info"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
                        <a href="" class="btn btn-block btn-outline-primary"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
                      </p>
                      <hr>
                      <form>
                        <div class="form-group">
                            <input name="" class="form-control" placeholder="Email or login" type="email">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <input class="form-control" placeholder="******" type="password">
                        </div> <!-- form-group// -->                                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"> Login  </button>
                                </div> <!-- form-group// -->
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="small" href="#">Forgot password?</a>
                            </div>                                            
                        </div> <!-- .row// -->                                                                  
                    </form>
                    </article>
                      ';
                      echo $thirtyfive;
              
                      }

else {

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