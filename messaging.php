<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Instant Messaging</title>
		<style>
			div#body{
				margin:50px 50px;
				color:#333;
			}
			div#body section#recent{
				float:left;
				width:30%;
				background-color:#fff;
				border-top:1px;
				margin:10px;
				height:inherit;
				overflow:auto;
			}
			.hidden{
				display:none;
			}
			div#body section#recent .contact{
				border:1px solid #000;
				padding:20px;
				cursor:pointer;
			}
			div#body section#recent .current{
				background-color:#627bae;
				color:#fff;
			}
			div#body section#recent .unread{
				background-color:#ebeef4;
				color:#333;
			}
			div#body section#recent .contact span.name{
				display:block;
			}
			div#body section#thread{
				margin-left:5px;
				float:right;
				text-align:left;
				width:65%;
				overflow:auto;
				height:inherit;
				border:1px solid #000;
			}
			div#body section#thread div#message{
				padding:1px 20px 3px;
			}
			div#body section#thread div#message p span{
				font-size:9px;
			}
			p.centered{
				margin:auto;
				text-align:center;
				v-align:middle;
				height:inherit;
				vertical-align:middle;
			}
			.dim{
				background-color:#CCC;
				width:inherit;
				height:inherit;
			}
			img.loader{
				/*position:absolute;*/
				z-index:9999;
			}
			div#loading-message{
				clear:both;
				text-align:center;
				margin-bottom:20px;
				display:none;
				font-size:20px;
				font-weight:bolder;
			}
		</style>
		<script src="js/jquery-1.9.0.js"></script>
		<script>
			$(function(){
				// console.log(window.innerHeight/2);
				$('div#body').css({'height':window.innerHeight/2});
				
				$.ajax(
					{
						url:'msg.clients.list.php',
						type:'post',
						dataType:'json',
						success:function( json){
							$.each(json, function(id, val){
								var div = $('div.hidden').first().clone();
								div.attr('var',id)
								.children('span.name')
								.text(val);
								$('section#recent').append(div.removeClass('hidden'));
							});
							window.setTimeout(findNew, 1000);
						}
					}
				);
				$(document).ajaxStart(start).ajaxStop(stop);
			});
			
			var findNew = function(){
				$.ajax({
					'url':'msg.new.php',
					'type':'get',
					'dataType':'json',
					'success':function(response){
						$.each(response, function(clientid,val){
							$('div#body section#recent .contact:not(.unread):not(.hidden)').each(function(i,element){
								// console.log( $(element).attr('var') );
								if( $(element).attr('var') == clientid){
									var clone = $(element).clone();
									$(element).remove();
									clone = clone.addClass('unread');
									$('div#body section#recent').prepend(clone);
								}
							});
						});
					}
				});
				window.setTimeout(findNew, 10000);
			}
			
			var start = function(param1){
				$('div#loading-message').show('slow');
				// console.log(param1);
				// $('div#body section#thread').addClass('dim');
				// $('div#body section#thread').empty();
				// $('div#body section#thread').prepend($('<img src="ajax/ajax-loader.gif" align="center" />').addClass('loader'));
			}
			var stop = function(param1){
				$('div#loading-message').hide('slow');
				// console.log(param1);
				// $('div#body section#thread').removeClass('dim');
				// $('img','div#body section#thread').remove();
			}
			$(document)
			.on('click',
			'div#body section#recent .contact',
			function(event){
				$this = $(this);
				$this.siblings().removeClass('current');
				$this.addClass('current');
				// $this.children('.last_message').text('Selected');
				$.get(
					'msg.client.php',
					{id:$this.attr('var')},
					function(response){
						$('div#body section#thread')
						.html(response);
					}
				);
				if( $this.hasClass('unread') ){
					$this.removeClass('unread');
				}
			});
		</script>
	</head>
	<body>
		<div id="body">
			<section id="recent">
				<div class="contact hidden" var="1">
					<span class="name">Name1</span>
					<!--<span class="last_message">Message1</span>-->
				</div>
			</section>
			<section id="thread">
				 
			</section>
			<div id="loading-message">Loading...</div>
		</div>
	</body>
</html>