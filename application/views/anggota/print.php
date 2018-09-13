<table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
        <td align="center"><p><font size="+3">KOPERASI KODANUA</font></p></td>
    </tr>
    <tr>
        <td align="center"><font size="+3">SALDO SIMPANAN DAN PINJAMAN ANGGOTA</font></td>
    </tr>
    <tr>
        <td align="center">&nbsp;</td>
    </tr>
</table><br/>
<table width="100%" border="1" cellspacing="0" cellpadding="4">
  <tr>
    <td>

        <table width="100%" border="0" cellspacing="0" cellpadding="4">
            <tr>
                <td width="15%">Nama</td>
                <td width="3%">:</td>
                <td width="52%"><?=strtoupper($detail['name'])?></td>
                <td width="30%">PER <?=strtoupper(format_tanggal_khusus_indo(date('Y-m-d')))?></td>
            </tr>
            <tr>
                <td>No. Anggota</td>
                <td>:</td>
                <td><?=strtoupper($detail['no_member'])?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Awal Keanggotaan</td>
                <td>:</td>
                <td><?=format_bulan_tahun($detail['member_date'])?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Guru Kelas</td>
                <td>:</td>
                <td><?=strtoupper($detail['company_name'])?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
        </table>
        <?php
		$grandTotalPinjam = 0;
		$grandTotalAngsuran = 0;
		if(count($pinjam)>0){
			foreach($pinjam as $key => $val){

				$total_angsuran = $this->anggota->total_angsuran_masuk($val['id']);
				$grandTotalAngsuran += $total_angsuran;

				$lama_angsuran = $val['lama_angsuran'];
				if($val['flag']=='Tahun'){
					$lama_angsuran = $val['lama_angsuran']*12;
				}
				$total_pinjam = $val['perbulan']*$lama_angsuran;
				$grandTotalPinjam += $total_pinjam;
			}
		}
		?>

        <table width="100%" border="0" cellspacing="0" cellpadding="4">
            <tr>
                <td colspan="5" width="57%"><strong><u>Simpanan</u></strong></td>
                <td colspan="5" width="43%"><strong><u>Pinjaman</u></strong></td>
            </tr>
            <tr>
                <td width="15%">Simpanan Pokok</td>
                <td width="3%">:</td>
                <td width="4%">Rp</td>
                <td width="17%" align="right"><?=format_uang($deposit['total_pokok'])?></td>
                <td width="18%">&nbsp;</td>
                <td width="13%">Pinjaman</td>
                <td width="3%">:</td>
                <td width="4%">Rp</td>
                <td width="17%" align="right"><?=format_uang($grandTotalPinjam)?></td>
                <td width="6%">&nbsp;</td>
            </tr>
            <tr>
                <td>Simpanan Wajib</td>
                <td>:</td>
                <td>Rp</td>
                <td align="right"><?=format_uang($deposit['total_wajib'])?></td>
                <td>&nbsp;</td>
                <td>Angsuran Masuk</td>
                <td>:</td>
                <td>Rp</td>
                <td align="right"><?=format_uang($grandTotalAngsuran)?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Simpanan Sukarela</td>
                <td>:</td>
                <td>Rp</td>
                <td align="right"><?=format_uang($deposit['total_sukarela'])?></td>
                <td>&nbsp;</td>
                <td>Saldo Pinjaman</td>
                <td style="border-top:1px solid #000">:</td>
                <td style="border-top:1px solid #000">Rp</td>
                <td align="right" style="border-top:1px solid #000"><?=format_uang($grandTotalPinjam-$grandTotalAngsuran)?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Saldo Simpanan</td>
                <td style="border-top:1px solid #000">:</td>
                <td style="border-top:1px solid #000">Rp</td>
                <td align="right" style="border-top:1px solid #000"><?=format_uang($deposit['total_pokok']+$deposit['total_wajib']+$deposit['total_sukarela'])?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="10">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="10">&nbsp;</td>
            </tr>
        </table>
    
    
        <table width="100%" border="0" cellspacing="0" cellpadding="4">
            <tr>
                <td width="10%">&nbsp;</td>
                <td width="30%" align="center">Jakarta, <?=format_tanggal_khusus_indo(date('Y-m-d'))?></td>
                <td width="60%">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td align="center">Pengelola Koperasi,</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td align="center">(<?=config_item('pengelola')?>)</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </table>


    </td>
  </tr>
</table>
