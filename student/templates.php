<?php
    include('function/student-function.php');
?>
<?php
	include('pages-head.php');
?>


    <!-- Top navigation -->

<!-- Skill lists -->

<!DOCTYPE html>
<html lang="en-US">

<head>
      <title>Resume-Templates | <?php echo $domain; ?></title>
      <meta name="title" content="Resume-Templates  | <?php echo $domain; ?>">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="language" content="English">
      <meta name="description" content="Impressive Resumes Made Easy! Get hired with the professional Perfect Resume that will make you stand out of the crowd! Start Now!">
      <meta name="keywords" content="<?php echo $keyword ?>">
      <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
      <meta name="robots" content="index, follow">
      <meta name="url" content="https://<?php echo $domain; ?>/resume/templates">
      <meta name="author" content="Vinod Kumar">
      <link rel="canonical" href="https://<?php echo $domain; ?>/resume/templates" />
      <meta name="generator" content="HTML 5 and PHP 7.1" />

      <!-- Meta OG Property -->
      <meta property="og:locale" content="en_US" />
      <meta property="og:type" content="article" />
      <meta property="og:title" content="Resume Templates  | <?php echo $domain; ?>" />
      <meta property="og:description" content="Impressive Resumes Made Easy! Get hired with the professional Perfect Resume that will make you stand out of the crowd! Start Now!" />
      <meta property="og:url" content="https://<?php echo $domain; ?>/resume/templates" />
      <meta property="og:site_name" content="<?php echo $domain; ?>" />

      <!-- Twitter Card -->
      <meta name="twitter:card" content="summary" />
      <meta name="twitter:description" content="Impressive Resumes Made Easy! Get hired with the professional Perfect Resume that will make you stand out of the crowd! Start Now!" />
      <meta name="twitter:title" content="Resume-Templates  | <?php echo $domain; ?>" />

      <!-- Base URL Set -->
     

      <!--- Include CSS files --->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      
      <!-- Title Logo -->     
      <link rel="icon" href="img/icon-cv.svg" sizes="32x32" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      

      <!-- Latest compiled and minified CSS -->
      <!-- Font Awsome -->
      

      <!-- Custom CSS -->
    
</head>
<style>
   .hovereffect {
width:100%;
height:100%;
float:left;

position:relative;
text-align:center;
cursor:default;
}



.hovereffect img {
display:block;
position:relative;
-webkit-transition:all .4s linear;
transition:all .4s linear;
}






.hovereffect:hover img {
-ms-transform:scale(1.2);
-webkit-transform:scale(1.2);
transform:scale(1.2);
}
#arrow{
   position: absolute;
   top: 5%;
}

</style>
<body>
<div class="intro-about ">
<div class="container " >
      <br>
    <!-- <button class="btn btn-outline-primary btn-sm d-none d-md-block" id="arrow">
      <a href="student-manage-portfolio.php" style="font-size:29px"> <i class="fa fa-long-arrow-left"></i></a>
     </button> -->
      <h2 class="text-center">CHOOSE YOUR RESUME TEMPLATE</h2>
      <h5 class="text-center">Remember, you can always change your template later on.</h5>
      <br>
      <div class="row">
           
      <div class="col-md-4 col-sm-6 col-xs- template-file template-file__image">
            <div class="hovereffect">
              <form  method="post" action="resume.php">
               <button type="submit" style="border: none; background: unset; " name="tmp" value="1">
                <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-25%20095517.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                <span class="btn btn-primary btn-sm">Use This Template</span>
               </button></form>
            </div>  
            </div>
            
         
            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image">
            <div class="hovereffect">
              <form  method="post" action="resume2.php">
               <button type="submit" style="border: none; background: unset; " name="tmp" value="1">
                <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-25%20091351.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                <span class="btn btn-primary btn-sm">Use This Template</span>
               </button></form>
            </div>  
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image thumbr">
            <div class="hovereffect">
               <form  method="post" action="resume4.php">
               <button type="submit" style="border: none; background: unset;" name="tmp" value="2">
               <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-12-07%20141949.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                <span class="btn btn-primary btn-sm">Use This Template</span>
               </button></form>
            </div>  
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image thumbl">
            <div class="hovereffect">
               <form  method="post" action="resume3.php">
               <button type="submit" style="border: none; background: unset;" name="tmp" value="3">
               <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-25%20095054.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                <span class="btn btn-primary btn-sm">Use This Template</span>
               </button></form>
            </div>      
            </div>                

            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image">
            <div class="hovereffect">
              <form  method="post" action="resume1.php">
               <button type="submit" style="border: none; background: unset;" name="tmp" value="4">
               <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-24%20155345.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                <span class="btn btn-primary btn-sm">Use This Template</span>
                </button></form>
            </div>  
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image thumbr ">
            <div class="hovereffect">
               <form  method="post" action="resume5.php">
               <button type="submit" style="border: none; background: unset;" name="tmp" value="5">
               <img alt="Resume1" src="http://localhost/employability-platform/assets/images/avatar/Screenshot%202022-11-25%20112107.png" class="img img-responsive thumbnail " style="border: 1px solid grey;" />
                <span class="btn btn-primary btn-sm">Use This Template</span>
               </button></form>
            </div>  
            </div>

                             

           
                
               </button></form>
            </div>                     
      </div>
</div>
<br><br><br><br>

<?php
	include('pages-footer.php');
?>

</body>
</html>
