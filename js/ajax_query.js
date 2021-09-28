
// AJAX запрос на изменение маркера
// $("document").ready(function(){
// $('.markerClass').click(function(event){   
// 	jsId='';
// 	realJsId='';
// 	jsId = (event.target.id);
// 	realJsId = jsId.substring(10); /// Убираем первую часть
// 	$.ajax({
// 		url: "ajax/ajax_change_marker.php",
// 		method: 'get',             /* Метод передачи (post или get) */
// 	  dataType: 'html',
// 		data: {id:realJsId},
// 		success: function(data){
// 			marker=data;
// 			if (data == 0 ) {document.getElementById(jsId).src = 'icons/table/nolamp.jpg';}
// 			if (data == 1 ) {document.getElementById(jsId).src = 'icons/table/lamp.jpg';}
// 						$.ajax({
// 							url: "ajax/logger_ajax_query.php",
// 							method: 'get',             /* Метод передачи (post или get) */
// 							dataType: 'html',
// 							data: {id:realJsId,
// 											marker: marker}
// 						});
// 		}
// });
// });
// });

// // AJAX запрос на изменение Комментария
// $("document").ready(function(){
// 	$('.markerClass').click(function(event){   
// 		jsId='';
// 		realJsId='';
// 		jsId = (event.target.id);
// 		realJsId = jsId.substring(11); /// Убираем первую часть
// 		alert (realJsId);
// 		$.ajax({
// 			url: "ajax/ajax_change_comment.php",
// 			method: 'get',             /* Метод передачи (post или get) */
// 			dataType: 'html',
// 			data: {id:realJsId},
// 			success: function(data){
// 				comment=data;
// 				alert(comment);
// 				if (data == 0 ) {document.getElementById(jsId).src = 'icons/table/nolamp.jpg';}
// 				if (data == 1 ) {document.getElementById(jsId).src = 'icons/table/lamp.jpg';}
// 							$.ajax({
// 								url: "ajax/logger_ajax_query.php",
// 								method: 'get',             /* Метод передачи (post или get) */
// 								dataType: 'html',
// 								data: {id:realJsId,
// 												marker: marker}
// 							});
// 			}
// 	});
// 	});
// 	});