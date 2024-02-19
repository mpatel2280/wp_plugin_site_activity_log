<?php
/**
 * Promo Notice
 *
 * @since 1.0
 * @package Site Activity Log
 */

add_action( 'plugins_loaded', 'site_load_plugin' );

if ( ! function_exists( 'site_load_plugin' ) ) {
	/**
	 * User Activity Load Plugin.
	 */
	function site_load_plugin() {

		// The promo time.
		$site_activity_log['promo_time'] = get_option( 'site_promo_time' );
		if ( empty( $site_activity_log['promo_time'] ) ) {
			$site_activity_log['promo_time'] = time();
			update_option( 'site_promo_time', $site_activity_log['promo_time'] );
		}

		// Are we to show the Blog Designer promo.
		if ( ! empty( $site_activity_log['promo_time'] ) && $site_activity_log['promo_time'] > 0 && $site_activity_log['promo_time'] < ( time() - ( 60 * 60 * 24 * 3 ) ) ) {
			add_action( 'admin_notices', 'site_promo' );
		}

		// Are we to disable the promo.
		if ( isset( $_GET['site_promo'] ) && 0 == (int) $_GET['site_promo'] ) {
			update_option( 'site_promo_time', ( 0 - time() ) );
			die( 'DONE' );
		}
	}
}

if ( ! function_exists( 'site_promo' ) ) {

	/**
	 * Show the promo.
	 */
	function site_promo() {
		echo '
            <script>
            jQuery(document).ready( function() {
                    (function($) {
                            $("#site_promo .site_promo-close").click(function(){
                                    var data;
                                    // Hide it
                                    $("#site_promo").hide();

                                    // Save this preference
                                    $.post("' . esc_attr( admin_url( 'admin.php?site_promo=0' ) ) . '", data, function(response) {
                                            //alert(response);
                                    });
                            });
                    })(jQuery);
            });
            </script>
            <style>/* Promotional notice css*/
                .site_button {
                    background-color: #4CAF50; /* Green */
                    border: none;
                    color: white;
                    padding: 8px 16px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px 2px;
                    -webkit-transition-duration: 0.4s; /* Safari */
                    transition-duration: 0.4s;
                    cursor: pointer;
                }
                .site_button:focus{
                    border: none;
                    color: white;
                }
                .site_button1 {
                    color: white;
                    background-color: #4CAF50;
                    border:3px solid #4CAF50;
                }
                .site_button1:hover {
                    box-shadow: 0 6px 8px 0 rgba(0,0,0,0.24), 0 9px 25px 0 rgba(0,0,0,0.19);
                    color: white;
                    border:3px solid #4CAF50;
                }
                .site_button2 {
                    color: white;
                    background-color: #0085ba;
                }
                .site_button2:hover {
                    box-shadow: 0 6px 8px 0 rgba(0,0,0,0.24), 0 9px 25px 0 rgba(0,0,0,0.19);
                    color: white;
                }
                .site_button3 {
                    color: white;
                    background-color: #365899;
                }
                .site_button3:hover {
                    box-shadow: 0 6px 8px 0 rgba(0,0,0,0.24), 0 9px 25px 0 rgba(0,0,0,0.19);
                    color: white;
                }
                .site_button4 {
                    color: white;
                    background-color: rgb(66, 184, 221);
                }
                .site_button4:hover {
                    box-shadow: 0 6px 8px 0 rgba(0,0,0,0.24), 0 9px 25px 0 rgba(0,0,0,0.19);
                    color: white;
                }
                .site_promo-close {
                    float:right;
                    text-decoration:none;
                    margin: 5px 10px 0px 0px;
                }
                .site_promo-close:hover {
                    color: red;
                }
                </style>
                <div class="notice notice-success" id="site_promo" style="min-height:120px">
                        <a class="site_promo-close" href="javascript:" aria-label="Dismiss this Notice">
                                <span class="dashicons dashicons-dismiss"></span> Dismiss
                        </a>
                        <img src="' . esc_url( SITE_PLUGIN_URL ) . '/images/logo-200.png" style="float:left; margin:10px 20px 10px 10px" width="100" />
                        <p style="font-size:16px">' . esc_html__( 'We are glad you like', 'site-activity-log' ) . ' <strong>' . esc_html__( 'Site Activity Log', 'site-activity-log' ) . '</strong> ' . esc_html__( 'plugin and have been using it since the past few days. It is time to take the next step.', 'site-activity-log' ) . '</p>
                        <p>
                                <a class="site_button site_button1" target="_blank" href="http://useractivitylog.solwininfotech.com/#sitep_versions">' . esc_html__( 'Upgrade to Pro', 'site-activity-log' ) . '</a>
                                <a class="site_button site_button2" target="_blank" href="https://wordpress.org/support/plugin/site-activity-log/reviews/?filter=5">' . esc_html__( 'Rate it', 'site-activity-log' ) . " 5★'s" . '</a>
                                <a class="site_button site_button3" target="_blank" href="https://www.facebook.com/SolwinInfotech/">' . esc_html__( 'Like Us on Facebook', 'site-activity-log' ) . '</a>
                                <a class="site_button site_button4" target="_blank" href="https://twitter.com/home?status=' . rawurlencode( 'I use #useractivitylog to secure my #WordPress site - http://useractivitylog.solwininfotech.com/' ) . '">' . esc_html__( 'Tweet about Site Activity Log', 'site-activity-log' ) . '</a>
                        </p>
                </div>';
	}
}
