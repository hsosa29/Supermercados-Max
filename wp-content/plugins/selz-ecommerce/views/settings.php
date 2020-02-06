<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
?>

<form action="options.php" method="post" id="settings" class="selz selz-settings">
    <?php
    settings_fields( selz()->slug . '_settings' );
    $options = get_option( selz()->slug . '_settings' );
    ?>

    <div class="container container--narrow">
        <div class="panel margin-top-4 margin-bottom-2">
            <div class="padding-6">
                <div class="text-center padding-4">
                    <img class="align-middle" src="<?php echo plugins_url( '../dist/img/svg/logo.svg?v=' . selz()->version, __FILE__ ); ?>" alt="Selz logo" width="150" height="54">

                    <?php if (!selz()->api->is_connected()) { ?>

                        <h4 class="margin-top-4"><?php printf( __( 'Connect your %s account to WordPress', selz()->lang ), selz()->name ); ?></h4>

                        <a href="<?php echo esc_url( selz()->api->connect_url() ); ?>" class="btn btn-primary padding-left-4 padding-right-4">
                            <?php _e( 'Connect', selz()->lang ); ?>
                        </a>

                        <small class="help-block margin-top-4">
                            <?php printf( __( 'You will be redirected to sign into your %s account and accept permissions to allow WordPress to access your %s account', selz()->lang ), selz()->name, selz()->name ); ?>
                        </small>

                    <?php } else {
                        $store = selz()->api->get_store();
                        ?>

                        <p><?php printf(
                            __( 'Connected to %s. %s', selz()->lang ),
                            '<strong>' . $store->display_name . '</strong>',
                            '<a href="' . esc_url( selz()->api->disconnect_url() ) . '">' . __( 'Disconnect', selz()->lang ) . '</a>'
                        ); ?></p>

                        <a href="<?php echo esc_url( selz()->home ); ?>dashboard/" target="_blank" class="btn"><?php _e( 'Go to Selz dashboard', selz()->lang ); ?></a>
                    <?php } ?>
                </div>

                <?php if (selz()->api->is_connected()) { ?>
                    <label for="<?php echo selz()->slug . "_display_cart" ?>" class="padding-top-4">
                        <?php
                        $checked = '';
                        if ( isset( $options['display_cart'] ) && $options['display_cart'] == 'on' ) {
                            $checked = 'checked';
                        }
                        echo "<input type='checkbox' id='" . selz()->slug . "_display_cart' name='" . selz()->slug . "_settings[display_cart]' ".$checked." onchange='document.forms.settings.submit()'>";
                        ?>
                        <?php _e( 'Shopping Cart', selz()->lang ); ?>
                        <small class="help-block"><?php _e( 'Display the shopping cart on all pages of your website.', selz()->lang ); ?></small>
                    </label>

                    <div class="alert margin-top-4 padding-top-3 padding-bottom-3 padding-left-4 padding-right-4 text-center">
                        <?php printf(
                            __( 'Read our %s on how to get the best out of your %s WordPress plugin.', selz()->lang ),
                            '<a href="' . admin_url() . 'admin.php?page=' . selz()->slug . '_help">' . __( 'guide', selz()->lang ) . '</a>',
                            selz()->name
                        ); ?>
                    </div>
                <?php } else { ?>
                    <aside class="padding-top-4">
                        <div>
                            <h4 class="margin-bottom-1"><?php printf( __( 'Need a %s account?', selz()->lang ), selz()->name ); ?></h4>
                            <p class="margin-0"><?php printf( __( 'Try %s free for 14 days. No risk and no credit card required.', selz()->lang ), selz()->name ); ?></p>
                        </div>
                        <a href="<?php echo esc_url( selz()->signup ); ?>" target="_blank" class="btn btn-primary"><?php _e( 'Start free trial', selz()->lang ); ?></a>
                    </aside>
                <?php } ?>
            </div>
        </div>
        <?php include( selz()->dir . '/includes/env.php' ); ?>
        <?php include( selz()->dir . '/includes/version.php' ); ?>
    </div>
</form>
