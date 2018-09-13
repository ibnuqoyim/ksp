<div class="row">
    <div class="col-lg-12">
    	<div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Tambah <?=$this->title?></h4>
            </div>

            <div class="panel-body">
                <form action="<?=site_url($this->func.'s/add_process')?>" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post">
                    <div class="form-body">
                       <div class="form-group">
                            <label class="col-md-3 control-label">Nama <span class="require">*</span> :</label>
                            <div class="col-md-5">
                                <input id="name" name="name" class="form-control" type="text" placeholder="Nama" maxlength="200" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Alamat :</label>
                            <div class="col-md-5">
                            	<textarea name="address" id="address" class="form-control" placeholder="Alamat"></textarea>
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


