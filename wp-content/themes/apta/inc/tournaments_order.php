<div class="wrap">
        <h1><?php _e( 'Tournaments Order', 'textdomain' ); ?></h1>
        <h2>All Transactions</h2><br/>
<?php global $wpdb;
$result1 = $wpdb->get_results( "SELECT * FROM tournament_orders ORDER BY id ASC" );

	if ( $result1 ) { ?>
    <table id="example" class="wp-list-table widefat fixed posts">
		<thead>
			<tr>
				<th class="manage-column" id="title" scope="col" style="width: 20px;"><span><?php esc_html_e( 'ID', 'classify' ); ?></span></th>
				<th class="manage-column" id="title" scope="col"><span><?php esc_html_e( 'tournament Name', 'classify' ); ?></span></th>
				<th class="manage-column" id="title" scope="col"><span><?php esc_html_e( 'User name', 'classify' ); ?></span></th>
				<th class="manage-column" id="title" scope="col"><span><?php esc_html_e( 'Transection ID', 'classify' ); ?></span></th>
				<th class="manage-column" id="title" scope="col"><span><?php esc_html_e( 'Price', 'classify' ); ?></span></th>
				<th class="manage-column" id="title" scope="col"><span><?php esc_html_e( 'Payment Date', 'classify' ); ?></span></th>
				<th class="manage-column" id="title" scope="col"><span><?php esc_html_e( 'Payment Status', 'classify' ); ?></span></th>
			</tr>
		</thead>
        <tbody id="the-list">
		<?php 

			foreach ( $result1 as $info ) { 

		$author_obj = get_user_by('id', $info->user_id);?>
        <tr class="type-post" >
			<td class="manage-column" style="width: 20px;"><span><?php echo  $info->id; ?></span></td>					<td class="manage-column price-table-row-name" ><span><?php echo get_the_title($info->tournanent_id); ?></span></td>			
            <td class="manage-column price-table-header-name"><span><?php echo  $author_obj->user_nicename; ?></span></td>
            <td class="manage-column price-table-row-ads"><span><?php echo $info->transection_id; ?></span></td>
            <td class="manage-column price-table-row-used"><span><?php echo $info->price; ?></span></td>
            <td class="manage-column price-table-row-days"><span><?php echo $info->payment_date;	 ?> </span></td>
            <td class="manage-column price-table-row-price"><span><?php echo $info->payment_status; ?></span></td>
		</tr>  

			<?php 
		} 
		 ?>
	</tbody>
    
    </table>
<?php } 
echo '</div>';
?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
		    jQuery('#example').DataTable();
		});
		</script>
    </div>