<?php 
/*
Plugin Name:Widget Blocks
Author:LR Photography Team
Description:This plugin is used to create widgets blocks in the widets section and creates a post type names widget blocks
where you will be able to create widgets design.
Author uri:https//:www.lriese.ch
Version:1.0
Text Domain: widget-blocks
*/

/*Register Widget in widget area*/

/*load languages translation*/

function wbc__load_plugin_textdomain() {
    load_plugin_textdomain( 'widget-blocks', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'wbc__load_plugin_textdomain' );

/*add coloum to post screen*/

// ONLY MOVIE CUSTOM TYPE POSTS
add_filter('manage_blockwidget_posts_columns', 'ST4_columns_head_only_blockwidget', 10);
add_action('manage_blockwidget_posts_custom_column', 'ST4_columns_content_only_blockwidget', 10, 2);
 
// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function ST4_columns_head_only_blockwidget($defaults) {
    $defaults['block_shortcode'] = __('Block Shortcode','widget-blocks');
    return $defaults;
}
function ST4_columns_content_only_blockwidget($column_name, $post_ID) {
    if ($column_name == 'block_shortcode') {
        echo "[block-widget id=".$post_ID."]";
    }
}

/*Block Shortcode*/
function wbc_block_widget_shortcode($atts){
  include('admin/blockShortcode.php');
}
add_shortcode('block-widget','wbc_block_widget_shortcode');

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
   
   add_meta_box('wbc_setting_metabox', __('Icon With Block Title','widget-blocks'), 'wbc_setting_metabox', 'blockwidget', 'normal', 'default');
 add_meta_box('wbc_row_coloumn_upload', __('Create Row Coloumns','widget-blocks'), 'wbc_row_coloumn_upload', 'blockwidget', 'normal', 'default');
 add_meta_box('wbc_row_upload', __('Sections','widget-blocks'), 'wbc_row_upload', 'blockwidget', 'normal', 'default');
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
        <label><?php echo __('Icons','widget-blocks');?></label>
        <input type = "text" name = "setting_icon" id = "setting_icon" size = "70" value = "<?php echo $strFile; ?>" />
        <input type = "hidden" name = "img_txt_id" id = "img_txt_id" value = "" />
        <input id = "upload_image_button" type = "button" value = "Upload">
        </td> 
        <td>
        	<label><?php echo __('Icon Placed','widget-blocks');?></label></td>
        	<td>
        	<input type="radio" name="_icon_position" <?php checked( $icon_position, 'centre' ); ?> value="centre"><?php echo __('Centre','widget-blocks');?><br>
        	<input type="radio" name="_icon_position" <?php checked( $icon_position, 'end' ); ?> value="end"><?php echo __('End','widget-blocks');?><br>
        	<input type="radio" name="_icon_position" <?php checked( $icon_position, 'begining' ); ?> value="begining"><?php echo __('Begining','widget-blocks');?><br>
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
	<td><?php echo __('Number of Rows','widget-blocks');?></td><td><select class="no_of_rows" name="no_of_rows" value="">
	<?php for($r_num=1;$r_num<=40;$r_num++){?>
  <option <?php if($rows==$r_num){?> selected="selected" <?php }?> ><?php echo $r_num;?></option>
	<?php }?>
	</select></td>
	<td><?php echo __('Number Of Coloumns','widget-blocks');?></td>
	<td><select name="no_of_coloumns" class="no_of_coloumns" value="">
	<?php for($c_num=1;$c_num<=40;$c_num++){?>
  <option <?php if($coloumns==$c_num){?> selected="selected" <?php }?> ><?php echo $c_num;?></option>
  <?php }?>
	</select></td>
	<td><button class="create_row_coloumn button-primary button button-large">Create</button></td>
</tr>

</table>
<?php }
function wbc_row_upload(){?>
<script type = "text/javascript">
        var file_frame;
    jQuery(document).on('click','.upload_row_image_button', function(podcast) {
      var id1 = jQuery(this).attr('id');
        podcast.preventDefault();
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
          var id_array = id1.split('_');
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();
            var url = attachment.url;
           // var field = document.getElementById('rowimage_'+id_array[1]);
            jQuery('#rowimage_'+id_array[1]).val(url);
            //alert(field);
            //console.log(field);
            //field.value = url; //set which variable you want the field to have
        });

        // Finally, open the modal
        file_frame.open();
    });

    </script>
	<?php global $wpdb;
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
<h3 style="text-decoration: underline;"><?php echo __('Row1/Coloumn1','widget-blocks');?></h3>
<table>

        	<tr>
        	<thead>
        		<td></td>
        		<td><b><?php echo __('Url','widget-blocks');?></b></td>
        		<td><b><?php echo __('Size 100X100','widget-blocks');?></b></td>
        		<td></td>
        		<td></td>
        		<td><b><?php echo __('Shape','widget-blocks');?></b></td>
        	</thead>
        	<tbody>
        		<td><b><?php echo __('Image','widget-blocks');?></b></td>
        		<td>
            <!-- <input type="text" name="row_coloumn[image_link][1][1][]" value=""> -->
            <input type = "text" name = "row_coloumn[image_link][1][1][]" class ="row_image" id="rowimage_11" size = "70" value = "" />
                    <input type = "hidden" name = "img_txt_id" id = "img_txt_id" value = "" />
                    <input id="rowimagebutton_11" class = "upload_row_image_button" type = "button" value = "Upload">
            </td>
        		<td><input type="text" name="row_coloumn[image_size][1][1][]" value=""></td>
        		<td></td>
        		<td></td>
        		<td><input type="radio" name="row_coloumn[round_or_sqare][1][1][]" value="round"><b><?php echo __('Round','widget-blocks');?></b><br>
        		<input type="radio" name="row_coloumn[round_or_sqare][1][1][]" value="square"><b><?php echo __('Square','widget-blocks');?></b></td>
        	</tbody>
        </tr> 
        <tr>
          <thead>
            <td></td>
            
          </thead>
          <tbody>
            <td><b><?php echo __('Link','widget-blocks');?></b></td>
            <td></td>
            <td><input type="text" value="" name="row_coloumn[row_link][1][1][]"></td>
          </tbody>
        </tr>
        <tr>
        	<thead>
        		<td></td>
        		
        	</thead>
        	<tbody>
        		<td><b><?php echo __('Description','widget-blocks');?></b></td>
        		<td></td>
        		<td><textarea name="row_coloumn[row_text][1][1][]"></textarea></td>
        	</tbody>
        </tr>
        <tr>
        	<thead>
        		<td></td>
        		
        	</thead>
        	<tbody>
        		<td><b><?php echo __('MouseHover Description','widget-blocks');?></b></td>
        		<td></td>
        		<td><textarea name="row_coloumn[row_mousehover_text][1][1][]"></textarea></td>
        	</tbody>
        </tr>
        <tr>
        	<thead>
        		<td></td>
        		
        	</thead>
        	<tbody>
        		<td><b><?php echo __('GrayScale','widget-blocks');?></b></td>
        		<td></td>
        		<td><input type="checkbox" name="row_coloumn[row_gray_scale][1][1][]" value="yes"><b><?php echo __('Yes','widget-blocks');?></b></td>
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
       	        		<td><b><?php echo __('Url','widget-blocks');?></b></td>
       	        		<td><b><?php echo __('Size 100x100','widget-blocks');?></b></td>
       	        		<td></td>
       	        		<td></td>
       	        		<td><b><?php echo __('Shape','widget-blocks');?></b></td>
       	        	</thead>
       	        	<tbody>
       	        		<td><b><?php echo __('Image','widget-blocks');?></b></td>
       	        		<td>
                    <!-- <input type="text" name="row_coloumn[image_link][<?php echo $x;?>][<?php echo $i;?>][]" value="<?php echo $row_coloumn['image_link'][$x][$i][0];?>"> -->
                      <input type = "text" name = "row_coloumn[image_link][<?php echo $x;?>][<?php echo $i;?>][]" class ="row_image" id="rowimage_<?php echo $x;?><?php echo $i;?>" size = "70" value = "<?php echo $row_coloumn['image_link'][$x][$i][0];?>" />
                    <input type = "hidden" name = "img_txt_id" id = "img_txt_id" value = "" />
                    <input id="rowimagebutton_<?php echo $x;?><?php echo $i;?>" class = "upload_row_image_button" type = "button" value = "Upload">
                    </td>
       	        		<td><input type="text" name="row_coloumn[image_size][<?php echo $x;?>][<?php echo $i;?>][]" value="<?php echo $row_coloumn['image_size'][$x][$i][0];?>"></td>
       	        		<td></td>
       	        		<td></td>
       	        		<td><input type="radio" <?php if($row_coloumn['round_or_sqare'][$x][$i][0]=="round"){?> checked="checked" <?php }?> name="row_coloumn[round_or_sqare][<?php echo $x;?>][<?php echo $i;?>][]" value="round"><b><?php echo __('Round','widget-blocks');?></b><br>
       	        		<input type="radio" <?php if($row_coloumn['round_or_sqare'][$x][$i][0]=="square"){?> checked="checked" <?php }?> name="row_coloumn[round_or_sqare][<?php echo $x;?>][<?php echo $i;?>][]" value="square"><b><?php echo __('Square','widget-blocks');?></b></td>
       	        	</tbody>
       	        </tr> 
                 <tr>
                  <thead>
                    <td></td>
                    
                  </thead>
                  <tbody>
                    <td><b><?php echo __('Link','widget-blocks');?></b></td>
                    <td></td>
                    <td><input type="text" value="<?php echo $row_coloumn['row_link'][$x][$i][0];?>" name="row_coloumn[row_link][<?php echo $x;?>][<?php echo $i;?>][]"></td>
                  </tbody>
                </tr>
       	        <tr>
       	        	<thead>
       	        		<td></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td><b><?php echo __('Description','widget-blocks');?></b></td>
       	        		<td></td>
       	        		<td><textarea name="row_coloumn[row_text][<?php echo $x;?>][<?php echo $i;?>][]"><?php echo $row_coloumn['row_text'][$x][$i][0];?></textarea></td>
       	        	</tbody>
       	        </tr>
       	        <tr>
       	        	<thead>
       	        		<td></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td><b><?php echo __('MouseHover Description','widget-blocks');?></b></td>
       	        		<td></td>
       	        		<td><textarea name="row_coloumn[row_mousehover_text][<?php echo $x;?>][<?php echo $i;?>][]"><?php echo $row_coloumn['row_mousehover_text'][$x][$i][0];?></textarea></td>
       	        	</tbody>
       	        </tr>
       	        <tr>
       	        	<thead>
       	        		<td></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td><b><?php echo __('GrayScale','widget-blocks');?></b></td>
       	        		<td></td>
       	        		<td><input type="checkbox" <?php if($row_coloumn['row_gray_scale'][$x][$i][0]=="yes"){?> checked="checked" <?php }?> name="row_coloumn[row_gray_scale][<?php echo $x;?>][<?php echo $i;?>][]" value="yes"><b><?php echo __('Yes','widget-blocks');?></b>
       	        		</td>
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
       	        		<td><b><?php echo __('Url','widget-blocks');?></b></td>
       	        		<td><b><?php echo __('Size 100x100','widget-blocks');?></b></td>
       	        		<td></td>
       	        		<td></td>
       	        		<td><b><?php echo __('Shape','widget-blocks');?></b></td>
       	        	</thead>
       	        	<tbody>
       	        		<td><b><?php echo __('Image','widget-blocks');?></b></td>
       	        		<td>
                    <!-- <input type="text" name="row_coloumn[image_link][<?php echo $x;?>][<?php echo $i;?>][]" value="<?php echo $row_coloumn['image_link'][$x][$i][0];?>"> -->
                    <input type = "text" name = "row_coloumn[image_link][<?php echo $x;?>][<?php echo $i;?>][]" class ="row_image" id="rowimage_<?php echo $x;?><?php echo $i;?>" size = "70" value = "<?php echo $row_coloumn['image_link'][$x][$i][0];?>" />
                    <input type = "hidden" name = "img_txt_id" id = "img_txt_id" value = "" />
                    <input id="rowimagebutton_<?php echo $x;?><?php echo $i;?>" class = "upload_row_image_button" type = "button" value = "Upload">
                    </td>
       	        		<td><input type="text" name="row_coloumn[image_size][<?php echo $x;?>][<?php echo $i;?>][]" value="<?php echo $row_coloumn['image_size'][$x][$i][0];?>"></td>
       	        		<td></td>
       	        		<td></td>
       	        		<td><input type="radio" <?php if($row_coloumn['round_or_sqare'][$x][$i][0]=="round"){?> checked="checked" <?php }?> name="row_coloumn[round_or_sqare][<?php echo $x;?>][<?php echo $i;?>][]" value="round"><b><?php echo __('Round','widget-blocks');?></b><br>
       	        		<input type="radio" <?php if($row_coloumn['round_or_sqare'][$x][$i][0]=="square"){?> checked="checked" <?php }?> name="row_coloumn[round_or_sqare][<?php echo $x;?>][<?php echo $i;?>][]" value="square"><b><?php echo __('Square','widget-blocks');?></b></td>
       	        	</tbody>
       	        </tr> 
                <tr>
                  <thead>
                    <td></td>
                    
                  </thead>
                  <tbody>
                    <td><b><?php echo __('Link','widget-blocks');?></b></td>
                    <td></td>
                    <td><input type="text" value="<?php echo $row_coloumn['row_link'][$x][$i][0];?>" name="row_coloumn[row_link][<?php echo $x;?>][<?php echo $i;?>][]"></td>
                  </tbody>
                </tr>
       	        <tr>
       	        	<thead>
       	        		<td></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td><b><?php echo __('Description','widget-blocks');?></b></td>
       	        		<td></td>
       	        		<td><textarea name="row_coloumn[row_text][<?php echo $x;?>][<?php echo $i;?>][]"><?php echo $row_coloumn['row_text'][$x][$i][0];?></textarea></td>
       	        	</tbody>
       	        </tr>
       	        <tr>
       	        	<thead>
       	        		<td></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td><b><?php echo __('MouseHover Description','widget-blocks');?></b></td>
       	        		<td></td>
       	        		<td><textarea name="row_coloumn[row_mousehover_text][<?php echo $x;?>][<?php echo $i;?>][]"><?php echo $row_coloumn['row_mousehover_text'][$x][$i][0];?></textarea></td>
       	        	</tbody>
       	        </tr>
       	        <tr>
       	        	<thead>
       	        		<td></td>
       	        		
       	        	</thead>
       	        	<tbody>
       	        		<td><b><?php echo __('GrayScale','widget-blocks');?></b></td>
       	        		<td></td>
       	        		<td><input type="checkbox" <?php if($row_coloumn['row_gray_scale'][$x][$i][0]=="yes"){?> checked="checked" <?php }?> name="row_coloumn[row_gray_scale][<?php echo $x;?>][<?php echo $i;?>][]" value="yes"><b><?php echo __('Yes','widget-blocks');?></b></td>
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