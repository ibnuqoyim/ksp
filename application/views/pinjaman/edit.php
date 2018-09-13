<div class="row">
    <div class="col-lg-12">
    	<div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Data <?=$this->title?></h4>
            </div>

            <div class="panel-body">
                <form action="<?=site_url($this->func.'s/edit_process/id/'.$this->uri->segment(4))?>" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post" >
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">No. Pinjaman <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <input class="form-control" type="text" disabled="disabled" value="<?=$result['no_loan']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tanggal <span class="require">*</span> :</label>
                            <div class="col-md-3">
                                <input id="date" name="date" type="text" placeholder="dd/mm/yyyy" class="date-picker form-control input-small" value="<?=format_datepicker($result['date'])?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Anggota <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <?php
                                echo form_dropdown('memberid',$member,$result['memberid'],'id="memberid" class="select2-size  form-control" ');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jumlah Pinjaman <span class="require">*</span> :</label>
                            <div class="col-md-3">
                                <input id="amount" name="amount" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);" value="<?=format_uang($result['amount'])?>"> 
                            </div>
                            <div class="col-md-6">
                            <label class="control-label text-info" id="maksimal"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lama Angsuran <span class="require">*</span> :</label>
                            <div class="col-md-2">
                                <input id="lama_angsuran" name="lama_angsuran" class="form-control" type="text" placeholder="0" maxlength="4" onkeypress="return blockNonNumbers(this, event, true, false);" value="<?=$result['lama_angsuran']?>">
                            </div>
                            <div class="col-md-4">
                            <?php
							$checked_bulan = 'checked="checked"';
							$checked_tahun = '';
							if($result['flag']=='Tahun'){
								$checked_bulan = '';
								$checked_tahun = 'checked="checked"';
							}
							?>
                            	<input type="radio" name="flag" class="flag" value="Bulan" <?=$checked_bulan?> /> Bulan&nbsp;&nbsp;
                            	<input type="radio" name="flag" class="flag" value="Tahun" <?=$checked_tahun?> /> Tahun
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Bunga (%) <span class="require">*</span> :</label>
                            <div class="col-md-2">
                                <input id="bunga" name="bunga" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);" value="<?=$result['bunga']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Angsuran Perbulan <span class="require">*</span> :</label>
                            <div class="col-md-3">
                                <input id="perbulan" readonly="readonly" name="perbulan" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);" value="<?=format_uang($result['perbulan'])?>">
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

