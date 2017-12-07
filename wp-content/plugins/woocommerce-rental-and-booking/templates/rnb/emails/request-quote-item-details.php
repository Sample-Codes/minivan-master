  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" valign="top">
        <center>

          <table width="100%" style="background-color:#ffffff;border-bottom:1px solid #e5e5e5;">
            <tr>
              <td align="center">
                <center style="padding:0 0 50px 0;">

                  <table width="70%" style="margin:0 auto;">
                    <tr>
                      <td>

                        <table>
                          <tr>
                            <td>
                              <h2 align="left" style="font-family:Georgia,Cambria,'Times New Roman',serif;font-size:32px;font-weight:300;line-height: normal;padding: 35px 0 0;color: #4d4d4d;">
                              <?php printf( __( 'Quote #%s Details', 'redq-rental' ), $quote['id'] ); ?>
                              </h2>
                            </td>
                          </tr>
                          <tr>
                            <td style="border-collapse: collapse;width: 70%;padding-top: 20px;text-align: left;vertical-align: top;">
                              <table cellspacing="0" cellpadding="0" width="100%">
                                <tbody><tr>
                                  <!-- <td style="vertical-align: top;border-collapse: collapse;text-align: left;width: 25%; padding: 0 20px 0 0;">
                                    <img width="110" height="92" src="https://s29.postimg.org/b52qey193/RPez_UIw_PRv8pjat_AAH1_E_item_images_19.jpg" alt="item1">
                                  </td> -->
                                  <td style="border-collapse: collapse;text-align: left;vertical-align: top;width: 90%">
                                    <span style="color: #4d4d4d; font-weight:bold;"><?php echo wpautop( wptexturize( $product_title ) ) ?> <strong> x 1</strong></span>
                                    <dl class="variation">
                                      <?php 
                                        $product_id = get_post_meta($quote_id, '_product_id', true); 
                                        $all_data = get_post_meta($product_id,'redq_all_data',true);
                                        $options_data = $all_data['local_settings_data'];
                                      ?>
                                      <?php foreach ($form_data as $meta) : ?>
                                      
                                      
                                      <?php
                                        if( isset( $meta['name'] ) ) {                            


                                          switch ($meta['name']) {
                                            case 'add-to-cart':
                                              # code...
                                              break;

                                            case 'currency-symbol':
                                              # code...
                                              break;

                                            case 'pickup_location':
                                              if(!empty($meta['value'])):  
                                                $pickup_location_title = $options_data['pickup_location_title'] ? $options_data['pickup_location_title'] : __('Pickup Location','redq-rental');
                                                $dval = explode('|', $meta['value'] );  
                                                $pickup_value = $dval[0].' ( '.wc_price($dval[2]). ' )'; ?>
                                                <dt style="float: left;margin-right: 10px;"><?php echo esc_attr( $pickup_location_title ) ?>:</dt>
                                                <dd>
                                                  <p><strong><?php echo $pickup_value; ?></strong></p>
                                                </dd>
                                              <?php endif; break;

                                            case 'dropoff_location':
                                              if(!empty($meta['value'])):  
                                                $return_location_title = $options_data['dropoff_location_title'] ? $options_data['dropoff_location_title'] : __('Drop Off Location','redq-rental');
                                                $dval = explode('|', $meta['value'] );  
                                                $return_value = $dval[0].' ( '.wc_price($dval[2]). ' )'; ?>
                                                <dt style="float: left;margin-right: 10px;"><?php echo esc_attr( $return_location_title ) ?>:</dt>
                                                <dd>
                                                  <p><strong><?php echo $return_value; ?></strong></p>
                                                </dd>
                                              <?php endif; break;       

                                            case 'pickup_date':
                                              if(!empty($meta['value'])):              
                                                $pickup_date_title = $options_data['pickup_date_title'] ? $options_data['pickup_date_title'] : __('Pickup Date ','redq-rental');           
                                                $pickup_date_value = $meta['value']; ?>
                                                <dt style="float: left;margin-right: 10px;"><?php echo esc_attr( $pickup_date_title ) ?>:</dt>
                                                <dd>
                                                  <p><strong><?php echo $pickup_date_value; ?></strong></p>
                                                </dd>
                                              <?php endif; break; 

                                            case 'pickup_time': 
                                              if(!empty($meta['value'])):             
                                                $pickup_time_title = $options_data['pickup_time_placeholder'] ? $options_data['pickup_time_placeholder'] : __('Pickup Time ','redq-rental');           
                                                $pickup_time_value = $meta['value'] ? $meta['value'] : '' ; ?>
                                                <dt style="float: left;margin-right: 10px;"><?php echo esc_attr( $pickup_time_title ) ?>:</dt>
                                                <dd>
                                                  <p><strong><?php echo $pickup_time_value; ?></strong></p>
                                                </dd>
                                              <?php endif; break;  

                                            case 'dropoff_date': 
                                              if(!empty($meta['value'])):             
                                                $return_date_title = $options_data['dropoff_date_title'] ? $options_data['dropoff_date_title'] : __('Return Date ','redq-rental');           
                                                $return_date_value = $meta['value'] ? $meta['value'] : '' ; ?>
                                                <dt style="float: left;margin-right: 10px;"><?php echo esc_attr( $return_date_title ) ?>:</dt>
                                                <dd>
                                                  <p><strong><?php echo $return_date_value; ?></strong></p>
                                                </dd>
                                              <?php endif; break; 

                                            case 'dropoff_time': 
                                              if(!empty($meta['value'])):           
                                              $return_time_title = $options_data['dropoff_date_placeholder'] ? $options_data['dropoff_date_placeholder'] : __('Pickup Time ','redq-rental');           
                                              $return_time_value = $meta['value'] ? $meta['value'] : '' ; ?>
                                              <dt style="float: left;margin-right: 10px;"><?php echo esc_attr( $return_time_title ) ?>:</dt>
                                              <dd>
                                                <p><strong><?php echo $return_time_value; ?></strong></p>
                                              </dd>
                                              <?php endif; break; 

                                            case 'additional_person_info':
                                              if(!empty($meta['value'])):  
                                                $person_title = $options_data['person_heading_title'] ? $options_data['person_heading_title'] : __('Person ','redq-rental');
                                                $dval = explode('|', $meta['value'] );  
                                                $person_value = $dval[0].' ( '.wc_price($dval[1]).' - '.$dval[2]. ' )'; ?>
                                                <dt style="float: left;margin-right: 10px;"><?php echo esc_attr( $person_title ) ?>:</dt>
                                                <dd>
                                                  <p><strong><?php echo $person_value; ?></strong></p>
                                                </dd>
                                              <?php endif; break;    

                                            case 'extras': ?>
                                              <?php 
                                                $resources_title = $options_data['resources_heading_title'] ? $options_data['resources_heading_title'] : __('Resources','redq-rental'); 
                                                 
                                                $resource_name = '';
                                                $payable_resource = array();
                                                foreach ($meta['value'] as $key => $value) {
                                                  $extras = explode('|', $value);
                                                  $payable_resource[$key]['resource_name'] = $extras[0]; 
                                                  $payable_resource[$key]['resource_cost'] = $extras[1];
                                                  $payable_resource[$key]['cost_multiply'] = $extras[2];
                                                  $payable_resource[$key]['resource_hourly_cost'] = $extras[3];                                                  
                                                }
                                                foreach ($payable_resource as $key => $value) {
                                                  if($value['cost_multiply'] === 'per_day'){
                                                    $resource_name .= $value['resource_name'].' ( '.wc_price($value['resource_cost']).' - '.__('Per Day','redq-rental').' )'.' , <br> ';
                                                  }else{
                                                    $resource_name .= $value['resource_name'].' ( '.wc_price($value['resource_cost']).' - '.__('One Time','redq-rental').' )'.' , <br> '; 
                                                  }
                                                }
                                              ?>
                                              <dt style="float: left;margin-right: 10px;"><?php echo esc_attr($resources_title);  ?></dt>
                                              <dd>
                                                <p><strong><?php echo $resource_name; ?></strong></p>
                                              </dd>
                                             <?php break;  
                                            case 'security_deposites': ?>
                                              <?php 
                                                $deposits_title = $options_data['deposite_heading_title'] ? $options_data['deposite_heading_title'] : __('Deposits','redq-rental'); 
                                                $deposite_name = '';
                                                $payable_deposits = array();
                                                foreach ($meta['value'] as $key => $value) {
                                                  $extras = explode('|', $value);
                                                  $payable_deposits[$key]['deposite_name'] = $extras[0]; 
                                                  $payable_deposits[$key]['deposite_cost'] = $extras[1];
                                                  $payable_deposits[$key]['cost_multiply'] = $extras[2];
                                                  $payable_deposits[$key]['deposite_hourly_cost'] = $extras[3];                                                 
                                                }
                                                foreach ($payable_deposits as $key => $value) {
                                                  if($value['cost_multiply'] === 'per_day'){
                                                    $deposite_name .= $value['deposite_name'].' ( '.wc_price($value['deposite_cost']).' - '.__('Per Day','redq-rental').' )'.' , <br> ';
                                                  }else{
                                                    $deposite_name .= $value['deposite_name'].' ( '.wc_price($value['deposite_cost']).' - '.__('One Time','redq-rental').' )'.' , <br> '; 
                                                  }
                                                }
                                              ?>
                                              <dt style="float: left;margin-right: 10px;">
                                                <?php echo esc_attr($deposits_title); ?>
                                              </dt>
                                              <dd>
                                                <p><strong><?php echo $deposite_name; ?></strong></p>
                                              </dd>
                                             <?php break;   
                                            
                                            default: ?>
                                              <dt style="float: left;margin-right: 10px;"><?php echo esc_attr( $meta['name'] ) ?>:</dt>
                                              <dd>
                                                <p><strong><?php echo esc_attr( $meta['value'] ) ?></strong></p>
                                              </dd>
                                              <?php break;
                                          }
                                        }
                                      ?>
                                      <?php endforeach ?>
                                    </dl>
                                  </td>
                                </tr>
                              </tbody></table>
                            </td>
                            <td style="border-collapse: collapse;padding-top: 20px;text-align: left;vertical-align: top; width: 10%;">
                              <?php echo woocommerce_price(get_post_meta($quote_id, '_quote_price', true)); ?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>

                </center>
              </td>
            </tr>
          </table>

        </center>
      </td>
    </tr>
  </table>