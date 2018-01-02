<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New Category</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="iabs_blogger?page=landing">IABS Blogger</a></li>
                <li class="breadcrumb-item"><span>New Category</span></li>
            </ul>
            <div class="content-i">
                <div class="content-box">
                    <div class="element-wrapper">
                        <h6 class="element-header">Create new blog entry</h6>
                        <div class="panel-body">
                            <?= form_open('plugins/iabs_blogger?page=new-category', 'id="new-category"') ?>
                                <div class="form-group">
                                    <label>Category Title</label>
                                    <input name="cat_title" class="form-control" type="text">
                                    <p class="help-block">e.g: Humanity</p>
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