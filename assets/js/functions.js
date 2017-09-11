function showWarningMessage(id, msg){
	var str = '<div class="alert alert-warning"> <a href="javascript:void(0)" class="close" data-dismiss="alert" onclick="closeMessage()">&times;</a> <strong>Warning!</strong> '+ msg +' </div>';
	try { 
		if(id == '' || typeof id == 'undefined'){throw new Error('First parameter id is missing');}
		$('#' + id).html(str);
	} catch (e) {
		alert(e.message);
	}
}
function showErrorMessage(id, msg){
	var str = '<div class="alert alert-danger"><a href="javascript:void(0)" class="close" data-dismiss="alert" onclick="closeMessage()">&times;</a> <strong>Error!</strong> '+ msg +' </div>';
	try { 
		if(id == '' || typeof id == 'undefined'){throw new Error('First parameter id is missing');}
		$('#' + id).html(str);
	} catch (e) {
		alert(e.message);
	}
}
function showSuccessMessage(id, msg){
	var str = '<div class="alert alert-success"> <a href="javascript:void(0)" class="close" data-dismiss="alert" onclick="closeMessage()">&times;</a> <strong>Success!</strong> '+ msg +' </div>';
	try { 
		if(id == '' || typeof id == 'undefined'){throw new Error('First parameter id is missing');}
		$('#' + id).html(str);
	} catch (e) {
		alert(e.message);
	}
}
function closeMessage(){
	$('.alert').remove();
}
function startLoading(id){
	try { 
		if(typeof id == 'undefined'){throw new Error('First parameter id is missing');}
		$('#' + id).attr('disabled', 'disabled');
		$('#' + id).val('Please wait...');
	} catch (e) {
		alert(e.message);
	}
}
function stopLoading(id, val){
	try { 
		if(id == '' || typeof id == 'undefined'){throw new Error('First parameter id is missing');}
		if(val == '' || typeof val == 'undefined'){throw new Error('Second parameter val is missing');}
		$('#' + id).removeAttr('disabled');
		$('#' + id).val(val);
	} catch (e) {
		alert(e.message);
	}

}