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
                            <label class="col-md-3 control-label">No. Transaksi <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <input class="form-control" type="text" disabled="disabled" value="<?=$result['no_trans']?>">
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
                            <label class="col-md-3 control-label">Simpanan Pokok <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <input id="pokok" name="pokok" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);" value="<?=format_uang($result['pokok'])?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Simpanan Wajib <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <input id="wajib" name="wajib" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);" value="<?=format_uang($result['wajib'])?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Simpanan Sukarela <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <input id="sukarela" name="sukarela" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);" value="<?=format_uang($result['sukarela'])?>">
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

