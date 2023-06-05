<html lang="en">
    <head> 
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ==" crossorigin="anonymous" />
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>DazzleDibs</title>
    </head>
    <body class="bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-11 mx-auto">
                    <div class="row mt-5 gx-3">
                    @if(count($cart) > 0)
                        <!-- left side div -->
                        <div class="col-md-12 col-lg-8 col-11 mx-auto main_cart mb-lg-0 mb-5 shadow">
                        <h2 class="py-4 font-weight-bold">Cart ({{ session('cartCount', 0) }} items)</h2>
                        @foreach($cart as $productId => $item)
                            <div class="card p-4">
                                    <div class="row">
                                        <!-- cart images div -->
                                        <div class="col-md-5 col-11 mx-auto bg-light d-flex justify-content-center align-items-center shadow product_img">
                                            <img src="{{ $item['product']->image_link }}" class="img-fluid" alt="cart img">
                                        </div>
                                            <!-- cart product details -->
                                            <div class="col-md-7 col-11 mx-auto px-4 mt-2">
                                                <div class="row">
                                                    <!-- product name  -->
                                                    <div class="col-6 card-title">
                                                        <h1 class="mb-4 product_name">{{ $item['product']->title }}</h1>
                                                        @if ($item['product']->color)
                                                            <p class="mb-2">COLOR: {{ $item['product']->color }}</p>
                                                        @endif
                                                            @if ($item['product']->size)
                                                                <div class="size-dropdown">
                                                                    <select class="size-dropdown-toggle" style="background-color: white; border-color:white">
                                                                        <option disabled selected>Select Size</option>
                                                                        @foreach (explode(',', $item['product']->size) as $size)
                                                                            <option class="size-option">{{ $size }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endif 
                                                    </div>
                                                    <!-- quantity inc dec -->
                                                    <div class="col-6">
                                                        <ul class="pagination justify-content-end set_quantity">
                                                            <form action="{{ route('products.removeFromCart', $item['product']->id) }}" method="POST" data-tip="Add to Cart">
                                                            @csrf 
                                                                <button class="page-link" onclick="decreaseNumber('textbox', 'itemval', '{{ $productId }}', '{{ $item['product']->price }}')">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </form>
                                                            <li class="page-item">
                                                                <input type="text" name="" class="page-link" value="{{ $item['quantity'] }}" id="textbox_{{ $productId }}">
                                                            </li>
                                                            <form action="{{ route('products.addToCart', $item['product']->id) }}" method="POST" data-tip="Add to Cart">
                                                            @csrf                                                                
                                                                <button class="page-link" onclick="increaseNumber('textbox', 'itemval', '{{ $productId }}', '{{ $item['product']->price }}')">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </form>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- //remover move and price -->
                                                <div class="row">
                                                    <div class="col-8 d-flex justify-content-between remove_wish">
                                                        <form action="{{ route('cart.removeItem', $productId) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button type="submit" style="background-color:white; border-color:white;"><p><i class="fas fa-trash-alt"></i> REMOVE</p></button>
                                                        </form>
                                                        <p><i class="fas fa-heart"></i> MOVE TO WISH LIST </p>
                                                    </div>
                                                    <div class="col-4 d-flex justify-content-end price_money">
                                                    <h3>$<span id="itemval_{{ $productId }}">{{ $item['product']->price }}</span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                <hr/>
                            </div>
                            @else
                                <p>Your cart is empty.</p>
                            @endif
                            <!-- right side div -->
                            <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                                <div class="right_side p-3 shadow bg-white">
                                    <h2 class="product_name mb-5">The Total Amount Of</h2>
                                        <div class="price_indiv d-flex justify-content-between"> 
                                            <p>Product amount</p>
                                            <p>$<span id="product_total_amt">{{ $totalAmount }}</span></p>
                                        </div>
                                        <div class="price_indiv d-flex justify-content-between">
                                            <p>Shipping Charge</p>
                                            <p>$<span id="shipping_charge">50.0</span></p>
                                        </div>
                                    <hr />
                                    <div class="total-amt d-flex justify-content-between font-weight-bold">
                                        <p>The total amount of (including VAT)</p>
                                        <p>$<span id="total_cart_amt">{{ $totalAmount + 50 }}</span></p>
                                    </div>
                                    <a href="/stripe" class="btn btn-primary text-uppercase">Checkout</a>
                                </div>
                                <!-- discount code part -->
                                <div class="discount_code mt-3 shadow">
                                    <div class="card">
                                        <div class="card-body">
                                            <a class="d-flex justify-content-between" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Add a discount code (optional)
                                                <span><i class="fas fa-chevron-down pt-1"></i></span>
                                            </a>
                                            <div class="collapse" id="collapseExample">
                                                <div class="mt-3">
                                                    <input type="text" name="" id="discount_code1" class="form-control font-weight-bold" placeholder="Enter the discount code">
                                                    <small id="error_trw" class="text-dark mt-3">code is thapa</small>
                                                </div>
                                                    <button class="btn btn-primary btn-sm mt-3" onclick="discount_code()">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- discount code ends -->
                                <div class="mt-3 shadow p-3 bg-white">
                                    <div class="pt-4">
                                        <h5 class="mb-4">Expected delivery date</h5>
                                        <p>July 27th 2020 - July 29th 2020</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- Optional JavaScript -->
<!-- Popper.js first, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

<script type="text/javascript">

    var product_total_amt = document.getElementById('product_total_amt');
    var shipping_charge = document.getElementById('shipping_charge');
    var total_cart_amt = document.getElementById('total_cart_amt');
    var discountCode = document.getElementById('discount_code1');
    
    const decreaseNumber = (incdec, itemprice, productId, initialPrice) => {
    var itemval = document.getElementById(incdec + '_' + productId);
    var itemprice = document.getElementById(itemprice + '_' + productId);

    if (itemval.value <= 0) {
        itemval.value = 0;
        alert('Negative quantity not allowed');
    } else {
        itemval.value = parseFloat(itemval.value) - 1;
        itemval.style.background = '#fff';
        itemval.style.color = '#000';
        itemprice.innerHTML = parseFloat(initialPrice) * parseFloat(itemval.value);
        calculateTotal();
    }
}

const increaseNumber = (incdec, itemprice, productId, initialPrice) => {
    var itemval = document.getElementById(incdec + '_' + productId);
    var itemprice = document.getElementById(itemprice + '_' + productId);


        itemval.value = parseFloat(itemval.value) + 1;
        itemprice.innerHTML = parseFloat(initialPrice) * parseFloat(itemval.value);
        calculateTotal();
}


const calculateTotal = () => {
    var productTotalAmt = 0;

    // Loop through all the items and calculate the total amount
    @foreach($cart as $productId => $item)
        var itemval = document.getElementById('textbox_{{ $productId }}');
        var itemprice = document.getElementById('itemval_{{ $productId }}');
        productTotalAmt += parseFloat(itemprice.innerHTML);
    @endforeach

    var shippingCharge = parseFloat(document.getElementById('shipping_charge').innerHTML);
    var totalCartAmt = productTotalAmt + shippingCharge;

    document.getElementById('product_total_amt').innerHTML = productTotalAmt.toFixed(2);
    document.getElementById('total_cart_amt').innerHTML = totalCartAmt.toFixed(2);
}



    const  discount_code = () => {
        let totalamtcurr = parseInt(total_cart_amt.innerHTML);
        let error_trw = document.getElementById('error_trw');
        
        if(discountCode.value === 'thapa'){
            let newtotalamt = totalamtcurr - 15;
            total_cart_amt.innerHTML = newtotalamt;
            error_trw.innerHTML = "Hurray! code is valid";
        }else{
            error_trw.innerHTML = "Try Again! Valid code is thapa";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        var sizeDropdown = document.querySelector(".size-dropdown-toggle");
        sizeDropdown.addEventListener("change", function() {
            var selectedSize = this.value;
            // Do something with the selected size, such as updating the cart or performing an action
        });
    });

</script>

</body>
</html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap');
    
    .size-dropdown-list {
    display: none;
    }

    .size-dropdown-list.active {
        display: block;
    }

    
    * { 
        margin: 0; 
        padding: 0; 
        box-sizing: border-box; 
        font-family: 'Mulish', sans-serif; 
    } 
    
    :root { 
        --text-clr: #4f4f4f; 
    } 
    
    p { 
        color: #6c757d; 
    } 
    
    a { 
        text-decoration: none; 
        color: var(--text-clr); 
    } 
    
    a:hover { 
        text-decoration: none; 
        color: var(--text-clr); 
    } 
    
    h2 { 
        color: var(--text-clr); 
        font-size: 1.5rem; 
    } 
    
    .main_cart { 
        background: #fff; 
    } 
    
    .card { 
        border: none; 
    } 
    
    .product_img img { 
        min-width: 200px; 
        max-height: 200px; 
    } 
    
    .product_name { 
        color: black; 
        font-size: 1.4rem; 
        text-transform: capitalize; 
        font-weight: 500; 
    } 
    
    .card-title p { 
        font-size: 0.9rem; 
        font-weight: 500; 
    } 
    
    .remove-and-wish p { 
        font-size: 0.8rem; 
        margin-bottom: 0; 
    } 
    
    .price-money h3 { 
        font-size: 1rem; 
        font-weight: 600; 
    } 
    
    .set_quantity { 
        position: relative; 
    } 
    
    .set_quantity::after { 
        content: "(Note, 1 piece)"; 
        width: auto; 
        height: auto; 
        text-align: center; 
        position: absolute; 
        bottom: -20px; 
        right: 1.5rem; 
        font-size: 0.8rem; 
    } 
    
    .page-link { 
        line-height: 16px; 
        width: 45px; 
        font-size: 1rem; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        color: #495057; 
    } 
    
    .page-item input { 
        line-height: 22px; 
        padding: 3px; 
        font-size: 15px; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        text-align: center; 
    } 
    
    .page-link:hover { 
        text-decoration: none; 
        color: #495057; 
        outline: none !important; 
    } 
    
    .page-link:focus { 
        box-shadow: none; 
    } 
    
    .price_indiv p { 
        font-size: 1.1rem; 
    } 
    
    .fa-heart:hover { 
        color: red; 
    }
</style>