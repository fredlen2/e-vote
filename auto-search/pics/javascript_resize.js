//javascript to control screen resize

function adjustStyle(){
			var width = 0;
			//get the width. more cross-browser issues
			if (window.innerHeight) {
				width = window.innerWidth;
			}
			else if (document.documentElement && document.documentElement.clientHeight) {
				width = document.documentElement.clientWidth;
			}
			else if (document.body) {
				width = document.body.clientWidth;
			}
			//now we should have it
			if (width < 600) {
				document.getElementById("mycss").setAttribute("href", "sheetN.css");
			}
			else { 
				document.getElementById("mycss").setAttribute("href", "sheet.css");
				document.getElementById("mycss").setAttribute("href", "sheet1.css");
			}
		}
		
		//now call it when the window is resized
		window.onresize =function() {
			adustStyle();
		};