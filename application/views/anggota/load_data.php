<?php
if($keywords!=''){
	echo '<div class="alert alert-info">
			<div class="alert-content">
				<strong><i class="fa fa-search"></i>&nbsp;Pencarian :</strong> '.$keywords.'
			</div>
	</div>';
?>

<?php
}
?>

<?php
if(count($result)>0){
?>

    <?php
	foreach($result as $result_key => $result_val){
		//echo ($result_key%3).'==';
		if($result_key%3==0){
			echo '<div class="row">';
		}
	?>
        <div class="col-lg-4">
            <div class="box">
    
                <div class="box-title">
                	<a href="<?=site_url($this->func.'s/detail/id/'.$result_val['id'])?>" title="Detail">
                        <h3 ><i class="fa fa-user"></i> <?=$result_val['no_member']?> - <?=$result_val['name']?></h3>
                    </a>
                </div>
    
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12 user-profile-info">
                            <p>
                                <span>Jenis Kelamin :</span> <?=$result_val['gender']?>
                            </p>
                            <p>
                                <span>TTL :</span> <?=$result_val['birthplace'] ? $result_val['birthplace'] : '-'?>, <?=$result_val['birthdate'] ? format_datepicker($result_val['birthdate']) : '-'?>
                            </p>
                            <p>
                                <span>Status :</span> <?=$result_val['relationship']?>
                            </p>
                            <p>
                                <span>Guru Kelas :</span> <?=$result_val['company_name']?>
                            </p>
                            <p>
                                <span>Telepon :</span> <?=$result_val['phone']?>
                            </p>
                            <p>
                                <span>Hp :</span> <?=$result_val['hp']?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
		if($result_key%3==2){
			echo '</div>';
		}
	}
	?>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-lg-12">
		<?=$pagination?>
    </div>
</div>


<?php
} else {
	echo '<div class="alert alert-warning">
			<div class="alert-content">
				<strong>Peringatan!</strong>
				Tidak ada data
			</div>
	</div>';
}
?>
