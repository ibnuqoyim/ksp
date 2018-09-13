<div class="row">
    <div class="col-lg-1">
        <div class="panel">
            <a href="<?=site_url($this->func.'s/add')?>" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp; Tambah <?=$this->title?></a>
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
    <br/><br/><br/>
    
</div>

<div class="row">
    <div class="col-lg-12">
        <?=$this->session->flashdata('pesan')?>
    </div>
</div>




<input type="hidden" id="hid_paging" />
<input type="hidden" id="hid_sort_by" />
<input type="hidden" id="hid_sort_order" />

<div id="data_entries"></div>
