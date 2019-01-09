<?php 
register_widget( 'wbc_Widget' );
class wbc_Widget extends WP_Widget {
	// class constructor
	public function __construct() {
	$widget_ops = array( 
		'classname' => 'wbc_My_Widget',
		'description' => __('A Widget to show product blocks on sidebar','widget-blocks'),
	);
	parent::__construct( 'wbc_Widget', __('Block Widget','widget-blocks'), $widget_ops );
}
	
	// output the widget content on the front-end
	public function widget( $args, $instance ) {
	echo $args['before_widget'];
	if ( ! empty( $instance['title'] ) ) {
		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
	}

	if( ! empty( $instance['blockwidget_name'] ) ){ 
		$wid = $instance['blockwidget_name'];
		$blockwidget_name = get_the_title($wid);
		$all_meta = get_post_meta($wid);
		$setting_icon = get_post_meta($wid,'setting_icon',true);
		$icon_position = get_post_meta($wid,'_icon_position',true);
		$no_of_rows = get_post_meta($wid,'no_of_rows',true);
		$no_of_coloumns = get_post_meta($wid,'no_of_coloumns',true);
		$row_coloumn = unserialize(get_post_meta($wid,'row_coloumn',true));
		//echo "<pre>";
		//print_r($row_coloumn);?>
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
				<div class="wbc_inner_image">
				<img height="<?php echo $height;?>" width="<?php echo $width;?>" src="<?php echo $row_coloumn['image_link'][$i][$j][0]; ?>">
				</div>
				<?php if($row_coloumn['row_text'][$i][$j][0]!=""){?>
				<a href="<?php echo $row_coloumn['row_link'][$i][$j][0];?>"><h3 class="wbc_text_widhout_hover"><?php echo $row_coloumn['row_text'][$i][$j][0];?></h3></a>
				<?php }?>
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

	echo $args['after_widget'];
}

	// output the option form field in admin Widgets screen
	public function form( $instance ) {

	$posts = get_posts( array( 
			'post_type'=>'blockwidget',
			'posts_per_page' => -1,
			'post_status' => 'publish'
		) );
	$blockwidget_name = $instance['blockwidget_name'];
	?>
	<div style="max-height: 120px; overflow: auto;">
	<br>
	<p><?php echo __('Select the Block Widget that you want to show on sidebar','widget-blocks');?></p>
	<select name="blockwidget_name">
	<option><?php echo __('Select','widget-blocks');?></option>
	<?php foreach ( $posts as $post ) { ?>

		<option <?php if($blockwidget_name==$post->ID){ ?> selected="selected" <?php } ?>  value="<?php echo $post->ID; ?>"><?php echo get_the_title( $post->ID ); ?></option>

	<?php } ?>

	</select>
	</div>
	<?php
}

	// save options
	public function update( $new_instance, $old_instance ) {
		
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
	$blockwidget_name = ( ! empty ( $_POST['blockwidget_name'] ) ) ? $_POST['blockwidget_name'] : '';
	$instance['blockwidget_name'] = $blockwidget_name;

	return $instance;
}
}