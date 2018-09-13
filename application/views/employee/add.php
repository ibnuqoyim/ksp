<div class="row">
    <div class="col-lg-12">
    	<div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Tambah <?=$this->title?></h4>
            </div>

            <div class="panel-body">
                <form action="<?=site_url($this->func.'s/add_process')?>" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Nama <span class="require">*</span> :</label>
                            <div class="col-md-6">
                                <input id="name" name="name" class="form-control" type="text" placeholder="Nama" maxlength="150">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Jenis Kelamin <span class="require">*</span> :</label>
                            <div class="col-md-6">
                            <?php
                            $gender = array('Laki-laki' => 'Laki-laki','Perempuan' => 'Perempuan');
                            
                            echo form_dropdown('gender',$gender,'','id="gender" class="select2-size  form-control input-small" ');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Jabatan :</label>
                            <div class="col-md-6">
                                <input id="position" name="position" class="form-control" type="text" placeholder="Jabatan" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Email :</label>
                            <div class="col-md-6">
                                <input id="email" name="email" class="form-control" type="text" placeholder="Email" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Hp :</label>
                            <div class="col-md-6">
                                <input id="hp" name="hp" class="form-control" type="text" placeholder="Hp" maxlength="20">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Tempat, Tgl Lahir :</label>
                            <div class="col-md-4">
                                <input id="birthplace" name="birthplace" class="form-control" type="text" placeholder="Tempat lahir" maxlength="80">
                            </div>
                            <div class="col-md-2">
                                <input id="birthdate" name="birthdate" type="text" placeholder="dd/mm/yyyy" class="date-picker form-control input-small"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Alamat :</label>
                            <div class="col-md-6">
                            	<textarea name="address" id="address" class="form-control" placeholder="Alamat"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Foto :</label>
                            <div class="col-md-6">

                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-group">
                                        <div class="form-control uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i> 
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <div class="input-group-btn">
                                            <a class="btn bun-default btn-file">
                                                <span class="fileupload-new">Pilih file</span>
                                                <span class="fileupload-exists">Ganti</span>
                                                <input type="file" name="photo" id="photo" class="file-input">
                                            </a>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                                <span><em>Extensi : PNG, JPG, GIF</em></span>
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
            <a href="<?=site_url($this->func.'s')?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>


