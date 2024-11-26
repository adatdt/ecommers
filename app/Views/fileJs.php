<script>
    class MyData{
        getProduct()
        {
                $.ajax({
                    url : `<?= site_url("get_product") ?>` ,
                    type:"post",
                    // data:
                    dataType:"json",
                    success: function(x){
                        const product = myData.getCardProduct(x.data)
                        $(product).insertBefore( "#btm-prod" );
                    }
                })
        }   

        getCardProduct(data)
        {
            let html =""; 
            const images = data.images;
            data.data.forEach(element => {
                let carouser = "";
                let idx = 1;
                images[element.id].forEach(image => {
                    
                    let active = idx==1?"active":"";
                     carouser +=`<div class="carousel-item ${active}">
                                        <img src="<?php base_url()?>${image}" class="d-block w-100 " height="180rem" alt="...">
                                    </div>`
                    idx++;
                });

                html += ` 
                    <div class="col-sm-3 p-2">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p>
                                        <div id="carouselProduct${element.id}" class="carousel slide">
                                            <div class="carousel-inner">${carouser}</div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduct${element.id}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselProduct${element.id}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                </p>
                                <p class="card-text">
                                    <span class="card-title text-left text-capitalize font-weight-bold">${element.name}</span><br />
                                    <span class="card-title text-left text-capitalize font-weight-bold">Harga : <b>Rp.${element.price}</b></span>
                                </p>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-success btn-sm" type="button" onClick="myData.saveStorage(${element.id}, 1)"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Keranjang</button>
                                    <input type="hidden" id="price${element.id}" value="${element.price}">
                                    <input type="hidden" id="id${element.id}" value="${element.id}">
                                    <input type="hidden" id="name${element.id}" value="${element.name}">

                                    <input type="hidden" id="description${element.id}" value="${element.description}">
                                    <input type="hidden" id="category${element.id}" value="${element.category}">
                                    <input type="hidden" id="condition${element.id}" value="${element.condition}">
                                    <input type="hidden" id="created_on${element.id}" value="${element.created_on}">
                                    <input type="hidden" id="warranty${element.id}" value="${element.warranty}">
                                    <input type="hidden" id="brand${element.id}" value="${element.brand}">
                                    <input type="hidden" id="stock${element.id}" value="${element.stock}">
                                    <input type="hidden" id="path${element.id}" value="${images[element.id].toString()}">

                                    <button type="button" class="btn btn-outline-primary btn-sm" onClick="myData.getModal(${element.id})" >
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>                                
                    `
            });

            return html;
        }
        getModal(id)
        {
            $("#conditionModal").html($(`#condition${id}`).val())

            $("#categoryModal").html($(`#category${id}`).val())
            $("#brandModal").html($(`#brand${id}`).val())
            $("#descriptionModal").html($(`#description${id}`).val())
            $("#createdOnModal").html($(`#created_on${id}`).val())
            $("#warrantyModal").html($(`#warranty${id}`).val())
            $("#nameModal").html($(`#name${id}`).val())
            

            $("#priceModal").html($(`#price${id}`).val())
            $("#stockModal").html($(`#stock${id}`).val())
            
            
            $("#idModal").val($(`#id${id}`).val())
            $("#getPriceModal").val($(`#price${id}`).val())
            $("#getStockModal").val($(`#stock${id}`).val())
            
            let myCart = JSON.parse(localStorage.getItem('cart'))
            let getQty = 1
            if(myCart)
            {                
                myCart.forEach(element => {
                    if(element.id == id)
                    {
                        getQty = element.qty;
                    }
                });
            }

            $("#totalPriceModal").html($(`#price${id}`).val() * getQty)
            $("#qtyModal").val(getQty)

            const  pathStrin = $(`#path${id}`).val()
            const paths = pathStrin.split(",");
            let htmlPath = "";
            for (let i = 0; i < paths.length; i++) {
                let activePath = i<1?"active":"";

                htmlPath +=` <div class="carousel-item ${activePath}">
                            <img src="<?= base_url() ?>${paths[i]}" class="d-block w-100 " height="auto" alt="...">
                        </div>`
            }
            $(`#carouselModal`).html(htmlPath)

           $('#staticBackdrop').modal('show');
        }
        saveStorage(id, qty, type=0)
        {
            // console.log(id)
            const name = $(`#name${id}`).val();
            // const qty = 1;
            const getId = $(`#id${id}`).val();
            let getCart = localStorage.getItem('cart')
            let data = [{id:getId, name : name, qty:qty}]
            let newData = data
            let totaItem = 1; 

            if(getCart !== null )
            {
                let cart = JSON.parse(getCart);
                const spreadData = [...data, ...cart]                
                const totalByProduct = spreadData.reduce((element, obj) => {
                    // Jika kategori belum ada di accumulator, inisialisasi dengan 0
                    if (!element[obj.id]) {
                        element[obj.id] = 0;
                    }
                    // Tambahkan nilai amount ke kategori yang sesuai
                    element[obj.id] += parseInt(obj.qty);                                    
                    return element;
                }, {});

                let dataPush = [];
                let dataElement = {}
                totaItem = 0;
                spreadData.forEach(element => {
                    element.qty = totalByProduct[element.id]
                    if(!dataElement[element.id])
                    {                        
                        dataElement[element.id] = 1;
                        dataPush.push(element)
                        totaItem +=1;
                    }
                });

                newData  = dataPush;
                // console.log(dataPush)
                // console.log(totalByProduct)
            }
            $("#myCart").html(totaItem)
            localStorage.setItem('cart', JSON.stringify(newData));
            if(type == 0)
            {
                alert("Berhasil Menambahkan")
            }
            // console.log(localStorage.getItem('cart'));
            // this.infoChart()
        }
        saveStorageModal(id, qty){

            if(qty == 0 )
            {
                this.deleteItem(id)
                $('#staticBackdrop').modal('toggle');
            }
            else if(qty < 0)
            {
                alert("quantity tidak boleh minus");
            }
            else 
            {
                let myCart = JSON.parse(localStorage.getItem('cart'))
                let check = 0
                let newData = []

                if(myCart)
                {                    
                    myCart.forEach(element => {
                        if(element.id == id)
                        {
                        element.qty = qty
                        check = 1;   
                        }
    
                        newData.push(element)
                    });                
                }

                // jika datanya tidak ada di existing
                if(check < 1)
                {
                    this.saveStorage(id, qty,1)
                }
                else
                {
                    // Hapus objek 'user' dari localStorage
                    localStorage.removeItem('cart');
                    localStorage.setItem('cart', JSON.stringify(newData));                    
                }
                // this.infoChart()
                $('#staticBackdrop').modal('hide');
                // alert("berhasil menambahkan")
            }
        }
        deleteItem(id)
        {
            let myCart = JSON.parse(localStorage.getItem('cart'))
            let newData = []
            myCart.forEach(element => {
                if(element.id != id)
                {
                    newData.push(element)
                }

            });

            // Hapus objek 'user' dari localStorage
            localStorage.removeItem('cart');
            if(newData.length > 0)
            {
                localStorage.setItem('cart', JSON.stringify(newData));
                this.infoChart()
            }
            $("#myCart").html(newData.length)
        }
        infoChart()
        {
            let myCart = JSON.parse(localStorage.getItem('cart'))
            let htmlCart = ""
            myCart.forEach(element => {
                htmlCart += ` <li style="font-size:10px;">
                        <div class="row">
                            <div class="col-md-4"><b>${element.name} </b></div>
                            <div class="col-md-4">Qty <b>${element.qty} </b></div>
                            <div class="col-md-1"><a class="btn btn-sm btn-danger" onclick="myData.deleteItem(${element.id})"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
                        </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                `
            });
            htmlCart += ` <li><a href="#">checkout</a></li>`            
            $("#infoCart").html(htmlCart);
        }
        detailCart()
        {
            let myCart = JSON.parse(localStorage.getItem('cart'))
            let html = ""
            let btn = `  <button type="button" class="btn btn-danger btn-sm"  data-bs-dismiss="modal">Tutup</button> `
            if(myCart)
            {                
                myCart.forEach(element => {
                    let price = $(`#price${element.id}`).val()
                    html += `<tr><td>${element.name}</td>
                        <td>${price} </td>
                        <td>
                                <div class="input-group mb-3">
                                    <button onclick=myData.updateMinusCart(${parseInt(element.id)}) class="btn btn-outline-secondary" type="button" id="minusModalCart" data-id="${parseInt(element.id)}"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                    <input style="text-align: center; float: none;" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="qtyModalCart${element.id}" value=${element.qty}>
                                    <button  onclick=myData.updatePlusCart(${parseInt(element.id)}) class="btn btn-outline-secondary" type="button" id="plusModalCart" data-id="${parseInt(element.id)}"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>                          
                        
                        </td>
                        <td >Rp <span id="tdTotalCart${element.id}">${parseInt(element.qty) * parseInt(price)}</span></td>
                        <td><button  onClick=myData.deleteItemCart(${element.id}) type="button" class="btn btn-danger btn-sm"  ><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td><tr>`
                })
                btn += `<a   href="<?= site_url()?>/checkout" type="button" class="btn btn-outline-success btn-sm pull-right"  >Checkout</a>`
                
            }
            $("#tBody").html(html)
            $("#btnCartDetail").html(btn);

        }
        updatePlusCart(id, type=0)
        {
            let qty = $(`#qtyModalCart${id}`).val()
            let stock = parseInt($(`#stock${id}`).val())
            let totalQty = parseInt(qty)+1
            if(totalQty > stock)
            {
                alert("Tidak boleh melebihi stock")                
            }
            else if(totalQty < 1)
            {
                alert("minimal 1")                
            }
            else
            {
 
                if(type == 1)
                {
                    $(`#qtyModalCart${id}`).val(totalQty)
                    let price = $(`#checkoutPrice${id}`).val()
                    let total = parseInt(totalQty) * parseInt(price)
                    $(`#tdTotalCart${id}`).html(total)
                    $(`#totalPrice${id}`).val(total)
                    this.saveStorageModal(id, totalQty)

                    this.getTotal()
                }
                else
                {
                    $(`#qtyModalCart${id}`).val(totalQty)
                    let price = $(`#price${id}`).val()
                    let total = parseInt(totalQty) * parseInt(price)
                    $(`#tdTotalCart${id}`).html(total)
                    this.saveStorageModal(id, totalQty)

                }
            }
        }

        getTotal()
        {
            let myCart = JSON.parse(localStorage.getItem('cart'))
              
            let totItemCheckout = myCart.length;
            let totPrice = 0;

            $(".totalPrice").each(function(){
                 totPrice += parseInt($(this).val());                    
            });
            
            let totSend = $("#expedition").find(':selected').data('price')
            let  totTagihan = totSend + totPrice

            $("#totItemCheckout").html(totItemCheckout)
            $("#totPrice").html(totPrice)
            $(".totSend").html(totSend)
            $("#totTagihan").html(totTagihan)
        }

        updateMinusCart(id, type=0)
        {
            let qty = $(`#qtyModalCart${id}`).val()
            let totalQty = parseInt(qty)-1


            if(totalQty < 1)
            {
                alert("minimal 1")                
            }
            else
            {
                if(type == 1)
                {
                    $(`#qtyModalCart${id}`).val(totalQty)
                    let price = $(`#checkoutPrice${id}`).val()
                    let total = parseInt(totalQty) * parseInt(price)
                    $(`#tdTotalCart${id}`).html(total)
                    $(`#totalPrice${id}`).val(total)
                    this.saveStorageModal(id, totalQty)

                    this.getTotal()
                }
                else
                {
                    $(`#qtyModalCart${id}`).val(totalQty)
                    let price = $(`#price${id}`).val()
                    let total = parseInt(totalQty) * parseInt(price)
                    $(`#tdTotalCart${id}`).html(total)
                    this.saveStorageModal(id, totalQty)

                }                

            }
        }  
        deleteItemCart(id,type=0)
        {
            
            if(type==1)
            {
                let myCart = JSON.parse(localStorage.getItem('cart'))
                if(myCart.length >1)
                {
                    this.deleteItem(id)
                    $("#tr"+id).remove()   
                    this.getTotal()
                }
                else
                {
                    alert("Keranjang Tidak Boleh Kosong")
                }
            }
            else
            {
                this.deleteItem(id)
                this.detailCart()
            }
            
        }  
        
        getCheckout()
        {
                let myCart = localStorage.getItem('cart')
                console.log(myCart)
                $.ajax({
                    url : `<?= site_url("checkout/data") ?>` ,
                    type:"post",
                    data: "data="+myCart,
                    dataType:"json",
                    success: function(x){
                        
                        let html =""
                        x.forEach(element => {                            
                            html += `<tr id="tr${element.id}"><td>${element.name}<input type="hidden" class="idProdCart"  value="${element.id}" ></td>
                            <td>${element.price} <input type="hidden"   id="checkoutPrice${element.id}" value=${element.price} ></td>
                            <td>
                                    <div class="input-group mb-3">
                                        <button onclick=myData.updateMinusCart(${parseInt(element.id)},1) class="btn btn-outline-secondary" type="button" id="minusModalCart" data-id="${parseInt(element.id)}"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                        <input style="text-align: center; float: none;" type="text" class="form-control qtyCart" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="qtyModalCart${element.id}" value=${element.qty}>
                                        <button  onclick=myData.updatePlusCart(${parseInt(element.id)},1) class="btn btn-outline-secondary" type="button" id="plusModalCart" data-id="${parseInt(element.id)}"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>                          
                            
                            </td>
                            <td >Rp <span id="tdTotalCart${element.id}">${element.total_price}</span> <input type="hidden"  id="totalPrice${element.id}" class="totalPrice" value=${element.total_price} > </td>
                            <td><button  onClick=myData.deleteItemCart(${element.id},1) type="button" class="btn btn-danger btn-sm"  ><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td><tr>`                        
                        });
                        $(`#tCheckout`).html(html)
                         myData.getTotal()

                    }
                })            
        }
        savePayment(data){
            $.ajax({
                url : `<?= site_url("checkout/save_payment") ?>` ,
                type:"post",
                data:data,
                dataType:"json",
                success: function(x){
                    console.log(x)
                    if(x.code == 1)
                    {
                        window.location = `<?= site_url() ?>`
                         localStorage.clear();    
                    }
                    else
                    {
                        alert("gagal transaksi")
                    }
                }
            })
            
        }
    }
  const myData = new MyData();
   
</script>