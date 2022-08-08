$(function(){
	$("#send_sms").keydown(function(e){
		if(e.keyCode == 13){
			var chat = $(this).val();
			var user = $("#user").val();
			$.ajax({
				url : "chat.php",
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
	$.ajax({
		url : "getchat.php",
		method : "POST"
	}).done(function(data){
		$("#user1").html("<p>"+data+"</p>");
	})
}