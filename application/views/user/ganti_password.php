<div class="box-content">
    <div class="row">
        <div class="col-md-12">
            <?=$this->session->flashdata('pesan')?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-title">
                <h3><i class="fa fa-lock"></i>Ganti Password</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-md-12">


                	<form action="<?=site_url('users/process_ganti_password')?>" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post">
                    	<div class="form-body">
                        	<div class="form-group">
                            	<label class="col-md-3 control-label" for="InputText">Username</label>
                                <div class="col-md-6">
                                	<input id="username" name="username" class="form-control " type="text" value="<?=$this->session->userdata('username')?>" readonly="readonly">
                                </div>
                            
                            </div>
                        	<div class="form-group">
                            	<label class="col-md-3 control-label" for="InputText">Password Saat Ini<span class="require">*</span></label>
                                <div class="col-md-6">
                                	<input id="password_lama" name="password_lama" class="form-control " type="password" placeholder="Password Saat Ini" maxlength="100" minlength="5">
                                </div>
                            
                            </div>

                        	<div class="form-group">
                            	<label class="col-md-3 control-label" for="InputText">Password Baru<span class="require">*</span></label>
                                <div class="col-md-6">
                                	<input id="password_baru" name="password_baru" class="form-control " type="password" placeholder="Password Baru" maxlength="100" minlength="5">
                                </div>
                            
                            </div>

                        	<div class="form-group">
                            	<label class="col-md-3 control-label" for="InputText">Konfirmasi Password Baru<span class="require">*</span></label>
                                <div class="col-md-6">
                                	<input id="conf_password_baru" name="conf_password_baru" class="form-control " type="password" placeholder="Konfirmasi Password Baru" maxlength="100" minlength="5">
                                </div>
                            
                            </div>
                        	<div class="form-group">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <button class="btn btn-success btn-outlined" type="submit"><i class="fa fa-save"></i> Change</button>
                                </div>
                            
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

