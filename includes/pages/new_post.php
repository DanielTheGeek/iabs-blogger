<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New Post</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="iabs_blogger?page=landing">IABS Blogger</a></li>
                <li class="breadcrumb-item"><span>New Post</span></li>
            </ul>
            <div class="content-i">
                <div class="content-box">
                    <div class="element-wrapper">
                        <h6 class="element-header">Create new blog entry</h6>
                        <div class="panel-body">
                            <?= form_open_multipart('plugins/iabs_blogger?page=new', 'id="new-post"') ?>
                                <div class="form-group">
                                    <label>Post Title</label>
                                    <input name="post_title" class="form-control" type="text">
                                    <p class="help-block">e.g: The effects of global warming.</p>
                                </div>
                                <div class="form-group">
                                    <label>Featured Image</label>
                                    <input type="file" name="featured_image" accept=".jpg,.jpeg,.png,.gif" class="form-control">
                                    <p class="help-block">Preview image.</p>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category" class="form-control">
                                        <?php
                                            if ( $fetch ) {
                                                foreach ($fetch as $key) 
                                                {
                                                    $id = $key['id'];
                                                    $title = $key['cat_title'];
                                                    $categories = "<option value='$id'>$title</option>";

                                                    echo $categories;
                                                }
                                            } else {
                                                $categories = "<option selected='' disabled=''>Please create a category first</option>";

                                                echo $categories;
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <p class="help-block">Enter the post content below.</p>
                                    <textarea id="post-content" name="content" rows="10"></textarea>
                                </div>
                                <div id="response"></div>
                                <button type="submit" name="submit" class="btn btn-primary">Publish</button>
                                <button type="submit" name="draft" class="btn btn-default">Save draft</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>