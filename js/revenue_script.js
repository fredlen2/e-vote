window.onload = function(){
			onloadMedi();
		}
		//show or hide medication form
		function onloadMedi(){
			//hide on initial page load
			document.getElementById("medi_fifth").style.display="none";
			document.getElementById("medi_sixth").style.display = "none";
			document.getElementById("medi_seventh").style.display = "none";
			document.getElementById("medi_eighth").style.display = "none";
		}
		
		var clicks = 0;
		function addMedi(){
				//for (clicks=1; clicks<=4; clicks++;){
				document.getElementById("medi_add").onclick = function(){
					if (document.getElementById("medi_add").onclick ){
						if (clicks == 0 ){
							//use CSS style to show it
							document.getElementById("medi_fifth").style.display="block";
							clicks++;
							}
						else if (clicks == 1 ){
								//use CSS style to show it
								document.getElementById("medi_sixth").style.display="block";
								clicks++;
							} 
						else if (clicks == 2 ){
								//use CSS style to show it
								document.getElementById("medi_seventh").style.display="block";
								clicks++;
							}
						else if (clicks == 3){
								//use CSS style to show it
								document.getElementById("medi_eighth").style.display="block";
								clicks++;
							} 
						}
					else{	//use CSS style to hide it
						document.getElementById("medi_fifth").style.display="none";
						document.getElementById("medi_sixth").style.display = "none";
						document.getElementById("medi_seventh").style.display = "none";
						document.getElementById("medi_eighth").style.display = "none";
						}
					}
				}
			
			function removeMedi(){
					document.getElementById("medi_remove").onclick = function(){
					if (document.getElementById("medi_remove").onclick ){
						if (clicks == 1){
								//use CSS style to show it
								document.getElementById("medi_fifth").style.display="none";
								clicks--;   
							} 
						else if (clicks == 2 ){
								//use CSS style to show it
								document.getElementById("medi_sixth").style.display = "none";
								clicks--;
							}
						else if (clicks == 3 ){
								//use CSS style to show it
								document.getElementById("medi_seventh").style.display = "none";
								clicks--;
							} 
						else if (clicks == 4 ){	
								//use CSS style to show it
								document.getElementById("medi_eighth").style.display = "none";
								clicks--;
							}
						}
					else{	//use CSS style to hide it				
						document.getElementById("medi_fifth").style.display = "block";
						document.getElementById("medi_sixth").style.display = "block";
						document.getElementById("medi_seventh").style.display = "block";
						document.getElementById("medi_eighth").style.display = "block";
						
						}
					}
				} 
				
				function amountCalc(){
					var qty1 = (document.getElementById("quantity1").value);
					var qty2 = (document.getElementById("quantity2").value);
					var qty3 = (document.getElementById("quantity3").value);
					var qty4 = (document.getElementById("quantity4").value);
					var qty5 = (document.getElementById("quantity5").value);
					var qty6 = (document.getElementById("quantity6").value);
					var qty7 = (document.getElementById("quantity7").value);
					var qty8 = (document.getElementById("quantity8").value);
					
					var price1 = (document.getElementById("price1").value);
					var price2 = (document.getElementById("price2").value);
					var price3 = (document.getElementById("price3").value);
					var price4 = (document.getElementById("price4").value);
					var price5 = (document.getElementById("price5").value);
					var price6 = (document.getElementById("price6").value);
					var price7 = (document.getElementById("price7").value);
					var price8 = (document.getElementById("price8").value);
					
					var total = ((qty1 * price1) + (qty2 * price2) + (qty3 * price3) + (qty4 * price4) + (qty5 * price5) + (qty6 * price6) + (qty7 * price7) + (qty8 * price8));
					document.getElementById('total').value = "GHC " + (total).toFixed(2).toString;
				}