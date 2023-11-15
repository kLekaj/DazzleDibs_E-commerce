<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('site.partials.styles')
</head>
<body>
    @include('site.partials.header')
    

<div class="row">
    <div class="product-list">
    @if (isset($products))
        @foreach ($products as $product)
            <div class="product-grid">
                <div class="product-image">
                    <a href="#" class="image">
                        <img class="pic-1" src="{{ $product->image_link }}" style="height: 300px;">
                    </a>
                    <ul class="product-links">
                        <li><a href="#" data-tip="Add to Wishlist"><i class="fas fa-heart"></i></a></li>
                        <li><a href="{{ route('products.show', $product->id) }}" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                        <li>
                            <form action="{{ route('products.addToCart', $product->id) }}" method="POST" data-tip="Add to Cart">
                            @csrf
                                <button type="submit" data-tip="Add to Cart">
                                    <i class="fa fa-shopping-bag" style="margin-left: -10px;"></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                    <div class="price">${{ $product->price }}</div>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">{{ $product->title }}</a></h3>
                    <ul class="rating">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star disable"></li>
                        <li class="fas fa-star disable"></li>
                    </ul>
                </div>
            </div>
        @endforeach
        @else
        @foreach ($allProducts as $product)
        <div class="product-grid">
                <div class="product-image">
                    <a href="#" class="image">
                        <img class="pic-1" src="{{ $product->image_link }}" style="height: 300px;">
                    </a>
                    <ul class="product-links">
                        <li><a href="#" data-tip="Add to Wishlist"><i class="fas fa-heart"></i></a></li>
                        <li><a href="#" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                        <li>
                            <form action="{{ route('products.addToCart', $product->id) }}" method="POST" data-tip="Add to Cart">
                            @csrf
                                <button type="submit" data-tip="Add to Cart">
                                    <i class="fa fa-shopping-bag"></i>
                                </button>
                            </form>
                        </li>                    </ul>
                    <div class="price">{{ $product->price }}</div>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">{{ $product->title }}</a></h3>
                    <ul class="rating">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star disable"></li>
                        <li class="fas fa-star disable"></li>
                    </ul>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
    @include('site.partials.footer')
</body>
</html>
<script>
    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            var searchTerm = $(this).val();
            $.get('/search', {q: searchTerm}, function (data) {
                $('.product-list').html(data);
            });
        });
    });
</script>

<style>
.row {
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
}

.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-top: -500px;
}

@media only screen and (max-width: 768px) {
  .product-list {
    justify-content: space-around;
  }
}

@media only screen and (max-width: 768px) {
  .product-grid {
    width: calc(50% - 20px);
  }
}

.product-grid {
  font-family: 'Fira Sans', sans-serif;
  width: calc(33.33% - 20px);
  margin-bottom: 40px;
  position: relative;
}

.product-grid{ font-family: 'Fira Sans', sans-serif; }
.product-grid .product-image{
    position: relative;
    overflow: hidden;
}
.product-grid .product-image a.image{ display: block; }
.product-grid.new .product-image a.image:before,
.product-grid .product-image a.image:after{
    content: '';
    background-color: #ffd800;
    height: 70px;
    width: 70px;
    border-radius: 50%;
    position: absolute;
    right: -25px;
    top: -25px;
}
.product-grid .product-image a.image:after{
    height: 120px;
    width: 120px;
    right: auto;
    left: -120px;
    top: auto;
    bottom: -120px;
    transition: all 0.3s ease;
}
.product-grid:hover .product-image a.image:after{
    left: -25px;
    bottom: -40px;
}
.product-grid .product-image img{
    width: 100%;
    height: auto;
}
.product-grid .product-new-label{
    color: #000;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    position: absolute;
    top: 7px;
    right: 5px;
}
.product-grid .product-links{
    padding: 0;
    margin: 0;
    list-style: none;
    position: absolute;
    bottom: 7px;
    right: 10px;
}
.product-grid .product-links li{
    margin: 0 0 4px;
    transform: translateX(100px);
    transition: all 0.5s ease 0s;
}
.product-grid:hover .product-links li{ transform: translateX(0); }
.product-grid:hover .product-links li:nth-child(2){ transition-delay: 0.1s; }
.product-grid:hover .product-links li:nth-child(3){ transition-delay: 0.2s; }
.product-grid .product-links li:last-child{ margin: 0; }
.product-grid .product-links li a{
    color: #000;
    background: rgba(255,216,0,0.2);
    font-size: 20px;
    text-align: center;
    line-height: 48px;
    height:45px;
    width: 45px;
    border-radius: 50%;
    display: block;
    position: relative;
     transition: all 200ms ease 0s;
}
.product-grid .product-links li button{
    color: #000;
    background: rgba(255,216,0,0.2);
    font-size: 20px;
    text-align: center;
    line-height: 48px;
    height:45px;
    width: 45px;
    border-radius: 50%;
    display: block;
    position: relative;
     transition: all 200ms ease 0s;
}
.product-grid .product-links li a:hover{ background: #ffd800; }
.product-grid .product-links li a:before,
.product-grid .product-links li a:after{
    content: attr(data-tip);
    color: #fff;
    background-color: #000;
    font-size: 14px;
    line-height: 22px;
    border-radius: 0;
    padding: 8px 15px;
    border-radius: 5px;
    white-space: nowrap;
    transform: translateY(-50%);
    visibility: hidden;
    position: absolute;
    right: 60px;
    top: 50%;
    transition: all 0.3s ease;
}
.product-grid .product-links li button:hover{ background: #ffd800; }
.product-grid .product-links li button:before,
.product-grid .product-links li button:after{
    content: attr(data-tip);
    color: #fff;
    background-color: #000;
    font-size: 14px;
    line-height: 22px;
    border-radius: 0;
    padding: 8px 15px;
    border-radius: 5px;
    white-space: nowrap;
    transform: translateY(-50%);
    visibility: hidden;
    position: absolute;
    right: 60px;
    top: 50%;
    transition: all 0.3s ease;
}
.product-grid .product-links li a:after{
    content: '';
    height: 15px;
    width: 15px;
    padding: 0;
    border-radius: 0;
    transform: translateY(-50%) rotate(45deg);
    right: 58px;
    z-index: -1;
}
.product-grid .product-links li button:after{
    content: '';
    height: 15px;
    width: 15px;
    padding: 0;
    border-radius: 0;
    transform: translateY(-50%) rotate(45deg);
    right: 58px;
    z-index: -1;
}
.product-grid .product-links li a:hover:before,
.product-grid .product-links li a:hover:after{
    visibility: visible;
}
.product-grid .product-links li button:hover:before,
.product-grid .product-links li button:hover:after{
    visibility: visible;
}
.product-grid .product-links li a:hover:before{ right: 55px; }
.product-grid .product-links li a:hover:after{ right: 53px; }
.product-grid .price{
    color: #000;
    font-size: 22px;
    font-weight: 700;
    position: absolute;
    bottom: 10px;
    left: 10px;
}
.product-grid .product-links li button:hover:before{ right: 55px; }
.product-grid .product-links li button:hover:after{ right: 53px; }
.product-grid .price{
    color: #000;
    font-size: 22px;
    font-weight: 700;
    position: absolute;
    bottom: 10px;
    left: 10px;
}
.product-grid .product-content{
    padding: 12px 0 0;
    position: relative;
}
.product-grid .title{
    font-size: 20px;
    font-weight: 500;
    text-transform: capitalize;
    margin: 0 0 10px;
}
.product-grid .title a{
    color: #000;
    transition: all 0.3s ease;
}
.product-grid .title a:hover{ color: #666; }
.product-content .rating{
    padding: 0;
    margin: 0 0 7px 0;
    list-style: none;
}
.product-grid .rating li{
    color: #ffba00;
    font-size: 14px;
    display: inline-block;
}
.product-grid .rating li.disable{ color: #b6b3b0; }
@media screen and (max-width:990px){
    .product-grid{ margin: 0 0 30px; }
}
</style>
