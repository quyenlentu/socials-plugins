<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="wrap">
    <h2><?php echo __('Social wall', TEXT_DOMAIN); ?></h2>
    <h2 class="nav-tab-wrapper admintabs">
        <a href="/wp-admin/admin.php?page=athena-social&tab=1" class="nav-tab <?php if(isset($_GET['tab']) && $_GET['tab'] == 1): ?>nav-tab-active current<?php endif; ?>">
            Gestion des libellés
        </a>
        <a href="/wp-admin/admin.php?page=athena-social&tab=2" class="nav-tab <?php if(isset($_GET['tab']) && $_GET['tab'] == 2): ?>nav-tab-active current<?php endif; ?>">
            Synchroniser
        </a>
    </h2>
    <?php
    if(isset($_GET['tab']) && $_GET['tab'] == 2){
        $this->getApiResults();
    }else {
        ?>
        <form method="post" action="options.php">
            <?php settings_fields('athena-social-group'); ?>
            <?php do_settings_sections('athena-social-group'); ?>
            <div class="asocial_wrapper">
                <h3><?php echo __('Facebook', TEXT_DOMAIN); ?></h3>
                <div class="input">
                    <label for=""><?php echo __('PageID', TEXT_DOMAIN); ?></label>
                    <input type="text" class="asocial_input" name="facebook_page_id"
                           value="<?php echo esc_attr(get_option('facebook_page_id')); ?>">
                </div>
                <div class="input">
                    <label for=""><?php echo __('Access ToKen', TEXT_DOMAIN); ?></label>
                    <input type="text" class="asocial_input" name="facebook_access_token"
                           value="<?php echo esc_attr(get_option('facebook_access_token')); ?>">
                </div>
                <h3><?php echo __('Youtube', TEXT_DOMAIN); ?></h3>

                <div class="input">
                    <label for=""><?php echo __('API Key', TEXT_DOMAIN); ?></label>
                    <input type="text" class="asocial_input" name="youtube_api_key"
                           value="<?php echo esc_attr(get_option('youtube_api_key')); ?>">
                </div>
                <div class="input">
                    <label for=""><?php echo __('PlaylistId', TEXT_DOMAIN); ?></label>
                    <input type="text" class="asocial_input" name="youtube_listID"
                           value="<?php echo esc_attr(get_option('youtube_listID')); ?>">
                </div>
                <h3><?php echo __('Instagram', TEXT_DOMAIN); ?></h3>

                <div class="input">
                    <label for=""><?php echo __('ClientId', TEXT_DOMAIN); ?></label>
                    <input type="text" class="asocial_input"
                           value="<?php echo esc_attr(get_option('new_option_name')); ?>">
                </div>
                <div class="input">
                    <label for=""><?php echo __('ClientSecret', TEXT_DOMAIN); ?></label>
                    <input type="text" class="asocial_input"
                           value="<?php echo esc_attr(get_option('new_option_name')); ?>">
                </div>
                <h3><?php echo __('Twitter', TEXT_DOMAIN); ?></h3>

                <div class="input">
                    <label for=""><?php echo __('Consumer Key', TEXT_DOMAIN); ?></label>
                    <input type="text" class="asocial_input" name="twitter_consumer_key"
                           value="<?php echo esc_attr(get_option('twitter_consumer_key')); ?>">
                </div>
                <div class="input">
                    <label for=""><?php echo __('Consumer Secret', TEXT_DOMAIN); ?></label>
                    <input type="text" class="asocial_input" name="twitter_consumer_secret"
                           value="<?php echo esc_attr(get_option('twitter_consumer_secret')); ?>">
                </div>
                <div class="input">
                    <label for=""><?php echo __('Tags', TEXT_DOMAIN); ?></label>
                    <input type="text" class="asocial_input" name="twitter_tags"
                           value="<?php echo esc_attr(get_option('twitter_tags')); ?>">
                </div>
            </div>
            <div class="submitFormField">
                <input type="submit" name="valider" value="<?php echo __('Save', TEXT_DOMAIN); ?>"
                       class="button-primary">
            </div>
        </form>
        <?php
    }
    ?>
</div>