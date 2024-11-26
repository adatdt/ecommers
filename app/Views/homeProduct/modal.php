<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-3">
                <div id="carouselDetailProduct" class="carousel slide">
                    <div class="carousel-inner" id="carouselModal"></div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselDetailProduct" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselDetailProduct" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class=" text-center text-capitalize" style=" font-weight: bold;" id="nameModal"></div> 
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">                        
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab" aria-controls="detail" aria-selected="true">Detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specific-tab" data-bs-toggle="tab" data-bs-target="#specific" type="button" role="tab" aria-controls="specific" aria-selected="false">Spesifikasi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="information-tab" data-bs-toggle="tab" data-bs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="false">Info Penting</button>
                        </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                            <div class="form-group">                                
                                    Kondisi: <span id="conditionModal"></span><br/>
                                    Kategori: <span id="categoryModal"></span><br/>
                                    Merek: <span id="brandModal"></span><br/>                                    
                            </div>
                            <p></p>
                            <b>Deskripsi</b><br /> 
                            <div class="form-group" id="descriptionModal"></div>

                        </div>
                        <div class="tab-pane fade" id="specific" role="tabpanel" aria-labelledby="specific-tab">
                            <div class="form-group">
                                    <b>Info Product</b><br/>
                                    Tanggal Rilis: <span id="createdOnModal"></span><br/>
                                    Garansi: <span id="warrantyModal"></span><br/>
                                    <p></p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                            <div class="form-group">
                                <b>Pengiriman</b><br/>                                    
                                    Hi selamat datang~! Semua Barang Ready Kak Silakan Diorder. 
                                    Tanggal Merah - Sabtu - Minggu Toko Libur. 
                                    Pengiriman cepat sekitar Jakarta bisa menggunakan Gosend atau GRAB Instan
                                    Pengiriman sekitar JABODETABEK bisa memilih kurir J&T
                                    Pengiriman Luar Kota khususnya P. Jawa bisa memilih kurir J&T Wajib Packing Kayu
                                    Pengiriman Luar Jawa bisa ditanyakan langsung melalui chat sebelum melakukan pemesanan atau
                                    Wajib Packing Kayu kurir yang tersedia di Tokopedia Pos Indonesia dan JNE Trucking pengiriman barang cair dan kimia
                            </div>
                            <div class="form-group">
                                <b>Kwalitas dan Ke Asli an Barang</b><br/>                                    
                                    Untuk Menjaga Kwalitas dan Ke Asli an Barang Disarankan Kepada Semua Pembeli,membeli Pada Link Dibawah Ini 
                            </div>                                                        
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr />
                        <div class="form-group text-muted">                            
                            <i class="fa fa-map-marker" aria-hidden="true"></i> Dikirim Dari : <b id="origin">Jakartya Barat</b>
                            <br>
                            <i class="fa fa-truck" aria-hidden="true"></i> Estimasi tiba besok - 27 Nov
                        </div>


                    </div>                     
                </div>                    
            </div>
            <div class="col-md-3">
                <div class="card" >
                    <div class="card-body">
                        <h5 class="card-title">Atur jumlah dan catatan</h5>
           
                        <p class="card-text"> 
                                <label for="exampleFormControlInput1" class="form-label text-muted">Stok : <b id="stockModal">10</b></label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" type="button" id="minus"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                    <input style="text-align: center; float: none;" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="qtyModal" value=1>
                                    <button class="btn btn-outline-secondary" type="button" id="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>   
                                <span>stok melibihi batas</span>        
                        </p>
                        <input type="hidden" value="17000" id="getPriceModal">
                        <input type="hidden" value="10" id="getStockModal">
                        Harga : <b >Rp.<span id="priceModal">17.000</span></b><br />
                        Total Harga: <b >Rp.<span id="totalPriceModal">17.000</span></b> 
                        <p></p>
                        <div class="d-grid gap-2">
                            <input type="hidden" id="idModal" >
                            <button class="btn btn-outline-success btn-sm" type="button" id="cartModal"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Keranjang</button>
                        </div>
                    </div>
                </div>              
            </div>            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm"  data-bs-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#plus").on("click", function(){
            let qty = parseInt($("#qtyModal").val());
            let totalQty = qty + 1 
            let getPrice = parseInt($("#getPriceModal").val());
            let getStock = parseInt($("#getStockModal").val());

            if(totalQty >getStock)
            {
                alert("tidak boleh melebihi stok")
            }
            else
            {
                $("#qtyModal").val(totalQty);
                let totalPrice = getPrice * totalQty
    
                $("#totalPriceModal").html(totalPrice)    
            }
        })
        $("#minus").on("click", function(){
            let qty = parseInt($("#qtyModal").val());
            let totalQty = qty - 1
            
            if(totalQty<1)
            {
                alert("minimal 1 barang")   
            }
            else
            {
                let getPrice = parseInt($("#getPriceModal").val());
                $("#qtyModal").val(totalQty);
                let totalPrice = getPrice * totalQty
    
                $("#totalPriceModal").html(totalPrice)
                
            }
        })

        $(`#cartModal`).on("click", function(){
            const id = $("#idModal").val()
            const qty = $("#qtyModal").val()
            // console.log(id+" "+qty)
            myData.saveStorageModal(id, qty)
 
        })
    })
</script>