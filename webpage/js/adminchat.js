$(function(){
	$("#send_sms").keydown(function(e){
		if(e.keyCode == 13){
			var chat = $(this).val();
			var user = "admin";
			$.ajax({
				url : "../adminchat.php",
				method : "POST",
				data : {chat:chat,user:user}
			}).done(function(data){
				$("#resp").text(data);
				getChat();
			})

		}
	})

	//get chat
	getChat();
	//end chat
})

function getChat(){
	var user = $("#user").val();
	$.ajax({
		url : "../getadminchat.php",
		method : "POST",
		data : {user:user}
	}).done(function(data){
		$("#user2").html("<p><b>Admin:</b>"+data+"</p>");
	})
}