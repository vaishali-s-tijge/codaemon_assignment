function prepareDialogHtml(id, appendto, message){
	var dialog_html = '<div id="'+id+'" title="Are your sure ?">';
	dialog_html += '<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>';
	dialog_html += '<div id="dialog_message">'+message+'</div>';
	dialog_html += '</p></div>';
	$(appendto).append(dialog_html);
	$('#'+id).hide();	
}
(function($){
	
	$.addParam = function(t,p){
		p = $.extend({
			REQUEST_URL: 'grid.php',
			dataType: 'html',
			FORM_ID: 'form#grid',
			DIV: '#user_grid',
			METHOD: 'GET',
			BTN_SEARCH: '#btn_search',
			BTN_RESET_SEARCH : '#btn_reset_search',
			TXT_COLUMN : '#txt_column',
			TXT_ORDER_TYPE: '#txt_order_type',
			ORDER_TYPE: 'asc',
			BTN_ACTION: '#btnaction',
			ALLOWDELETE: false,
			DELETEMSG: 'Are you sure you want to delete this record?',
			ALLOWRESETSEARCH: false,
			ALLOWDIALOG: false,
			DEFAULT_AJAX: true,
			CURRENT_GRID_COLUMN: '',
			COOKIE: ""
		}, p);
		
		$.p = p;
		
		if(typeof $.ui !== "undefined"){
			if(typeof $.ui.dialog !== "undefined"){
				p.ALLOWDIALOG = false;
			}
		}
		
		$('body').append('<div class="indicator-main"><div id="indicator">Loading...</div></div>');
		if(p.DEFAULT_AJAX == true){
			sendRequest(t, p);
		}else{
			var data = $(t).html();
			addData(data, t, p);
		}
		return t;
	};
	
	setGridCookie = function(t, p, query_string){
		if(typeof $.cookie === "undefined") { return query_string; /*throw "jsTree cookie: jQuery cookie plugin not included.";*/ }
		if(query_string.length > 0){
			$.cookie(p.COOKIE, query_string);
			return query_string;
		}else{
			return getGridCookie(t, p);
		}
	}
	
	getGridCookie = function(t, p){		
		if(typeof $.cookie === "undefined") { return false; /*throw "jsTree cookie: jQuery cookie plugin not included.";*/ }
		if(p.COOKIE == "") { alert("Please set cookie name."); return false; /*throw "jsTree cookie: jQuery cookie plugin not included.";*/ }
		if(p.ALLOWRESETSEARCH == false){
			var query_string = ($.cookie(p.COOKIE) != null ? $.cookie(p.COOKIE) : "") ;
			if(query_string.length < 1){
				query_string = false;
			}
			return query_string;
		}else{
			$.cookie(p.COOKIE, null);
			return false;
		}
		
	}
	
	setPage = function(t, p){
		//$('#page', t).val(p.page);
		sendRequest(t, p);
	}
	
	getAllParameters = function(t, p){
		if(p.ALLOWRESETSEARCH == false){
			var query_string = $(p.FORM_ID, t).serialize();
			if(typeof $('#action').val() === "undefined" || $('#action').val() == ""){
				query_string = setGridCookie(t, p, query_string);
			}
			return query_string;
		} else {
			// code execute when reset search btn clicked.
			var query_string = getGridCookie(t, p);
			return query_string;
		}
	}
	
	blockUi = function(t, p){
		$(".indicator-main").show();
	}
	
	unblockUi = function(t, p){
		$(".indicator-main").fadeOut(1000, function() { $(".indicator-main").hide(); });
		//$(".indicator-main").hide();

	}
	
	sendRequest = function(t, p){
		//blockUi(t, p);
		/* START UI BLOCK */
		$(".indicator-main").fadeIn(function(){
			var param = getAllParameters(t, p);
			$.ajax({
				type: p.METHOD,
				url: p.REQUEST_URL,
				async: true,
				data: param,
				contentType: 'application/x-www-form-urlencoded; charset=iso-8859-1;',
				cache: false,
				dataType: p.dataType,
				success: function(data){
					addData(data, t, p);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { try { if (p.onError) p.onError(XMLHttpRequest, textStatus, errorThrown); } catch (e) {} }
			});
		});
		/* END UI BLOCK */
	}
	
	$.sendRequest = function(t, p){
		$.p = $.extend(p, $.p);
		sendRequest(t,$.p);
	}
	
	deleteRow = function(id, t, p){
		if(confirm(p.DELETEMSG)){
			$('#checkall').parents('table:eq(0)').find(':checkbox').removeAttr('checked');
			var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv');
			$(newTextBoxDiv).css({'display':'none'});
			newTextBoxDiv.html('<input type="checkbox" name="id[]" id="id[]" value="'+id+'" checked="checked" >');
			newTextBoxDiv.appendTo(p.FORM_ID);
			$("#action").val('delete').attr("selected", "selected");
		}
		sendRequest(t, p);
	}
	
	performDelete = function(t, p){
		if(p.ALLOWDIALOG == true){
			prepareDialogHtml('dialog-confirm', t, p.DELETEMSG);
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Delete": function() {
						$( this ).dialog( "close" );
						sendRequest(t, p);
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else{
			if(p.ALLOWDELETE == false){ alert('Add {ALLOWDELETE: true} in your code'); return false; }
			if(confirm(p.DELETEMSG)){	sendRequest(t, p);	}else{ return false; }//if
		}		
	}
	
	
	performInactive = function(t, p){
		if(p.ALLOWDIALOG == true){
			prepareDialogHtml('dialog-confirm', t, 'Are you sure, you want to inactive selected records?');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Inactive": function() {
						$( this ).dialog( "close" );
						sendRequest(t, p);
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else{
			if(confirm('Are you sure, you want to inactive selected records?')){	sendRequest(t, p);	}else{ return false; }//if
		}
	}
	
	
	performActive = function(t, p){
		if(p.ALLOWDIALOG == true){
			prepareDialogHtml('dialog-confirm', t, 'Are you sure, you want to active selected records?');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Active": function() {
						$( this ).dialog( "close" );
						sendRequest(t, p);
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else{
			if(confirm('Are you sure, you want to active selected records?')){	sendRequest(t, p);	}else{ return false; }//if
		}
	}
	
	
	performApproved = function(t, p){
		if(p.ALLOWDIALOG == true){
			prepareDialogHtml('dialog-confirm', t, 'Are you sure, you want to approved selected records?');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Approved": function() {
						$( this ).dialog( "close" );
						sendRequest(t, p);
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else{
			if(confirm('Are you sure, you want to approved selected records?')){	sendRequest(t, p);	}else{ return false; }//if
		}
	}
	
	
	performDisapproved = function(t, p){
		if(p.ALLOWDIALOG == true){
			prepareDialogHtml('dialog-confirm', t, 'Are you sure, you want to disapproved selected records?');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Disapproved": function() {
						$( this ).dialog( "close" );
						sendRequest(t, p);
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else{
			if(confirm('Are you sure, you want to disapproved selected records?')){	sendRequest(t, p);	}else{ return false; }//if
		}
	}
	
	
	performDispached = function(t, p){
		if(p.ALLOWDIALOG == true){
			prepareDialogHtml('dialog-confirm', t, 'Are you sure, you want to dispached selected records?');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"dispached": function() {
						$( this ).dialog( "close" );
						sendRequest(t, p);
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else{
			if(confirm('Are you sure, you want to dispached selected records?')){	sendRequest(t, p);	}else{ return false; }//if
		}
	}
	
	
	performInprogress = function(t, p){
		if(p.ALLOWDIALOG == true){
			prepareDialogHtml('dialog-confirm', t, 'Are you sure, you want to set selected records inprogress?');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"inprogress": function() {
						$( this ).dialog( "close" );
						sendRequest(t, p);
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else{
			if(confirm('Are you sure, you want to set selected records inprogress?')){	sendRequest(t, p);	}else{ return false; }//if
		}
	}
	
	
	performCompleted = function(t, p){
		if(p.ALLOWDIALOG == true){
			prepareDialogHtml('dialog-confirm', t, 'Are you sure, you want to complete order?');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"completed": function() {
						$( this ).dialog( "close" );
						sendRequest(t, p);
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else{
			if(confirm('Are you sure, you want to complete order?')){	sendRequest(t, p);	}else{ return false; }//if
		}
	}
	
	
	performCancelled = function(t, p){
		if(p.ALLOWDIALOG == true){
			prepareDialogHtml('dialog-confirm', t, 'Are you sure, you want to cancelled order?');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"cancelled": function() {
						$( this ).dialog( "close" );
						sendRequest(t, p);
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}else{
			if(confirm('Are you sure, you want to cancelled order?')){	sendRequest(t, p);	}else{ return false; }//if
		}
	}
	
	addData = function(data, t, p){
		p.ALLOWRESETSEARCH = false;
		$(t).html("");
		$(t).html(data);
		$(p.BTN_SEARCH, t).click(function(){
			p.REQUEST_URL = filename;
			//$('#page', t).val("1");
			p.ALLOWRESETSEARCH = false;
			//$("#page", t).val("1");
			blockUi(t, p)
			sendRequest(t, p);
		});
		$(p.BTN_RESET_SEARCH, t).click(function(){
			p.REQUEST_URL = filename;
			p.ALLOWRESETSEARCH = true;
			sendRequest(t, p);
		});

		
		$(".pagination a", t).click(function(){
			p.REQUEST_URL = $(this).attr("href");
			sendRequest(t, p);
			return false;
		});

		
		var el = $('th', t);
		$(el).each(function(){
			$(this).click(function(){
				if($(this).attr('abbr')){
					p.CURRENT_GRID_COLUMN = this;
					$("#action", t).val('').attr("selected", "selected");
					$(p.TXT_COLUMN, t).val($(this).attr('abbr'));
					p.ORDER_TYPE = (p.ORDER_TYPE == 'asc' ? 'desc' : 'asc');
					$(p.TXT_ORDER_TYPE, t).val(p.ORDER_TYPE);
					var actionValue = $("#action", t).val();
					if(typeof($("#action", t).val() === "undefined")){
						sendRequest(t, p);
					}else{
						$(p.BTN_ACTION, t).trigger('click');
					}
				}
			});
			
			if($(p.TXT_COLUMN).val() == $(this).attr('abbr')){
				$('.down', t).remove();
				$('.up', t).remove();
				if(p.ORDER_TYPE == 'asc'){
					$('div', this).addClass('pull-left');
					$(this, t).append('<span class="fa fa-sort-amount-asc pull-right">&nbsp;</span>');
				}
				if(p.ORDER_TYPE == 'desc'){
					$('div', this).addClass('pull-left');
					$(this, t).append('<span class="fa fa-sort-amount-desc pull-right">&nbsp;</span>');
				}
			}
			
		});
		
		var el = $( '.form-control', t);
		$(el).each(function(){
			$(this).keypress(function(event) {
				if ( event.which == 13 ) {
					$('#page', t).val("1");
					if($("#action", t).val() != ""){
						$(p.BTN_SEARCH, t).trigger('click');
					}else{
						sendRequest(t, p);
					}
				}
			});
		});
		
		$('#checkall', t).click(function () {
			$(this).parents('table:eq(0)').find(':checkbox').prop('checked', this.checked);
		});
		
		var el = $('#checkall', t).parents('table:eq(0)').find("input[id=\"id[]\"]");
		$(el).each(function(){
			$(this).click(function(){
				if($(this, t).prop("checked") == false || typeof($(this, t).prop("checked")) === 'undefined'){
					$('#checkall', t).prop('checked', false);
				}else if($(el).length == $("input[id=\"id[]\"]", t).filter(':checked').length){
					$('#checkall', t).prop('checked', true);
				}
			});
		});

		
		$(p.BTN_ACTION, t).click(function () {
			var action = $('#action').val();
			var n = $("input[id=\"id[]\"]", t).filter(':checked').length;
			if(parseInt(n) < 1){
				if(p.ALLOWDIALOG == true){
					prepareDialogHtml('dialog-modal', t, "Please select records, to perform this action.")
					$( "#dialog-modal" ).dialog({
						height: 100,
						modal: true
					});
				}else{
					alert("Please select records, to perform this action.");
					return false;
				}
			}
			switch(action){
				case "delete":
					performDelete(t, p);
				break;
				case "inactive":
					performInactive(t, p);
				break;
				case "active":
					performActive(t, p);
				break;
				case "approved":
					performApproved(t, p);
				break;
				case "disapproved":
					performDisapproved(t, p);
				break;
				case "dispached":
					performDispached(t, p);
				break;
				case "inprogress":
					performInprogress(t, p);
				break;
				case "completed":
					performCompleted(t, p);
				break;
				case "cancelled":
					performCancelled(t, p);
				break;
				default:
					alert("Plase select action !!!");
				break;
			}//switch
		});
		
		$('.delete', t).each(function(){
			$(this).click(function(){
				if(p.ALLOWDELETE == false){ alert('Add {ALLOWDELETE: true} in your code'); return false; }
				deleteRow($(this).attr('id'), t, p);
			});
		});
		unblockUi(t, p);
	}
	
	$.fn.custom_grid_plugin = function(p) {
		return this.each( function() {
			var t = this;
			$(document).ready(function (){
				$.addParam(t,p);
			});
		});
		$.sendRequest(t,p);
	}; //end flexigrid
	
})(jQuery);