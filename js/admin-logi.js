		var validationTimer;
		var editable = function(object, options)
		{
			var td = object.parent('td');
			var text = $('<input/>').attr({'type':'text','name':options.name,'value':options.value});
			var hidden = $('<input/>').prop({'type':'hidden','name':'Equipment_ID','value':options.id});
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
					var hidden = $('<input/>').prop({'type':'hidden','name':'Equipment_ID','value':options.id});
					 form.append(hidden); td.prepend(form); form.children('select').focus();
				}
			);
		}
		
		var equiStat = function(object, options)
		{
			var td = object.parent('td'); 
			var sel = $('<select name="Equipment_Status"><option>Brand New</option><option>Good</option><option>Defective</option></select>');
			var form = $('<form>')
				.append(sel)
				.append( $('<input/>').prop({ 'type':'hidden', 'value':options.id, 'name':'Equipment_ID'}) );
			object.parent('td').append( form.prop({'id':'stat'}) );
			object.remove();
		}
		var clickEvent = function(event){
			$this = $(this);
			// console.log( $(document).data('processing') );
			if($(document).data('processing')){ return false; }
			$(document).data('processing',true);
			if( $this.parent('td').hasClass('manu'))
			{
				selectable($this,{id:$this.parents('tr').prop('id'), name:$this.parent('td').attr('var'), statusid:$this.parent('td').attr('val'),url: 'ajax.manufacturer.php' });
			}
			else if( $this.parent('td').hasClass('equistat') )
			{
				equiStat($this, {id:$this.parents('tr').prop('id')} );
			}
			else
			{
				editable($this,{id:$this.parents('tr').prop('id'), name:$this.parent('td').attr('var'), value:$this.text()});
			}
			$(document).data('processing',false);
			// event.stopPropagation();
			//$(document).off('click');
		}