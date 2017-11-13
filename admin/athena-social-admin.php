<?php
class Athena_Social_Admin{
    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    public function __construct($plugin_name, $version){
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $this->load_admin();
    }

    public function load_admin(){
        add_action('admin_menu', array($this, 'add_menu'));
        add_action( 'admin_enqueue_scripts', array($this, 'load_assets') );
        add_action( 'admin_init', array($this, 'athena_social_settings') );
    }

    //load plugin menu
    public function add_menu(){
        // Create our settings page as a submenu page.
        add_menu_page(         // parent slug
            __('Socials', TEXT_DOMAIN),      // page title
            __('Socials', TEXT_DOMAIN),      // menu title
            'manage_options',                        // capability
            'athena-social',                           // menu_slug
            array($this, 'display_settings_page')  // callable function
        );
    }

    //template menus
    public function display_settings_page(){
        /*if(isset($_GET['tab']) && $_GET['tab'] == 2){
            $this->getApiResults();
        }else{*/
            require_once plugin_dir_path(dirname(__FILE__)).'admin/templates/athena-social-admin-display.php';
        //}
    }

    //load asstes in plugin
    public function load_assets(){
        wp_register_style( 'athena_social_admin', plugins_url('css/athena-social-admin.css',__FILE__ ), false, '1.0.0' );
        wp_enqueue_style( 'athena_social_admin' );
    }

    public function athena_social_settings() {
        //register our settings
        register_setting( 'athena-social-group', 'facebook_page_id' );
        register_setting( 'athena-social-group', 'facebook_access_token' );
        register_setting( 'athena-social-group', 'youtube_api_key' );
        register_setting( 'athena-social-group', 'youtube_listID' );
        register_setting( 'athena-social-group', 'twitter_consumer_key' );
        register_setting( 'athena-social-group', 'twitter_consumer_secret' );
        register_setting( 'athena-social-group', 'twitter_tags' );
    }

    public function getApiResults(){
        /*if(get_option('facebook_access_token') && get_option('facebook_page_id')){
            echo "<h3>".__('Facebook', TEXT_DOMAIN)."</h3>";
            $facebook_access_token = get_option('facebook_access_token');
            $facebook_page_id = get_option('facebook_page_id');
            require_once PLUGIN_DIR."api/facebook/Athena_Facebook_Api.php";
            $facebook = new Athena_Facebook_Api();
            $facebook->getResults($facebook_page_id, $facebook_access_token);
        }*/
        if(get_option('youtube_api_key') && get_option('youtube_listID')){
            echo "<h3>".__('Youtube', TEXT_DOMAIN)."</h3>";
            $youtube_api_key = get_option('youtube_api_key');
            $youtube_listID = get_option('youtube_listID');
            require_once PLUGIN_DIR."api/youtube/Athena_Youtube_Api.php";
            $facebook = new Athena_Youtube_Api();
            $facebook->getResults($youtube_listID, $youtube_api_key);
        }
    }
}