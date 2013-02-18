
		$(function() {
		$( "#tabs" ).tabs();
		});
		
		// $(document).data('processing',false);
		var validationTimer;
		var editable = function(object, options)
		{
			var td = object.parent('td');
			var text = $('<input/>').attr({'type':'text','name':options.name,'value':options.value});
			var hidden = $('<input/>').prop({'type':'hidden','name':'id','value':options.id});
			var form = $('<form></form>').prop({'id':'jap'}).prepend( text ).append( hidden );
			object.remove(); td.prepend(form); form.children('input[type=text]').focus();
			// $(document).on('click','table#jquery tbody td span',clickEvent);
		}
		
		var selectable = function(object, options)
		{
			// console.log(options);
			var td = object.parent('td'); object.remove();
			var form;
			$.get(options.url,
				{id:options.statusid},
				function(html){
					form = $('<form>').prop({'id':'stat'}).html(html);
					var hidden = $('<input/>').prop({'type':'hidden','name':'id','value':options.id});
					 form.append(hidden); td.prepend(form); form.children('select').focus();
				}
			);
			// $(document).on('click','table#jquery tbody td span',clickEvent);
			// var form = $('<form>').prop({'id':'stat'}).load(options.url+'?id='+options.statusid);
			// var hidden = $('<input/>').prop({'type':'hidden','name':'id','value':options.id});
			// form.append(hidden);
			// object.remove(); td.prepend(form); form.children('select').focus();
		}
		
		var genderOptions = function(object, options)
		{
			var td = object.parent('td'); 
			var sel = $('<select name="gender">')
				.append('<option>M</option>')
				.append('<option>F</option>');
			var form = $('<form>')
				.append(sel)
				.append( $('<input/>').prop({ 'type':'hidden', 'value':options.id, 'name':'id'}) );
			object.parent('td').append( form.prop({'id':'stat'}) );
			object.remove();
		}
		
		var clickEvent = function(event){
			$this = $(this);
			// console.log( $(document).data('processing') );
			if($(document).data('processing')){ return false; }
			$(document).data('processing',true);
			if( $this.parent('td').hasClass('educ'))
			{
				selectable($this,{id:$this.parents('tr').prop('id'), name:$this.parent('td').attr('var'), statusid:$this.parent('td').attr('val'),url: 'ajax.educ.status.php' });
			}
			else if( $this.parent('td').hasClass('civil') )
			{
				selectable($this,{id:$this.parents('tr').prop('id'), name:$this.parent('td').attr('var'), statusid:$this.parent('td').attr('val'),url: 'ajax.civil.status.php' });
			}
			else if( $this.parent('td').attr('var').trim() == 'gender' )
			{
				genderOptions($this, {id:$this.parents('tr').prop('id')} );
			}
			else if( $this.parent('td').attr('var').trim() == 'guard_status' )
			{
				selectable($this,{id:$this.parents('tr').prop('id'), name:$this.parent('td').attr('var'), statusid:$this.parent('td').attr('val'),url: 'ajax.hirestatus.php' });
			}
			else
			{
				editable($this,{id:$this.parents('tr').prop('id'), name:$this.parent('td').attr('var'), value:$this.text()});
			}
			$(document).data('processing',false);
			// event.stopPropagation();
			//$(document).off('click');
		}
		
		
		$(function(){
			$('button#addnew')
			.click(function(event){
				$div = $('<div>')
				.attr('id','newguard');
				$.get('form.newguard.php',{},function(data){
				// console.log(data);
				if(data.length>0){
					$div.html(data).dialog({
						'title':'Add New Guard',
						'buttons':{
							'OK':function(e){
								$('div#newguard form').trigger('submit');
								// $(this).dialog('close');
							}
						},
						close: function(ev, ui) { $(this).remove(); },
						width: '500px'
					});
					$('input.datepicker',$div).datepicker({ dateFormat: "yy-mm-dd",defaultDate: $this.val(),changeYear: true ,changeMonth: true });
				}
				});
			});
		});
		$(document).on('submit','div#newguard form',
			function(event){
				var $form = $(this);
				$.post('newguard.php',
				$form.serialize(),
				function(result){
					result = $.parseJSON(result);
					if(result.status == 'success'){
						alert(result.message);
						$form.parent('div#newguard').remove();
						$('.ui-datepicker').remove();
						window.location.href = 'admin.guards.php';
					}else{
						alert(result.message);
					}
				});
				return false;
			}
		);
		
		$(document).on('focus','table#jquery tbody td.date input[type=text]',
			function(event){
			// event.stopPropagation();
			$this = $(this);
			$this.datepicker({ dateFormat: "yy-mm-dd",defaultDate: $this.val(),changeYear: true ,changeMonth: true , onClose : function(){ $('.ui-datepicker').remove(); } });
			// $(this).trigger('blur').trigger('click');
		});
		$(document).on('click','table#jquery tbody td span',clickEvent);
		$(document).on('blur','body',
			function(event){
			// console.log(event);
			//form#jap input[type=text],form#stat select
			// console.log( event.target );
			$this = $( event.target );
			// console.log( $('form#jap input[type=text],form#stat select').eq($this) );
			validationTimer = setTimeout(function(){
				validationTimer = null;
				if( $('.ui-datepicker').length == 0 )
				{
					// console.log($('form#jap input[type=text]').length + $('form#stat select').length);
					if( ($('form#jap input[type=text]').length + $('form#stat select').length) > 0 ){
						var cont = confirm('Are you sure you want to continue these changes?');
						if(!cont){
							return false;
						}
						// Perform Validation on 'blurred'.
						$.post('ajax.guard.save.php', 
						{
						'value' : $this.val(),
						'name' : $this.prop('name'),
						'id' : $this.siblings('input[type=hidden]').val()
						},
						function(data){
							data = $.parseJSON(data);
							// alert(data.status);
							if(data.status=='success'){
								var span;
								if( $('form#stat select').length > 0 ){
									// console.log('SELECT');
									span = $('<span></span>').text( $('option:selected',$this).text() );
								}else{
									// console.log('TEXT');
									span = $('<span></span>').text( $this.val() );
								}
								$this.parents('td').first().prepend(span);
								$this.parent('form').remove();
							}
						});
					}
				}
			},200);
			// validationTimer();
		});
		$(document).on('click','.ui-datepicker-calendar',
			function(event){
			if(validationTimer){
				window.clearTimeout(validationTimer);
				validationTimer = null;
			}
		});
		
		$(function(){
			$('table#jquery td input[type=checkbox]').change(function(ev){
				$this = $(this);
				// console.log(ev);
				$.post(
					'ajax.req.save.php',
					{
						id : $this.parents('tr').first().attr('id'),
						val : $this.val(),
						name : $this.attr('name')
					},
					function(data){
						data = $.parseJSON(data);
						if(data.status=='success'){
							// console.log('pass');
							$this.val( Math.abs( $this.val() -1 ) );
							$.get('ajax.get.reqstat.php',
							{id:$this.parents('tr').first().attr('id')},
							function(success){
								success = $.parseJSON(success);
								if(success.status == 'success'){
									$this.parents('tr').first().children('td.req_status').text(success.message);
								}
							});
						}else{
							console.log('error : '+data.message);
						}
					}
				);
				return false;
			})
		});