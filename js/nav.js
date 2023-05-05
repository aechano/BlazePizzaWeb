'use strict';

$(".qty").bind('keyup change click', function (e) {
	var $previousValue = $(this).data("previousValue");
   	if (!$(this).data("previousValue") || $(this).data("previousValue") != $(this).val()){     
    	$(this).data("previousValue", $(this).val());
    	var $loader = $('#loading' + $(this).attr('id'));
    	var $self = $(this);
    	$loader.show();

       	setTimeout(function () {
		    $.ajax({
		      type: "POST",
		      url: "../app/add_to_cart.php",
		      data: $("#form" + $self.attr('id')).serialize(),
		      success: function(data) {
		      	if(data != "success") {	
		      		alert("Something went wrong!")
		      		$self.val($previousValue)
		      	}
		        $loader.hide();
		      }
		    })
	    }, 1000);

   	}
});

$(".qty").each(function () {
    $(this).data("previousValue", $(this).val());
});
