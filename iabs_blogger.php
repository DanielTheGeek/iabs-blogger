<?php 
// Make sure we don't expose any info if called directly
if ( ! function_exists( 'add_action' ) ) {
    exit('Hi there!  I\'m just a plugin, not much I can do when called directly.');
}

/**
 * Plugin Name: IABS Blogger
 * Plugin URI: https://iabs.scriptorigin.com/marketplace/iabs-blogger
 * Version: 1.0
 * Description: Advanced blogging tool for IABS
 * Author: Daniel Omoniyi
 * Author URI: https://danielthegeek.tk
 *
 * @package IABS Blogger
 */
class Iabs_blogger extends CI3_plugin_system
{
    use plugin_trait;

    public function __construct()
    {
        parent::__construct();

        $this->ci =& get_instance();

        add_action('after_settings_nav', [$this, 'show_sidebar_nav']);
        add_action('in_settings_nav', [$this, 'settings_nav']);
        add_action('plugin_message', [$this, 'plugin_message']);

        add_filter('iabs_page_title', [$this, 'app_page_title']);

        define( 'IABSB_VERSION', '1.1.0' );
        define( 'IABSB_MINIMUM_IABS_VERSION', '1.0' );
        define( 'IABSB_DIR', base_url().'application/_plugins/iabs_blogger/' );

        if (IABS_VERSION < IABSB_MINIMUM_IABS_VERSION) {
            add_action('plugin_message', [$this, 'compat']);
            $this->compat();
        }
    }

    // Install method. Called when plugin is installed
    public static function install( $data = NULL ) 
    {
        $options = [
            'table'     =>  'blog_posts',
            'fields'    =>  [
                'post_title' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255'
                ],
                'featured_image' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'null'       => TRUE
                ],
                'featured_image_thumb' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'null'       => TRUE
                ],
                'post_content' => [
                    'type' => 'LONGTEXT',
                    'null' => TRUE
                ],
                'post_short_content' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE
                ],
                'post_slug' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '20'
                ],
                'post_status' => [
                    'type'       => 'INT',
                    'constraint' => '1',
                    'default'    => '0' 
                ],
                'post_category' => [
                    'type'          => 'INT',
                    'constraint'    => '9'
                ],
                'post_timestamp' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255'
                ],
                'id' => [
                    'type'       => 'INT',
                    'constraint' => '9',
                ]
            ]
        ];

        create_table('iabs_blogger', $options);

        $options2 = [
            'table'     =>  'blog_categories',
            'fields'    =>  [
                'id' => [
                    'type'          => 'INT',
                    'constraint'    => '9'
                ],
                'cat_title' => [
                    'type'          => 'VARCHAR',
                    'constraint'    => '255',
                    'unique'        => TRUE
                ]
            ]
        ];

        create_table('iabs_blogger', $options2);

        $options3 = [
            'table'     =>  'blog_comments',
            'fields'    =>  [
                'id' => [
                    'type'       => 'INT',
                    'constraint' => '9',
                ],
                'comment_author' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '50'
                ],
                'comment_content' => [
                    'type' => 'LONGTEXT'
                ],
                'post_id' => [
                    'type'          => 'INT',
                    'constraint'    => '9'
                ],
                'timestamp' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255'
                ]
            ]
        ];

        create_table('iabs_blogger', $options3);

        $options4 = [
            'table'     =>  'site_gallery',
            'fields'    =>  [
                'id' => [
                    'type'       => 'INT',
                    'constraint' => '9',
                ],
                'picture_desc' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ],
                'timestamp' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'null'       => TRUE
                ],
                'picture' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255'
                ],
                'picture_thumb' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255'
                ]
            ]
        ];

        create_table('iabs_blogger', $options4);

        return true;
    }

    public static function table_created( $data = NULL )
    {
        // Do something when table is created
    }

    // Install method. Called when plugin is installed
    public static function uninstall( $data = NULL ) 
    {
        delete_table('iabs_blogger', 'blog_posts');
        delete_table('iabs_blogger', 'blog_categories');
        delete_table('iabs_blogger', 'site_gallery');

        return true;
    }

    // Activation method. Called when plugin is activated
    public static function activate( $data = NULL ) 
    {
        // Do something
    }

    public static function deactivate( $data = NULL ) 
    {
        // Do something
    }

    // Controller for plugin, used to manage the plugin, not required though.
    public function controller($data = NULL)
    {
        if ($this->ci->input->get('page')) {
            require 'includes/app.php';
            $this->app = new App;

            switch ($this->ci->input->get('page')) {
                case 'landing':
                    add_action('iabs_show_page', [$this->app, 'landing']);
                    break;
                
                case 'settings':
                    require 'includes/settings.php';
                    $this->settings = new Settings;

                    add_action('iabs_enqueue_footer_scripts', [$this, 'settings_script']);
                    add_action('iabs_show_page', [$this->settings, 'index']);
                    break;

                case 'new':
                    add_action('iabs_enqueue_css', [$this, 'app_style']);
                    add_action('iabs_show_page', [$this->app, 'new_post']);
                    add_action('iabs_enqueue_footer_scripts', [$this, 'app_scripts']);
                    break;

                case 'posts':
                    add_action('iabs_enqueue_css', [$this, 'app_style']);
                    add_action('iabs_show_page', [$this->app, 'index']);
                    add_action('iabs_enqueue_footer_scripts', [$this, 'app_scripts']);
                    break;

                case 'new-category':
                    add_action('iabs_enqueue_css', [$this, 'app_style']);
                    add_action('iabs_show_page', [$this->app, 'new_category']);
                    add_action('iabs_enqueue_footer_scripts', [$this, 'cat_script']);
                    break;

                case 'new-gallery-post':
                    require 'includes/gallery.php';
                    $this->gallery = new Gallery;

                    add_action('iabs_enqueue_css', [$this, 'app_style']);
                    add_action('iabs_show_page', [$this->gallery, 'index']);
                    add_action('iabs_enqueue_footer_scripts', [$this, 'cat_script']);
                    break;

                default:
                    show_404();
                    break;
            }
        } else {
            show_404();
        }
        return true;
    }

    // API controller for plugin
    public function api_controller($data = NULL)
    {
        if ($this->ci->input->get('endpoint')) {
            require 'includes/app.php';
            $this->app = new App;

            switch ( $this->ci->input->get('endpoint') ) {
                case 'new':
                    $this->app->new_post();
                    break;
                case 'new-category':
                    $this->app->new_category();
                    break;
                case 'do_new_gallery_post':
                    require 'includes/gallery.php';
                    $this->gallery = new Gallery;

                    $this->gallery->do_new_gallery_post();
                    break;
                default:
                    show_404();
                    break;
            }
        } else {
            show_404();
        }
        return true;
    }

    public function settings_script() {
        echo '<script src="'.IABSB_DIR.'assets/js/settings.js"></script>';
    }

    public function app_style() {
        echo '<link rel="stylesheet" href="'.IABSB_DIR.'assets/css/style.css">';
    }

    public function app_scripts() {
        echo '<script src="'.IABSB_DIR.'assets/js/vendor/ckeditor/ckeditor.js"></script>';
        echo '<script src="'.IABSB_DIR.'assets/js/vendor/jquery.form.min.js"></script>';
        echo '<script src="'.IABSB_DIR.'assets/js/app.js"></script>';
    }

    public function cat_script()
    {
        echo '<script src="'.IABSB_DIR.'assets/js/vendor/jquery.form.min.js"></script>';
        echo '<script src="'.IABSB_DIR.'assets/js/app.js"></script>';;
    }

    public function init() 
    {
        include_once('includes/app.php'); 
    }

    public function app_page_title() {
        if ( isset($_GET['page']) && uri_string() == 'plugins/iabs_blogger' ) {
            switch ($_GET['page']) {
                case 'landing':
                    echo "IABS Blogger | ";
                    break;
                case 'new':
                    echo "IABS Blogger - New Post | ";
                    break;
                case 'settings':
                    echo "IABS Blogger Settings | ";
                    break;
                case 'new-category':
                    echo "IABS Blogger - New Category | ";
                    break;
                case 'new-gallery-post':
                    echo "IABS Blogger - New Gallery Post | ";
                    break;
                default:
                    echo "IABS Blogger | ";
                    break;
            }
        }
    }

    public function settings_nav()
    {
        $content = '<li>
            <a href="'.site_url('plugins/iabs_blogger?page=settings').'">IABS Blogger Settings</a>
        </li>';
        echo $content;
    }

    public function show_sidebar_nav() 
    {
        $content = '<li>
            <a href="#"><i class="fa fa-pencil-square"></i>&nbsp;&nbsp;IABS Blogger<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="#"><i class="fa fa-files-o"></i>&nbsp;Posts <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level collapse" aria-expanded="false" style="">
                        <li>
                            <a href="'.site_url('plugins/iabs_blogger?page=new').'">New post</a>
                        </li>
                        <li>
                            <a href="'.site_url('containers/view/iabs_blog_posts').'">All posts</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i>&nbsp;Categories <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level collapse" aria-expanded="false" style="">
                        <li>
                            <a href="'.site_url('plugins/iabs_blogger?page=new-category').'">New category</a>
                        </li>
                        <li>
                            <a href="'.site_url('containers/view/iabs_blog_categories').'">All categories</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-file-picture-o"></i>&nbsp;Gallery <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level collapse" aria-expanded="false" style="">
                        <li>
                            <a href="'.site_url('plugins/iabs_blogger?page=new-gallery-post').'">New post</a>
                        </li>
                        <li>
                            <a href="'.site_url('containers/view/iabs_site_gallery').'">All posts</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="'.site_url('plugins/iabs_blogger?page=landing').'">About</a>
                </li>
            </ul>
        </li>';
        echo $content;
    }

    public function plugin_message() 
    {
         //   echo "<div class='panel-body'><div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-pencil fa-lg'></i>&nbsp;If you disabled the IABS Blogger due to a bug or issue please <a href='mailto://info@scriptorigin.com'>tell me</a> about it or use the <a href='https://iabs.scriptorigin.com/support'>support page</a>.</div></div>";
    }
    
    public function compat() 
    {
        echo "<div class='panel-body'><div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-pencil fa-lg'></i>&nbsp;Your copy of IABS Blogger (".IABSB_VERSION.") is not compatible with your version of IABS (".IABS_VERSION.")</div></div>";
    }

    public function add_javascript()
    {
    }

}