<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
	function readURL(input) {
  	if (input.files && input.files[0]) {
    var reader = new FileReader();
    


    reader.onload = function(e) {
      $('.imagePreview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

    $(".imagePreviewInput").change(function() {
    readURL(this);
});

</script>

<script type="text/javascript">
//Image zoom size

$(document).on('input change', '.formControlRange', function() {
    
   var image = document.getElementById('image_preview_container');
   image.style.width = 20*($(this).val())+'px';
    image.style.height = 20*($(this).val())+'px';
   
    if(this.value < 20){ image.style.marginTop = (100-this.value)+'px';}
    else{
      image.style.marginTop ='auto';
    }

});

// slider.oninput = function() {

// var image = document.getElementById('image_preview_container');
//     image.style.width = 20*(this.value)+'px';
//     image.style.height = 20*(this.value)+'px';
   
//     if(this.value < 20){ image.style.marginTop = (100-this.value)+'px';}
//     else{
//       image.style.marginTop ='auto';
//     }
  
// }
</script>
	
	
<script>
//Make the DIV element draggagle:
dragElement(document.getElementById("image_preview_container"));

function dragElement(elmnt) {
  var pos1 =0, pos2 = 0, pos3 = 0, pos4 = 0 , get_top=0 , get_left=0;
  if (false) {
    /* if present, the header is where you move the DIV from:*/
   // document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
   
    elmnt.onmousedown = dragMouseDown;
    
  }

  function dragMouseDown(e) { console.log(pos1);
    e = e || window.event;
    e.preventDefault();
 
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    console.log('dragMouseDown');
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    
     // elmnt.style.left = 0 + "px";
     
    get_top=elmnt.offsetTop - pos2;
    get_left =elmnt.offsetLeft - pos1;

    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {

    if(get_top <-273 || get_top >273){
      $("#image_preview_container").css('top','0px');
    $("#image_preview_container").css('left','0px');
    }
    else if(get_left <-435 || get_left>435){
      console.log('i amm'+get_left);
      $("#image_preview_container").css('top','0px');
    $("#image_preview_container").css('left','0px');
    }

    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>



<style>
	.container {
  margin-top: 50px;
  cursor: move;

  
}

#screen {
  overflow: hidden;
  width: 200px;
  height: 200px;
  clear: both;
  border: 1px solid black;
}

</style>
