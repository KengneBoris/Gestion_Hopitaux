<?php
include 'connexion.php';
include 'securite.php';
include './chifrement.php';

?>

<!DOCTYPE html>
<html>
  <head>
  <?php
       require_once("_head/meta.php");
       require_once("_head/link.php");
       require_once("_head/script.php");
       
    ?>
  <title>gestion hopital</title>
    <!-- Google fonts - Poppins -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header z-index-50">
      <?php require_once("_menu/head.php");?>

      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <?php require_once("_menu/menu.php");?>
        <!-- menu -->
        <div class="content-inner w-100">
          <!-- Page Header-->
          <header class="bg-white shadow-sm px-4 py-3 z-index-20">
            <div class="container-fluid px-0">
              <h2 class="mb-0 p-1">tableau de bord</h2>
            </div>
          </header>
          <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <u><h2 style="float: right;"><?php echo date('d/m/y  h:i:s');?></h2></u>
                        
                    </div>
                    </div>
                <!-- /.row -->
                <div ><center><iframe name="plan" width= 100% height= 580px></iframe></center></div>         
               
            </div>

</div>      
                  
                </div>
              </div>
            </div>
          </section>

           
    <?php require_once("_footer/footer.php");?>
          <!-- Page Footer-->
          
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <?php require_once("_footer/script.php");?>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>