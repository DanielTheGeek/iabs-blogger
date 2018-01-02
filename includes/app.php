<?php 
    /**
    * App class
    */
    class App
    {
        function __construct()
        {
            $this->ci =& get_instance();
        }

        public function new_post()
        {
            if ( $this->ci->input->is_ajax_request() && isset($_POST['submit']) || isset($_POST['draft']) ) {
                $title = ( $this->ci->input->post('post_title') ) ? $this->ci->input->post('post_title') : '';
                $category = ( $this->ci->input->post('category') ) ? $this->ci->input->post('category') : '';
                $content = ( $this->ci->input->post('content') ) ? $this->ci->input->post('content') : '';
                $featured_image = ( $this->ci->input->post('featured_image') ) ? $this->ci->input->post('featured_image') : '';

                if ( empty($title) ) {
                    die("Please enter a title");
                } elseif ( empty($category) ) {
                    echo "Select a category";
                } elseif ( empty($content) ) {
                    echo "Please enter some content";
                } else {
                    $upload_config['upload_path']   = './src/images/blog';
                    $upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $upload_config['max_size']      = 5048;

                    $this->ci->load->library('upload', $upload_config);
                    $this->ci->load->helper('string');
                    $this->ci->load->helper('text');

                    $file_path = 'src/images/blog/default.jpg';
                    $thumb_path = 'src/images/blog/default.jpg';
                    $data = '';

                    if ( ! empty($_FILES['featured_image']['name']) ) {
                        $upload = $this->ci->upload->do_upload('featured_image');

                        if ( ! $upload ) {
                            echo '<div class="btn-danger btn-sm">'.$this->ci->upload->display_errors().'</div>';
                        } else {
                            $data = $this->ci->upload->data();
                            $file_path = 'src/images/blog/'.$data['file_name'];
                            $thumb_path = ( is_array($data) && array_key_exists('file_name', $data) ) ? 'src/images/blog/'.$data['raw_name'].'_thumb'.$data['file_ext'] : 'src/images/blog/default.jpg';
        
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $data['full_path'];
                            $config['create_thumb'] = TRUE;
                            $config['maintain_ratio'] = FALSE;
                            $config['height']       = 300;

                            $this->ci->load->library('image_lib', $config);
                            
                            if ( ! $this->ci->image_lib->resize())
                            {
                                echo $this->ci->image_lib->display_errors();
                            }
                        }
                    }

                    $id = random_string('numeric', 9); 
                    $slug = str_replace( ' ', '-', strtolower(word_limiter($title, 10, '')) );
                    $post_short_content = word_limiter(strip_tags($content), 10, '&#8230');
                    $status = ( isset($_POST['draft']) ) ? '0' : '1';

                    $options = [
                        'table' =>  'blog_posts',
                        'data'  =>  [
                            'id'            =>  $id,
                            'post_title'    =>  $title,
                            'featured_image'=>  $file_path,
                            'featured_image_thumb'=> $thumb_path,
                            'post_slug'     =>  $slug,
                            'post_category' =>  $category,
                            'post_content'  =>  $content,
                            'post_short_content'=>  $post_short_content,
                            'post_timestamp'=>  date('D, d M Y', time()),
                            'post_status'   =>  $status
                        ]
                    ];

                    $resp = post_data('iabs_blogger', $options);

                    if ( $resp ) {
                        echo "true";
                    }
                }
            } else {
                $options = [
                    'type'  =>  'default',
                    'fetch' =>  [
                        'table' =>  'blog_categories',
                        'row'   =>  '*'
                    ]
                ];

                $fetch = get_data('iabs_blogger', $options);
                $categories = '';
    
                require 'pages/new_post.php'; 
            }
        }

        public function new_category()
        {
            if ( $this->ci->input->is_ajax_request() && isset($_POST['submit']) ) {
                // Load form validation library
                $this->ci->load->library('form_validation');

                $config = [
                    [
                        'field' => 'cat_title',
                        'label' => 'Category title',
                        'rules' => 'required|is_unique[iabs_blog_categories.cat_title]',
                        'errors' => array(
                            'is_unique' => '%s already exists.',
                        )
                    ]
                ];

                $this->ci->form_validation->set_rules($config);

                if ($this->ci->form_validation->run() == FALSE)
                {
                    $this->ci->form_validation->set_error_delimiters('<span class="btn-sm btn-danger">', '</span><br><br>');
                    echo validation_errors();
                }
                else
                {
                    // Generate an ID for the category
                    $this->ci->load->helper('string');
                    $id = random_string( 'numeric', 9 );

                    $cat_title = $this->ci->db->escape_str( $this->ci->input->post('cat_title') );

                    $options = [
                        'table' =>  'blog_categories',
                        'data'  =>  [
                            'id'        => $id,
                            'cat_title' => $cat_title
                        ]
                    ];

                    $resp = post_data('iabs_blogger', $options);

                    if ( $resp ) {
                        echo "true";
                    } else {
                        echo "Unable to create category due to a technical fault, please contact the developers";
                    }
                }
            } else {
                require 'pages/new_category.php'; 
            }
        }

        public function landing()
        {
            require 'pages/landing.php';
        }
    }