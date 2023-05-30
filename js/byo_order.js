
/*// first
$(function() {
    // Set
    var main = $('div.mm-dropdown .textfirst')
    var li = $('div.mm-dropdown > ul > li.input-option')
    var inputoption = $("div.mm-dropdown .option")
    
    // Animation
    
    var inputValue = this.getAttribute("data-input");

    if (inputValue == 0){
        
    }



    // Insert Data
    li.click(function() {
        // hide
        var livalue = $(this).data('value');
        var lihtml = $(this).html();
        main.html(lihtml);
        inputoption.val(livalue);
    });
});

    
    // second
$(function() {
    // Set
    var main = $('div.mm-dropdown1 .textfirst1')
    var li = $('div.mm-dropdown1 > ul > li.input-option')
    var inputoption = $("div.mm-dropdown1 .option")

    
    // Insert Data
    li.click(function() {
        // hide
        var livalue = $(this).data('value');
        var lihtml = $(this).html();
        main.html(lihtml);
        inputoption.val(livalue);
    });
});



// third
    $(function() {
    // Set
    var main = $('div.mm-dropdown2 .textfirst2')
    var li = $('div.mm-dropdown2 > ul > li.input-option')
    var inputoption = $("div.mm-dropdown2 .option")
    
    // Insert Data
    li.click(function() {
        // hide
        var livalue = $(this).data('value');
        var lihtml = $(this).html();
        main.html(lihtml);
        inputoption.val(livalue);
    });
});


// fourth
    $(function() {
    // Set
    var main = $('div.mm-dropdown3 .textfirst3')
    var li = $('div.mm-dropdown3 > ul > li.input-option')
    var inputoption = $("div.mm-dropdown3 .option")
    
    // Insert Data
    li.click(function() {
        // hide
        var livalue = $(this).data('value');
        var lihtml = $(this).html();
        main.html(lihtml);
        inputoption.val(livalue);
    });
    });


//fifth
$(function() {
    // Set
    var main = $('div.mm-dropdown4 .textfirst4')
    var li = $('div.mm-dropdown4 > ul > li.input-option')
    var inputoption = $("div.mm-dropdown4 .option")
    
    // Insert Data
    li.click(function() {
        // hide
        var livalue = $(this).data('value');
        var lihtml = $(this).html();
        main.html(lihtml);
        inputoption.val(livalue);
    });
});


// sixt
$(function() {
    // Set
    var main = $('div.mm-dropdown5 .textfirst5')
    var li = $('div.mm-dropdown5 > ul > li.input-option')
    var inputoption = $("div.mm-dropdown5 .option")
    
    // Insert Data
    li.click(function() {
        // hide
        var livalue = $(this).data('value');
        var lihtml = $(this).html();
        main.html(lihtml);
        inputoption.val(livalue);
    });
});
*/

    $(document).ready(function(){
    $('.count').prop('disabled', true);
        $(document).on('click','.plus',function(){
    $('.count').val(parseInt($('.count').val()) + 1 );
    });
        $(document).on('click','.minus',function(){
        $('.count').val(parseInt($('.count').val()) - 1 );
        if ($('.count').val() == 0) {
        $('.count').val(1);
        }
        });
});

    var minus = document.querySelector(".btn-subtract")
    var add = document.querySelector(".btn-add");
    var quantityNumber = document.querySelector(".item-quantity");
    var currentValue = 1;
    
    minus.addEventListener("click", function(){
        currentValue -= 1;
        quantityNumber.value = currentValue;
        console.log(currentValue)
});
    
    add.addEventListener("click", function() {
        currentValue += 1;
        quantityNumber.value = currentValue;
        console.log(currentValue);
});

setTimeout(function(){
    if ($('#info').length > 0) {
        $('#info').empty();
    }
}, 5000)

$("#add_to_cart").bind('click', function (e) {

  $('.loading1').show();
  setTimeout(function () {
    $.ajax({
      type: "POST",
      url: "../app/build_your_own.php?action=add_to_cart&order_type=1",
      data: $('#form').serialize(),
      success: function(data) {
        data = JSON.parse(data);
        $('#message').empty();

        if(data['hasError'] != false) { 
            $('#message').append('<p class="error">' + data['message'] + '</p>');
            $('.loading1').hide();
            setTimeout(function(){
              $('#message').empty();
            }, 5000);
            return;
        }

        $('#message').append('<p class="success">' + data['message'] + '</p>');
        $('.loading1').hide();
        setTimeout(function(){
            location.reload();
        }, 1000);
      }
    })
  }, 1000);

});