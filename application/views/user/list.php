<div class="row">
    <div class="col-lg-1">
        <div class="panel">
            <a href="<?=site_url('users/add')?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah User</a>
        </div>
    </div>

    <div class="col-lg-7">&nbsp;</div>
    <div class="col-lg-4">
        <div class="input-group">
        <input id="txt_keywords" class="txt_keywords form-control" type="text" value="<?=$keyword?>">
        <span class="input-group-btn">
        <button class="btn btn-success btn_search" type="button">Cari</button>
        </span>
        </div>
    </div>
    <br/>
</div>

<div class="row">
    <div class="col-lg-12">
        <?=$this->session->flashdata('pesan')?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    	<div class="panel panel-primary">
            <input type="hidden" id="hid_paging" />
            <input type="hidden" id="hid_sort_by" />
            <input type="hidden" id="hid_sort_order" />
        	<div class="panel-heading"><h4 class="panel-title">List User</h4></div>
            <div class="panel-body">
                <div id="data_entries" class="table-responsive"></div>
            </div>
        
        </div>
    </div>
</div>
