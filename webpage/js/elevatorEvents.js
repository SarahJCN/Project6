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
//end of document ready
})
	function getVal(x){
		document.getElementById("setVal").value = x;

		if( $("#setVal").val() != "" ){
			var data = $("#setVal").val();
			$("form").submit();
		}

	}