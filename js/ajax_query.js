
$("document").ready(function(){
$('.power').click(function(event){   
	jsId='';
	realJsId='';
	jsId = (event.target.id);
	// alert(jsId);
	realJsId = jsId.substring(10);
	//  alert(realJsId);
	$.ajax({
		url: "ajax/ajaxChangeMarker.php",
		method: 'get',             /* Метод передачи (post или get) */
	  dataType: 'html',
		data: {id:realJsId},
		// data: id=realJsId,
		success: function(data){
			//  alert(data);
			marker=data;
			if (data == 0 ) {document.getElementById(jsId).src = 'icons/table/nolamp.jpg';}
			if (data == 1 ) {document.getElementById(jsId).src = 'icons/table/lamp.jpg';}
			

			$.ajax({
				url: "ajax/logger_ajax_query.php",
				method: 'get',             /* Метод передачи (post или get) */
				dataType: 'html',
				data: {id:realJsId,
				 				marker: marker}
				
				
		});




		}
});
});
});


