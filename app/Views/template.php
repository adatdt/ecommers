<!DOCTYPE html>
<html lang="en">
<head>
    <style>        
        html,
        body {
        height: 100%;
        }
        #footer {
        flex-shrink: none;
        }
    </style>
    <meta charset="UTF-8">
    <title></title>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> -->
    
</head>
<?php 
    include "fileJs.php"; 
    $typeMenu = empty($typeMenu)?"":"display:none;";
?>
<body>

    <nav class="navbar navbar-expand-md navbar-light fixed-top"  style="background-color:  #a3a3c2;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url();?>">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item" style="<?= $typeMenu ?>">
                        <a class="nav-link " aria-current="page" href="#kategori" >Kategori</a>
                    </li>
                    <li class="nav-item " style="<?= $typeMenu ?>">
                        <a class="nav-link"  href="#product" >Product</a>
                    </li>
                    <li class="nav-item " >
                        <a class="nav-link"  href="#myFooter" >Contact</a>
                    </li>

                </ul>
      
                <div class="d-flex align-items-end " style="width:5rem" >

                    <!-- Example split danger button -->
                    <div class="btn-group" style="<?= $typeMenu ?>">
                        <!-- <ul class="dropdown-menu " id="infoCart" style="padding:10px; width:13rem;"></ul> -->
                        <button type="button" class="btn  "  id="btnCart">
                            <i class="fa fa-shopping-cart" style="color:white" aria-hidden="true"></i>
                            <span style=" padding:3px; color:white; width:20px; height:20px;" id="myCart"></span>
                        </button>
                        <!-- <button type="button" class="btn btn-danger">Action</button> -->
                    </div>

                </div>
            </div>
        </div>
    </nav>    

    <div class="container" style="margin-top:5%;">
        <p><?= empty($content)?"":view($content); ?></p>
    </div>
<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted" id="myFooter">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Alamat
          </h6>
          <p>
            Bekasi
          </p>
        </div>
        <!-- Grid column -->


        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p> adatdt@gmail.com</p>
        
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->


    <!-- Modal -->
    <div class="modal fade" id="modalCart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tBody">
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" id="btnCartDetail"></div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function(){
                
            $("#btnCart").on("click", function(){
                $("#modalCart").modal('show');
                myData.detailCart()
                // console.log("haloo")
            })
        })
    </script>
   
</body>
</html>
