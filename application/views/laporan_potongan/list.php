<div class="row">
    <div class="col-md-12">
    	<div class="panel panel-primary">
            <input type="hidden" id="hid_paging" />
            <input type="hidden" id="hid_sort_by" />
            <input type="hidden" id="hid_sort_order" />
        	<div class="panel-heading"><h4 class="panel-title"><?=$this->title?></h4></div>
            <div class="panel-body">
                <form action="#" class="form-horizontal form-seperated" id="form-tambah" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Anggota </label>
                            <div class="col-md-6">
                            <?php echo form_dropdown('memberid',$member,'','id="memberid" class="select2-size form-control" ');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Kelas </label>
                            <div class="col-md-6">
                            <?php echo form_dropdown('companyid',$company,'','id="companyid" class="select2-size form-control" ');?>
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-md-3 control-label" for="InputText">Period :</label>
                            <div class="col-md-6">
                                <div class="input-group input-daterange">
                                    <input id="tgl_dari" name="tgl_dari" type="text" data-date-format="mm/yyyy" placeholder="mm/yyyy" class="form-control"/>
                                    <span class="input-group-addon">sampai</span>
                                    <input id="tgl_sampai" name="tgl_sampai" type="text" data-date-format="mm/yyyy" placeholder="mm/yyyy" class="form-control"/>
                                </div>
                            </div>
                        
                        </div>

                        <div class="form-group">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <button class="btn btn-success btn-outlined btn_search" type="button"><i class="fa fa-search"></i> Tampilkan</button>
                            </div>
                        
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <div id="data_entries" class="table-big"></div>
            </div>
        
        </div>
    </div>
</div>
