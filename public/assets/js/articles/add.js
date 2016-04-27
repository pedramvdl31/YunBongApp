$(document).ready(function(){
	add.pageLoad();
	add.events();

});
add = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });




	},
	events: function() {
		$('#form-submit-btn').change(function () {
			$('.loading-icon').removeClass('hide');
			event.stopPropagation(); // Stop stuff happening
		    event.preventDefault(); // Totally stop stuff happening
		    // Create a formdata object and add the files
		    var this_file = new FormData();
		    $.each(this.files, function(key, value)
		    {
		        this_file.append(key, value);
		    });
		 	$.ajax({
			        url: '/users/send-file',
			        type: 'POST',
			        data: this_file,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	$('.loading-icon').addClass('hide');
			        	var status = data.status;
			        	switch (status){
			        		case 200:
			        			var newpath = data.newpath;
			        			$('.profile_img').attr('src',newpath);
			        			$('#imagename').val(data.image_name);
			        			$('#saved').removeClass('hide');
			        		break;
			        		case 'error':
			        		break;
			        	}
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	$('.loading-icon').addClass('hide');
			        }
			    });
		});




	  	$('.keyword-text').keydown(function(event){
		    if(event.keyCode == 13) {
		    	event.preventDefault();
	            $('#keyword-dup').addClass('hide');
	            var this_text = $(this).val();
	            $(this).val('');
	            var dup = 0;
	            var obj = $('.label-keyword');
	            var count = $('.label-keyword').length;
	            $('.label-keyword').removeClass('new-zip');
	            if (!$.isBlank(this_text)) {
	                $('.this-keyword-t').each(function( index ) {
	                  if ($(this).text() == this_text) {
	                    dup = 1;
	                  };
	                });
	                if (dup == 0) {
	                    var label_html = '<span class="label label-success label-keyword new-zip '+this_text+'" > <span class="this-keyword-t">'+this_text+'</span> <i class="glyphicon glyphicon-trash delete-keyword"></i></span>';
	                    var input_html = '<input class="'+this_text+'" type="hidden" name="keywords['+count+this_text+']" value="'+this_text+'" >';
	                    $('#keyword-group-wrapper').append(label_html);
	                    $('#keyword-group-wrapper').append(input_html);
	                } else {
	                    $('#keyword-dup').removeClass('hide');
	                }
	            }
		    }
	  	});
        
        $(document).on('click', '.add-keyword', function() {
            $('#keyword-dup').addClass('hide');
            var this_text = $(this).parents('.input-group').find('.keyword-text').val();
            $(this).parents('.input-group').find('.keyword-text').val('');
            var dup = 0;
            var obj = $('.label-keyword');
            var count = $('.label-keyword').length;
            $('.label-keyword').removeClass('new-zip');
            if (!$.isBlank(this_text)) {
                $('.this-keyword-t').each(function( index ) {
                  if ($(this).text() == this_text) {
                    dup = 1;
                  };
                });
                if (dup == 0) {
                    var label_html = '<span class="label label-success label-keyword new-zip '+this_text+'" > <span class="this-keyword-t">'+this_text+'</span> <i class="glyphicon glyphicon-trash delete-keyword"></i></span>';
                    var input_html = '<input class="'+this_text+'" type="hidden" name="keywords['+count+this_text+']" value="'+this_text+'" >';
                    $('#keyword-group-wrapper').append(label_html);
                    $('#keyword-group-wrapper').append(input_html);
                } else {
                    $('#keyword-dup').removeClass('hide');
                }
            }
        });
        $(document).on('click', '.delete-keyword', function() {
            var this_text = $(this).parents('.label-keyword').find('.this-keyword-t').text();
            $('.'+this_text).remove();
        });
	}
}
request = {
	add: function(id) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/',
			{
				"_token": token
			},
			function(result){
				var status = result.status;

				switch(status) {
					case 200: 
						
					break;				
					case 400: 
						
					break;
					default:
					break;
				}

				}
				);
	}
};
function addf(url)
{

}
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);