$(document).ready(function(){
	$("#box").text($("#floorNum").text());
		$("#subbath").click(function(){
			$("#subbath").css({"backgroundColor":"green","color":"white","color":"white"});
		});
		var num = $("#floorNum").html();
		if(num == 1){ sound1(); $("#fl1").css({"backgroundColor":"green","color":"white"});
			$("#1st").css({"backgroundColor":"black","color":"white"});
		}
		if(num == 2){ sound2(); $("#fl2").css({"backgroundColor":"green","color":"white"});
			$("#2nd").css({"backgroundColor":"black","color":"white"});
		}
		if(num == 3){ sound3(); $("#fl3").css({"backgroundColor":"green","color":"white"});
			$("#3rd").css({"backgroundColor":"black","color":"white"});
		}
		//sabbath mode
		var flag = "up";
		$("#subbath").click(function(){
			subbath();
		});
		//subbath function
		function subbath(){
			var dt = new Date();
			var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
			//if($("#floorNum").text())
			setInterval(function(){
				var fno = parseInt($("#floorNum").text());
				

				$.ajax({
					url: "setfloor.php",
					method: 'post',
					data: {fno:fno,flag:flag},
				}).done(function(data){
					$("#floorNum").text(data);
					data = parseInt(data);
					if(data == 1){ sound1(); 

						$("#fl1").css({"backgroundColor":"green","color":"white"});
						$("#fl2").css({"backgroundColor":"#F0F0F0","color":"black"});
						$("#fl3").css({"backgroundColor":"#F0F0F0","color":"black"});

						$("#1st").css({"backgroundColor":"black","color":"white"});
						$("#2nd").css({"backgroundColor":"white","color":"black"});
						flag = "up";
					}
					if(data == 2){ console.log("2nd"); sound2(); 

						$("#fl2").css({"backgroundColor":"green","color":"white"});
						$("#fl1").css({"backgroundColor":"#F0F0F0","color":"black"});
						$("#fl3").css({"backgroundColor":"#F0F0F0","color":"black"});

						$("#2nd").css({"backgroundColor":"black","color":"white"});
						$("#1st").css({"backgroundColor":"white","color":"black"});
						$("#3rd").css({"backgroundColor":"white","color":"black"});
					}
					if(data == 3){ sound3(); 
						$("#fl3").css({"backgroundColor":"green","color":"white"});
						$("#fl2").css({"backgroundColor":"#F0F0F0","color":"black"});
						$("#fl1").css({"backgroundColor":"#F0F0F0","color":"black"});
						
						$("#3rd").css({"backgroundColor":"black","color":"white"});
						$("#2nd").css({"backgroundColor":"white","color":"black"});
						flag = "down";
					} console.log(flag)
				})
			}, 12000)
		}
		//subbath mode

		$("#stop").click(function(){
			location.reload(true);
		})

		var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

		var a = new Date();
		//alert(a.getDay())
		if(weekday[a.getDay()] == "Monday"){
			//alert("monday");
			subbath();
		}

		$("#open").click(function(){
			//alert("dd")
			$("#door").css({"fontSize":"12px"});
			$("#door").text("Door is open");
		});
		$("#close").click(function(){
			//alert("dd")
			$("#door").css({"fontSize":"12px"});
			$("#door").text("Door is closed");
		});

	$(".setMargin").click(function(){
			exDB($(this).val());
	})
//end of document ready
})

function ajaxCol(fno, flag){
	$.ajax({
		url: "setfloor1.php",
		method: 'post',
		data: {fno:fno,flag:flag},
	}).done(function(data){ var dt = JSON.parse(data);
		// console.log("data="+dt['floor'])
		$("#floorNum").text(dt['floor']);
		$("#dir").text(dt['dir']);
		data = parseInt(dt['floor']);
	});//ajax end
}
var q = new Array();
function exDB(val){ 
	var curFlor, reqFlor, dir, strt, end ;
	curFlor = parseInt($("#floorNum").text());
	reqFlor = parseInt(val);
	if(curFlor != reqFlor){
		if(curFlor == 1 && reqFlor == 3 && q.length == 0){
			for (var i = 1; i < reqFlor; i++) {
				q.push(++curFlor)
				$("#que").text(q.toString());
				task();
				// curFlor++;
			}
		}else if(curFlor == 3 && reqFlor == 1 && q.length == 0){
			for (var i = curFlor; i > 1; i--) {
				q.push(--curFlor)
				$("#que").text(q.toString());
				task();
				// curFlor--;
			}
		}else{
			q.push(reqFlor)
			$("#que").text(q.toString());
			task();
		}
		
	}
}

function openDoor(){
	$(".door1").animate({"width":"0px"},2000);
	$(".door2").animate({"width":"0px"},2000);
}
function closeDoor(){
	$(".door1").animate({"width":"98px"},2000);
	$(".door2").animate({"width":"98px"},2000);
}
 
var i = 0, j = 1;
function task() {
  setTimeout(function() {
      if(i <= q.length-1 ){ //console.log("q = "+q[i]+" length = "+q.length+" i = "+i+" j = "+j)
      	
    	ajaxCol(q[i],"Up");
    	var itemtoRemove = q[i];
    	setTimeout(function(){ $("#box").text(itemtoRemove); },j*6000);
    	setTimeout(function(){ 
    		if(itemtoRemove == 1){ 
			 sound1();
				$("#fl1").css({"backgroundColor":"green","color":"white"});
				$("#fl2").css({"backgroundColor":"#F0F0F0","color":"black"});
				$("#fl3").css({"backgroundColor":"#F0F0F0","color":"black"});
		}
		if(itemtoRemove == 2){ 
			// setTimeout(function(){ 
				sound2();
				$("#fl2").css({"backgroundColor":"green","color":"white"});
				$("#fl1").css({"backgroundColor":"#F0F0F0","color":"black"});
				$("#fl3").css({"backgroundColor":"#F0F0F0","color":"black"});
			// },5000);
		}
		if(itemtoRemove == 3){ 
			// setTimeout(function(){ 
				sound3();
				$("#fl3").css({"backgroundColor":"green","color":"white"});
				$("#fl2").css({"backgroundColor":"#F0F0F0","color":"black"});
				$("#fl1").css({"backgroundColor":"#F0F0F0","color":"black"});
			// },5000);
		}
    	 },j*6000);
    	setTimeout(function(){ q.splice($.inArray(itemtoRemove, q), 1); $("#que").text(q.toString());openDoor();closeDoor();},j*6000);
			
	} j++; i++;
  }, j*4000); //end of time out
  i = 0, j = 1;
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}