<?php
class Athena_Social{
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

    public function __construct()
    {
        if (defined('PLUGIN_NAME_VERSION')) {
            $this->version = PLUGIN_NAME_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'athena-social';

        $this->load_dependencies();
    }

    //load_dependencies
    public function load_dependencies(){
        require PLUGIN_DIR ."admin/athena-social-admin.php";
        $social_admin = new Athena_Social_Admin($this->plugin_name, $this->version);
    }
}