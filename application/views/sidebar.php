<div id="sidebar" class="navbar-collapse collapse">
    <ul class="nav nav-list">
        <li>&nbsp;</li>
        <li>
            <a href="#">
            <span>MAIN MENU</span>
            </a>
        </li>
        <li>&nbsp;</li>
        <?php
		$classBeranda		= '';
		$classSimpanan		= '';
		$classPinjaman		= '';
		$classAngsuran		= '';
		$classPegawai		= '';
		$classAnggota		= '';

		$classSetting		= '';
		$classSettingUser	= '';
		$classSettingCompany= '';

		$classReport			= '';
		$classReportPotongan	= '';


		if($this->uri->segment(1)=='' || $this->uri->segment(1)=='berandas'){
			$classBeranda	= 'class="active"';
		}
		if($this->uri->segment(1)=='simpanans'){
			$classSimpanan	= 'class="active"';
		}
		if($this->uri->segment(1)=='pinjamans'){
			$classPinjaman	= 'class="active"';
		}
		if($this->uri->segment(1)=='angsurans'){
			$classAngsuran	= 'class="active"';
		}
		if($this->uri->segment(1)=='employees'){
			$classPegawai	= 'class="active"';
		}
		if($this->uri->segment(1)=='anggotas'){
			$classAnggota	= 'class="active"';
		}
		if($this->uri->segment(1)=='laporan_potongans'){
			$classReport	= 'class="active"';
			if($this->uri->segment(1)=='laporan_potongans'){
				$classReportPotongan	= 'class="active"';
			}
		}
		if($this->uri->segment(1)=='users' || $this->uri->segment(1)=='perusahaans'){
			$classSetting	= 'class="active"';
			if($this->uri->segment(1)=='users'){
				$classSettingUser	= 'class="active"';
			}
			if($this->uri->segment(1)=='perusahaans'){
				$classSettingCompany	= 'class="active"';
			}
		}
		?>

        <li <?=$classBeranda?>>
            <a href="<?=site_url('berandas')?>">
            <i class="fa fa-dashboard"></i>
            <span>Beranda</span>
            </a>
        </li>
        <?php
		if($this->session->userdata('roleid')==1){
		?>
            <li <?=$classPegawai?>>
                <a href="<?=site_url('employees')?>">
                <i class="fa fa-user"></i>
                <span>Pegawai</span>
                </a>
            </li>
        <?php
		}
		if($this->session->userdata('roleid')==1 || $this->session->userdata('roleid')==2){
		?>
            <li <?=$classAnggota?>>
                <a href="<?=site_url('anggotas')?>">
                <i class="fa fa-users"></i>
                <span>Anggota</span>
                </a>
            </li>
            <li <?=$classSimpanan?>>
                <a href="<?=site_url('simpanans')?>">
                <i class="fa fa-folder"></i>
                <span>Simpanan</span>
                </a>
            </li>
    
            <li <?=$classPinjaman?>>
                <a href="<?=site_url('pinjamans')?>">
                <i class="fa fa-book"></i>
                <span>Pinjaman</span>
                </a>
            </li>
            <li <?=$classAngsuran?>>
                <a href="<?=site_url('angsurans')?>">
                <i class="fa fa-ticket"></i>
                <span>Angsuran</span>
                </a>
            </li>
        <?php
		}
		?>

        <?php
		if($this->session->userdata('roleid')==1 || $this->session->userdata('roleid')==3){
		?>
            <li <?=$classReport?>>
                <a href="#" class="dropdown-toggle">
                <i class="fa fa-bar-chart-o"></i>
                <span>Laporan</span>
                <b class="arrow fa fa-angle-right"></b>
                </a>
                <ul class="submenu">
                    <li <?=$classReportPotongan?>>
                        <a href="<?=site_url('laporan_potongans')?>">Laporan</a>
                    </li>
                </ul>
            </li>
        <?php
		}
		?>



        <?php
		if($this->session->userdata('roleid')==1){
		?>
    
            <li <?=$classSetting?>>
                <a href="#" class="dropdown-toggle">
                <i class="fa fa-gear"></i>
                <span>Setting</span>
                <b class="arrow fa fa-angle-right"></b>
                </a>
                <ul class="submenu">
                    <li <?=$classSettingUser?>>
                        <a href="<?=site_url('users')?>">User</a>
                    </li>
                    <li <?=$classSettingCompany?>>
                        <a href="<?=site_url('perusahaans')?>">Kelas</a>
                    </li>
                </ul>
            </li>
        <?php
		}
		?>

    </ul>
    <div id="sidebar-collapse" class="visible-lg">
        <i class="fa fa-angle-double-left"></i>
    </div>
</div>
