		var c=0
		var s
		function cameraView() {
		if (c%5==0){
		document.getElementById('camera1').src = "images/1265849610942_20.png";
		}
		if (c%5==1) {
		document.getElementById('camera1').src = "images/rect2888.png";
		}
		if (c%5==0) {
		document.getElementById('camera2').src = "images/rect2888.png";
		}
		if (c%5==1) {
		document.getElementById('camera2').src = "images/1265849610942_20.png";
		}
		c=c+1
		s=setTimeout("cameraView()",1000)
		}
