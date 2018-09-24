<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Data <?=$this->title?></h4>
            </div>

            <div class="panel-body">
                <form action="<?=site_url($this->func.'s/edit_process/id/'.$this->uri->segment(4))?>" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">No. Anggota <span class="require">*</span> :</label>
                            <div class="col-md-8">
                                <input value="<?=$result['no_member']?>" class="form-control" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">NIK <span class="require">*</span> :</label>
                            <div class="col-md-8">
                                <input id="nik" name="nik" class="form-control" type="text" placeholder="NIK" maxlength="150">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">NPWP <span class="require">*</span> :</label>
                            <div class="col-md-8">
                                <input id="npwp" name="npwp" class="form-control" type="text" placeholder="NPWP" maxlength="150">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Nama <span class="require">*</span> :</label>
                            <div class="col-md-8">
                                <input id="name" name="name" class="form-control" type="text" placeholder="Nama" maxlength="150" value="<?=$result['name']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Jenis Kelamin <span class="require">*</span> :</label>
                            <div class="col-md-8">
                            <?php
                            $gender = array('Laki-laki' => 'Laki-laki','Perempuan' => 'Perempuan');
                            
                            echo form_dropdown('gender',$gender,$result['gender'],'id="gender" class="select2-size  form-control input-small" ');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Tempat, Tgl Lahir :</label>
                            <div class="col-md-5">
                                <input id="birthplace" name="birthplace" class="form-control" type="text" placeholder="Tempat lahir" maxlength="80" value="<?=$result['birthplace']?>">
                            </div>
                            <div class="col-md-3">
                                <input id="birthdate" name="birthdate" type="text" placeholder="dd/mm/yyyy" class="date-picker form-control input-small" value="<?=format_datepicker($result['birthdate'])?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Status hubungan  :</label>
                            <div class="col-md-8">
                            <?php
                            $relationship = array('Sendiri' => 'Sendiri','Menikah' => 'Menikah');
                            
                            echo form_dropdown('relationship',$relationship,$result['relationship'],'id="relationship" class="select2-size  form-control input-small" ');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Nama pasangan  :</label>
                            <div class="col-md-8">
                                <input id="partner" name="partner" class="form-control" type="text" placeholder="Nama pasangan" maxlength="150" value="<?=$result['partner']?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Nama ahli waris  :</label>
                            <div class="col-md-8">
                                <input id="heir" name="heir" class="form-control" type="text" placeholder="Nama ahli waris" maxlength="150" value="<?=$result['heir']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Alamat (ktp) :</label>
                            <div class="col-md-8">
                                <textarea name="address" id="address" class="form-control" placeholder="Alamat (ktp)"><?=$result['address']?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Alamat (saat ini) :</label>
                            <div class="col-md-8">
                                <textarea name="current_address" id="current_address" class="form-control" placeholder="Alamat (saat ini)"><?=$result['current_address']?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Telepon :</label>
                            <div class="col-md-8">
                                <input id="phone" name="phone" class="form-control" type="text" placeholder="Telepon" maxlength="20" value="<?=$result['phone']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Hp :</label>
                            <div class="col-md-8">
                                <input id="hp" name="hp" class="form-control" type="text" placeholder="Hp" maxlength="20" value="<?=$result['hp']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Nama perusahaan <span class="require">*</span> :</label>
                            <div class="col-md-8">
                            <?php
                            echo form_dropdown('companyid',$company,$result['companyid'],'id="companyid" class="select2-size  form-control input-small" ');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Tanggal gabung di perusahaan  :</label>
                            <div class="col-md-8">
                                <input id="join_date" name="join_date" type="text" placeholder="dd/mm/yyyy" class="date-picker form-control input-small" value="<?=format_datepicker($result['join_date'])?>"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Jabatan :</label>
                            <div class="col-md-8">
                                <input id="position" name="position" class="form-control" type="text" placeholder="Jabatan" maxlength="50" value="<?=$result['position']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Jabatan :</label>
                            <div class="col-md-8">
                                <input id="position" name="position" class="form-control" type="text" placeholder="Jabatan" maxlength="50">
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
            <a href="<?=site_url($this->func.'s/detail/id/'.$this->uri->segment(4))?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>

