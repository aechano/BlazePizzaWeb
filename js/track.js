'use strict';

// all initial elements
const payAmountBtn = document.querySelector('#payAmount');
const decrementBtn = document.querySelectorAll('#decrement');
const quantityElem = document.querySelectorAll('#quantity');
const incrementBtn = document.querySelectorAll('#increment');
const priceElem = document.querySelectorAll('#price');
const subtotalElem = document.querySelector('#subtotal');
const taxElem = document.querySelector('#tax');
const totalElem = document.querySelector('#total');
const promo_code = document.querySelector('#promo_code');
const shipping = document.querySelector('#shipping');

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

    totalCalc();

  });

}

// function: for calculating total amount of product price
const totalCalc = function () {

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


  // show the `total` variable value on `totalElem` & `payAmou,ntBtn` element
  totalElem.textContent = total.toFixed(2);
  payAmountBtn.textContent = total.toFixed(2);

}

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
        $("#message").append('<div class="success"><p>Promo code added!</p></div>');

        setTimeout(function(){
          $('#message').empty();
        }, 5000);
      } else {
        $("#discount-token").val("");
        $("#message").append('<div class="error"><p>Invalid promo code!</p></div>');

        setTimeout(function(){
          $('#message').empty();
        }, 5000);
      }

      totalCalc();

    },
  })
});

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


$(".product-close-btn").bind('click', function (e) {

  var self = $(this);
  console.log($("#form" + self.attr('id')));

  $.ajax({
    type: "POST",
    url: "../app/order.php?action=remove_order",
    data: $("#payment_form" + self.attr('id')).serialize(),
    success: function(data) {
      if(data != "success") { 
        alert("Something went wrong!");
      }
     $('.product-card' + self.attr('id')).empty();
     totalCalc();
    }
  })
  
});