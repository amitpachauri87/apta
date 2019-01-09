<?php 
global $wpdb;
$myrows = $wpdb->get_results( "SELECT * FROM tournament_orders WHERE `user_id`=".get_current_user_id() );
//print_r($myrows);
?>
<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
			<tr>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number"><span class="nobr">Order</span></th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number"><span class="nobr">Tournament Name</span></th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr">Date</span></th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-actions"><span class="nobr">Transection ID</span></th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status"><span class="nobr">Status</span></th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total"><span class="nobr">Total</span></th>
			</tr>
		</thead>

		<tbody>
		<?php 
		if(!empty($myrows))
		{
			foreach ($myrows as $key => $value) {?>
			
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-on-hold order">
				<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order">
						#<?php echo $value->id;?>
				</td>
				<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order">
						<?php echo get_the_title($value->tournanent_id);?>
				</td>
				<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order">
				<?php echo $value->payment_date;?>
				</td>
				<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order">
				<?php echo $value->transection_id;?>
				</td>
				<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order">
				<?php echo $value->payment_status;?>
				</td>
				<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order">
				<?php echo $value->price;?>
				</td>
									</tr>
									<?php 
								}
									}?>
					</tbody>
	</table>

	
	

<div class="woocommerce-notices-wrapper"></div>