$(document).ready(function(){
	results.pageLoad();
	results.events();

});
results = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});

		  $('.rrssb-buttons').rrssb({
		    // required:
		    title: 'w re erter te erterw re erter te erterw re erter te erterw re erter te erterw re erter te erter',
		    url: 'http://yunbong.app:8000/view/Bill+Gates/5',

		    // optional:
		    description: 'w re erter te erterw re erter te erterw re erter te erterw re erter te erterw re erter te erter',
		    emailBody: 'w re erter te erterw re erter te erterw re erter te erterw re erter te erter'
		  });
	},
	events: function() {
        $(document).on('click','.view-this',function(){
        	var t_id = $(this).parents('.article-wrapper:first').attr('data');
        	if (!$.isBlank(t_id)) {
        		window.location.href = "/view/"+t_id;
            }
        });
	}
}
requestres = {
	results: function(id) {
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
function resultsf(url)
{

}
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);