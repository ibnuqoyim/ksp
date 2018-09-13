<form action="<?=site_url($this->func.'s/add_process')?>" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post">
<input type="hidden" id="installmentid"/>
<div class="row">
    <div class="col-lg-12">
    	<div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Tambah <?=$this->title?></h4>
            </div>

            <div class="panel-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">No. Transaksi <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <input class="form-control" type="text" disabled="disabled" value="xxxxxxxx">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tanggal <span class="require">*</span> :</label>
                            <div class="col-md-3">
                                <input id="date" name="date" type="text" placeholder="dd/mm/yyyy" class="date-picker form-control input-small"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">No. Pinjaman <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <?php
                                echo form_dropdown('loanid',$pinjaman,'','id="loanid" class="select2-size  form-control" ');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Anggota :</label>
                            <div class="col-md-5">
                            <label class="control-label anggota">&nbsp;</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Angsuran ke :</label>
                            <div class="col-md-5">
                            <label class="control-label angsuran_ke">&nbsp;</label>
                            <input type="hidden" name="transaction" id="transaction" />
                            <input type="hidden" name="total_transaction" id="total_transaction" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Nominal <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <input id="amount" readonly="readonly" name="amount" class="form-control angka" type="text" placeholder="0.00" maxlength="20" onkeypress="return blockNonNumbers(this, event, true, false);">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <button class="btn btn-success btn-outlined" type="submit"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        
                        </div>
                    </div>
            </div>
        </div>


    </div>


</div>
</form>

<div class="row">
    <div class="col-lg-1">
        <div class="panel">
            <a href="<?=site_url($this->func.'s')?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>


