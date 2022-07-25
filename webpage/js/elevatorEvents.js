$(document).ready(function(){

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
		if(weekday[a.getDay()] == "Saturday"){
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
function getVal(x){
	//var vl = document.getElementById("floorNum").innerHTML;
	document.getElementById("setVal").value = x;
	// var flag = "up";
	if( $("#setVal").val() != "" ){
		var newFloor,currFloor, fno = 1, flag = '';
		newFloor = parseInt($("#setVal").val());
		currFloor = parseInt($("#floorNum").text());
		console.log("curr floor "+currFloor+"= new floor "+newFloor+"diff "+(currFloor - newFloor));
		

		if(currFloor < newFloor){
			if((currFloor - newFloor) == 0){
				newFloor = currFloor;flag = 'start';
				// ajaxCol(newFloor, flag);
			}
			if((currFloor - newFloor) == -1){
				newFloor = currFloor + 1;flag = 'up';
				// ajaxCol(newFloor, flag);
				flag = 'up';
			}
			if((currFloor - newFloor) == -2){
				newFloor = currFloor + 2;
				flag = 'up';
				for(var i = 1; i <= 2; i++){ fno = fno + 1;
					// setTimeout(ajaxCol(fno, flag),12000);
				}//end for loop
			}
			console.log("New floor = "+newFloor+" from if");
		}else{
			if((currFloor - newFloor) == 0){
				newFloor = currFloor;
				flag = 'end';
				// ajaxCol(newFloor, flag);
			}
			if((currFloor - newFloor) == 1){
				newFloor = currFloor - 1;
				flag = 'down';
				// ajaxCol(newFloor, flag);
			}
			if((currFloor - newFloor) == 2){
				flag = 'down';
				for(var i = 2; i >= 1; i--){ 
					fno = i;
					// setTimeout(ajaxCol(fno, flag),12000);
				}//end for loop
			}
			console.log("New floor = "+newFloor+" from else");
		}
		// $("form").submit()
	}
}
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
					if(data == 1){ sound1();

						$("#fl1").css({"backgroundColor":"green","color":"white"});
						$("#fl2").css({"backgroundColor":"#F0F0F0","color":"black"});
						$("#fl3").css({"backgroundColor":"#F0F0F0","color":"black"});

						$("#1st").css({"backgroundColor":"black","color":"white"});
						$("#2nd").css({"backgroundColor":"white","color":"black"});
						// $("#que").text("Floor 1");
					}
					if(data == 2){ sound2();

						$("#fl2").css({"backgroundColor":"green","color":"white"});
						$("#fl1").css({"backgroundColor":"#F0F0F0","color":"black"});
						$("#fl3").css({"backgroundColor":"#F0F0F0","color":"black"});

						$("#2nd").css({"backgroundColor":"black","color":"white"});
						$("#1st").css({"backgroundColor":"white","color":"black"});
						$("#3rd").css({"backgroundColor":"white","color":"black"});
						// $("#que").text("Floor 3");
					}
					if(data == 3){ sound3();
						$("#fl3").css({"backgroundColor":"green","color":"white"});
						$("#fl2").css({"backgroundColor":"#F0F0F0","color":"black"});
						$("#fl1").css({"backgroundColor":"#F0F0F0","color":"black"});
						
						$("#3rd").css({"backgroundColor":"black","color":"white"});
						$("#2nd").css({"backgroundColor":"white","color":"black"});
						// $("#que").text("Floor 3");
					}
				});//ajax end
}

function exDB(val){
	var curFlor, reqFlor, dir, strt, end;
	curFlor = parseInt($("#floorNum").text());
	reqFlor = parseInt(val);
	$("#que").text("Floor "+reqFlor);
	if(reqFlor < curFlor){
		if((parseInt(curFlor)-parseInt(reqFlor)) == 2)
			$("#que").text("Floor 2 > Floor 1");
		// $("#que").text(parseInt(curFlor)-parseInt(reqFlor));
		dir = "Down";
		strt = reqFlor;
		end = curFlor; 
		for(var i = strt; i < end; i++) {
		    (function(index) { 
		        setTimeout(function() {
		        	if(reqFlor == 2 && curFlor == 3){
		        		ajaxCol(2, dir);
		        		$("#que").text("Floor "+3);
		        	}
		        	else{
		        		ajaxCol((end-index), dir); 
		        		$("#que").text("Floor "+(end-index));
		        	}
		        }, index*2000);
		    })(i);
		}
	}else{ 
		if((parseInt(reqFlor)-parseInt(curFlor)) == 2)
			$("#que").text("Floor 2 > Floor 3");
		// $("#que").text(parseInt(reqFlor)-parseInt(curFlor));
		dir = "Up";
		strt = curFlor;
		end = reqFlor;
		for(var i = strt; i < end; i++) {
		    (function(index) {
		        setTimeout(function() { 
		        	// console.log(index+" "+i);
		        	ajaxCol(index, dir); 
		        	$("#que").text("Floor "+index);
		        }, index*2000);
		    })(i+1);
		}
	}//end of else
	
}