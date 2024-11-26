<div class="card">
    <h5 class="card-header">Checkout</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
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
                            <tbody id="tCheckout"></tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Masukan Alamat Anda
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"> <textarea class="form-controll"  style="min-width: 100%" id="address"></textarea></li>
                            </ul>
                        </div>
                        <p></p>
                    </div>                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Pengiriman
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <select id="expedition" class="form-control">
                                        <option value="1" data-price="10000">reguler</option>
                                        <option value="2" data-price="15000">express</option>
                                    </select>
                                    Harga : <b>Rp.<span class="totSend">10000</span></b>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Pembayaran
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <select id="payment" class="form-control">
                                        <option value="bni" data-id="0989xxxx" >BNI</option>
                                        <option value="mandiri" data-id="0676xxxx" >MANDIRI</option>
                                        <option value="bca" data-id="76689xxxx">BCA</option>
                                    </select>
                                    no rek : <span id="rek">0989xxxx</span>
                                </li>
                            </ul>
                        </div>                        
                    </div>
                    <div class="col-md-12"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Ringkasan Belanja
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Total Item : <span id="totItemCheckout"></span><br>
                            Total Harga : Rp.<span id="totPrice"></span><br>
                            Harga Pengiriman : Rp.<span class="totSend"></span> <br></li>
                        <li class="list-group-item">Total Tagihan: Rp.  : Rp.<span id="totTagihan"></span></li>
                        <li class="list-group-item">
                                <a href="#" class="btn btn-success pull-right" id="getPayment">Bayar</a>                    
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="checkoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
            <div class="modal-body text-center">
                    Terimaksih Sudah berbelanja silahkan untuk melakukan Pembayaran
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm"  id="btnHome">Tutup</button>
            </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function(){
        myData.getCheckout()

        $("#getPayment").on("click", function(){
            let address = $("#address").val()

            if(address == "" )
            {
                alert("alamat harus diisi")
            }
            else
            {
                $("#checkoutModal").modal("show");
            }
        })

        $("#expedition").on("change", function(){
            myData.getTotal()
        })

        $("#payment").on("change", function(){
            let rek = $(this).find(':selected').data('id')
            $("#rek").html(rek)
        })

        $("#btnHome").on("click", function(){

            let idProdCart = [];
            let qtyCart = [] ;
            let address = $("#address").val()
            let expedition = $("#expedition").val()
            let payment = $("#payment").val()
            let totSend = $("#expedition").find(':selected').data('price')

            $(".idProdCart").each(function(){
                 idProdCart.push(parseInt($(this).val()));                    
            })
            $(".qtyCart").each(function(){
                 qtyCart.push(parseInt($(this).val()));                    
            });

            console.log(qtyCart.toString());
            $param =  {id:idProdCart, qty:qtyCart, expedition:expedition, payment:payment, address:address,fare_expedition:totSend}
            myData.savePayment($param)
            // let qtyCart = [] ;
            
            // window.location = `<?= site_url() ?>`
            //  localStorage.clear(); 
        })
    })
</script>