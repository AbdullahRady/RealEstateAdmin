<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />

<title></title>
</head>
<body>
    <label for="uploadbannerimage1">
      <input id="uploadbannerimage1" name="uploadbannerimage1" type="file" onchange="updateimage(this);" style="display: none" />
        <img id="bannerimage1" name="bannerimage1" src="../img/slider/slides/slide1.jpg" width="187" height="70" alt="" style="cursor: pointer" />
    </label>
    
    <label for="uploadbannerimage2">
      <input id="uploadbannerimage2" name="uploadbannerimage2" type="file" onchange="updateimage(this);" style="display: none" />
        <img id="bannerimage2" name="bannerimage2" src="../img/slider/slides/slide1.jpg" width="187" height="70" alt="" style="cursor: pointer" />
    </label> 
    
         
</body>
</html>


<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script>
		
		
		function updateimage(input) 
		{
			
			var bannerimageinputid = input.id;
			var bannerimageid = bannerimageinputid.substr(6);
			
            if (input.files && input.files[0]) 
			{
                var reader = new FileReader();
				
				var filepath = document.getElementById(''+bannerimageinputid).value;
				var fileextension = getExt(filepath);
				
				if(fileextension == "jpg" || fileextension == "jpeg" || fileextension == "png" || fileextension == "gif")
				{
				
					reader.onload = function (e) 
					{
						
						$('#'+bannerimageid)
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