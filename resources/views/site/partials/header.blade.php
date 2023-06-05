<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Georgian&display=swap">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<body class="header_sticky" >
   <div class="aniketrod" >
      <section id="header" class="header" >
         <div class="header-top">
            <div class="container">
               <div class="row">
                  <div class="col-md-4">
                     <ul class="flat-support">
                        <li>
                           <a href="#" title="" class="support">Support</a> 
                        </li>
                        <li>
                           <a href="#" title="" class="store">Store Locator</a>
                        </li>
                        <li>
                           <a href="#" title="" class="track">Track Your Order</a>
                        </li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <ul class="flat-infomation">
                        <li class="phone">
                           Call Us: <a href="#" title="">(+91) 90129 83208</a>
                        </li>
                     </ul>
                  </div>
                  <!-- /.col-md-4 -->
                  <div class="col-md-4">
                     <ul class="flat-unstyled">
                        <li class="account">
                           <a href="#" title="">My Account<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                           <ul class="unstyled">
                              <li>
                                 <a href="#" title="">Login</a>
                              </li>
                              <li>
                                 <a href="#" title="">Wishlist</a>
                              </li>
                              <li>
                                 <a href="#" title="">My Cart</a>
                              </li>
                              <li>
                                 <a href="#" title="">My Account</a>
                              </li>
                              <li>
                                 <a href="#" title="">Checkout</a>
                              </li>
                           </ul>
                        </li>
                        <li class="currency">
                           <a href="#" title="">USD<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                           <ul class="unstyled">
                              <li>
                                 <a href="#" title="">Euro</a>
                              </li>
                              <li>
                                 <a href="#" title="">Dolar</a>
                              </li>
                           </ul>
                        </li>
                        <li class="language">
                           <a href="#" title="">English<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                           <ul class="unstyled">
                              <li>
                                 <a href="#" title="">Turkish</a>
                              </li>
                              <li>
                                 <a href="#" title="">English</a>
                              </li>
                              <li>
                                 <a href="#" title="">اللغة العربية</a>
                              </li>
                              <li>
                                 <a href="#" title="">Español</a>
                              </li>
                              <li>
                                 <a href="#" title="">Italiano</a>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="header-middle">
            <div class="container">
               <div class="row">
                  <div class="col-md-3">
                     <div id="logo" class="logo">
                        <a href="#" title="">
                           <h1 style="margin-top: 15px;   font-family: 'Noto Sans Georgian', sans-serif; color: #00ccff;" class="name">DazzleDibs</h1>
                           <h5 style="margin-left: 10px;     font-family: 'Pacifico', cursive; color: #00ccff;" class="sigla">One-Stop Shop</h5>
                           <img class="logo1" src="{{ asset('img/DazzleDibs.png') }}" alt="logo" style="width:175px; margin-left:170px; margin-top: -200px;">
                        </a>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="top-search">
                        <!-- <form action="" method="GET" class="form-search" accept-charset="utf-8">
                                <input type="text" id="searchInput" name="search" placeholder="Search what you looking for?">
                                <span class="btn-search">
                                <button type="submit" class="waves-effect"><i class="fa fa-search"></i></button>
                                </span>
                        </form> -->
                        <form action="{{ isset($category) ? url('/categories/'.$category->id.'/search') : url('/search') }}" method="GET" class="search-form">
                            <input type="text" name="q" placeholder="Search products...">
                            <button type="submit">Search</button>
                        </form>

                        <!-- /.form-search -->
                     </div>
                     <!-- /.top-search -->
                  </div>
                  <!-- /.col-md-6 -->
                  <div class="col-md-3">
                     <div class="box-cart">
                        <div class="inner-box">
                           <ul class="menu-compare-wishlist">
                              <li class="compare">
                                 <a href="#" title="">
                                 <i class="fa fa-superpowers"></i>
                                 </a>
                              </li>
                              <li class="wishlist">
                                 <a href="#" title="">
                                 <i class="fa fa-user" aria-hidden="true"></i>
                                 </a>
                              </li>
                           </ul>
                           <!-- /.menu-compare-wishlist -->
                        </div>
                        <!-- /.inner-box -->
                        <div class="inner-box">
                           <a href="#" title="">
                              <div class="icon-cart">
                                 <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                 <span>{{ session('cartCount', 0) }}</span>
                              </div>
                           </a>
                           <div class="dropdown-box">
                              <ul>
                              @foreach($cart as $productId => $item)
                                 <li>
                                    <div class="img-product">
                                    <img src="{{ $item['product']->image_link }}">
                                    </div>
                                    <div class="info-product">
                                       <div class="name">
                                       {{ $item['product']->title }}
                                       </div>
                                       <div class="price">
                                          <span>{{ $item['quantity'] }} X</span>
                                          <span>{{ $item['product']->price }}</span>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- <span class="delete">x</span> -->
                                    <form class="delete" action="{{ route('cart.removeItem', $productId) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                       <button style="background-color:white; color:black;" type="submit">x</button>
                                    </form>
                                 </li>
                              @endforeach
                              </ul>
                              <div class="total">
                                 <span>Subtotal:</span>
                                 <span class="price">${{ $total }}</span>
                              </div>
                              <div class="btn-cart">
                                 <a href="/cart" class="view-cart" title="">View Cart</a>
                                 <a href="/stripe" class="check-out" title="">Checkout</a>
                              </div>
                           </div>
                        </div>
                        <!-- /.inner-box -->
                     </div>
                     <!-- /.box-cart -->
                  </div>
                  <!-- /.col-md-3 -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container -->
         </div>
         <!-- /.header-middle -->
         
         @include('site.partials.nav')

         </div>
         <!-- /.header-bottom -->
      </section>
      <!-- /#header -->
      <section style="min-height: 100vh"></section>
   </div>

   <!-- /.aniketrod -->
   <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>