<?php include "modal.php" ?>
<div class="row ">
    <div class="col-12 p-2">
        <div id="carouselExample" class="carousel slide"  data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2024/7/22/6d79d227-67fe-497a-a904-af990882e2ee.jpg?ect=4g" class="d-block w-100 " height="300px" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://images.tokopedia.net/img/NsjrJu/2020/9/25/ea701ee6-f36b-473d-b429-4d2a1da0713d.jpg?ect=4g" class="d-block w-100 " height="300px" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://images.tokopedia.net/img/NsjrJu/2020/9/25/b1d2ed1e-ef80-4d7a-869f-a0394f0629be.jpg?ect=4g" class="d-block w-100 " height="300px" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
   <div class="col-12 p-2" id="kategori">
        <div class="card p-4 shadow rounded" style="width: 100%;">
            <h5 class="card-title">Kategori</h5>
            <div class="row">
                <?php foreach ($category as $key => $value) { ?>
                <div class="col-sm-3 p-2">
                    <div class="card text-white shadow" style="background-color:<?= $value->color_card?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $value->name; ?></h5>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
                
        </div>
    </div>    
    <div class="col-12 p-2" id="product">
    
            <h5 class="card-title">Product</h5>
            <div class="row">
                <div class="col-sm-12 p-2" id="btm-prod"></div>
            </div>
                

    </div>
    <div class="col-12">
        halo
    </div>
</div>

<script>
   
    $(document).ready(function(){
        myData.getProduct();

        let myCart = JSON.parse(localStorage.getItem('cart'))
        let totalCart = !myCart?0:myCart.length
        $("#myCart").html(totalCart)
        // myData.infoChart()
    })

</script>