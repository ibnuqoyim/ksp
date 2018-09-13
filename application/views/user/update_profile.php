<div class="content">
    <div class="row">
        <div class="col-lg-12">
			<?=$this->session->flashdata('pesan')?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="caption">Edit Profile</div>
                </div>

                <div class="panel-body">
                	<form action="<?=site_url('users/process_update_profile')?>" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post">
                    	<div class="form-body">
                        	<div class="form-group">
                            	<label class="col-md-3 control-label" for="InputText">Username</label>
                                <div class="col-md-6">
                                	<input id="username" name="username" class="form-control " type="text" value="<?=$detail['username']?>" readonly="readonly">
                                </div>
                            
                            </div>
                        	<div class="form-group">
                            	<label class="col-md-3 control-label" for="InputText">Name</label>
                                <div class="col-md-6">
                                	<input id="name" name="name" class="form-control " placeholder="Name" type="text" value="<?=$detail['name']?>" >
                                </div>
                            
                            </div>
                        	<div class="form-group">
                            	<label class="col-md-3 control-label" for="InputText">Email</label>
                                <div class="col-md-6">
                                	<input id="email" name="email" class="form-control " placeholder="Email" type="text" value="<?=$detail['email']?>" >
                                </div>
                            </div>
                        	<div class="form-group">
                            	<label class="col-md-3 control-label" for="InputText">Gender</label>
                                <div class="col-md-6">
                                <?php
                                $gender = array('Laki-laki' => 'Laki-laki','Perempuan' => 'Perempuan');
								
								echo form_dropdown('gender',$gender,$detail['gender'],'id="gender" class="selectpicker form-control input-small" ');?>
                                </div>
                            </div>
                        	<div class="form-group">
                            	<label class="col-md-3 control-label" for="InputText">Handphone/Telepone </label>
                                <div class="col-md-6">
                                	<input id="hp" name="hp" class="form-control " type="text" placeholder="Handphone/Telepone" maxlength="100" value="<?=$detail['hp']?>">
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


</div>

