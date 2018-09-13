<div class="row">
    <div class="col-lg-12">
    	<div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Tambah User</h4>
            </div>

            <div class="panel-body">
                <form action="<?=site_url('users/add_process')?>" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Role <span class="require">*</span></label>
                            <div class="col-md-6">
                            <?php echo form_dropdown('roleid',$role,'','id="roleid" class="select2-size form-control" ');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Pegawai <span class="require">*</span></label>
                            <div class="col-md-6">
                            <?php echo form_dropdown('employeeid',$employee,'','id="employeeid" class="select2-size form-control" ');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Username <span class="require">*</span></label>
                            <div class="col-md-6">
                                <input id="username" name="username" class="form-control " type="text" placeholder="Username" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Password <span class="require">*</span></label>
                            <div class="col-md-6">
                                <input id="password" name="password" class="form-control " type="password" placeholder="Password" maxlength="100" minlength="5">
                            </div>
                        
                        </div>
                        <div class="form-group">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <button class="btn btn-success btn-outlined" type="submit"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>

<div class="row">
    <div class="col-lg-1">
        <div class="panel">
            <a href="<?=site_url('users')?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>

