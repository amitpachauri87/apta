<?php 
$wid = $atts['id'];

if( ! empty( $wid ) ){ 
		//$wid = $instance['blockwidget_name'];
		$blockwidget_name = get_the_title($wid);
		$all_meta = get_post_meta($wid);
		$setting_icon = get_post_meta($wid,'setting_icon',true);
		$icon_position = get_post_meta($wid,'_icon_position',true);
		$no_of_rows = get_post_meta($wid,'no_of_rows',true);
		$no_of_coloumns = get_post_meta($wid,'no_of_coloumns',true);
		$row_coloumn = unserialize(get_post_meta($wid,'row_coloumn',true));
		//echo "<pre>";
		//print_r($row_coloumn);?>
		<div class="wbc_My_Widget">
		<div class="wbc_sidebar_section right-box">
		<div class="wbc_widget_title">
		<h3><?php echo $blockwidget_name;?></h3><div class="wbc_logo_image <?php echo 'wbc_'.$icon_position;?>"><img width="40" height="40" src="<?php echo $setting_icon;?>"></div>
		</div>
		<?php 
		$i=1;
		while($i<=$no_of_rows)
		{
		$j=1;?>
			<div id="row_<?php echo $no_of_coloumns;?>" class='wbc_row'>
		<?php 
		while($j<=$no_of_coloumns){
			 $size = $row_coloumn['image_size'][$i][$j][0]; 
			 $sizes = explode('x', $size); 
			 $width = $sizes[0];
			 $height = $sizes[1]; ?>
			 <style type="text/css">
			 	.wbc_My_Widget .wbc_coloumn img {
			 		height:<?php echo $height;?>px; 
			 		width:<?php echo $width ;?>px;
			 	}
			 </style>
				<div  class="wbc_coloumn wbc_coloumn_<?php echo $j;?>">
				<a href="<?php echo $row_coloumn['row_link'][$i][$j][0];?>">
				<div class="wbc_full_box <?php echo 'wbc_gray_'.$row_coloumn['row_gray_scale'][$i][$j][0];?>">
				<div class="wbc_image_section <?php echo 'wbc_'.$row_coloumn['round_or_sqare'][$i][$j][0];?>">
				<div class="wbc_inner_image"><img height="<?php echo $height;?>" width="<?php echo $width;?>" src="<?php echo $row_coloumn['image_link'][$i][$j][0]; ?>"></div>
				<a href="<?php echo $row_coloumn['row_link'][$i][$j][0];?>"><h3 class="wbc_text_widhout_hover"><?php echo $row_coloumn['row_text'][$i][$j][0];?></h3></a>
				<a href="<?php echo $row_coloumn['row_link'][$i][$j][0];?>"><h3 class="wbc_text_on_hover"><?php echo $row_coloumn['row_mousehover_text'][$i][$j][0];?></h3></a>
				</div>
				</div>
				</a>
				</div>
		<?php 
		$j++;
			}
		$i++;?>
			</div>
		<?php }
		}
		echo '</div>';
		echo '</div>';

?>