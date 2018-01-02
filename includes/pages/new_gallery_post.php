<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New Gallery Post</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="iabs_blogger?page=landing">IABS Blogger</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('containers/view/iabs_site_gallery') ?>">Gallery</a></li>
                <li class="breadcrumb-item"><span>New post</span></li>
            </ul>
            <div class="content-i">
                <div class="content-box">
                    <div class="element-wrapper">
                        <h6 class="element-header">Create new gallery post</h6>
                        <div class="panel-body">
                            <?= form_open_multipart('', 'id="new-gallery-post"') ?>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="desc" rows="3"></textarea>
                                    <p class="help-block">Short description of the image (not required).</p>
                                </div>
                                <div id="response"></div>
                                <button type="submit" name="submit" class="btn btn-primary">Publish</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>