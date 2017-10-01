<?php 

$temp_dir = get_bloginfo('template_directory');


?>

<script>

jQuery(document).ready(function()
{
	//console.log(tinymce);
	
	jQuery('body').on('click','.module__add__button,.element__add__button',function(e){
		
		e.preventDefault();
		
		$link = jQuery(this);
		$type = "module";
		$select_id = $link.attr('data-select');
		$name = jQuery($select_id).val();
		$append_to = $link.attr('data-append-to');

		
		$variable_name = $link.attr('data-variable-name');
		
		
		if(jQuery(this).hasClass('element__add__button')){
			
			$type = "element";
		}
		
		$count = $link.attr('data-count');
		$file = "<?php echo $temp_dir; ?>/config/"+$type+".php";
		
		
		jQuery.post($file, {
			ajax: true,
			type: "_"+$type,
			name: $name,
			count:$count, 
			variable_name:$variable_name, 
			count:$count, 
			post_id:<?php echo isset($_GET['post']) ? $_GET['post'] : 0; ?>
		}, 
		function(data, status){
			if(status == "success"){
	
				jQuery($append_to).append(data);
	
				$variable_name = $variable_name.replace('['+$type+'_'+parseInt($count)+']','['+$type+'_'+(parseInt($count)+1)+']');
				
				$link.attr('data-count',parseInt($count) + 1);
				$link.attr('data-variable-name',$variable_name);
				
				reinit_tinymce();
			}
		});
		
	});
	
	
	jQuery('body').on('click','.item__add__button',function(e){
		
		e.preventDefault();
		
		$link = jQuery(this);
		$count = $link.attr('data-count');
		
		
		
		$placeholder = $link.parent().find('.item_new');
		$new = $placeholder.clone();
		
		$new.removeClass('item_new');
		
		$placeholder.before($new);
		
		$placeholder.find('[name]').each(function(index){
			
			name = jQuery(this).attr('name');
			name = name.replace('item_'+parseInt($count), 'item_'+(parseInt($count) + 1));
	
			jQuery(this).attr('name', name);
		});
		
		$placeholder.find('[id]').each(function(index){
			
			id = jQuery(this).attr('id');
			id = id.replace('item_'+parseInt($count), 'item_'+(parseInt($count) + 1));
			jQuery(this).attr('id', id);
		});
		
		
		$link.attr('data-count',parseInt($count) + 1);
		
		
	});
	
	
	jQuery('body').on('click','.module_delete, .field_delete',function(e){
		
		e.preventDefault();

		if(confirm("Are you sure you want to delete this module/element?"))
			jQuery(this).parent().remove();
	});
	
	jQuery('body').on('click','.module_up, .field_up',function(e){
		
		e.preventDefault();
		
		
		$parent = jQuery(this).parent();
		$before = jQuery(this).parent().prev();
		
		$parent.find('.wp-editor-area').each(function () {
			tinymce.execCommand('mceRemoveEditor', false, jQuery(this).attr('id'));
		});
		
		$parent.insertBefore($before);
		
		reinit_tinymce();
	});
		
	jQuery('body').on('click','.module_down, .field_down',function(e){
		
		e.preventDefault();
		
		$parent = jQuery(this).parent();
		$after= jQuery(this).parent().next();

		$parent.find('.wp-editor-area').each(function () {
			tinymce.execCommand('mceRemoveEditor', false, jQuery(this).attr('id'));
		});
		
		$parent.insertAfter($after);
		
		reinit_tinymce();
	});
	
	jQuery('body').on('click','.module_minify',function(e){
		
		e.preventDefault();
		
		$parent = jQuery(this).parent();
		
		$parent.find('.wp__open__save').val("");
		
		$parent.addClass('minified');
	});
		
	jQuery('body').on('click','.module_expand',function(e){
		
		e.preventDefault();
		
		$parent = jQuery(this).parent();
		
		
		$parent.find('.wp__open__save').val('true');
		
		$parent.removeClass('minified');
	});
	
	jQuery('body').on('change','.module_status',function(e){
		
		e.preventDefault();
		
		$parent = jQuery(this).parent();
		$select = jQuery(this);
		
		if($select.val() == "draft")
			$parent.addClass('draft');
		else
			$parent.removeClass('draft');
	});
	
	/* Media button */
	jQuery('body').on('click','.button--media', function(e)
	{
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = 	jQuery(this);
		var type = button.attr('data-type');
		
		wp.media.editor.send.attachment = function(props, attachment)
		{
			if(attachment.type == "video" && type == "video")
			{
				button.closest(".selectmedia").find(".preview").html('<video autoplay loop><source src="' + attachment.url + '" type="' + attachment.mime + '"></video><br />' + attachment.filesizeHumanReadable);
			}
			else if(attachment.type == "image" && type == "image")
			{
				button.closest(".selectmedia").find(".preview").html('<img src="' + attachment.url + '" /><br />' + attachment.filesizeHumanReadable);
			}
			else if(attachment.subtype == "pdf" && type == "pdf")
			{
				button.closest(".selectmedia").find(".preview").html('<p>' + attachment.filename + ' (' + attachment.filesizeHumanReadable + ')</p>');
			}
			else
			{
				return false;
			}
			
			if(!button.next().hasClass("button--clear"))
			{
				button.after(' <span class="button--clear button">Remove</span>');
			}

			button.closest(".selectmedia").find("input[type=hidden]").val(attachment.id);
			
			return true;
		}
	
		wp.media.editor.open(button);
		return false;
	});
	
	jQuery('body').on('click','.button--clear', function(e)
	{
		var button = jQuery(this);
		
		button.closest(".selectmedia").find("input[type=hidden]").val('');
		button.closest(".selectmedia").find(".preview").html('');
		button.remove();

		return false;
	});
	
	// inline text area
	tinymce.init({
		selector: 'p.editable',
		inline: true,
		toolbar: 'bold italic redo undo',
		menubar: false
	});

	function reinit_tinymce()
	{
		settings = tinymce.EditorManager.editors[0].settings;
		settings.id = "";
		settings.selector = '.wp-editor-area';
		tinymce.init(settings);

		// inline text area
		tinymce.init({
			selector: 'p.editable',
			inline: true,
			toolbar: 'bold italic redo undo',
			menubar: false
		});
	}
});
</script>

