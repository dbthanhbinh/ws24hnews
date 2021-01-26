function builderHeader (boxTitle, nextCell) {
	var html = '';
	html += '<li id="listItem_'+ nextCell +'" class="ui-state-default">';
		html += '<div class="widget-head">' + boxTitle + '<a style="display:none" class="toggle-open">+</a>';
		html += '<a style="display:block" class="toggle-close">-</a>';
		html += '</div>';
		html += '<div style="display:block" class="widget-content">';
		html += '<label for="tie_home_cats['+ nextCell +'][title]">';
		html += '<span>' + boxTitle + ':</span>';
		html += '<input id="tie_home_cats['+ nextCell +'][title]"';
		html += 'name="tie_home_cats['+ nextCell +'][title]"';
		html += 'value="' + boxTitle + '"';
		html += 'type="text" /></label>';
		html += '<label for="tie_home_cats['+ nextCell +'][show_title]">';
		html += '<span>Show Box Title :</span>';
		html += '<select id="tie_home_cats['+ nextCell +'][show_title]" name="tie_home_cats['+ nextCell +'][show_title]">';
		html += '<option value="y" selected="selected">Show</option>';
		html += '<option value="n">Hidden</option>';
		html += '</select>';
		html += '</label>';
		html += '<label for="tie_home_cats['+ nextCell +'][description]">';
		html += '<span>Box description :</span>';
		html += '<textarea style="direction:ltr; text-align:left"';
		html += 'id="tie_home_cats['+ nextCell +'][description]"';
		html += 'name="tie_home_cats['+ nextCell +'][description]"';
		html += 'type="textarea" cols="100%" rows="3" tabindex="4"></textarea>';
		html += '</label>';
		html += '<label for="tie_home_cats['+ nextCell +'][show_description]">';
		html += '<span>Show Box description :</span>';
		html += '<select id="tie_home_cats['+ nextCell +'][show_description]" name="tie_home_cats['+ nextCell +'][show_description]">';
		html += '<option value="y" selected="selected">Show</option>';
		html += '<option value="n">Hidden</option>';
		html += '</select>';
		html += '</label>';

	return html;
}

function builderHeaderGroupTemplate(boxTitle, nextCell) {
	var html = '';
		html += '<li id="listItem_'+ nextCell +'" class="ui-state-default">';
		html += '<div class="widget-head">' + boxTitle;
		html += '<a class="toggle-open">+</a>';
		html += '<a class="toggle-close">-</a>';
		html += '</div>';
		html += '<div class="widget-content">';
		html += '<label for="tie_home_cats['+ nextCell +'][show_box]">';
		html += '<span>Show/Hiden Box :</span>';
		html += '<select id="tie_home_cats['+ nextCell +'][show_box]" name="tie_home_cats['+ nextCell +'][show_box]">';
		html += '<option value="y" selected="selected">Show</option>';
		html += '<option value="n">Hidden</option>';
		html += '</select>';
		html += '</label>';
	
		html += '<label for="tie_home_cats['+ nextCell +'][title]">';
		html += '<span>Box Title :</span>';
		html += '<input id="tie_home_cats['+ nextCell +'][title]"';
		html += 'name="tie_home_cats['+ nextCell +'][title]"';
		html += 'value="'+boxTitle+'"';
		html += 'type="text"';
		html += '/>';
		html += '</label>';
		html += '<label for="tie_home_cats['+ nextCell +'][subtitle]">';
		html += '<span>Box subtitle :</span>';
		html += '<input id="tie_home_cats['+ nextCell +'][subtitle]"';
		html += 'name="tie_home_cats['+ nextCell +'][subtitle]"';
		html += 'value="'+boxTitle+'"';
		html += 'type="text"';
		html += '/>';
		html += '</label>';
		html += '<label for="tie_home_cats['+ nextCell +'][show_title]">';
		html += '<span>Show Box Title :</span>';
		html += '<select id="tie_home_cats['+ nextCell +'][show_title]" name="tie_home_cats['+ nextCell +'][show_title]">';
		html += '<option value="y" selected="selected">Show</option>';
		html += '<option value="n">Hidden</option>';
		html += '</select>';
		html += '</label>';
		html += '<label for="tie_home_cats['+ nextCell +'][description]">';
		html += '<span>Box description :</span>';
		html += '<textarea style="direction:ltr; text-align:left"';
		html += 'id="tie_home_cats['+ nextCell +'][description]"';
		html += 'name="tie_home_cats['+ nextCell +'][description]"';
		html += 'type="textarea" cols="100%" rows="3" tabindex="4"></textarea>';
		html += '</label>';
		html += '<label for="tie_home_cats['+ nextCell +'][show_description]">';
		html += '<span>Show Box description :</span>';
		html += '<select id="tie_home_cats['+ nextCell +'][show_description]" name="tie_home_cats['+ nextCell +'][show_description]">';
		html += '<option value="y" selected="selected">Show</option>';
		html += '<option value="n">Hidden</option>';
		html += '</select>';
		html += '</label>';

	return html;
}

function builderFooter (nextCell, type = 'recent') {
	var boxid = 1 + Math.floor(Math.random() * 1500);
	var html = '';
		html += '<input id="tie_home_cats['+ nextCell +'][boxid]"';
		html += 'name="tie_home_cats['+ nextCell +'][boxid]"';
		html += 'value="'+ type + '_'+ boxid +'" type="hidden" />';
		html += '<input id="tie_home_cats['+ nextCell +'][type]"';
		html += 'name="tie_home_cats['+ nextCell +'][type]"';
		html += 'value="'+type+'" type="hidden" />';
		html += '<a class="del-cat"></a>';
		html += '</div>';
	html += '</li>';

	return html;
}

function builderFooterGroupTemplate (nextCell) {
	var boxid = 1 + Math.floor(Math.random() * 1500);
	var html = '';
	html += '<label for="tie_home_cats['+ nextCell +'][order]">';
	html += '<span>Position order :</span>';
	html += '<input style="width:50px;" id="tie_home_cats['+ nextCell +'][order]" name="tie_home_cats['+ nextCell +'][order]" value="1" type="text" />';
	html += '</label>';

	html += '<input id="tie_home_cats['+ nextCell +'][boxid]" name="tie_home_cats['+ nextCell +'][boxid]" value="group_'+ boxid +'" type="hidden" />';
	html += '<input id="tie_home_cats['+ nextCell +'][type]" name="tie_home_cats['+ nextCell +'][type]" value="group-template" type="hidden" />';
	html += '<a class="del-cat"></a>';
    html += '</div>';
	html += '</li>';
	return html;
}

function builderRecentPost (boxTitle, nextCell, content) {	
	var html = '';
	html += builderHeader (boxTitle, nextCell);

	html += '<label>';
	html += '<span style="float:left;">Exclude This Categories : </span>';
	html += '<select multiple="multiple" name="tie_home_cats['+ nextCell +'][exclude][]" id="tie_home_cats['+ nextCell +'][exclude][]">';
	html += content;
	html += '</select>';
	html += '</label>';
	
	html += '<label for="tie_home_cats['+ nextCell +'][display]"><span>Display Mode:</span>';
	html += '<select class="display_mode_choosing_js" data-id="'+nextCell+'" id="tie_home_cats['+ nextCell +'][display]" name="tie_home_cats['+ nextCell +'][display]">';
	html += '<option value="grid" selected="selected">As Grid</option>';
	html += '<option value="list">As list</option>';
	html += '</select>';
	html += '</label>';

	html += '<label id="display_mode_choosing_show_cols_'+nextCell+'" class="display_mode_choosing_show active" for="tie_home_cats['+ nextCell +'][grid_cols]"><span>Show cols:</span>';
	html += '<select id="tie_home_cats['+ nextCell +'][grid_cols]" name="tie_home_cats['+ nextCell +'][grid_cols]">';
	html += '<option value="4" selected="selected">4 cols</option>';
	html += '<option value="3">3 cols</option>';
	html += '<option value="6">6 cols</option>';
	html += '</select>';
	html += '</label>';

	html += '<label for="tie_home_cats['+ nextCell +'][number]">';
	html += '<span>Number of posts to show :</span>';
	html += '<input style="width:50px;" id="tie_home_cats['+ nextCell +'][number]" name="tie_home_cats['+ nextCell +'][number]" value="8" type="text" />';
	html += '</label>';
	
	html += '<p id="display_mode_choosing_show_message_'+nextCell+'" class="tie_message_hint display_mode_choosing_show active">If you are choosing <i>Display Mode</i> as <strong>Grid</strong>, Please input <strong>Number of posts to show</strong> divisible by [3,4,6] </p>';
	
	html += builderFooter (nextCell);
	return html;
}

// For categories tab box
function builderCategoriesTabBox (boxTitle, nextCell) {	
	var html = '';
	html += builderHeader (boxTitle, nextCell);

	html += builderFooter (nextCell, 'categories');
	return html;
}

// For video list
function builderVideoList (boxTitle, nextCell) {	
	var html = '';
	html += builderHeader (boxTitle, nextCell);
	
	html += '<label for="tie_home_cats['+ nextCell +'][display]"><span>Display Mode:</span>';
	html += '<select class="display_mode_choosing_js" data-id="'+nextCell+'" id="tie_home_cats['+ nextCell +'][display]" name="tie_home_cats['+ nextCell +'][display]">';
	html += '<option value="grid" selected="selected">As Grid</option>';
	html += '<option value="list">As list</option>';
	html += '</select>';
	html += '</label>';

	html += '<label id="display_mode_choosing_show_cols_'+nextCell+'" class="display_mode_choosing_show active" for="tie_home_cats['+ nextCell +'][grid_cols]"><span>Show cols:</span>';
	html += '<select id="tie_home_cats['+ nextCell +'][grid_cols]" name="tie_home_cats['+ nextCell +'][grid_cols]">';
	html += '<option value="4">4 cols</option>';
	html += '<option value="3" selected="selected">3 cols</option>';
	html += '<option value="6">6 cols</option>';
	html += '</select>';
	html += '</label>';

	html += '<label for="tie_home_cats['+ nextCell +'][number]">';
	html += '<span>Number of posts to show :</span>';
	html += '<input style="width:50px;" id="tie_home_cats['+ nextCell +'][number]" name="tie_home_cats['+ nextCell +'][number]" value="8" type="text" />';
	html += '</label>';
	
	html += '<p id="display_mode_choosing_show_message_'+nextCell+'" class="tie_message_hint display_mode_choosing_show active">If you are choosing <i>Display Mode</i> as <strong>Grid</strong>, Please input <strong>Number of posts to show</strong> divisible by [3,4,6] </p>';
	
	html += builderFooter(nextCell, 'videos');
	return html;
}

// For Group template
function builderGroupTemplate(boxTitle, nextCell, content) {	
	var html = '';
	html += builderHeaderGroupTemplate(boxTitle, nextCell);
	html += '<label for="tie_home_cats['+nextCell+'][home_group]"><span>Display Group template:</span>';
	html += '<select id="tie_home_cats['+nextCell+'][home_group]" name="tie_home_cats['+nextCell+'][home_group]">';
		for(var g=1 ; g<=2; g++){
			var selected = '';
			if(g ==1)
				selected = 'selected="selected"';
			html += '<option value="home_group_'+g+'" '+selected+'>Group template '+g+'</option>';
		}
	html += '</select>';
	html += '</label>';


	html += builderFooterGroupTemplate(nextCell);
	return html;
}

// image Uploader Functions
function tie_styling_uploader(field) {
	var button = "#upload_"+field+"_button";
	jQuery(button).click(function() {
		window.restore_send_to_editor = window.send_to_editor;
		tb_show('', 'media-upload.php?referer=tie-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
		styling_send_img(field);
		return false;
	});
	jQuery('#'+field).change(function(){
		jQuery('#'+field+'-preview img').attr("src",jQuery('#'+field).val());
	});
}

function styling_send_img(field) {
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		
		if(typeof imgurl == 'undefined')
			imgurl = jQuery(html).attr('src');
			
		jQuery('#'+field+'-img').val(imgurl);
		jQuery('#'+field+'-preview').show();
		jQuery('#'+field+'-preview img').attr("src",imgurl);
		tb_remove();
		window.send_to_editor = window.restore_send_to_editor;
	}
}
	
jQuery(document).ready(function() {
    jQuery('.tooltip').tipsy({fade: true, gravity: 's'});	
	
	jQuery("select[name='tie_options[typography_test][font]']").change(function(){
		var selected_font = jQuery("select[name='tie_options[typography_test][font]'] option:selected").val();
		var parts = selected_font.split(':');
		var output =  parts[0] ;
		jQuery("#tie-fonts-css").attr( 'href' , 'http://fonts.googleapis.com/css?family='+output );
		jQuery("#font-preview").css( "font-family" , output );
	});

	jQuery("input[name='tie_options[typography_test][color]']").change(function(){
		var selected_color = jQuery("input[name='tie_options[typography_test][color]']").val();
		jQuery("#font-preview").css( "color" , selected_color );
	});
	
	jQuery("select[name='tie_options[typography_test][size]']").change(function(){
		var selected_size = jQuery("select[name='tie_options[typography_test][size]'] option:selected").val();
		jQuery("#font-preview").css( "font-size" , selected_size+'px' );
	});

	jQuery("select[name='tie_options[typography_test][weight]']").change(function(){
		var selected_weight = jQuery("select[name='tie_options[typography_test][weight]'] option:selected").val();
		jQuery("#font-preview").css( "font-weight" , selected_weight );
	});
	
	jQuery("select[name='tie_options[typography_test][style]']").change(function(){
		var selected_style = jQuery("select[name='tie_options[typography_test][style]'] option:selected").val();
		jQuery("#font-preview").css( "font-style" , selected_style );
	});


		
	// image Uploader Functions
	function tie_set_uploader(field) {
		var button = "#upload_"+field+"_button";
		jQuery(button).click(function() {
			window.restore_send_to_editor = window.send_to_editor;
			tb_show('', 'media-upload.php?referer=tie-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
			tie_set_send_img(field);
			return false;
		});
		jQuery('#'+field).change(function(){
			jQuery('#'+field+'-preview').show();
			jQuery('#'+field+'-preview img').attr("src",jQuery('#'+field).val());
		});
	}

	function tie_set_send_img(field) {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			
			if(typeof imgurl == 'undefined')
				imgurl = jQuery(html).attr('src');
				
			jQuery('#'+field).val(imgurl);
			jQuery('#'+field+'-preview').show();
			jQuery('#'+field+'-preview img').attr("src",imgurl);
			tb_remove();
			window.send_to_editor = window.restore_send_to_editor;
		}
	}
	
	/** Defined image */
	tie_set_uploader("logo");
	tie_set_uploader("logo_retina");
	tie_set_uploader("favicon");
	tie_set_uploader("gravatar");
	
	// tie_set_uploader("apple_iphone_retina");
	// tie_set_uploader("apple_iPad");
	tie_set_uploader("breadcrumb_banner");
	tie_set_uploader("banner_top_img");
	tie_set_uploader("banner_bottom_img");
	tie_set_uploader("banner_above_img");
	tie_set_uploader("banner_below_img");
	tie_set_uploader("home_tabs_big_image");
	tie_set_uploader("dashboard_logo");

	// Custom home Group-1
	for(var g=1; g <= 2; g++){
		tie_set_uploader("home_group_"+g+"_upload_big");
		for(var i=1; i <= 6; i++){
			tie_set_uploader("home_group_"+g+"_upload_item_"+i);
		}
	}

	// Del Preview Image
	jQuery(document).on("click", ".del-img" , function(){
		jQuery(this).parent().fadeOut(function() {
			jQuery(this).hide();
			jQuery(this).parent().find('input[class="img-path"]').attr('value', '' );
		});
	});	
	
	// Single Post Head
	 
	// Single page template Head

	// Display on Home admin
	var selected_radio = jQuery("input[name='tie_options[on_home]']:checked").val();
	if (selected_radio == 'latest') {	jQuery('#Home_Builder').hide();	}
	jQuery("input[name='tie_options[on_home]']").change(function(){
		var selected_radio = jQuery("input[name='tie_options[on_home]']:checked").val();
		if (selected_radio == 'latest') {
			jQuery('#Home_Builder').fadeOut();
		}else{
			jQuery('#Home_Builder').fadeIn();
		}
	 });
	 
	// Reviews On or Off
	 	 
	// Add new review Criteria

	// Slider Position

	// Slider Query Type
	var selected_type = jQuery("input[name='tie_options[slider_query]']:checked").val();
	if (selected_type == 'custom') {jQuery('#slider_custom-item').show();}
	
	jQuery("input[name='tie_options[slider_query]']").change(function(){
		var selected_type = jQuery("input[name='tie_options[slider_query]']:checked").val();
		if (selected_type == 'custom') {
			jQuery('#slider_cat-item ,#slider_posts-item ,#slider_tag-item,#slider_pages-item').hide();
			jQuery('#slider_custom-item').fadeIn();
		}
	 });

	// Save Settings Alert
	jQuery(".mpanel-save").click( function() {
		jQuery('#save-alert').fadeIn();
	});

	// HomeBuilder
	var categoryDf = jQuery('#cats_defult').html();
	
	// For recent post
	jQuery("#add-recent").click(function() {
		jQuery('#cat_sortable').append(builderRecentPost(boxTitle='Recent post', nextCell, content=categoryDf));
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});

	// For group template
	jQuery("#add-group").click(function() {
		jQuery('#cat_sortable').append(builderGroupTemplate(boxTitle='Group template', nextCell, content=categoryDf));
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});

	// For video list
	jQuery("#add-videos").click(function() {
		jQuery('#cat_sortable').append(builderVideoList(boxTitle='Video list', nextCell));
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});

	// For categories tab box
	jQuery("#add-categories").click(function() {
		jQuery('#cat_sortable').append(builderCategoriesTabBox(boxTitle='Categories tab box', nextCell));
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});


	// Toggle open/Close
	jQuery(document).on("click", ".toggle-open" , function(){
		jQuery(this).parent().parent().find(".widget-content").slideToggle(300);
		jQuery(this).hide();
		jQuery(this).parent().find(".toggle-close").show();
    });
	
	jQuery(document).on("click", ".toggle-close" , function(){
		jQuery(this).parent().parent().find(".widget-content").slideToggle("fast");
		jQuery(this).hide();
		jQuery(this).parent().find(".toggle-open").show();
    });
	
	// Expand/collapse all	
	jQuery(document).on("click", "#expand-all" , function(){
		jQuery("#cat_sortable .widget-content").slideDown(300);
		jQuery("#cat_sortable .toggle-close").show();
		jQuery("#cat_sortable .toggle-open").hide();
    });
	jQuery(document).on("click", "#collapse-all" , function(){
		jQuery("#cat_sortable .widget-content").slideUp(300);
		jQuery("#cat_sortable .toggle-close").hide();
		jQuery("#cat_sortable .toggle-open").show();
    });
	
	// Del Cats
	jQuery(document).on("click", ".del-cat" , function(){
		jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
			jQuery(this).remove();
		});
	});

	// Delete Sidebars Icon
	jQuery(document).on("click", ".del-sidebar" , function(){
		var option = jQuery(this).parent().find('input').val();
		jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
			jQuery(this).remove();
			jQuery('#custom-sidebars select').find('option[value="'+option+'"]').remove();

		});
	});	
	
	// Delete Custom Text Icon
	jQuery(document).on("click", ".del-custom-text" , function(){
		var option = jQuery(this).parent().find('input').val();
		jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
			jQuery(this).remove();
		});
	});	
	
	// Sidebar Builder
	jQuery("#sidebarAdd").click(function() {
		var SidebarName = jQuery('#sidebarName').val();
		if( SidebarName.length > 0){
			jQuery('#sidebarsList').append('<li><div class="widget-head">'+SidebarName+' <input id="tie_sidebars" name="tie_options[sidebars][]" type="hidden" value="'+SidebarName+'" /><a class="del-sidebar"></a></div></li>');
			jQuery('#custom-sidebars select').append('<option value="'+SidebarName+'">'+SidebarName+'</option>');
		}
		jQuery('#sidebarName').val('');

	});	
	
	// Custom Breaking News Text
	jQuery("#TextAdd").click(function() {
		var customlink = jQuery('#custom_link').val();
		var customtext = jQuery('#custom_text').val();
		if( customtext.length > 0 && customlink.length > 0  ){
			jQuery('#customList').append('<li><div class="widget-head"><a href="'+customlink+'" target="_blank">'+customtext+'</a> <input name="tie_options[breaking_custom]['+customnext+'][link]" type="hidden" value="'+customlink+'" /> <input name="tie_options[breaking_custom]['+customnext+'][text]" type="hidden" value="'+customtext+'" /><a class="del-custom-text"></a></div></li>');
		}
		customnext ++ ;
		jQuery('#custom_link , #custom_text').val('');

	});
	
	// Background Type
	var bg_selected_radio = jQuery("input[name='tie_options[background_type]']:checked").val();
	if (bg_selected_radio == 'custom') {	jQuery('#pattern-settings').hide();	}
	if (bg_selected_radio == 'pattern') {	jQuery('#bg_image_settings').hide();	}
	jQuery("input[name='tie_options[background_type]']").change(function(){
		var bg_selected_radio = jQuery("input[name='tie_options[background_type]']:checked").val();
		if (bg_selected_radio == 'pattern') {
			jQuery('#pattern-settings').fadeIn();
			jQuery('#bg_image_settings').hide();
		}else{
			jQuery('#bg_image_settings').fadeIn();
			jQuery('#pattern-settings').hide();
		}
	 });
 
	// Panel Tabs
	jQuery(".tabs-wrap").hide();
	jQuery(".mo-panel-tabs ul li:first").addClass("active").show();
	jQuery(".tabs-wrap:first").show(); 
	jQuery("li.tie-tabs:not(.tie-not-tab)").click(function() {
		jQuery(".mo-panel-tabs ul li").removeClass("active");
		jQuery(this).addClass("active");
		jQuery(".tabs-wrap").hide();
		var activeTab = jQuery(this).find("a").attr("href");
		jQuery(activeTab).fadeIn('fast');
		return false;
	});
	
	// Skins
	jQuery("#theme-skins input:checked").parent().addClass("selected");
	jQuery("#theme-skins .checkbox-select").click(
		function(event) {
			event.preventDefault();
			jQuery("#theme-skins li").removeClass("selected");
			jQuery(this).parent().addClass("selected");
			jQuery(this).parent().find(":radio").attr("checked","checked");			 
		}
	);	
	
	// Patterns
	jQuery("#theme-pattern input:checked").parent().addClass("selected");
	jQuery("#theme-pattern .checkbox-select").click(
		function(event) {
			event.preventDefault();
			jQuery("#theme-pattern li").removeClass("selected");
			jQuery(this).parent().addClass("selected");
			jQuery(this).parent().find(":radio").attr("checked","checked");			 
		}
	);	
	
	// Sidebar Position	
	jQuery("#sidebar-position-options input:checked").parent().addClass("selected");
	jQuery("#sidebar-position-options .checkbox-select").click(
		function(event) {
			event.preventDefault();
			jQuery("#sidebar-position-options li").removeClass("selected");
			jQuery(this).parent().addClass("selected");
			jQuery(this).parent().find(":radio").attr("checked","checked");			 
		}
	);	

	// Footer Widgets	
	jQuery("#footer-widgets-options input:checked").parent().addClass("selected");
	jQuery("#footer-widgets-options .checkbox-select").click(
		function(event) {
			event.preventDefault();
			jQuery("#footer-widgets-options li").removeClass("selected");
			jQuery(this).parent().addClass("selected");
			jQuery(this).parent().find(":radio").attr("checked","checked");			 
		}
	);	

	// Ctageories options
	jQuery(".tie-cats-options input:checked").parent().addClass("selected");
	jQuery(document).on("click", ".tie-cats-options .checkbox-select" , function(event){
		event.preventDefault();
		jQuery(this).parent().parent().find("li").removeClass("selected");
		jQuery(this).parent().addClass("selected");
		jQuery(this).parent().find(":radio").attr("checked","checked");			 
		
	});
	
	// Ctageories Tabs box	
	jQuery("#tabs_cats input:checked").parent().addClass("selected");
	jQuery("#tabs_cats span").click(
		function(event) {
			event.preventDefault();
			if( jQuery(this).parent().find(":checkbox").is(':checked') ){
				jQuery(this).parent().removeClass("selected");
				jQuery(this).parent().find(":checkbox").removeAttr("checked");			 
			}else{
				jQuery(this).parent().addClass("selected");
				jQuery(this).parent().find(":checkbox").attr("checked","checked");
			}				
		}
	);
	 
  
	var allPanels = jQuery('.tie-accordion > .tie-accordion-contnet').hide();
	jQuery('.tie-accordion > .accordion-head > a').click(function() {
		$this = jQuery(this);
		$target =  $this.parent().next();
		if(!$target.hasClass('active')){
			allPanels.removeClass('active').slideUp();
			$target.addClass('active').slideDown();
		}
		return false;
	});
  

});

function toggleVisibility(id) {
	var e = document.getElementById(id);
    if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
}

// for custom
// display_mode_choosing_js
jQuery(document).on('change', '.display_mode_choosing_js',function(event) {
		event.preventDefault();
		var myval = jQuery(this).val();
		var myid = jQuery(this).data('id');
		if(myval == 'grid'){
			jQuery('#display_mode_choosing_show_cols_' + myid).removeClass('inactive');
			jQuery('#display_mode_choosing_show_message_' + myid).removeClass('inactive');
			jQuery('#display_mode_choosing_show_cols_' + myid).addClass('active');
			jQuery('#display_mode_choosing_show_message_' + myid).addClass('active');
		} else {
			jQuery('#display_mode_choosing_show_cols_' + myid).removeClass('active');
			jQuery('#display_mode_choosing_show_cols_' + myid).addClass('inactive');
			jQuery('#display_mode_choosing_show_message_' + myid).removeClass('active');
			jQuery('#display_mode_choosing_show_message_' + myid).addClass('inactive');
		}
});	

(function($){var i=function(e){if(!e)var e=window.event;e.cancelBubble=true;if(e.stopPropagation)e.stopPropagation()};$.fn.checkbox=function(f){try{document.execCommand('BackgroundImageCache',false,true)}catch(e){}var g={cls:'jquery-checkbox',empty:'empty.png'};g=$.extend(g,f||{});var h=function(a){var b=a.checked;var c=a.disabled;var d=$(a);if(a.stateInterval)clearInterval(a.stateInterval);a.stateInterval=setInterval(function(){if(a.disabled!=c)d.trigger((c=!!a.disabled)?'disable':'enable');if(a.checked!=b)d.trigger((b=!!a.checked)?'check':'uncheck')},10);return d};return this.each(function(){var a=this;var b=h(a);if(a.wrapper)a.wrapper.remove();a.wrapper=$('<span class="'+g.cls+'"><span class="mark"><img src="'+g.empty+'" /></span></span>');a.wrapperInner=a.wrapper.children('span:eq(0)');a.wrapper.hover(function(e){a.wrapperInner.addClass(g.cls+'-hover');i(e)},function(e){a.wrapperInner.removeClass(g.cls+'-hover');i(e)});b.css({position:'absolute',zIndex:-1,visibility:'hidden'}).after(a.wrapper);var c=false;if(b.attr('id')){c=$('label[for='+b.attr('id')+']');if(!c.length)c=false}if(!c){c=b.closest?b.closest('label'):b.parents('label:eq(0)');if(!c.length)c=false}if(c){c.hover(function(e){a.wrapper.trigger('mouseover',[e])},function(e){a.wrapper.trigger('mouseout',[e])});c.click(function(e){b.trigger('click',[e]);i(e);return false})}a.wrapper.click(function(e){b.trigger('click',[e]);i(e);return false});b.click(function(e){i(e)});b.bind('disable',function(){a.wrapperInner.addClass(g.cls+'-disabled')}).bind('enable',function(){a.wrapperInner.removeClass(g.cls+'-disabled')});b.bind('check',function(){a.wrapper.addClass(g.cls+'-checked')}).bind('uncheck',function(){a.wrapper.removeClass(g.cls+'-checked')});$('img',a.wrapper).bind('dragstart',function(){return false}).bind('mousedown',function(){return false});if(window.getSelection)a.wrapper.css('MozUserSelect','none');if(a.checked)a.wrapper.addClass(g.cls+'-checked');if(a.disabled)a.wrapperInner.addClass(g.cls+'-disabled')})}})(jQuery);
// tipsy, version 1.0.0a
(function(a){function b(a,b){return typeof a=="function"?a.call(b):a}function c(a){while(a=a.parentNode){if(a==document)return true}return false}function d(b,c){this.$element=a(b);this.options=c;this.enabled=true;this.fixTitle()}d.prototype={show:function(){var c=this.getTitle();if(c&&this.enabled){var d=this.tip();d.find(".tipsy-inner")[this.options.html?"html":"text"](c);d[0].className="tipsy";d.remove().css({top:0,left:0,visibility:"hidden",display:"block"}).prependTo(document.body);var e=a.extend({},this.$element.offset(),{width:this.$element[0].offsetWidth,height:this.$element[0].offsetHeight});var f=d[0].offsetWidth,g=d[0].offsetHeight,h=b(this.options.gravity,this.$element[0]);var i;switch(h.charAt(0)){case"n":i={top:e.top+e.height+this.options.offset,left:e.left+e.width/2-f/2};break;case"s":i={top:e.top-g-this.options.offset,left:e.left+e.width/2-f/2};break;case"e":i={top:e.top+e.height/2-g/2,left:e.left-f-this.options.offset};break;case"w":i={top:e.top+e.height/2-g/2,left:e.left+e.width+this.options.offset};break}if(h.length==2){if(h.charAt(1)=="w"){i.left=e.left+e.width/2-15}else{i.left=e.left+e.width/2-f+15}}d.css(i).addClass("tipsy-"+h);d.find(".tipsy-arrow")[0].className="tipsy-arrow tipsy-arrow-"+h.charAt(0);if(this.options.className){d.addClass(b(this.options.className,this.$element[0]))}if(this.options.fade){d.stop().css({opacity:0,display:"block",visibility:"visible"}).animate({opacity:this.options.opacity})}else{d.css({visibility:"visible",opacity:this.options.opacity})}}},hide:function(){if(this.options.fade){this.tip().stop().fadeOut(function(){a(this).remove()})}else{this.tip().remove()}},fixTitle:function(){var a=this.$element;if(a.attr("title")||typeof a.attr("original-title")!="string"){a.attr("original-title",a.attr("title")||"").removeAttr("title")}},getTitle:function(){var a,b=this.$element,c=this.options;this.fixTitle();var a,c=this.options;if(typeof c.title=="string"){a=b.attr(c.title=="title"?"original-title":c.title)}else if(typeof c.title=="function"){a=c.title.call(b[0])}a=(""+a).replace(/(^\s*|\s*$)/,"");return a||c.fallback},tip:function(){if(!this.$tip){this.$tip=a('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-inner"></div>');this.$tip.data("tipsy-pointee",this.$element[0])}return this.$tip},validate:function(){if(!this.$element[0].parentNode){this.hide();this.$element=null;this.options=null}},enable:function(){this.enabled=true},disable:function(){this.enabled=false},toggleEnabled:function(){this.enabled=!this.enabled}};a.fn.tipsy=function(b){function e(c){var e=a.data(c,"tipsy");if(!e){e=new d(c,a.fn.tipsy.elementOptions(c,b));a.data(c,"tipsy",e)}return e}function f(){var a=e(this);a.hoverState="in";if(b.delayIn==0){a.show()}else{a.fixTitle();setTimeout(function(){if(a.hoverState=="in")a.show()},b.delayIn)}}function g(){var a=e(this);a.hoverState="out";if(b.delayOut==0){a.hide()}else{setTimeout(function(){if(a.hoverState=="out")a.hide()},b.delayOut)}}if(b===true){return this.data("tipsy")}else if(typeof b=="string"){var c=this.data("tipsy");if(c)c[b]();return this}b=a.extend({},a.fn.tipsy.defaults,b);if(!b.live)this.each(function(){e(this)});if(b.trigger!="manual"){var h=b.live?"live":"bind",i=b.trigger=="hover"?"mouseenter":"focus",j=b.trigger=="hover"?"mouseleave":"blur";this[h](i,f)[h](j,g)}return this};a.fn.tipsy.defaults={className:null,delayIn:0,delayOut:0,fade:false,fallback:"",gravity:"n",html:false,live:false,offset:0,opacity:.8,title:"title",trigger:"hover"};a.fn.tipsy.revalidate=function(){a(".tipsy").each(function(){var b=a.data(this,"tipsy-pointee");if(!b||!c(b)){a(this).remove()}})};a.fn.tipsy.elementOptions=function(b,c){return a.metadata?a.extend({},c,a(b).metadata()):c};a.fn.tipsy.autoNS=function(){return a(this).offset().top>a(document).scrollTop()+a(window).height()/2?"s":"n"};a.fn.tipsy.autoWE=function(){return a(this).offset().left>a(document).scrollLeft()+a(window).width()/2?"e":"w"};a.fn.tipsy.autoBounds=function(b,c){return function(){var d={ns:c[0],ew:c.length>1?c[1]:false},e=a(document).scrollTop()+b,f=a(document).scrollLeft()+b,g=a(this);if(g.offset().top<e)d.ns="n";if(g.offset().left<f)d.ew="w";if(a(window).width()+a(document).scrollLeft()-g.offset().left<b)d.ew="e";if(a(window).height()+a(document).scrollTop()-g.offset().top<b)d.ns="s";return d.ns+(d.ew?d.ew:"")}}})(jQuery)