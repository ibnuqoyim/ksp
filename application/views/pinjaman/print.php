<?php
$lama_angsuran = $detail['lama_angsuran'];
if($detail['flag']=='Tahun'){
	$lama_angsuran = $detail['lama_angsuran']*12;
}
$bunga_percent_total = $detail['bunga'];
if($detail['flag']=='Bulan'){
	$bunga_percent_total = round($detail['bunga']*$lama_angsuran);
}
$total_pinjaman = $detail['perbulan']*$lama_angsuran;
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="60%" valign="bottom">
        
        <table width="100%" border="0" cellspacing="0" cellpadding="4">
            <tr>
                <td width="25%">Nama</td>
                <td width="5%">:</td>
                <td width="70%"><?=$detail['name']?></td>
            </tr>
            <tr>
                <td>No. Anggota</td>
                <td>:</td>
                <td><?=$detail['no_member']?></td>
            </tr>
            <tr>
                <td>Perusahaan</td>
                <td>:</td>
                <td><?=$detail['company_name']?></td>
            </tr>
        </table>

        
        </td>
        <td width="40%">
        
            <table width="100%" border="1" cellspacing="0" cellpadding="2">
                <tr>
                    <td width="55%" align="right">Bunga Pinjaman</td>
                    <td width="45%" align="right"><?=$bunga_percent_total?>%</td>
                </tr>
                <tr>
                    <td align="right">Jangka Waktu Pinjam</td>
                    <td align="right"><?=$detail['lama_angsuran'].' '.$detail['flag']?> </td>
                </tr>
                <tr>
                    <td align="right">Pokok Pinjam</td>
                    <td align="right"><?=format_uang($detail['amount'])?></td>
                </tr>
                <tr>
                    <td align="right">Tanggal Pinjam</td>
                    <td align="right"><?=format_tanggal_khusus($detail['date'])?></td>
                </tr>
                <tr>
                    <td align="right">Angsuran Perbulan</td>
                    <td align="right"><?=format_uang($detail['perbulan'])?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2"><br/><br/>

            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                <tr>
                    <td width="40%">&nbsp;</td>
                    <td width="20%" align="center" style="background-color:#3FC"><strong>Pokok Pinjaman</strong></td>
                    <td width="20%" align="center" style="background-color:#3FC"><strong>Bunga</strong></td>
                    <td width="20%" align="center" style="background-color:#3FC"><strong>Total Pinjaman</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center" style="background-color:#3FC"><strong><?=format_uang($detail['amount'])?></strong></td>
                    <td align="center" style="background-color:#3FC"><strong><?=format_uang($total_pinjaman-$detail['amount'])?></strong></td>
                    <td align="center" style="background-color:#3FC"><strong><?=format_uang($total_pinjaman)?></strong></td>
                </tr>
            </table>


        </td>
    </tr>
</table>
<br/><br/>
<table width="100%" border="1" cellspacing="0" cellpadding="4">
	<thead>
    <tr>
        <td colspan="5" align="center"><strong>TABEL ANGSURAN PINJAMAN</strong></td>
    </tr>
    <tr>
        <td align="center"><strong>BULAN KE</strong></td>
        <td align="center"><strong>BULAN</strong></td>
        <td align="center"><strong>TOTAL PINJAMAN</strong></td>
        <td align="center"><strong>ANGSURAN PERBULAN</strong></td>
        <td align="center"><strong>SALDO TOTAL PINJAMAN</strong></td>
    </tr>
	</thead>
<?php

$pokok = $total_pinjaman;
$cumulative = $pokok-$detail['perbulan'];

$bulan_pinjam = $detail['date'];
for($i=1;$i<=$lama_angsuran;$i++){
	$bulan_pinjam = date('Y-m-d', strtotime('+'.$i.' month', strtotime($detail['date'])));
?>
    
    <tr>
        <td align="center"><?=$i?></td>
        <td align="center"><?=format_bulan_tahun($bulan_pinjam)?></td>
        <td align="right"><?=format_uang($pokok)?></td>
        <td align="right"><?=format_uang($detail['perbulan'])?></td>
        <td align="right"><?=format_uang($cumulative)?></td>
    </tr>
<?php
	$pokok = $cumulative;
	$cumulative = $pokok-$detail['perbulan'];

}
?>

</table>
