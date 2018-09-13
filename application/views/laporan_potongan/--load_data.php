<?php
if(count($result)>0){
?>
<table border="1" width="100%" cellpadding="4" cellspacing="0" class="table table-hover fill-head">
    <thead>
    	<tr>
        	<th rowspan="2" style="text-align:center;">NO</th>
        	<th rowspan="2" style="text-align:center">NAMA ANGGOTA</th>
        	<th rowspan="2" style="text-align:center">NO. ANGG</th>
        	<th rowspan="2" style="text-align:center">TANGGAL</th>
        	<th colspan="4" style="text-align:center">NILAI SIMPANAN</th>
            <th colspan="3" style="text-align:center">NILAI ANGSURAN PINJAMAN</th>
            <!--<th rowspan="2" style="text-align:center">TOTAL PEMOTONGAN GAJI</th>-->
            <th rowspan="2" style="text-align:center">ANGSUARAN KE</th>
            <th rowspan="2" style="text-align:center">LAMANYA PINJAMAN</th>
       	</tr>
    	<tr>
        	<th style="text-align:center">POKOK</th>
        	<th style="text-align:center">WAJIB</th>
        	<th style="text-align:center">SUKARELA</th>
        	<th style="text-align:center">TOTAL</th>
        	<th style="text-align:center">TOTAL PINJAMAN</th>
        	<th style="text-align:center">SISA BULAN LALU</th>
        	<th style="text-align:center">ANGSURAN</th>
       	</tr>
    </thead>
    <?php
	$gt_simpanan_pokok = 0;
	$gt_simpanan_wajib = 0;
	$gt_simpanan_sukarela = 0;
	$gt_simpanan_total = 0;
	$gt_pinjaman = 0;
	$gt_sisa = 0;
	$gt_angsuran = 0;
	//$gt_potongan_gaji = 0;
	foreach($result as $result_key => $result_val){
		$total_simpanan = $result_val['pokok']+$result_val['wajib']+$result_val['sukarela'];
		$pinjaman = $this->laporan_potongan->get_pinjam_angsuran($result_val['memberid'],$result_val['tgl_simpan']);

		$total_pinjaman = 0;
		$sisa_lalu = 0;
		$angsuran = 0;
		
		$angsuran_ke = 0;
		$lama_pinjaman = 0;
		if(count($pinjaman)>0){
			$lama_pinjaman = $pinjaman['lama_angsuran'];#dalam bulan
			if($pinjaman['flag']=='Tahun'){
				$lama_pinjaman = $pinjaman['lama_angsuran']*12;#dalam bulan
			}
			$angsuran = $pinjaman['angsuran'];
			$total_uang_masuk = ($pinjaman['angsuran_ke']-1)*$angsuran;
			$total_pinjaman = $lama_pinjaman*$angsuran;
			$sisa_lalu = $total_pinjaman-$total_uang_masuk;

			$angsuran_ke = $pinjaman['angsuran_ke'];
		}
		//$total_potong_gaji = $total_simpanan+$angsuran;
	?>
        <tr>
            <td align="center"><?=($result_key+1)?></td>
            <td><?=$result_val['name']?></td>
            <td align="center"><?=$result_val['no_member']?></td>
            <td align="center"><?=format_bulan_tahun($result_val['tgl_simpan'])?></td>
            <td align="right"><?=format_uang($result_val['pokok'])?></td>
            <td align="right"><?=format_uang($result_val['wajib'])?></td>
            <td align="right"><?=format_uang($result_val['sukarela'])?></td>
            <td align="right"><?=format_uang($total_simpanan)?></td>
            <td align="right"><?=format_uang($total_pinjaman)?></td>
            <td align="right"><?=format_uang($sisa_lalu)?></td>
            <td align="right"><?=format_uang($angsuran)?></td>
            <!--<td align="right"><?=format_uang($total_potong_gaji)?></td>-->
            <td align="center"><?=$angsuran_ke?></td>
            <td align="center"><?=$lama_pinjaman ? $lama_pinjaman.' Bulan' : 0?></td>
        </tr>
    <?php
		$gt_simpanan_pokok += $result_val['pokok'];
		$gt_simpanan_wajib += $result_val['wajib'];
		$gt_simpanan_sukarela += $result_val['sukarela'];
		$gt_simpanan_total += $total_simpanan;
		$gt_pinjaman += $total_pinjaman;
		$gt_sisa += $sisa_lalu;
		$gt_angsuran += $angsuran;
		//$gt_potongan_gaji += $total_potong_gaji;
	}
	?>
    <tfoot>
    <tr bgcolor="#efefef">
        <td colspan="4" align="center"><strong>TOTAL</strong></td>
        <td align="right"><strong><?=format_uang($gt_simpanan_pokok)?></strong></td>
        <td align="right"><strong><?=format_uang($gt_simpanan_wajib)?></strong></td>
        <td align="right"><strong><?=format_uang($gt_simpanan_sukarela)?></strong></td>
        <td align="right"><strong><?=format_uang($gt_simpanan_total)?></strong></td>
        <td align="right"><strong><?=format_uang($gt_pinjaman)?></strong></td>
        <td align="right"><strong><?=format_uang($gt_sisa)?></strong></td>
        <td align="right"><strong><?=format_uang($gt_angsuran)?></strong></td>
       <!-- <td align="right"><strong><?=format_uang($gt_potongan_gaji)?></strong></td> -->
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
    </tr>
    </tfoot>

</table>
<br/>
<?php //echo $pagination?>
<br/>
<div class="btn-group" style="float:right">
	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">Print & Export</a>
    <ul class="dropdown-menu">
    	<li>
            <a href="<?=site_url($this->func.'s/print_data')?>" title="Print" target="_blank" >
            <i class="fa fa-print"></i> Print
            </a>
        </li>
    	<li>
            <a href="<?=site_url($this->func.'s/export_data')?>" title="Print" target="_blank" >
            <i class="fa fa-file-o"></i> Export
            </a>
        </li>
    </ul>

</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>


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
