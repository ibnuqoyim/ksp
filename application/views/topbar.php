<button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
<span class="fa fa-bars"></span>
</button>
<?php
	$logo = base_url('template/images/logo.png');
?>
<a class="navbar-brand" href="#" style="padding-top:15px">
<small>
KOPERASI
</small>
<?php //config_item('web_title')?>
</a>
<?php
$detail = detail_employee($this->session->userdata('employeeid'));
if($detail['gender']=='Laki-laki'){
	$avatar = base_url('template/images/employee/male.png');
} else {
	$avatar = base_url('template/images/employee/female.png');
}
if($detail['photo']){
	$avatar = base_url('template/images/employee/'.$detail['photo']);
}
?>

<ul class="nav flaty-nav pull-right">
    <li class="user-profile">
        <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
            <img class="nav-user-photo" src="<?=$avatar?>" alt="<?=$detail['name']?>"/>
            <span id="user_info"><?=$detail['name']?></span>
            <i class="fa fa-caret-down"></i>
        </a>

        <ul class="dropdown-menu dropdown-navbar" id="user_menu">
            <li>
                <a href="<?=site_url('employees/detail/id/'.$detail['id'])?>">
                <i class="fa fa-user"></i>
                Profile </a>
            </li>
            <li>
                <a href="<?=site_url('users/ganti_password')?>">
                    <i class="fa fa-question"></i>
                    Ganti Password
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?=site_url('logins/logout')?>">
                <i class="fa fa-off"></i>
                Keluar </a>
            </li>
        </ul>
    </li>
</ul>

