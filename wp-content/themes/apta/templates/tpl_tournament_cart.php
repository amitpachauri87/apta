<?php
/*
Template Name:tournament cart
*/
if(!is_user_logged_in())
{
	wp_redirect('my-account');
	exit();
}
get_header();
$api_version = '85.5';
$sandbox_api_username = get_field('sanbox_api_username','option');
$sandbox_api_password = get_field('sanbox_api_password','option');
$sandbox_api_endpoint = get_field('sandbox_api_endpoint','option');
$sandbox_api_signature = get_field('sanbox_api_signature','option');

$live_api_endpoint = get_field('live_api_endpoint','option');
$live_api_username = get_field('live_api_username','option');
$live_api_password = get_field('live_api_password','option');
$live_api_signature = get_field('live_api_signature','option');


$api_endpoint = $sandbox ?  $sandbox_api_endpoint: $live_api_endpoint;
$api_username = $sandbox ?  $sandbox_api_username : $live_api_username;
$api_password = $sandbox ?  $sandbox_api_password : $live_api_password;
$api_signature = $sandbox ? $sandbox_api_signature : $live_api_signature;

 $slug = $_GET['slug'];
 $mypost = get_page_by_path($slug, '', 'tournaments');
 $id = $mypost->ID;
 $title = get_the_title($id);
$price = get_post_meta($id,'tournament_price',true);
$start_date = get_field('tournament_start_date',false, false);
$date = new DateTime($start_date);
$formated_date = $date->format('d-m-Y');
$currency = 'USD';
$request_params = array
                    (
                    'METHOD' => 'DoDirectPayment', 
                    'USER' => $sandbox_api_username, 
                    'PWD' => $sandbox_api_password, 
                    'SIGNATURE' => $sandbox_api_signature, 
                    'VERSION' => $api_version, 
                    'PAYMENTACTION' => 'Sale',                   
                    'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
                    'CREDITCARDTYPE' => 'MasterCard', 
                    'ACCT' => '5522340006063638',                        
                    'EXPDATE' => '022021',           
                    'CVV2' => '456', 
                    'FIRSTNAME' => 'Tester', 
                    'LASTNAME' => 'Testerson', 
                    'STREET' => '707 W. Bay Drive', 
                    'CITY' => 'Largo', 
                    'STATE' => 'FL',                     
                    'COUNTRYCODE' => 'US', 
                    'ZIP' => '33770', 
                    'AMT' => $price, 
                    'CURRENCYCODE' => $currency, 
                    'DESC' => $title
                    );



//echo "<pre>";
//print_r($request_params);
/*$nvp_string = '';
foreach($request_params as $var=>$val)
{
    $nvp_string .= '&'.$var.'='.urlencode($val);    
}
//print_r($nvp_string);                    

$curl = curl_init();
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_URL, $sandbox_api_endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);
 
$result = curl_exec($curl);     
curl_close($curl);

$nvp_response_array = parse_str($result);

$output = NVPToArray($result);
echo "<pre>";
print_r($output);
// Function to convert NTP string to an array
function NVPToArray($NVPString)
{
    $proArray = array();
    while(strlen($NVPString))
    {
        // name
        $keypos= strpos($NVPString,'=');
        $keyval = substr($NVPString,0,$keypos);
        // value
        $valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
        $valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
        // decoding the respose
        $proArray[$keyval] = urldecode($valval);
        $NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
    }
    return $proArray;
}
print_r($nvp_response_array);*/
?>
<section class="main-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 extra-cl">
                <div class="inner-main inner-page">
                    <h3>Tournament Checkout</h3>
                    <div class="details-box">
                    <h4><?php echo $title;?></h4>
                        <p><strong>Date:</span><?php echo $date->format('d-m-Y'); ?></strong></p>
                        <p><strong>Price : <?php echo $price .'&nbsp;'.$currency; ?></strong></p>
                        <div class="success_message" style="display: none;color: green;">
                                <h2>Thankyou for your order.</h2>
                        </div>
                        <div class="error_message" style="display: none;color: red;">
                                <h2>Please check your details and correct them it have some error.</h2>
                        </div>
                </div>
                <form id="tournament_form" action="" method="post">
                    <div class="row">
                        <div class="col col-md-6">
                            <label>First Name</label>    
                            <input type="text" required="required" class="form-control" name="first_name" value="<?php echo get_usermeta(get_current_user_id(),'billing_first_name',true);?>">
                        </div>
                        <div class="col col-md-6">
                            <label>Last Name</label>    
                            <input type="text" required="required" class="form-control" name="last_name" value="<?php echo get_usermeta(get_current_user_id(),'billing_last_name',true);?>">
                        </div>
                    </div>

                    <div class="row">
	                    <div class="col col-md-6">
	                            <label>Country</label>    
	                            <input type="text" required="required" class="form-control" name="country_code" value="<?php echo get_usermeta(get_current_user_id(),'billing_country',true);?>">
	                    </div>
	                    <div class="col col-md-6">
	                            <label>State</label>    
	                            <input type="text" required="required" class="form-control" name="state" value="<?php echo get_usermeta(get_current_user_id(),'billing_state',true);?>">
	                    </div>
                    </div>

                    <div class="row">
                        
                    	 <div class="col col-md-4">
                            <label>Street</label>    
                            <input type="text" required="required" class="form-control" name="street" value="<?php echo get_usermeta(get_current_user_id(),'billing_address_1',true);?>">
                        </div>
                        <div class="col col-md-4">
                            <label>City</label>    
                            <input type="text" required="required" class="form-control" name="city" value="<?php echo get_usermeta(get_current_user_id(),'billing_city',true);?>">
                        </div>

                        <div class="col col-md-4">
                            <label>Zip Code</label>    
                            <input type="text" required="required" class="form-control" name="zip_code" value="<?php echo get_usermeta(get_current_user_id(),'billing_postcode',true);?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-12">
                            <label>Card Number</label>
                            <input type="number"  required="required" class="form-control" name="card_number" value="">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col col-md-6">
                            <label>Expiration Date</label>    
                            <input type="text" required="required" class="form-control" name="expiration_date" value="">

                        </div>
                        <div class="col col-md-6">
                            <label>CVV Number</label>    
                            <input type="number" required="required" class="form-control" name="cvv_number" value="">
                        </div>
                    </div>
                        <input type="hidden" name="api_version" value="<?php echo $api_version;?>">
                        <input type="hidden" name="post_id" value="<?php echo $id;?>">
                        <input type="hidden" name="post_title" value="<?php echo $title;?>">
                        <input type="hidden" name="slug" value="<?php echo $slug;?>">
                        <input type="hidden" name="start_date" value="<?php echo $formated_date;?>">
                        <input type="hidden" name="currency" value="<?php echo $currency;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                    <div class="col-md-3">
                        <br>
                        <input type="submit" name="pay_now" class="btn sign-up pay_now" value="Pay Now">
                        <div style="display: none;" class="loader">
                        </div>
                    </div>
                </form>
</div>
</div>
</div>
</div>
</section>
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 60px;
  height: 60px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#tournament_form").submit(function(e){
            jQuery('.loader').css('display','inline-block');

            e.preventDefault();            
            var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
            var form_data = new FormData(this);
            
            form_data.append('action', 'submit_review');
            
            jQuery.ajax({
                url: ajax_url,
                type: 'post',
                processData: false,
                contentType: false,
                data: form_data,
                success: function (response){ 
                    if(response =='success')
                    {
                        jQuery('.loader').hide();
                        jQuery('.success_message').fadeIn('slow', function(){
                            jQuery('.success_message').delay(50000).fadeOut(); 
                     });
                        jQuery('#tournament_form')[0].reset();
                        window.location.href="https://apta.pd.cisinlive.com/my-account/tournaments-order/";

                        
                    }
                    else{
                        jQuery('.loader').hide();
                        jQuery('.error_message').fadeIn().delay(3000).fadeOut();
                        return false;
                    }
                     }
            });
        });
    });
</script>
<?php get_footer();?>