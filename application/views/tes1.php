<?php $this->load->view("general/header");?>
<script>
$(function(){
	var guid = 1;
	var uid = 3;
	var topicid = 1;
	socket.emit('joinroom',guid,uid);
	socket.on('error',function(data){
		alert(data);
	});
	socket.on('new_user_join',function(user_id){
		alert(user_id);
	});
	$(".startgame").click(function(){
		socket.emit('startgame',guid,topicid);
	});
	$(".cancelroom").click(function(){
		socket.emit('cancelroom',guid);
	});
	$(".leaveroom").click(function(){
		socket.emit('leaveroom',guid,uid);
	});
	socket.on('room_leave',function(user_id){
		alert(user_id + " leave");
	});
	socket.on('room_cancel',function(){
		alert("host room canceled");
	});
	socket.on('game_start',function(){
		alert("game started");
	});
	
	
	// ready to play
	$(".readytoplay").click(function(){
		socket.emit('readytoplay',guid,uid);
	});
	socket.on('question',function(question){
		alert(question);
	});
});
</script>
<input type="button" class="startgame" value="start">
<input type="button" class="cancelroom" value="cancel">
<input type="button" class="leaveroom" value="leave">
<input type="button" class="readytoplay" value="ready to play">
<?php $this->load->view("general/footer");?>