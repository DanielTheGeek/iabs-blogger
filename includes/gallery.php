<?php 
    /**
    * Gallery class
    */
    class Gallery
    {
        function __construct()
        {
            $this->ci =& get_instance();
        }

        public function index()
        {
            require 'pages/new_gallery_post.php'; 
        }

        public function do_new_gallery_post()
        {
            if ( $this->ci->input->is_ajax_request() && isset($_POST['submit']) ) {
                $this->ci->load->helper('string');

                $config['upload_path']   = './src/images/gallery';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = 5048;

                $this->ci->load->library('upload', $config);

                if ( ! $this->ci->upload->do_upload('image') ) {
                    echo '<div class="btn-danger btn-sm">'.$this->ci->upload->display_errors().'</div>';
                } else {
                    $desc = ( $this->ci->input->post('desc') ) ? $this->ci->input->post('desc') : '';
                    $data = $this->ci->upload->data();
                    $file_path = 'src/images/gallery/'.$data['file_name'];
                    $id = random_string( 'numeric', 9 );

                    $thumb_path = ( empty($file_path) ? 'src/images/gallery/default.jpg' : 'src/images/gallery/'.$data['raw_name'].'_thumb'.$data['file_ext'] );

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $data['full_path'];
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['height']       = 400;

                    $this->ci->load->library('image_lib', $config);
                    
                    if ( ! $this->ci->image_lib->resize())
                    {
                        echo $this->ci->image_lib->display_errors();
                    }

                    $options = [
                        'table' =>  'site_gallery',
                        'data'  =>  [
                            'id'      => $id,
                            'picture' => $file_path,
                            'picture_thumb' => $thumb_path,
                            'picture_desc' => $desc,
                            'timestamp' => date('D, d M Y', time())
                        ]
                    ];

                    $resp = post_data('iabs_blogger', $options);

                    if ( $resp ) {
                        echo "true";
                    } else {
                        echo "Unable to create post due to a technical fault, please contact the developers";
                    }
                }
            } else {
                show_404();
            }
        }
    }