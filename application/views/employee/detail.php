<div class="row">
    <div class="col-lg-12">
        <?=$this->session->flashdata('pesan')?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
    	<div class="panel panel-primary">

            <div class="panel-heading">
                <h4 class="panel-title">Info Profil</h4>
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
                        <img class="img-responsive img-thumbnail" src="<?=base_url('template/images/employee/'.$photo)?>" alt="profile picture"/>
                        <br/><br/>
                    </div>
                    <div class="col-md-9 user-profile-info">
                        <p>
                            <span>Nama :</span> <?=$result['name']?>
                        </p>
                        <p>
                            <span>Jenis Kelamin :</span> <?=$result['gender'] ? $result['gender'] : '-'?>
                        </p>
                        <p>
                            <span>Jabatan :</span> <?=$result['position'] ? $result['position'] : '-'?>
                        </p>
                        <p>
                            <span>Email :</span> <?=$result['email'] ? $result['email'] : '-'?>
                        </p>
                        <p>
                            <span>Hp :</span> <?=$result['hp'] ? $result['hp'] : '-'?>
                        </p>
                        <p>
                            <span>Tempat, Tgl Lahir :</span> <?=$result['birthplace'] ? $result['birthplace'] : '-'?>, <?=$result['birthdate'] ? format_datepicker($result['birthdate']) : '-'?>
                        </p>
                        <p>
                            <span>Alamat :</span> <?=$result['address'] ? nl2br($result['address']) : '-'?>
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

                        </p>
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

