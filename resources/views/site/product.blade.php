<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700|Open+Sans:400,700">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<div class="container-fluid">
        <div class="cart">
            <div class="row row1">
                <div class="col-md-4">
                    <img src="{{ $product->image_link }}" width="100%" id="ProductImg" style="padding-right: 10px;">
                    <div class="small-imgs">
                        <img src="{{ $product->image_link }}" width="100%" class="small-img">
                    @foreach ($product->gallery as $image)
                        <img src="{{ $image->image_path }}" width="100%" class="small-img">
                    @endforeach
                    </div>                
                </div>
                <div class="col-md-6">
                    <h1 class="product-title">{{ $product->title }}</h1>
                    <div class="reviews">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $product->averageRating())
            <i class="fas fa-star"></i>
        @elseif ($i - 0.5 <= $product->averageRating())
            <i class="fas fa-star-half-alt"></i>
        @else
            <i class="far fa-star"></i>
        @endif
    @endfor
    <p>{{ $product->reviews()->count() }} reviews</p>
</div>
    <!-- Form to submit a review -->
    <form method="post" action="{{ route('reviews.store') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="rating">
    @for ($i = 1; $i <= 5; $i++)
        <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}" hidden>
        <label for="rating{{ $i }}"><i class="far fa-star"></i></label>
    @endfor
        </div>
        <textarea name="content" placeholder="Write your review" required></textarea>
        <div class="container">
        <button type="submit" id="btn">
            <p id="btnText">Submit</p>
            <div class="check-box">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                    <path fill="transparent" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>
            </div>
        </button>
        </div>
    </form>
    <style>
.rating{
    margin-left: 15px;
}

button{
    margin-top: 5px;
    margin-left: 5px;
    width: 135px;
    height: 40px;
    border: none;
    outline: none;
    background: #2f2f2f;
    color: #fff;
    font-size: 22px;
    border-radius: 40px;
    text-align: center;
    box-shadow: 0 6px 20px -5px rgba(0,0,0,0.4);
    position: relative;
    overflow: hidden;
    cursor: pointer;
}

.check-box{
    width: 80px;
    height: 80px;
    border-radius: 40px;
    box-shadow: 0 0 12px -2px rgba(0,0,0,0.5);
    position: absolute;
    top: 0;
    right: -40px;
    opacity: 0;
}

.check-box svg{
    width: 40px;
    margin: 20px;
}

svg path{
    stroke-width: 3;
    stroke: #fff;
    stroke-dasharray: 34;
    stroke-dashoffset: 34;
    stroke-linecap: round;
}

.active{
    background: #ff2b75;
    transition: 1s;
}

.active .check-box{
    right: 0;
    opacity: 1;
    transition: 1s;
}

.active p{
    margin-right: 125px;
    transition: 1s;
}

.active svg path{
    stroke-dashoffset: 0;
    transition: 1s;
    transition-delay: 1s;
}
    </style>
    <script type="text/javascript">
        const btn = document.querySelector("#btn");
        const btnText = document.querySelector("#btnText");

        btn.onclick = () => {
            btnText.innerHTML = "Thanks";
            btn.classList.add("active");
        };
    </script>
<script>
    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    const ratingLabels = document.querySelectorAll('.rating label');

    ratingLabels.forEach((label, index) => {
        label.addEventListener('click', () => {
            for (let i = 0; i <= index; i++) {
                ratingInputs[i].checked = true;
                ratingLabels[i].innerHTML = '<i class="fas fa-star"></i>';
            }
            for (let i = index + 1; i < ratingLabels.length; i++) {
                ratingInputs[i].checked = false;
                ratingLabels[i].innerHTML = '<i class="far fa-star"></i>';
            }
        });
    });
</script>

                    <div class="price">
                        <span>{{ $product->price }}</span>
                        <span>${{ $product->price + rand(0, 20) }}</span>
                    </div>
                    <div class="row" style="display: flex;">
                        @if ($product->size)
                        <div class="col-md-4 sze">
                            <h5>Size</h5>
                            <select class="size custom-select">
                                <option>Select Size</option>
                                @foreach (explode(',', $product->size) as $size)
                                <option>{{ $size }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif 
                        <div class="col-md-4 qty">
                            <h5>Quantity</h5>
                            <select class="quantity custom-select">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>
                    <div id="product" class="product-inf">
                        <ul>
                          <li class="active"><a href="#Description">Product Description</a></li>
                        </ul>
                        <div class="tabs-content">
                            <div id="Description">
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="row" style="display: flex;">
                            <div class="col-md-6">
                                <a href="#" class="custom-btn">Add To Cart <i class="fas fa-angle-right"></i></a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="custom-btn">Buy Now <i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
h2 {
	color: #333;
	text-align: center;
	text-transform: uppercase;
	font-family: "Roboto", sans-serif;
	font-weight: bold;
	position: relative;
	margin: 25px 0 50px;
}
h2::after {
	content: "";
	width: 100px;
	position: absolute;
	margin: 0 auto;
	height: 3px;
	background: #ffdc12;
	left: 0;
	right: 0;
	bottom: -10px;
}
.carousel {
	width: 650px;
	margin: 0 auto;
	padding-bottom: 50px;
}
.carousel .carousel-item {
	color: white;
	font-size: 14px;
	text-align: center;
	overflow: hidden;
	min-height: 340px;
}
.carousel .carousel-item a {
	color: #eb7245;
}
.carousel .img-box {
	width: 145px;
	height: 145px;
	margin: 0 auto;
	border-radius: 50%;
}
.carousel .img-box img {
	width: 100%;
	height: 100%;
	display: block;
	border-radius: 50%;
}
.carousel .testimonial {	
	padding: 30px 0 10px;
    color: black;
}
.carousel .overview {	
	text-align: center;
	padding-bottom: 5px;
}
.carousel .overview b {
	color: white;
	font-size: 15px;
	text-transform: uppercase;
	display: block;	
	padding-bottom: 5px;
}
.carousel .star-rating i {
	font-size: 18px;
	color: #ffdc12;
}
.carousel-control-prev, .carousel-control-next {
	width: 30px;
	height: 30px;
	border-radius: 50%;
	background: #999;
	text-shadow: none;
	top: 4px;
}
.carousel-control-prev i, .carousel-control-next i {
	font-size: 20px;
	margin-right: 2px;
}
.carousel-control-prev {
	left: auto;
	right: 40px;
}
.carousel-control-next i {
	margin-right: -2px;
}
.carousel .carousel-indicators {
	bottom: 15px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 11px;
	height: 11px;
	margin: 1px 5px;
	border-radius: 50%;
}
.carousel-indicators li {	
	background: #e2e2e2;
	border: none;
}
.carousel-indicators li.active {		
	background: #888;		
}
</style>
@if (count($product->reviews) > 0)
<h2>Reviews</h2>
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="border: thick double black;">
        <!-- Carousel indicators -->
        <ol class="carousel-indicators" style="padding-top: 10px;">
            @foreach ($product->reviews as $key => $review)
                <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
    
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
            @foreach ($product->reviews as $key => $review)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="background-color: white;">
                    <div class="img-box"><img src="https://cdn.pixabay.com/photo/2018/11/13/21/43/instagram-3814049__480.png" width="250px" style="padding-top: 10px;"></div>
                    <p class="testimonial">{{ $review->content }}</p>
                    <p class="overview"><b style="color: black;">{{ $review->user->name }}</b></p>
                    <div class="star-rating">
                        <ul class="list-inline">
                            @for ($i = 1; $i <= $review->rating; $i++)
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            @endfor
                            @for ($i = $review->rating + 1; $i <= 5; $i++)
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    
        <!-- Carousel controls -->
        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
@endif

    <!-- BOOTSTRAP JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/4077c6ef6a.js" crossorigin="anonymous"></script>

    <script src="script.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,800&display=swap');

* {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
a:hover {
    color: #000;
}
.container-fluid {
    height: 100%;
    display: grid;
    align-items: center;
    justify-content: center;
    background: #000;
}
.cart {
    background: #fff;
    padding: 50px;
    border-radius: 20px;
    margin: 27px 50px;
    box-shadow: 0 0 15px 2px rgba(0,0,0,0.1);
}
.row1 {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
#ProductImg {
    margin-bottom: 25px;
    transition: 0.4s;
}
.black,
.red,
.white,
.yellow {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    transition: 0.3s;
    cursor: pointer;
    border: 1px solid transparent;
}
.black:hover {
    border: 1px solid #000;
}
.black::before {
    content: "";
    background: #000;
    width: 19px;
    height: 19px;
    display: block;
    border-radius: 50%;
    position: relative;
    top: 2px;
    left: 2px;
}
.red:hover {
    border: 1px solid #ff0000;
}
.red::before {
    content: "";
    background: #ff0000;
    width: 19px;
    height: 19px;
    display: block;
    border-radius: 50%;
    position: relative;
    top: 2px;
    left: 2px;
}
.white:hover {
    border: 1px solid #fff;
}
.white::before {
    content: "";
    background: #fff;
    width: 19px;
    height: 19px;
    display: block;
    border-radius: 50%;
    position: relative;
    top: 2px;
    left: 2px;
}
.yellow:hover {
    border: 1px solid #ffff00;
}
.yellow::before {
    content: "";
    background: #ffff00;
    width: 19px;
    height: 19px;
    display: block;
    border-radius: 50%;
    position: relative;
    top: 2px;
    left: 2px;
}

.colors {
    display: flex;
    background: rgb(55, 55, 55);
    padding: 5px;
    border-radius: 10px;
    align-items: center;
    justify-content: center;
}
.price {
    margin-bottom: 15px;
}
.price span:first-child {
    font-size: 30px;
    font-weight: 700;
    margin-right: 10px;
}
.price span:last-child {
    color: rgb(117, 117, 117);
    text-decoration: line-through;
    font-size: 19px;
}
.reviews {
    display: flex;
    margin: 16px 0;
}
.reviews p {
    font-size: 15px;
    color: #777;
    margin: 0;
    margin-left: 8px;
    line-height: 19px;
}
.reviews i {
    color: #000;
}
.product-title {
    font-size: 35px;
    font-weight: 700;
    font-style: italic;
    color: #000;
}
.product-inf {
    margin-top: 20px;
}
.product-inf ul {
    display: flex;
    list-style: none;
}
.product-inf ul li:first-child {
    margin-right: 15px;
}
.product-inf ul li {
    padding: 10px 30px;
    border-radius: 10px;
    transition: 0.3s;
    cursor: pointer;
}
.product-inf ul li:hover {
    border-radius: 5px;
    background: #eee;
}
.product-inf ul li a {
    color: #000;
    font-size: 18px;
    font-weight: 500;
}
.product-inf ul li a:hover {
    text-decoration: none;
}
.product-inf ul li.active {
    border-bottom: 3px solid #000;
    background: #eee;
    transition: 0.3s;
}
#Details {
    display: none;
}

.custom-btn {
    background: #000;
    color: #fff;
    display: block;
    width: 200px;
    text-align: center;
    font-size: 16px;
    border-radius: 25px;
    padding: 10px;
    transition: 0.3s;
    font-weight: 500;
    margin-top: 20px;
}
.custom-btn:hover {
    text-decoration: none;
    color: #fff;
    opacity: 0.88;
}

.buttons .row .col-md-6 {
    display: flex;
    align-items: center;
    justify-content: center;
}
.small-imgs {
    display: flex;
}
.small-img {
    margin: 0 5px;
    cursor: pointer;
    width: 22%;
}

.custom-btn i {
    margin-left: 15px;
}

.size,
.quantity {
    cursor: pointer;
}
.size:focus,
.quantity:focus {
    border-color: #919191 !important;
    outline: 0;
    box-shadow: 0 0 0 .2rem rgba(0, 0, 0, 0.25) !important;
}

@media only screen and (max-width: 768px){
    .product-title {
        margin-top: 65px;
    }
    .sze {
        margin-top: 28px;
    }
    .qty {
        margin-top: 28px;
    }
    .cart {
        padding: 25px;
    }
    * {
        text-align: center;
    }
    .reviews {
        display: flex;
        margin: 16px 0;
        text-align: center !important;
        align-items: center;
        justify-content: center;
    }
}
@media only screen and (max-width: 390px){
    .cart {
        padding: 15px;
    }
}
    </style>
    <script>
        var ProductImg = document.getElementById("ProductImg");
var SmallImg = document.getElementsByClassName("small-img");

$(document).ready(function() {
    $(SmallImg[0]).click(function() {
        $(".container-fluid").css("background", "#000");
        $(".product-title").css("color", "#000");
        $(".price span:first-child").css("color", "#000");
        $(".custom-btn").css("background", "#000");
        $(".reviews i").css("color", "#000");
        $(".colors").css("background", "rgb(55, 55, 55)");
        ProductImg.src = SmallImg[0].src
    });
    $(SmallImg[1]).click(function() {
        $(".container-fluid").css("background", "rgb(186, 34, 42)");
        $(".product-title").css("color", "rgb(186, 34, 42)");
        $(".price span:first-child").css("color", "rgb(186, 34, 42)");
        $(".custom-btn").css("background", "rgb(186, 34, 42)");
        $(".reviews i").css("color", "rgb(186, 34, 42)");
        $(".colors").css("background", "rgb(186, 34, 42)");
        ProductImg.src = SmallImg[1].src
    });
    $(SmallImg[2]).click(function() {
        $(".container-fluid").css("background", "rgb(200, 200, 200)");
        $(".product-title").css("color", "rgb(200, 200, 200)");
        $(".price span:first-child").css("color", "rgb(200, 200, 200)");
        $(".custom-btn").css("background", "rgb(200, 200, 200)");
        $(".reviews i").css("color", "rgb(200, 200, 200)");
        $(".colors").css("background", "rgb(200, 200, 200)");
        ProductImg.src = SmallImg[2].src
    });
    $(SmallImg[3]).click(function() {
        $(".container-fluid").css("background", "rgb(232, 198, 35)");
        $(".product-title").css("color", "rgb(232, 198, 35)");
        $(".price span:first-child").css("color", "rgb(232, 198, 35)");
        $(".custom-btn").css("background", "rgb(232, 198, 35)");
        $(".reviews i").css("color", "rgb(232, 198, 35)");
        $(".colors").css("background", "rgb(232, 198, 35)");
        ProductImg.src = SmallImg[3].src
    });
    $('.product-inf a').click(function() {
    
        $('.product-inf li').removeClass('active');
        $(this).parent().addClass('active');
    
        let currentTab = $(this).attr('href');
        $('.tabs-content div').hide();
        $(currentTab).show();
    
        return false;
    });
    $('.black').click(function(){
        $(".container-fluid").css("background", "#000");
        $(".product-title").css("color", "#000");
        $(".price span:first-child").css("color", "#000");
        $(".custom-btn").css("background", "#000");
        $(".reviews i").css("color", "#000");
        $(".colors").css("background", "rgb(55, 55, 55)");
        ProductImg.src = SmallImg[0].src
    });
    $('.red').click(function(){
        $(".container-fluid").css("background", "rgb(186, 34, 42)");
        $(".product-title").css("color", "rgb(186, 34, 42)");
        $(".price span:first-child").css("color", "rgb(186, 34, 42)");
        $(".custom-btn").css("background", "rgb(186, 34, 42)");
        $(".reviews i").css("color", "rgb(186, 34, 42)");
        $(".colors").css("background", "rgb(186, 34, 42)");
        ProductImg.src = SmallImg[1].src
    });
    $('.white').click(function(){
        $(".container-fluid").css("background", "rgb(200, 200, 200)");
        $(".product-title").css("color", "rgb(200, 200, 200)");
        $(".price span:first-child").css("color", "rgb(200, 200, 200)");
        $(".custom-btn").css("background", "rgb(200, 200, 200)");
        $(".reviews i").css("color", "rgb(200, 200, 200)");
        $(".colors").css("background", "#c8c8c8");
        ProductImg.src = SmallImg[2].src
    });
    $('.yellow').click(function(){
        $(".container-fluid").css("background", "rgb(232, 198, 35)");
        $(".product-title").css("color", "rgb(232, 198, 35)");
        $(".price span:first-child").css("color", "rgb(232, 198, 35)");
        $(".custom-btn").css("background", "rgb(232, 198, 35)");
        $(".reviews i").css("color", "rgb(232, 198, 35)");
        $(".colors").css("background", "#e8c623");
        ProductImg.src = SmallImg[3].src
    });
});
    </script>