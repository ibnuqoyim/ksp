<div class="row">
    <div class="col-lg-12">
        <?=$this->session->flashdata('pesan')?>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="panel panel-primary">

            <div class="panel-heading">
                <h4 class="panel-title">Data Pribadi</h4>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <?php
                        if($result['gender']=='Laki-laki'){
                            $photo = 'Male.png';
                        } else {
                            $photo = 'Female.png';
                        }
                        if($result['photo']){
                            $photo = $result['photo'];
                        }
                        ?>
                        <img class="img-responsive img-thumbnail" src="<?=base_url('template/images/anggota/'.$photo)?>" alt="profile picture"/>
                        <br/><br/>
                    </div>
                    <div class="col-md-12 user-profile-info">
                        <p>
                            <span>No. Anggota :</span> <?=$result['no_member']?>
                        </p>
                        <p>
                            <span>Nama :</span> <?=$result['name']?>
                        </p>
                        <p>
                            <span>NIK :</span> <?=$result['nik']?>
                        </p>
                        <p>
                            <span>NPWP :</span> <?=$result['npwp']?>
                        </p>
                        <p>
                            <span>Jenis Kelamin :</span> <?=$result['gender'] ? $result['gender'] : '-'?>
                        </p>
                        <p>
                            <span>Tempat, Tgl Lahir :</span> <?=$result['birthplace'] ? $result['birthplace'] : '-'?>, <?=$result['birthdate'] ? format_datepicker($result['birthdate']) : '-'?>
                        </p>

                        <p>
                            <span>Status hubungan :</span> <?=$result['relationship'] ? $result['relationship'] : '-'?>
                        </p>
                        <p>
                            <span>Nama pasangan :</span> <?=$result['partner'] ? $result['partner'] : '-'?>
                        </p>
                        <p>
                            <span>Nama ahli waris :</span> <?=$result['heir'] ? $result['heir'] : '-'?>
                        </p>
                        <p>
                            <span>Alamat (ktp) :</span> <?=$result['address'] ? nl2br($result['address']) : '-'?>
                        </p>
                        <p>
                            <span>Alamat (saat ini) :</span> <?=$result['current_address'] ? nl2br($result['current_address']) : '-'?>
                        </p>
                        <p>
                            <span>Telepon :</span> <?=$result['phone'] ? $result['phone'] : '-'?>
                        </p>
                        <p>
                            <span>Hp :</span> <?=$result['hp'] ? $result['hp'] : '-'?>
                        </p>


                        <p>
                            <span>Perusahaan :</span> <?=$result['company_name'] ? $result['company_name'] : '-'?>
                        </p>
                        <p>
                            <span>Tanggal gabung di perusahaan :</span> <?=$result['join_date'] ? format_datepicker($result['join_date']) : '-'?>
                        </p>
                        <p>
                            <span>Jabatan :</span> <?=$result['position'] ? $result['position'] : '-'?>
                        </p>

                        <p class="cleafix">
                            <a href="<?=site_url($this->func.'s/edit/id/'.$result['id'])?>" class="btn btn-success btn-outlined" title="Edit">
                            <i class="fa fa-edit"></i> Edit
                            </a>
                            
                            <?php
                            if($this->session->userdata('roleid')==1){
                            ?>

                                <a href="javascript:;" field="<?=$result['id']?>" class="btn btn-danger btn-outlined delete" data-toggle="modal" data-target="#modal-confirm" title="Hapus">
                                <i class="fa fa-trash-o"></i> Hapus
                                </a>
                            <?php
                            }
                            ?>

                            <a href="<?=site_url($this->func.'s/print_data/id/'.$result['id'])?>" class="btn btn-info btn-outlined" title="Print" target="_blank">
                            <i class="fa fa-print"></i> Print
                            </a>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <p class="cleafix">
            <a href="javascript:;" class="btn btn-info btn-block btn-lg" title="Form Perubahan" onclick="form_perubahan()">
            Form Perubahan
            </a>
        </p>

        <div class="panel panel-primary" id="form_perubahan" style="display:none">
            <div class="panel-heading">
                <h4 class="panel-title">Form Perubahan</h4>
            </div>

            <form action="<?=site_url($this->func.'s/add_deposit_process/id/'.$this->uri->segment(4))?>" class="form-horizontal form-seperated" id="form-perubahan" role="form" method="post">
            <div class="panel-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Tanggal efektif <span class="require">*</span> :</label>
                            <div class="col-md-8">
                                <input id="perubahan_date" name="perubahan_date" type="text" placeholder="dd/mm/yyyy" class="date-picker form-control input-small"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Pokok <span class="require">*</span> :</label>
                            <div class="col-md-8">
                                <input id="perubahan_pokok" name="perubahan_pokok" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Wajib <span class="require">*</span> :</label>
                            <div class="col-md-8">
                                <input id="perubahan_wajib" name="perubahan_wajib" class="form-control angka" type="text" placeholder="Simpanan Wajib" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Sukarela <span class="require">*</span> :</label>
                            <div class="col-md-8">
                                <input id="perubahan_sukarela" name="perubahan_sukarela" class="form-control angka" type="text" placeholder="Simpanan Sukarela" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <button class="btn btn-success btn-outlined" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                <button class="btn btn-warning btn-outlined" type="button" onclick="batal_perubahan()"><i class="fa fa-mail-reply"></i> Batal</button>
                            </div>
                        
                        </div>
                    </div>
            </div>
            </form>
        </div>





        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Simpanan</h4>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 user-profile-info" id="form_edit" style="display:none">
                    <form action="<?=site_url($this->func.'s/edit_deposit_process/id/'.$this->uri->segment(4))?>" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="InputText">Tanggal efektif <span class="require">*</span> :</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="frm_id_deposit" id="frm_id_deposit" value="" />
                                    <input id="date" name="date" type="text" placeholder="dd/mm/yyyy" class="date-picker form-control input-small"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="InputText">Pokok <span class="require">*</span> :</label>
                                <div class="col-md-8">
                                    <input id="pokok" name="pokok" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="InputText">Wajib <span class="require">*</span> :</label>
                                <div class="col-md-8">
                                    <input id="wajib" name="wajib" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="InputText">Sukarela <span class="require">*</span> :</label>
                                <div class="col-md-8">
                                    <input id="sukarela" name="sukarela" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);">
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-3"></div>
                                <div class="col-md-8">
                                    <button class="btn btn-success btn-outlined" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                    <button class="btn btn-warning btn-outlined" type="button" onclick="batal()"><i class="fa fa-mail-reply"></i> Batal</button>
                                </div>
                            
                            </div>
                        </div>
                    </form>

                    </div>
                    <div class="col-md-12 user-profile-info" id="form_display">

                <?php
                if(count($deposit)>0){
                    foreach($deposit as $deposit_key => $deposit_val){
                ?>
                        <p>
                            <span>Tanggal efektif :</span> <?=format_datepicker($deposit_val['date'])?>
                        </p>
                        <p>
                            <span>Pokok :</span> Rp. <?=format_uang($deposit_val['pokok'])?>
                        </p>
                        <p>
                            <span>Wajib :</span> Rp. <?=format_uang($deposit_val['wajib'])?>
                        </p>
                        <p>
                            <span>Sukarela :</span> Rp. <?=format_uang($deposit_val['sukarela'])?>
                        </p>
                        <p class="cleafix">
                            <a href="#javascript:" onclick="edit_deposit(<?=$deposit_val['id']?>)" class="btn btn-success btn-outlined btn-xs" title="Edit">
                            <i class="fa fa-edit"></i> Edit
                            </a>
                            
                            <?php
                            if($this->session->userdata('roleid')==1){
                            ?>

                                <a href="javascript:;" field="<?=$deposit_val['id']?>" class="btn btn-danger btn-outlined delete_deposit btn-xs" data-toggle="modal" data-target="#modal-confirm-deposit" title="Hapus">
                                <i class="fa fa-trash-o"></i> Hapus
                                </a>
                            <?php
                            }
                            ?>

                        </p>

                    <?php
                    if($deposit_key!=count($deposit)-1){
                        echo '<hr/>';
                    }
                    ?>
                    

                <?php
                    }
                }
                ?>

                    </div>
                </div>
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



<!--Modal Confirm-->
<div id="modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">Apakah anda yakin akan menghapus data ini?</div>
            <div class="modal-footer">
                <input type="hidden" id="id" />
                <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                <button type="button" data-dismiss="modal" class="btn btn-success btn-hapus">Ya</button>
            </div>
        </div>
    </div>
</div>

<!--Modal Confirm Deposit-->
<div id="modal-confirm-deposit" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">Apakah anda yakin akan menghapus data ini?</div>
            <div class="modal-footer">
                <input type="hidden" id="id_deposit" />
                <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                <button type="button" data-dismiss="modal" class="btn btn-success btn-hapus-deposit">Ya</button>
            </div>
        </div>
    </div>
</div>

