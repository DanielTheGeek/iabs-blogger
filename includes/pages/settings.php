<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">IABS Blogger Settings</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3">
        <div class="panel" style="<?= 'background-image: url('.IABSB_DIR.'assets/img/bg.jpg);' ?>">
            <div class="panel-heading">
                <div class="row" style="color: #fff;">
                    <div class="col-xs-3">
                        <i class="fa fa-tint fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= IABSB_VERSION ?></div>
                        <div>IABS Blogger Version</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Basic Settings
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form">
                            <div class="form-group">
                                <label>Allowed user groups</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="developers">Developers
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="project_managers">Project Managers
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="designers">Designers
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Team members
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>File Manager Features</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="developers">Ajax Upload
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="project_managers">Folder creation
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="designers">File creation
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Allow file editing
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Allow file renaming
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Allow file extraction
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Allow file upload
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Allow remote file upload
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Allow file deletion
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Allow file copying/moving
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Require file manager authentication
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Allow file editing
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Show file size
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Advanced Settings
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="developers">Show last modified
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="project_managers">Show file size
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="designers">Display owner
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Show group
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Show permissions
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Show <code>.htdocs</code> files
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="members">Show hidden files
                                    </label>
                                </div>
                            </div>
                        </form>
                        <label>Authentication settings</label>
                        <form>
                            <div class="form-group">
                                <input class="form-control" name="fm_uname" placeholder="File Manager username">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="fm_pass" placeholder="File Manager password">
                            </div>
                            <div style="margin: 0 auto; width: 25%;">
                                <button type="submit" class="btn btn-primary">Save Auth Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>
<!-- /.row -->