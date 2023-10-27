<?php
    include('function/student-function.php');
?>
<?php
	include('pages-head.php');
?>


    <!-- Top navigation -->
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
.img{

   border: 1px solid grey;
   width: 350px;

}
.btn{

   margin-top: 1rem;
}




</style>

<body>

  <!-- Top navigation -->
  <?php
  include('pages-topbar.php');
  ?>

<div class="intro-about ">
<div class="container " >
      <br>
      <button type="button" name="updatecoverletter" id="updatecoverletter" class="btn btn-primary" onclick="window.location.href='updatecoverletter.php'">Back <--</button>
     
      
      <h1 class="text-center">CHOOSE YOUR COVER LETTER TEMPLATE</h1>
      <h3 class="text-center">Remember, you can always change your template later.</h3>
      <br>
      <div class="row">
           
      <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image">
            <div class="hovereffect">
              <form  method="post" action="cover_letter_type1.php">
               <button type="submit" style="border: none; background: unset; " name="tmp" value="1">
                <img alt="Cover letter type-1" src="http://localhost/employability-platform/assets/cover_letter_Images/cover_letter_type1.png" class="img img-responsive thumbnail "  />
                <span class="btn btn-primary btn-sm">Use This Template</span>
               </button></form>
            </div>  
            </div>
            
         
            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image">
            <div class="hovereffect">
              <form  method="post" action="cover_letter_type2.php">
               <button type="submit" style="border: none; background: unset; " name="tmp" value="1">
                <img alt="Resume1" src="http://localhost/employability-platform/assets/cover_letter_Images/cover_letter_type2.png" class="img img-responsive thumbnail " style="height: 500px;" />
                <span class="btn btn-primary btn-sm">Use This Template</span>
               </button></form>
            </div>  
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image thumbr">
            <div class="hovereffect">
               <form  method="post" action="cover_letter_type3.php">
               <button type="submit" style="border: none; background: unset;" name="tmp" value="2">
               <img alt="Resume1" src="http://localhost/employability-platform/assets/cover_letter_Images/cover_letter_type3.png" class="img img-responsive thumbnail " style="height: 500px;" />
                <span class="btn btn-primary btn-sm">Use This Template</span>
               </button></form>
            </div>  
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image thumbl">
            <div class="hovereffect">
               <form  method="post" action="cover_letter_type4.php">
               <button type="submit" style="border: none; background: unset;" name="tmp" value="3">
               <img alt="Resume1" src="http://localhost/employability-platform/assets/cover_letter_Images/cover_letter_type4.png" class="img img-responsive thumbnail " style="height: 500px;" />
                <span class="btn btn-primary btn-sm">Use This Template</span>
               </button></form>
            </div>      
            </div>                

            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image">
            <div class="hovereffect">
              <form  method="post" action="cover_letter_type5.php">
               <button type="submit" style="border: none; background: unset;" name="tmp" value="4">
               <img alt="Resume1" src="http://localhost/employability-platform/assets/cover_letter_Images/cover_letter_type5.png" class="img img-responsive thumbnail " style="height: 500px;"  />
                <span class="btn btn-primary btn-sm">Use This Template</span>
                </button></form>
            </div>  
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 template-file template-file__image thumbr ">
            <div class="hovereffect">
               <form  method="post" action="cover_letter_type6.php">
               <button type="submit" style="border: none; background: unset;" name="tmp" value="5">
               <img alt="Resume1" src="http://localhost/employability-platform/assets/cover_letter_Images/cover_letter_type6.png" class="img img-responsive thumbnail " style="height: 500px;"/>
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
