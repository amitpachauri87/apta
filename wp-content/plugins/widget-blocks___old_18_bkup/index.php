<?php 
/*
Plugin Name:Widget Blocks
Author:CIS Team
Description:This plugin is used to create widgets blocks in the widets section and creates a post type names widget blocks
where you will be able to create widgets design.
Author uri:https:www.cisin.com
Version:1.0
*/

/*Register Widget in widget area*/

function wbc_widget_callback(){

	include('admin/widgetRegister.php');
}
add_action( 'widgets_init', 'wbc_widget_callback');

/*Register Post type Block Widget*/

function wbc_setup_post_type(){
	include('admin/postType.php');
	
}
add_action( 'init', 'wbc_setup_post_type' );


//Add Metabox to add new post screen

add_action('add_meta_boxes', 'wbc_metaboxes');

function wbc_metaboxes() {
   
   add_meta_box('wbc_setting_metabox', 'Icon In block Name', 'wbc_setting_metabox', 'blockwidget', 'normal', 'default');
 add_meta_box('wbc_row_coloumn_upload', 'Create Row coloumns', 'wbc_row_coloumn_upload', 'blockwidget', 'normal', 'default');
 add_meta_box('wbc_row_upload', 'Sections', 'wbc_row_upload', 'blockwidget', 'normal', 'default');
}
function wbc_setting_metabox() {
    global $post;
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="settingmeta_noncename" id="settingmeta_noncename" value="'.
    wp_create_nonce(plugin_basename(__FILE__)).'" />';
    global $wpdb;
    $strFile = get_post_meta($post->ID, $key = 'setting_icon', true);
    $icon_position = get_post_meta($post->ID, $key = '_icon_position', true);
    $media_file = get_post_meta($post->ID, $key = '_wp_attached_file', true);
    
    
    if (!empty($media_file)) {
        $strFile = $media_file;
    } ?>


    <script type = "text/javascript">
        var file_frame;
    jQuery('#upload_image_button').live('click', function(podcast) {
        podcast.preventDefault();
        // If the media frame already exists, reopen it.
        if (file_frame) {
            file_frame.open();
            return;
        }
        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery(this).data('uploader_title'),
            button: {
                text: jQuery(this).data('uploader_button_text'),
            },
            multiple: false // Set to true to allow multiple files to be selected
        });
        // When a file is selected, run a callback.
        file_frame.on('select', function(){
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();
            var url = attachment.url;
            var field = document.getElementById("setting_icon");

            field.value = url; //set which variable you want the field to have
        });

        // Finally, open the modal
        file_frame.open();
    });

    </script>



    <div>

        <table>
        <tr>
        <td>
        <label>Icons in block Name</label>
        <input type = "text" name = "setting_icon" id = "setting_icon" size = "70" value = "<?php echo $strFile; ?>" />
        <input type = "hidden" name = "img_txt_id" id = "img_txt_id" value = "" />
        <input id = "upload_image_button" type = "button" value = "Upload">
        </td> 
        <td>
        	<label>Icon Placed</label></td>
        	<td>
        	<input type="radio" name="_icon_position" <?php checked( $icon_position, 'centre' ); ?> value="centre">Centre<br>
        	<input type="radio" name="_icon_position" <?php checked( $icon_position, 'end' ); ?> value="end">End<br>
        	<input type="radio" name="_icon_position" <?php checked( $icon_position, 'begining' ); ?> value="begining">Begining<br>
        </td>
        </tr>

        </table> 
        
    </div>    
  <?php
    function admin_scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }

    function admin_styles() {
        wp_enqueue_style('thickbox');
    }
    add_action('admin_print_scripts', 'admin_scripts');
    add_action('admin_print_styles', 'admin_styles');
}
function wbc_row_coloumn_upload(){
	global $wpdb;
	global $post;
	$rows = get_post_meta($post->ID, $key = 'no_of_rows', true);
    $coloumns = get_post_meta($post->ID, $key = 'no_of_coloumns', true);?>
<table>
<tr>
	<td>Number of Rows</td><td><select class="no_of_rows" name="no_of_rows" value="">
	<option <?php if($rows==1){?> selected="selected" <?php }?> >1</option>
	<option <?php if($rows==2){?> selected="selected" <?php }?>>2</option>
	<option <?php if($rows==3){?> selected="selected" <?php }?>>3</option>
	<option <?php if($rows==4){?> selected="selected" <?php }?>>4</option>
	<option <?php if($rows==5){?> selected="selected" <?php }?>>5</option>
	</select></td>
	<td>Number Of Coloumns</td>
	<td><select name="no_of_coloumns" class="no_of_coloumns" value="">
	<option <?php if($coloumns==1){?> selected="selected" <?php }?>>1</option>
	<option <?php if($coloumns==2){?> selected="selected" <?php }?>>2</option>
	<option <?php if($coloumns==3){?> selected="selected" <?php }?>>3</option>
	<option <?php if($coloumns==4){?> selected="selected" <?php }?>>4</option>
	<option <?php if($coloumns==5){?> selected="selected" <?php }?>>5</option>
	</select></td>
	<td><button class="create_row_coloumn button-primary button button-large">Create Row & Coloumns</button></td>
</tr>

</table>
<?php }
function wbc_row_upload(){
	global $wpdb;
	global $post;
	$row_coloumn = get_post_meta($post->ID, $key = 'row_coloumn', true);
    //echo "<pre>";
    //print_r(unserialize($row_coloumn));
    $row_coloumn = unserialize($row_coloumn); 
     $rows = get_post_meta($post->ID, $key = 'no_of_rows', true);
     $coloumns = get_post_meta($post->ID, $key = 'no_of_coloumns', true);
     echo '<input type="hidden" name="widget_block_id" class="widget_block_id" value="'.$post->ID.'">';
    if(!$row && !$coloumns){?>
<div class="dynamic_div">
<div class="section">
<h3 style="text-decoration: underline;">Row1/Coloumn1</h3>
<table>

        	<tr>
        	<thead>
        		<td></td>
        		<td><b>Picture</b></td>
        		<td><b>Size 500x500</b></td>
        		<td></td>
        		<td></td>
        		<td><b>Round or Square Shape</b></td>
        	</thead>
        	<tbody>
        		<td></td>
        		<td><input type="text" name="row_coloumn[image_link][1][1][]" value=""></td>
        		<td><input type="text" name="row_coloumn[image_size][1][1][]" value=""></td>
        		<td></td>
        		<td></td>
        		<td><input type="radio" name="row_coloumn[round_or_sqare][1][1][]" value="round"><b>Round</b><br>
        		<input type="radio" name="row_coloumn[round_or_sqare][1][1][]" value="square"><b>Square</b></td>
        	</tbody>
        </tr> 
        <tr>
          <thead>
            <td><b>Link</b></td>
            
          </thead>
          <tbody>
            <td></td>
            <td></td>
            <td><input type="text" value="" name="row_coloumn[row_link][1][1][]"></td>
          </tbody>
        </tr>
        <tr>
        	<thead>
        		<td><b>Text</b></td>
        		
        	</thead>
        	<tbody>
        		<td></td>
        		<td></td>
        		<td><textarea name="row_coloumn[row_text][1][1][]"></textarea></td>
        	</tbody>
        </tr>
        <tr>
        	<thead>
        		<td><b>MouseHover Text</b></td>
        		
        	</thead>
        	<tbody>
        		<td></td>
        		<td></td>
        		<td><textarea name="row_coloumn[row_mousehover_text][1][1][]"></textarea></td>
        	</tbody>
        </tr>
        <tr>
        	<thead>
        		<td><b>GrayScale</b></td>
        		
        	</thead>
        	<tbody>
        		<td></td>
        		<td></td>
        		<td><input type="radio" name="row_coloumn[row_gray_scale][1][1][]" value="yes"><b>Yes</b><input type="radio" name="row_coloumn[row_gray_scale][1][1][]" value="no"><b>No</b></td>
        	</tbody>
        </tr>
 </table>
 </div>
 </div>
 <?php }
 else{
 	echo '<div class="dynamic_div"><div class="section">';
		$x = 1;
       while ($x <= $rows) {
                $i = 1; 
       	        echo "<div class='row'>";

       	       	  while ($i <= $coloumns) {
       	       	 
       			?>
       			
       			 <div class="section">
       				<h3 style="text-decoration: underline;">Row <?php echo $x; ?>/Coloumn <?php echo $i; ?></h3>
       				<table>
       	        	<tr>
       	        	<thead>
       	        		<td></td>
       	        		<td><b>Picture</b></td>
       	        		<td><b>Size 500x500</b></td>
       	        		<td></td>
       	        		<td></td>
       	        		<td><b>Round or Square Shape</b></td>
       	        	</thead>
       	        	<tbody>
       	        		<td></td>
       	        		<td><input type="text" name="row_coloumn[image_link][<?php echo $x;?>][<?php echo $i;?>][]" value="<?php echo $row_coloumn['image_link'][$x][$i][0];?>"></td>
       	        		<td><input type="text" name="row_coloumn[image_size][<?php echo $x;?>][<?php echo $i;?>][]" value="<?php echo $row_coloumn['image_size'][$x][$i][0];?>"></td>
       	        		<td></td>
       	        		<td></td>
       	        		<td><input type="radio" <?php if($row_coloumn['round_or_sqare'][$x][$i][0]=="round"){?> checked="checked" <?php }?> name="row_coloumn[round_or_sqare][<?php echo $x;?>][<?php echo $i;?>][]" value="round"><b>Round</b><br>
       	        		<input type="radio" <?php if($row_coloumn['round_or_sqare'][$x][$i][0]=="square"){?> checked="checked" <?php }?> name="row_coloumn[round_or_sqare][<?php echo $x;?>][<?php echo $i;?>][]" value="square"><b>Square</b></td>
       	        	</tbody>
       	        </tr> 
                 <tr>
                  <thead>
                    <td><b>Link</b></td>
                    
                  </thead>
                  <tbody>
                    <td></td>
                    <td></td>
                    <td><input type="text" value="<?php echo $row_coloumn['row_link'][$x][$i][0];?>" name="row_coloumn[row_link][<?php echo $x;?>][<?php echo $i;?>][]"></td>
                  </tbody>
                </tr>
       	        <tr>
       	        	<thead>
       	        		<td><b>Text</b></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td></td>
       	        		<td></td>
       	        		<td><textarea name="row_coloumn[row_text][<?php echo $x;?>][<?php echo $i;?>][]"><?php echo $row_coloumn['row_text'][$x][$i][0];?></textarea></td>
       	        	</tbody>
       	        </tr>
       	        <tr>
       	        	<thead>
       	        		<td><b>MouseHover Text</b></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td></td>
       	        		<td></td>
       	        		<td><textarea name="row_coloumn[row_mousehover_text][<?php echo $x;?>][<?php echo $i;?>][]"><?php echo $row_coloumn['row_mousehover_text'][$x][$i][0];?></textarea></td>
       	        	</tbody>
       	        </tr>
       	        <tr>
       	        	<thead>
       	        		<td><b>GrayScale</b></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td></td>
       	        		<td></td>
       	        		<td><input type="radio" <?php if($row_coloumn['row_gray_scale'][$x][$i][0]=="yes"){?> checked="checked" <?php }?> name="row_coloumn[row_gray_scale][<?php echo $x;?>][<?php echo $i;?>][]" value="yes"><b>Yes</b><input <?php if($row_coloumn['row_gray_scale'][$x][$i][0]=="no"){?> checked="checked" <?php }?> type="radio" name="row_coloumn[row_gray_scale][<?php echo $x;?>][<?php echo $i;?>][]" value="no"><b>No</b></td>
       	        	</tbody>
       	        </tr>
       		   </table>
       		   </div>
       		   <?php  
       	          $i++;
       	   	   }
       	       echo '</div>';
       	      
       	$x++;
       }
       echo '</div></div>';
 }?>
<?php }
//Saving the file
function wbc_save_setting_meta($post_id, $post) {
	
	/*echo "<pre>";
  print_r($post);
  print_r($_POST);
  print_r($post_id);
  exit();*/
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if (!wp_verify_nonce($_POST['settingmeta_noncename'], plugin_basename(__FILE__))) {
        return $post -> ID;
    }
    // Is the user allowed to edit the post?
    if (!current_user_can('edit_post', $post->ID))
        return $post->ID;
    // We need to find and save the data
    // We'll put it into an array to make it easier to loop though.
    
    
    // Add values of $podcasts_meta as custom fields
    if(isset($_POST['_icon_position'])){
        update_post_meta($post->ID,'_icon_position',$_POST['_icon_position']);
    }
    if(isset($_POST['no_of_rows'])){
    update_post_meta($post->ID,'no_of_rows',$_POST['no_of_rows']);
	}
    if(isset($_POST['no_of_coloumns'])){
    update_post_meta($post->ID,'no_of_coloumns',$_POST['no_of_coloumns']);
	}
    if(isset($_POST['row_coloumn'])){
    update_post_meta($post->ID,'row_coloumn',serialize($_POST['row_coloumn']));
	}
	if(isset($_POST['setting_icon'])){
	$podcasts_meta['setting_icon'] = $_POST['setting_icon'];
    foreach($podcasts_meta as $key => $value) {
        if ($post->post_type == 'revision') return;
        $value = implode(',', (array) $value);
        if (get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value it will update
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value it will add
            add_post_meta($post->ID, $key, $value);
        }
        if (!$value) delete_post_meta($post->ID, $key); // Delete if blank value
    }
	}
}
add_action('save_post', 'wbc_save_setting_meta', 1, 2); // save the custom fields

function wbc_load_scripts() {
	// load our jquery file that sends the $.post request
	wp_enqueue_script( "wbc_ajax", plugin_dir_url( __FILE__ ) . 'js/wbc_ajax.js', array( 'jquery' ) );
 	wp_enqueue_style( 'widget_block', plugins_url( 'css/widget_block.css', __FILE__ ) );
	// make the ajaxurl var available to the above script
	wp_localize_script( 'wbc_ajax', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );	
}
add_action('wp_print_scripts', 'wbc_load_scripts');

function wbc_ajax_process_request() {
	// first check if data is being sent and that it is the data we want
  	if ( isset( $_POST["post_var"] ) ) {
		$row = $_POST['post_var']['row'];
		$col = $_POST['post_var']['col'];
    $id = $_POST['post_var']['id']; 
    $row_coloumn = unserialize(get_post_meta($id,'row_coloumn',true));
		$x = 1;
		
       while ($x <= $row) {
                $i = 1; 
       	        echo "<div class='row'>";

       	       	  while ($i <= $col) {
       	       	 
       			?>
       			
       			 <div class="section">
       				<h3 style="text-decoration: underline;">Row <?php echo $x; ?>/Coloumn <?php echo $i; ?></h3>
       				<table>
       	        	<tr>
       	        	<thead>
       	        		<td></td>
       	        		<td><b>Picture</b></td>
       	        		<td><b>Size 500x500</b></td>
       	        		<td></td>
       	        		<td></td>
       	        		<td><b>Round or Square Shape</b></td>
       	        	</thead>
       	        	<tbody>
       	        		<td></td>
       	        		<td><input type="text" name="row_coloumn[image_link][<?php echo $x;?>][<?php echo $i;?>][]" value="<?php echo $row_coloumn['image_link'][$x][$i][0];?>"></td>
       	        		<td><input type="text" name="row_coloumn[image_size][<?php echo $x;?>][<?php echo $i;?>][]" value="<?php echo $row_coloumn['image_size'][$x][$i][0];?>"></td>
       	        		<td></td>
       	        		<td></td>
       	        		<td><input type="radio" <?php if($row_coloumn['round_or_sqare'][$x][$i][0]=="round"){?> checked="checked" <?php }?> name="row_coloumn[round_or_sqare][<?php echo $x;?>][<?php echo $i;?>][]" value="round"><b>Round</b><br>
       	        		<input type="radio" <?php if($row_coloumn['round_or_sqare'][$x][$i][0]=="square"){?> checked="checked" <?php }?> name="row_coloumn[round_or_sqare][<?php echo $x;?>][<?php echo $i;?>][]" value="square"><b>Square</b></td>
       	        	</tbody>
       	        </tr> 
                <tr>
                  <thead>
                    <td><b>Link</b></td>
                    
                  </thead>
                  <tbody>
                    <td></td>
                    <td></td>
                    <td><input type="text" value="<?php echo $row_coloumn['row_link'][$x][$i][0];?>" name="row_coloumn[row_link][<?php echo $x;?>][<?php echo $i;?>][]"></td>
                  </tbody>
                </tr>
       	        <tr>
       	        	<thead>
       	        		<td><b>Text</b></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td></td>
       	        		<td></td>
       	        		<td><textarea name="row_coloumn[row_text][<?php echo $x;?>][<?php echo $i;?>][]"><?php echo $row_coloumn['row_text'][$x][$i][0];?></textarea></td>
       	        	</tbody>
       	        </tr>
       	        <tr>
       	        	<thead>
       	        		<td><b>MouseHover Text</b></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td></td>
       	        		<td></td>
       	        		<td><textarea name="row_coloumn[row_mousehover_text][<?php echo $x;?>][<?php echo $i;?>][]"><?php echo $row_coloumn['row_mousehover_text'][$x][$i][0];?></textarea></td>
       	        	</tbody>
       	        </tr>
       	        <tr>
       	        	<thead>
       	        		<td><b>GrayScale</b></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td></td>
       	        		<td></td>
       	        		<td><input type="radio" <?php if($row_coloumn['row_gray_scale'][$x][$i][0]=="yes"){?> checked="checked" <?php }?> name="row_coloumn[row_gray_scale][<?php echo $x;?>][<?php echo $i;?>][]" value="yes"><b>Yes</b><input type="radio" <?php if($row_coloumn['row_gray_scale'][$x][$i][0]=="no"){?> checked="checked" <?php }?> name="row_coloumn[row_gray_scale][<?php echo $x;?>][<?php echo $i;?>][]" value="no"><b>No</b></td>
       	        	</tbody>
       	        </tr>
       		   </table>
       		   </div>
       		   <?php  
       	          $i++;
       	   	   }
       	       echo '</div>';
       	      
       	$x++;
       }

       
		
	}
	wp_die();
}
add_action('wp_ajax_response', 'wbc_ajax_process_request');