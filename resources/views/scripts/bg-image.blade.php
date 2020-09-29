<script type="text/javascript">
 //Image zoom size
// var slider = document.getElementById("formControlRange");

// slider.oninput = function() { 

//   var image = document.getElementById('round_image');
//       image.style.width = 20*(this.value)+'px';
//       image.style.height = 20*(this.value)+'px';
     
//       if(this.value < 20){ image.style.marginTop = (100-this.value)+'px';}
//       else{
//         image.style.marginTop ='auto';
//       }
    
// }


//Image Rotate
var angle = 0,
  img = document.getElementById('round_image');
document.getElementById('rotate').onclick = function() {
  angle = (angle + 90) % 360;
  img.className = "rotate" + angle;
}




  $(document).ready(function() {
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $("#round_image").attr('src', e.target.result);

    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}


$("#upload__quiz__icon").change(function() {
  
  readURL(this);
  
});





  });

  
</script>

<script>
    var zoomer = document.getElementById('zoomer');
var hubblepic = document.getElementById('round_image');

function deepdive(){ 
	zoomlevel = zoomer.valueAsNumber;
  hubblepic.style.webkitTransform = "scale("+zoomlevel+")";
	hubblepic.style.transform = "scale("+zoomlevel+")";
}
</script>
<style>
     #image-container {
  width: 100%;
  font-size: 0;
  border: 1px solid #111;
  overflow: hidden;
  margin: 0 auto;
 /* margin-top: 2rem;*/
}

#round_image{
  width: 100%;
  height: 100%;
  position: absolute;
}

/* #zoomer {
  display: block;
  width: 50%;
  margin: 2rem auto;
} */
@media all and (max-width: 500px) {
  #zoomer, #image-container {
    width: 85%;
  }
}
 </style>
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
	$(function() {
  $(".draggable").draggable();
});
</script> -->


<script>
//Make the DIV element draggagle:
dragElement(document.getElementById("round_image"));

function dragElement(elmnt) {
  var pos1 =0, pos2 = 0, pos3 = 0, pos4 = 0 ,get_top=0 , get_left=0;
  if (false) {
    /* if present, the header is where you move the DIV from:*/
   // document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {

    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
 
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
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
    /* stop moving when mouse button is released:*/

    if(get_top <-273 || get_top >273){
      $("#round_image").css('top','0px');
    $("#round_image").css('left','0px');
    }
    else if(get_left <-435 || get_left>435){
    
      $("#round_image").css('top','0px');
    $("#round_image").css('left','0px');
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