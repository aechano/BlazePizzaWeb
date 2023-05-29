'use strict';

let payAmountBtn = document.querySelector('#payAmount');
let incrementBtn = document.querySelectorAll('#increment');
let decrementBtn = document.querySelectorAll('#decrement');

window.onload = function() {
  totalCalc();
}

// loop: for add event on multiple `increment` & `decrement` button
for (let i = 0; i < incrementBtn.length; i++) {

  incrementBtn[i].addEventListener('click', function () {

    // collect the value of `quantity` textContent,
    // based on clicked `increment` button sibling.
    let increment = Number(this.previousElementSibling.textContent);

    // plus `increment` variable value by 1
    increment++;

    // show the `increment` variable value on `quantity` element
    // based on clicked `increment` button sibling.
    this.previousElementSibling.textContent = increment;
    var quantity = this.previousElementSibling;
    var self = this;
    var $loader = $('#loading' + this.getAttribute("name"));
    $loader.show();
    $("#payment_form" + this.getAttribute("name")).children('#quantity' + this.getAttribute("name")).val(increment);

    setTimeout(function () {
      $.ajax({
        type: "POST",
        url: "../app/add_to_cart.php",
        data: $("#payment_form" + self.getAttribute("name")).serialize(),
        success: function(data) {
          if(data != "success") { 
            alert("Something went wrong!")
            quantity.textContent = increment-1;
          }
          $loader.hide();
        }
      })
    }, 1000);
    
    totalCalc();

  });


  decrementBtn[i].addEventListener('click', function () {

    // collect the value of `quantity` textContent,
    // based on clicked `decrement` button sibling.
    let decrement = Number(this.nextElementSibling.textContent);

    // minus `decrement` variable value by 1 based on condition
    decrement <= 1 ? 1 : decrement--;

    // show the `decrement` variable value on `quantity` element
    // based on clicked `decrement` button sibling.
    this.nextElementSibling.textContent = decrement;
    var quantity = this.nextElementSibling;
    var self = this;
    var $loader = $('#loading' + this.getAttribute("name"));
    $loader.show();
    $("#payment_form" + this.getAttribute("name")).children('#quantity' + this.getAttribute("name")).val(decrement);

    setTimeout(function () {
      $.ajax({
        type: "POST",
        url: "../app/add_to_cart.php",
        data: $("#payment_form" + self.getAttribute("name")).serialize(),
        success: function(data) {
          if(data != "success") { 
            alert("Something went wrong!")
            quantity.textContent = decrement+1;
          }
          $loader.hide();
        }
      })
    }, 1000);
    
    totalCalc();

  });

}

// function: for calculating total amount of product price
const totalCalc = function () {

  let quantityElem = document.querySelectorAll('#quantity');
  let priceElem = document.querySelectorAll('#price');
  let subtotalElem = document.querySelector('#subtotal');
  let taxElem = document.querySelector('#tax');
  let totalElem = document.querySelector('#total');
  let promo_code = document.querySelector('#promo_code');
  let shipping = document.querySelector('#shipping');

  // declare all initial variable
  const tax = 0.05;
  let subtotal = 0;
  let totalTax = 0;
  let total = 0;

  // loop: for calculating `subtotal` value from every single product
  for (let i = 0; i < quantityElem.length; i++) {

    subtotal += Number(quantityElem[i].textContent) * Number(priceElem[i].textContent);

  }

  // show the `subtotal` variable value on `subtotalElem` element
  subtotalElem.textContent = subtotal.toFixed(2);

  // calculating the `totalTax`
  totalTax = subtotal * tax;

  // show the `totalTax` on `taxElem` element
  taxElem.textContent = totalTax.toFixed(2);

  // calcualting the `total`
  total = ((subtotal + totalTax + Number(shipping.textContent)) - Number(promo_code.textContent));

  console.log(total);

  // show the `total` variable value on `totalElem` & `payAmou,ntBtn` element
  totalElem.textContent = total.toFixed(2);
  payAmountBtn.textContent = total.toFixed(2);

}

//fetch voucher
$('body').on('click' , '#promo_button', function() {
    $.ajax({
    type: "POST",
    url: "../app/voucher.php",
    data: $("#promo").serialize(),
    success: function(data) {
      if(data != "0") {
        $(".promo_code").show();
        $("#promo_code").text(parseFloat(data).toFixed(2));
        $("#remove_promo").show();
        $("#promo_button").hide();
        $("#discount-token").prop("readonly", true);
        $('#message').empty();
        $("#message").append('<div class="success"><p>Promo code added!</p></div>');

        setTimeout(function(){
          $('#message').empty();
        }, 5000);
      } else {
        $("#discount-token").val("");
        $('#message').empty();
        $("#message").append('<div class="error"><p>Invalid promo code!</p></div>');

        setTimeout(function(){
          $('#message').empty();
        }, 5000);
      }

      totalCalc();

    },
  })
});

//remove promo
$('body').on('click' , '#remove_promo', function() {

    $("#remove_promo").hide();
    $("#promo_button").show();
    $("#discount-token").val("");

    $.ajax({
      type: "POST",
      url: "../app/voucher.php",
      data: $("#promo").serialize(),
      success: function(data) {
        if(data == "0") {
          $('#message').empty();
          $("#discount-token").prop("readonly", false);
          $(".promo_code").hide();
          $("#promo_code").text(parseFloat(data).toFixed(2));
          totalCalc();
        } 
    },
  })
});


//remove order
$(".product-close-btn").bind('click', function (e) {

  var self = $(this);
 
  $.ajax({
    type: "POST",
    url: "../app/order.php?action=remove_order",
    data: $("#payment_form" + self.attr('id')).serialize(),
    success: function(data) {
      data = JSON.parse(data);
      if(data['hasError'] != false) { 
        alert(data['message']);
        return;
      } 
      $('.product-card' + self.attr('id')).empty();
      totalCalc();
    }
  })

});


//proceed to order
$("#submit").bind('click', function (e) {

  $('.loading1').show();
  var data = {
    "promo_code" : $('#discount-token').val(),
    "payment_option": $('#payment_option').find(":selected").val(),
    "notes" : $('#notes').val(),
    "address": $('#address').val(),
    "order_type" : $('#order_type').val(),
    "id" : $('#id0').val(),
    "quantity" : $('#quantity0').val(),
  }

  console.log(data);

  setTimeout(function () {
    $.ajax({
      type: "POST",
      url: "../app/order.php?action=order",
      data: data,
      success: function(data) {
        data = JSON.parse(data);
        if(data['hasError'] != false) { 
          $('#message').empty();
          $("#message").append('<div class="error"><p>' + data['message'] +'</p></div>');
          $('.loading1').hide();
          return;
        }
        
        window.location = '../app/order_status.php?order_id=' + data['message'];
        $('.loading1').hide();
      }
    })
  }, 1000);

});