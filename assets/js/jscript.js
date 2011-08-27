// JavaScript Document
//Constants
var url = "http://localhost/pheedbak/";
TopUp.host = url;
TopUp.images_path = "assets/img/top_up/";
var loading_src = "http://localhost/pheedbak/assets/img/loading.gif";

//Asynchronous fuctions
function user_keywords() {
	var u = url+"keywords/user_keywords";
	$.getJSON(u,function(data) {
		$.each(data,function(index,item) {
				$('#user_keywords').append(
			'<div class="word">'+
			'<a href="#">'+item.keywords+'</a>'+
			'<span class="delete_item">'+
			'<img id="'+item.keywords+'" src=\"http://localhost/pheedbak/assets/img/cross.png\" onclick="delete_keyword(this.id)" />'+
			'</span>'+
			'</div>'
			);
		});
	});
}
function latest_pheeds() {
	var action = url+"pheeds/latest_pheeds";
	$('#pheed-stream').html('<div class="loading"></div>');
	$('.loading').append("Loading Pheeds........");
	$.getJSON(action,function(data) {
		$('.loading').fadeOut('slow');
		$.each(data,function(index,item) {
			$('#pheed-stream').append
			(
			'<div class="pheed" id="'+item.pheed_id+'">'+
			'<p><a href="'+url+'conversations/start/'+item.user_id+'">'+item.user_id+'</a></p>'+
			'<p>'+item.pheed+'</p>'+
			'<div class="pheed_meta">'+
			'<span>'+item.datetime+' Ago</span>'+
			'<span class="cm">'+item.comments+
			'<img class="comment_trigger" src="/pheedbak/assets/img/comment.png" title="Click to comment on pheed" onclick="retrieve_comments('+item.pheed_id+')">'+
			'</span>'+
			'<span>'+item.repheeds+
			' Repheeds'+
			'<img class="repheed_trigger" src="/pheedbak/assets/img/communication.png" title="Click to repheed" onclick="repheed('+item.pheed_id+')">'+
			'</span>'+
			'</div>'+
			'</div>'
			);
		});
	});
}
//Keyword functions
function delete_keyword(id) {
	var action_url = url+"keywords/remove_keyword";
	var keyword = id;
	var crsf =  $('input[name=ci_csrf_token]').val();
	var dataString = "keyword="+keyword+"&ci_csrf_token="+crsf;
	$.ajax({
		url:action_url,
		type:'POST',
		cache:false,
		data:dataString,
		success:function(data) {
			$('#user_keywords').html('');
			user_keywords();
		}
	});
}
//Pheed functions
function repheed(pheed_id) {
	var action = url+'pheeds/repheed';
	var csrf =  $('input[name=ci_csrf_token]').val();
	var dataString = "pheed_id="+pheed_id+"&ci_csrf_token="+csrf;
	$.ajax({
		url:action,
		cache:false,
		type:'POST',
		data:dataString,
		dataType:'json',
		error:function () {
			alert("Error in repheed pheed");
		},
		success:function(data) {
			$.each(data,function(index,item) {
				$("#" + pheed_id +' span:nth-child(3)').append(
				item.repheeds+ 'Repheeds'+
				'<img class="repheed_trigger" src="/pheedbak/assets/img/communication.png" title="Click to repheed" onclick="repheed('+item.pheed_id+')">'
				);
			});
		}
	});
}
//Pheed Commenting fucntions
function retrieve_comments(pheed_id) {
	if($("#" + pheed_id +' .pheed_comments').length == 0 ) {
	var action = url+'comments/get_comments';
	var crsf =  $('input[name=ci_csrf_token]').val();
	var dataString = "pheed_id="+pheed_id+"&ci_csrf_token="+crsf;
	$.ajax({
		url:action,
		type:'POST',
		cache:false,
		dataType:'json',
		data:dataString,
		success:function(data) {
			$.each(data,function(index,item) {
				$("#" + pheed_id).append(
				'<div class="'+pheed_id+' pheed_comments" id="'+pheed_id+'">'+
					'<div class="comment">'
					+'<span><p>'+item.user+'</p></span>'
					 +item.comment+
					'</div>'+
				'</div>'
				);
			});
			$('#' + pheed_id).append(
				'<div id="comment_box" class="'+pheed_id+'">'+
					'<textarea id="comment" cols="30">'+
					'</textarea><br>'+
					'<div id="loading"></div>'+
					'<input type="button" class="submit_btn" value="comment" onclick="post_comment('+pheed_id+')" />'+
				'</div>'
			);
		}
	});
	}
}
function post_comment(pheed_id) {
	$('.' + pheed_id +' #loading').append('<img src ="'+loading_src+'" />');
	var crsf =  $('input[name=ci_csrf_token]').val();
	var action = url+'comments/post_comment';
	var comment = $("#comment").val();
	var datastring = "pheed_id="+pheed_id+"&comment="+comment+"&ci_csrf_token="+crsf;
	
	$.ajax({
		url:action,
		type:'POST',
		cache:false,
		data:datastring,
		dataType:'json',
		success:function(data) {
			$('.' + pheed_id +' #loading').fadeOut('slow').html('');
			var comment_count = $("#" + pheed_id).children('.pheed_comments').children('comment').length
			$("#" + pheed_id).children('.pheed_comments').remove();
			$("#" + pheed_id).children('#comment_box').remove();
					retrieve_comments(pheed_id);
		}
	});
}
//Conversation functions
function post_conversation_msg() {
	var action = url+"conversations/post_message";
	var crsf =  $('input[name=ci_csrf_token]').val();
	var conv_id = $('input[name=conv_id]').val();
	var r_id = $('input[name=r_id]').val();
	var msg = $('textarea[name=message]').val();
	var dataString = "conv_id="+conv_id+"&message="+msg+"&reciever="+r_id+"&ci_csrf_token="+crsf;
	
	$.ajax({
		url:action,
		type:'POST',
		cache:false,
		data:dataString,
		error:function() {
				$.growl("An error occured in sending your message please try again later.");
			},
		success:function() {
			$.growl("Sent");
				$('#conversation-timeline').append(
				'<div class="message">'+
				 '<span>'+msg+'</span>'+
				'</div>'
				);
				$('textarea[name=message]').val() = "";
			}
	});
}
//Help ad support fucnctions
function load_page(page) {
	var action = url+"help/"+page;
	$('#topic-content').html('');
	$('#topic-content').fadeIn('slow').load(action);
}
$(document).ready(function() {
	var href = url+"users";
	var keywords_url = url+"keywords";
	if(document.location.href == href) {
	latest_pheeds();
	}
	if(document.location.href == keywords_url) {
	user_keywords();
	}
	
	//Pheed Posting
	$(function () {
		$("#pheedform input[type=submit]").click(function(e) {
			
			$('#status').append("<img src=\""+loading_src+"\" />");
			var pheed = $('#pheed').val();
			var crsf = $('input[name=ci_csrf_token]').val();
			var action_url = url+"pheeds/add";
			var dataString = "pheed="+pheed+"&ci_csrf_token="+crsf;
			
			$.ajax({
				url:action_url,
				type:'POST',
				data:dataString,
				cache:false,
				success:function(html) {
					$('#status').html('');
					$('#status').append(html).fadeOut('slow',function() {
							$('#pheed-stream').prepend(
							"<div class=\"pheed\">"+
							"<p>"+pheed+"</p>"+
							"<div class=\"pheed_meta\">"+
							"<span>Posted Just now </span>"+
							"</div>"+
							"</div>"
							);
						});
					$('#pheedform')[0].reset();
				}
			});
			e.preventDefault();
		});
	});
	//New keyword
	$(function() {
		$('#newKeyword input[type=submit]').click(function(e) {
			
			$('#progress').append("<img src=\""+loading_src+"\" />");
			var word = $('input[name=keyword]').val();
			var u = url+'keywords/new_keyword';
			var crsf = $('input[name=ci_csrf_token]').val();
			var dataString = "keyword="+word+"&ci_csrf_token="+crsf;
			$.ajax({
				url:u,
				type:'POST',
				cache:false,
				data:dataString,
				success:function(html) {
						$('#progress').fadeOut('slow').html('');
						$('#user_keywords').prepend(
						'<div class="word">'+
			'<a href="#">'+word+'</a>'+
			'<span class="delete_item">'+
			'<img id="'+word+'" src=\"http://localhost/pheedbak/assets/img/cross.png\" onclick="delete_keyword(this.id)" />'+
			'</span>'+
			'</div>'
						);
						$('#newKeyword')[0].reset();
						TopUp.overlayClose();
				}
			});
			e.preventDefault();
		});
	});
	$(function() {
		$('#feedbackform input[type=submit]').click(function(e) {
			$(this).slideUp('slow');
			$('.progress').append("<img src=\""+loading_src+"\" />");
			
			var ur = url+'feedback/send_feedback';
			var crsf = $('input[name=ci_csrf_token]').val();
			var email =  $('input[name=email').val();
			var comment = $('textarea[name=comment]').val();
			var datastring = "email="+email+"&comment="+comment+"&ci_csrf_token="+crsf;
			$.ajax({
				url:ur,
				type:'POST',
				cache:false,
				data:datastring,
				success:function(html) {
					$('.progess').fadeOut('slow').html('');
					$('#feedbackform').slideUp('slow',function() {
							$('#feedback-form').append(html);
						});
				}
			});
			e.preventDefault();
		});
	});
	
});
