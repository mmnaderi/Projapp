function file_enable() {
	if($("#file").attr("disabled") == "disabled") {
		$("#file").removeAttr('disabled');
	}
	else {
		$("#file").attr("disabled","disabled");
	}
}
function password_enable() {
	if($("#password").attr("disabled") == "disabled") {
		$("#password").removeAttr('disabled');
	}
	else {
		$("#password").attr("disabled","disabled");
	}
}
function edit_category($id) {
	$("#category_name"+$id).css("display","none");
	$("#category_edit"+$id).css("display","inline-block");
	$("#submit_category_edit"+$id).css("display","inline-block");
	$("#cancel"+$id).css("display","inline-block");
}
function cancel_edit($id) {
	var default_text = $('#category_name'+$id).text();
	$("#category_edit"+$id).val(default_text);
	$("#category_edit"+$id).val();
	$("#category_name"+$id).css("display","inline-block");
	$("#category_name"+$id).css("width","auto");
	$("#category_edit"+$id).css("display","none");
	$("#submit_category_edit"+$id).css("display","none");
	$("#cancel"+$id).css("display","none");
}
function submit_category($id) {
	var cat_name = $("#category_edit"+$id).val();
	  $.post("categories.php",
	  {
		id:$id,
		name:cat_name
	  },
	  function(data,status){
		$('#category_name'+$id).html(data);
		cancel_edit($id);
	  });
}