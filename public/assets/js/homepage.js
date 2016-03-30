$(document).ready(function(){
	main.pageLoad();
	main.events();

});
main = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	events: function() {

		$('.back-to-home').click(function(){
			window.location = "/";
		});

		// $('#sform-input').keypress(function(event) {

		//     if(event.which == 13) {
		//     	event.preventDefault();
		//     	$('.sform').submit()
		//     }
		// });
	}
}
requestw = {

};

