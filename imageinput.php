<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />

<title></title>
</head>
<body>
<label for="uploadbannerimage">
  <input id="uploadbannerimage" name="uploadbannerimage" type="file" onchange="readURL(this);" style="display: none" />
    <img id="bannerimage" name="bannerimage" src="../img/slider/slides/slide1.jpg" width="187" height="70" alt="" style="cursor: pointer" />
</label>   
</body>
</html>


<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script>
		
		
		
		function readURL(input) 
		{
            if (input.files && input.files[0]) 
			{
                var reader = new FileReader();
				
				var filepath = document.getElementById('uploadbannerimage').value;
				var fileextension = getExt(filepath);
				
				if(fileextension == "jpg" || fileextension == "jpeg" || fileextension == "png" || fileextension == "gif")
				{
				
					reader.onload = function (e) 
					{
						
						$('#bannerimage')
							.attr('src', e.target.result)
							.width(187)
							.height(70);
					};
	
					reader.readAsDataURL(input.files[0]);
				
				}
				else
				{
					alert("Unknown image format");
				}
            }
		}
		
		function getExt(filename)
		{
			var ext = filename.split('.').pop();
			if(ext == filename) return "";
			return ext;
		}

</script>