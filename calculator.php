 <?php
if(!defined('custom_page_from_inclusion')) { die(); }
 
echo <<<EOT
	<!DOCTYPE html>	
	<head>
	<style>
		td    {
			padding: 2px 2px 2px 2px !important;
		}
	</style>	

	<script>
	function roundToTwo(num) {    
	    return +(Math.round(num + "e+2")  + "e-2");
	}	
	
    $(document).ready(function() {
//		$("#c1").val("5000");
//		$("#v1").val("");			
//		$("#c2").val("100");
//		$("#v2").val("500");


		
		$("#clear").click(function() {
			$("#c1").val("");
			$("#v1").val("");			
			$("#c2").val("");
			$("#v2").val("");
			$("#c1s option[value=1000]").prop('selected', true);
			$("#v1s option[value=1000]").prop('selected', true);
			$("#c2s option[value=1000]").prop('selected', true);
			$("#v2s option[value=1000]").prop('selected', true);
			$("#msg").text("You need to provide 3 out of 4 values");
																		
		});
		
		$("#c1s").focus(function() {
			if ($("#c1").val() != "") {			
				$(this).data("old" , $(this).val());
			}
		});
		$("#v1s").focus(function() {
			if ($("#v1").val() != "") {				
				$(this).data("old" , $(this).val());
			}
		});
		$("#c2s").focus(function() {
			if ($("#c2").val() != "") {					
				$(this).data("old" , $(this).val());
			}
		});
		$("#v2s").focus(function() {
			if ($("#cv").val() != "") {								
				$(this).data("old" , $(this).val());
			}
		});

		$("#c1s").change(function() {
			if ($("#c1").val() != "") {
				$("#c1").val(($("#c1").val() / $(this).data("old") * $(this).val()));
			}
			$(this).data("old" , $(this).val());			
		});		

		$("#v1s").change(function() {
			if ($("#v1").val() != "") {			
				$("#v1").val(($("#v1").val() / $(this).data("old") * $(this).val()));
			}
			$(this).data("old" , $(this).val());			
		});		

		$("#c2s").change(function() {
			if ($("#c2").val() != "") {						
				$("#c2").val(($("#c2").val() / $(this).data("old") * $(this).val()));
			}
			$(this).data("old" , $(this).val());			
		});		

		$("#v2s").change(function() {
			if ($("#v2").val() != "") {									
				$("#v2").val(($("#v2").val() / $(this).data("old") * $(this).val()));
			}
			$(this).data("old" , $(this).val());			
		});		
	
		$("#calculate").click(function() {
			
			var c1s = $("#c1s option:selected").val();
			var v1s = $("#v1s option:selected").val();
			var c2s = $("#c2s option:selected").val();
			var v2s = $("#v2s option:selected").val();			
			var c1 = $("#c1").val();
			var v1 = $("#v1").val();						
			var c2 = $("#c2").val();
			var v2 = $("#v2").val();
						
			if (c1 == "" && v2 != "" && c2 != "" && v2 != ""){
				$("#msg").text(" ");																			
				var c1 = roundToTwo((((c2 / c2s) * (v2 / v2s)) / (v1 / v1s)) * c1s);
				if (c1 * c1s <= 0.01) {
					$("#msg").text("Your stock concentration unit is too high");				
					c1 = "";
				}									
				$("#c1").val(c1);
			} else
			if (v1 == "" && c1 != "" && c2 != "" && v2 != ""){
				$("#msg").text(" ");				
				var v1 = roundToTwo((((c2 / c2s) * (v2 / v2s)) / (c1 / c1s)) * v1s);
				if (v1 * v1s <= 0.01) {
					$("#msg").text("Your stock volume unit is too high");				
					v1 = "";					
					} else			
				if ((v1 / v1s) > (v2 / v2s)) {
					v1 = "";
					$("#msg").text("The stock concentration is too low");
					} else
				if ((v1 / v1s) == (v2 / v2s)) {
					v1 = "";
					$("#msg").text("This is not a dilution, the stock concentration equals desired concentration");
				};				
				$("#v1").val(v1);								
			} else
			if (c2 == "" && c1 != "" && v1 != "" && v2 != ""){
				$("#msg").text(" ");				
				var c2 = roundToTwo((((c1 / c1s) * (v1 / v1s)) / (v2 / v2s)) * c2s);
				if (c2 * c2s <= 0.01) {
					$("#msg").text("Your desired concentration unit is too high");				
					c2 = "";
				}									
				$("#c2").val(c2);
			} else
			if (v2 == "" && c1 != "" && v1 != "" && c2 != ""){
				$("#msg").text(" ");
				var v2 = roundToTwo((((c1 / c1s) * (v1 / v1s)) / (c2 / c2s)) * v2s);
				if (v2 * v2s <= 0.01) {
					$("#msg").text("Your desired volume unit is too high");				
					v2 = "";					
					} else
				if ((v1 / v1s) > (v2 / v2s)) {
					v2 = "";
					$("#msg").text("The stock concentration is too low");
					} else
				if ((v1 / v1s) == (v2 / v2s)) {
					v2 = "";
					$("#msg").text("This is not a dilution, the stock concentration equals desired concentration");
				}						
				$("#v2").val(v2);			
			} else
			if ($("#c1").val() != "" && $("#v1").val() != "" && $("#c2").val() != "" && $("#v2").val() != ""){
				$("#msg").text("you need to leave on value empty");
			}
		});
		
    });
	</script>
	</head>
	<body>
	<center><h1> Buffer Dilution Calculator </h1></center>
	<p id="msg" align="center">You need to provide 3 out of 4 values</p>
	<table align="center">
	<tr>
	<td>
		Stock concentration: 
	</td>
	<td>
		<input type="text" name="c1" id="c1"> 
	</td>
	<td>
	<select id="c1s">
		<option value="1">M Molar</option>
		<option value="1000" selected>mM Millimolar</option>
		<option value="1000000">µM Micromolar</option>
		<option value="1000000000">nM Nanomolar</option>
		<option value="1000000000000">pM Picomolar</option>
	</select>
	</td>
	</tr>
	<tr>
	<td>
		Stock Volume: 
	</td>
	<td>
		<input type="text" name="v1" id="v1">
	</td>
	<td>
	<select id="v1s">
		<option value="1">L liter</option>
		<option value="1000" selected>ml milliliter</option>
		<option value="1000000">µl microliter</option>
	</select>
	</td>
	</tr>
	<tr>
	<td>
		Desired concentration: 
	</td>
	<td>
		<input type="text" name="c2" id="c2"> 
	</td>
	<td>
	<select id="c2s">
		<option value="1">M Molar</option>
		<option value="1000" selected>mM Millimolar</option>
		<option value="1000000">µM Micromolar</option>
		<option value="1000000000">nM Nanomolar</option>
		<option value="1000000000000">pM Picomolar</option>														
																
	</select>
	</td>
	</tr>
	<tr>
	<td>
		Desired Volume: 
	</td>
	<td>
		<input type="text" name="v2" id="v2"> 
	</td>
	<td>
	<select id="v2s">
		<option value="1">L liter</option>
		<option value="1000" selected>ml milliliter</option>
		<option value="1000000">µl microliter</option>
	</select>
	</td>
	</tr>
	<tr>
		<td colspan="4" align="right">
		<br>
			<button id="clear">clear</button>
			<button id="calculate">calculate</button>
		</td>
		</tr>
	</table>
	<center>
	<p style="font-size: 9pt;">
	<br>This buffer dilution calculator rounds to two digits. <br>I have checked the calculations but use at your own risk and recheck. <br> Please  let me know if you encounter any erros.
	</body>
	</html>

EOT;

?>