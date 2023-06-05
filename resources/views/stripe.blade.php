<!DOCTYPE html>
<html>
    <head>
        <title>DazzleDibs</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>
    <body>
        <div class="main-container" style="height: 800px;">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" style="margin-left: 350px;">
                    <div class="panel panel-default credit-card-box">
                    <div class="creditcard-wrap">
                        <div class="creditcard-front">
                            <div class="creditcard-icon">
                                <img src="http://www.pngmart.com/files/3/Credit-Card-Visa-And-Master-Card-PNG-HD.png" class="card-icon" />
                            </div>
                            <div class="creditDeatils-holder">
                                <div class="creditNumber">
                                    <div class="creditcard-number" id="b1">XXXX</div>
                                    <div class="creditcard-number" id="b2">XXXX</div>
                                    <div class="creditcard-number" id="b3">XXXX</div>
                                    <div class="creditcard-number" id="b4">XXXX</div>
                                </div>
                                <div class="creditcard-secondLine">
                                    <div class="creditcard-name" id="cname">Your Name</div>
                                    <div class="creditcard-expiry">
                                        <span id="mon">04</span> /
                                        <span id="yer">12</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="creditcard-back">
                            <div class="creditcard-rfid"></div>
                            <div class="creditcard-ccv">
                                <div class="ccv-number">XXXX</div>
                                    <span id="ccvno">XXX</span>
                                </div>
                            </div>
                        </div>
                        <div class="creditcard-form">
                            <div class="creditcard-details">
                            <div class="col-sm-12 text-center">
                            @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                            @endif
                            <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                                <div class='required'>
                                    <input autocomplete='off' class='card-number input-creditnum' size='20' type='text' style="width: 250px;" placeholder="XXXX XXXX XXXX XXXX">
                                </div>
                                <div class='required creditcard-name--input'>
                                    <input name="name" id="name" class="input-creditname" placeholder="Credit Card Holder Name" size='4' type='text'>
                                </div>
                                <div class='required creditcard-month--input'>
                                    <input name="month" id="month" class="input-select card-expiry-month" placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='required creditcard-year--input'>
                                    <input name="year" id="year" class="input-select card-expiry-year" placeholder='YYYY' size='4' type='text'>
                                </div>
                                <div class='required creditcard-ccv--input'>
                                    <input name="ccv" id="ccv" class="input-creditnum card-cvc" placeholder="XXX" autocomplete='off' size='4' type='text'>
                                </div>
                            <div class='form-row row'>
                                <div class='col-md-12 error form-group hide'>
                                    <div class='alert-danger alert'>
                                        Please correct the errors and try again.
                                    </div>
                                </div>
                            </div>
                            <?php
                              // Retrieve the cart and total amount from the session
                              $cart = Session::get('cart', []);
                              $totalAmount = Session::get('totalAmount', 0);

                              // Calculate the updated total amount based on item prices and quantities
                              $updatedTotalAmount = 0;
                                foreach ($cart as $productId => $item) {
                                  $updatedTotalAmount += $item['product']->price * $item['quantity'];
                                }
                            ?>
                            <div class="col-sm-12 text-center">
                              <button class="input-submit" type="submit">Pay Now (${{ $updatedTotalAmount + 50 }})</button>
                            </div>
                            </form>
                            </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");
                $('form.require-validation').bind('submit', function(e) {
                    var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]','input[type=text]', 'input[type=file]','textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                    $errorMessage.addClass('hide');
                    $('.has-error').removeClass('has-error');
                        $inputs.each(function(i, el) {
                        var $input = $(el);
                        if ($input.val() === '') {
                            $input.parent().addClass('has-error');
                            $errorMessage.removeClass('hide');
                            e.preventDefault();
                        }
                        });
                        if (!$form.data('cc-on-file')) {
                            e.preventDefault();
                            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                            Stripe.createToken({
                                number: $('.card-number').val(),
                                cvc: $('.card-cvc').val(),
                                exp_month: $('.card-expiry-month').val(),
                                exp_year: $('.card-expiry-year').val()
                            }, stripeResponseHandler);
                        }
                });
                function stripeResponseHandler(status, response) {
                    if (response.error) {
                        $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                    } else {
                        /* token contains id, last4, and card type */
                        var token = response['id'];
                        $form.find('input[type=text]').empty();
                        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                        $form.get(0).submit();
                    }
                }
        });
        $(document).ready(function(){
  $("#block1").keyup(function(){
    $("#b1").text($(this).val());
  });
  $("#block2").keyup(function(){
    $("#b2").text($(this).val());
  });
  $("#block3").keyup(function(){
    $("#b3").text($(this).val());
  });
  $("#block4").keyup(function(){
    $("#b4").text($(this).val());
  });
  $("#name").keyup(function(){
    $("#cname").text($(this).val());
  });
  $("#month").change(function(){
    $("#mon").text($(this).val());
  });
  $("#year").change(function(){
    $("#yer").text($(this).val());
  });
  $("#ccv").blur(function(){
    $(".creditcard-back").fadeOut("fast");
    $(".creditcard-front").fadeIn("fast");
    $("#ccvno").text($(this).val());
  });
  $("#ccv").keyup(function(){
    $("#ccvno").text($(this).val());
  });
  $("#ccv").focus(function(){
    $(".creditcard-back").fadeIn("fast");
    $(".creditcard-front").fadeOut("fast");
  });
});
    </script>
    <style>
    // Credit Card Checkout: 
$blue : #4459F2;
$green : #33B23F;
$darkgrey : #25262B;
$lightgrey : #333742;
$pink : #FE2C75;
*{
  font-family: 'Open Sans', sans-serif;
}
.main-container{
  background: #006CAC;
  background: -webkit-linear-gradient(left top, #006CAC, #00060E); 
  background: -o-linear-gradient(bottom right, #006CAC, #00060E);
  background: -moz-linear-gradient(bottom right,#006CAC, #00060E);
  background: linear-gradient(to bottom right, #006CAC, #00060E);
  height: 200vh;  
  padding: 50px 90px;
}
.creditcard-wrap{
  background: url(http://www.freebiesgallery.com/wp-content/uploads/2014/02/dotted-world-map-vector-2.png) no-repeat;
  background-color: #23438D;
  background-size: contain;
  height: 220px;
  border-radius: 5px;
  width: 350px;
  z-index: 2;
  margin: 0 auto;
  box-shadow: 0px 5px 25px 0px #000;
  position: relative;
}
.creditcard-front{
  position: relative;
  padding: 25px;
  width: 100%;
  height: 100%;
}
.creditDeatils-holder{
  position: absolute;
  bottom: 25px;
}
.creditcard-number{
  font-family: 'Inconsolata', monospace;
  font-size: 25px;
  color: #fff;
  padding: 0 5px;
  display: inline-block;
}
.creditNumber{
  text-align: center;
  width: 100%;
}
.creditcard-name{
  font-family: 'Inconsolata', monospace;
  font-size: 20px;
  color: #fff;
  display: inline-block;
}
.creditcard-expiry{
  font-family: 'Inconsolata', monospace;
  font-size: 20px;
  color: #fff;
  margin-left: 50px;
  display: inline-block;
  &:after{
    content: "Expiry";
    font-size: 14px;    
    display: block;
    margin-top: -10px;
    text-align: center;
  }
}
.creditcard-icon {  
  position: absolute;
  top: 15px;
  right: 15px;
  text-align: right;
  padding-left: 15px;
  
}
.card-icon{
  width: 150px;
}
.creditcard-back{
  display: none;
}
.creditcard-rfid{
  background: #000;
  height: 45px;
  margin-top: 25px;
}
.creditcard-ccv{
  margin-top: 15px;
  background: #fff;
}
.ccv-number{
  text-align: right;
  padding: 0 25px;
  border-left: 1px solid #222;
}
.creditcard-form{
  background: #fff;
  height: 100%;
  border-radius: 5px;
  width: 100%;
  margin-top: -75px;
  z-index: 1;
}
.creditcard-details{
  padding-top: 100px;
}
.creditcard-number--input{
  width: 100%;
  padding: 10px 25px;
}
.input-creditnum{
  display: inline-block;
  width: 75px;
  border: none;
  margin: 0 5px;
  border-bottom: 2px solid #00060E;
  text-align: center;
}
.input-creditname{
  width: 320px;
  border: none;
  margin: 0 5px;
  border-bottom: 2px solid #00060E;
  text-align: left;
}
.creditcard-name--input, .creditcard-ccv--input{
  display: inline-block;
  text-align: left;
  padding: 10px 25px;
}
.creditcard-month--input, .creditcard-year--input  {
  display: inline-block;
}
.creditcard-ccv--input{
  &:before{
    content: "CCV:";
    padding: 0 15px;
  }
}
.creditcard-year--input{
  &:after{
    content: "";
    position: absolute;
    text-align: center;
    margin-left: -8px;
  }
}
.creditcard-month--input{
  &:after{
    content: "";
    position: absolute;
    margin-left: -8px;
  }
}
.input-select{
  border: 1px solid #00060E;
  padding: 3px 5px;
  border-radius: 3px;
}
.input-submit{
  border: 2px solid #006CAC;
  background: #006CAC;
  color: #fff;
  outline: none;
  font-weight: 400;
  font-size: 1.5em;
  cursor: pointer;
  margin: 25px;
  padding: 2px 25px;
  border-radius: 30px;
  transition: all 300ms ease-in;
  &:hover, &:focus{
    color: #00060E;
  }
}
</style>
</html>