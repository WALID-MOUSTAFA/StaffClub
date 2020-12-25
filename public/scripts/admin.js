$(document).ready(function() {
	$("button.submit-delete").on("click", function(e) {
		e.preventDefault();
		var confirm_delete= confirm("هل أنت واثق من أنك تريد متابعة الحذف؟");
		if(confirm_delete) {
			$(this).closest("form").submit();
		}else {
			return false;
		} 
	});
});
