jQuery(function() {
	jQuery("a img").parent().css("border","none");
	jQuery("a img").hover(
		function () {
			jQuery(this).parent().css("border","none");
		},
		function () {
			jQuery(this).parent().css("border","none");
		}
	);
});