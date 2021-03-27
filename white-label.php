<?php
//Admin bar menu greeting text

add_action( 'admin_bar_menu', 'custom_admin_bar_greeting_text' );

function custom_admin_bar_greeting_text( $wp_admin_bar ) {
  
  $user_data         = wp_get_current_user();
  $user_display_name = isset( $user_data->display_name ) ? $user_data->display_name : false;
  $user_id           = isset( $user_data->ID ) ? (int) $user_data->ID : 0;
  
  if ( ! $user_id || ! $user_display_name ) {
    return;
 
  }  
    
  $user_avatar = get_avatar( $user_id, 26 );  
  
  
  $day = date("l");
    
    if( $day == 'Sunday' ) {
        $greet= "Happy Sunday, ";
} elseif ( $day == 'Monday') {
        $greet= "Happy Monday, ";
} elseif ( $day == 'Tuesday') {
        $greet= "Happy Tuesday, ";
} elseif ( $day == 'Wednesday') {
        $greet= "Happy Wednesday, ";
} elseif ( $day == 'Thursday') {
        $greet= "Happy Thursday, ";
} elseif ( $day == 'Friday') {
        $greet= "Happy Friday,  ";
}  elseif ( $day == 'Saturday' ) {
        $greet= "Happy Saturday, ";
}
 
  $my_account_text = 
      sprintf(__( '%s' ),'<span class="display-name">' . esc_html( $user_data->display_name ) . '</span>'); 
    
  $wp_admin_bar->add_node(
    array(
      'id'    => 'my-account',
      'title' => $greet .  $my_account_text . $user_avatar,
    )
  );
}
add_action( 'admin_bar_menu', 'custom_admin_bar_greeting_text' );



//Footer Text
function change_admin_footer_text () {
 return __('Basic Child Theme designed & coded with ♥ and whiskey by <a href="https://www.DancingFraxinus.com/">Dancing Fraxinus</a>.');
}
add_filter( 'admin_footer_text', 'change_admin_footer_text' );


//Dashboard Widgets -- CONTACT CARD
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_widget', 'WebDev Contact Card', 'custom_dashboard_information');
}
function custom_dashboard_information() {
	
?>
<table style= "width: 100%; background-color: #633030; padding: 3%; margin: 0;">
	<tr><td>
<a href="https://portfolio.dancingfraxinus.com"><img src="https://www.gravatar.com/avatar/fd25f3667e19235c0514bba25f7516b4?s=150" title="View My Portfolio" style="box-shadow:  2px 2px 8px 3px rgba(0, 0, 0, 0.35);"></a><br/>	
</td>
	<td style= "padding: 2% 10%; display: flex; align-items: center;">
		<p style = "line-height: 1.5em; color: white; font-size: 1em; font-style: italic;" id="admess">
			Hey Sarah! <br/> This is my webdev contact card. The 'Your Project' Link will go to our shared Bonsai space. Cheers! - Liz
</td></tr>
	<tr><td style="padding: 0 10px;">
	<a href="https://www.dancingfraxinus.com/help" title="Questions?" id="adfa" target="_blank"><span class="dashicons dashicons-editor-help"></span></a>
		<a href="mailto:liz@dancingfraxinus.com" title="email me" id="adfa" target="_blank"><span class="dashicons dashicons-email"></span></a>
		<a href="https://www.linkedin.com/in/ashlieelizabethmoore/" title="My LinkedIn Profile" id="adfa" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>
		<a href="https://www.youtube.com/channel/UCdP5DjaKEWUHOwPcf6IZ11w" title="How-To Videos" id="adfa" target="_blank"><span class="dashicons dashicons-youtube"></span></a>
        <a href="https://app.hellobonsai.com/projects/f1636f113172ed5" title="Your Project" id="adfa" target="_blank"><span class="dashicons dashicons-admin-generic"></span></a>	
		
		<style type ="text/css">
			#adfa{
				font-size: 1.25em;  
				text-decoration: none;
				padding: 1px; 
				color: #eababa; 
                
			}
			#adfa:hover {
				color: #ce7878;
				transition-duration: .2s;
			}
			#admess a{
				color: white;
				color: #e6a1a1;
			}
		</style>
		</td></tr>
</table>
	
	<?php
}

// Use when needed: flush_rewrite_rules();
?>