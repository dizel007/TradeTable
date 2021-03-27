
function AjaxQuery(){
type="text/javascript"> 
			$("document").ready(function(){

				var send={};
				
				send['a'] = $("#one").text();
				send['b'] = $("#two").text();

				$.ajax({
					url: "test.php",
					type: "POST",
					data: {
						a:999
								},
					success: function(data){
							alert(data);
					}
				

					
				});
			});
 }
 <?php

 $daann = "pppppp";
 $one="#one";
 echo "<p id=\"".$one."\">".$daann."</p>";
 
 ?>
 
 <script type="text/javascript"> 
 $("document").ready(function(){
 
	 var perem = '<?php echo $one;?>';
	 var send={};
	 
	 send['a'] = $(perem).text();
	 
	 // send['b'] = $("#two").text();
 
	 $.ajax({
		 url: "test.php",
		 type: "GET",
		 data: {
			 a:999
					 },
		 success: function(data){
					alert(data);
					document.getElementById(perem).innerHTML="Новый текст!";
		 }
	 
 
		 
	 });
 });
 
 </script>