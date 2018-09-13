<!DOCTYPE html>
<html lang="en">
<head><title><?=config_item('web_title')?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=base_url('template/assets/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('template/assets/font-awesome/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('template/assets/code-prettify/code-prettify.css')?>">
    <link rel="stylesheet" href="<?=base_url('template/css/flaty.css')?>">
    <link rel="stylesheet" href="<?=base_url('template/css/flaty-responsive.css')?>">

    <style>
		.require{
			color:#F00;
		}
		.angka{
			text-align: right;	
		}
	</style>

   <?php echo $_styles; ?>
</head>
<body class="skin-red">
<div id="navbar" class="navbar">
	<?php $this->load->view('topbar'); ?>
</div>
<div class="container" id="main-container">
		<?php $this->load->view('sidebar'); ?>
		<div id="main-content">

			<?php echo  $_title_page ;?>
            <?php echo  $_breadcrumb ;?>
            <?php echo  $content ; ?>



		<?php $this->load->view('footer'); ?>
    </div>
</div>


<script>
	window.jQuery || document.write('<script src="<?=base_url('template/assets/jquery/jquery-2.0.3.min.js')?>"><\/script>')
</script>
<script src="<?=base_url('template/assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('template/assets/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<script src="<?=base_url('template/assets/jquery-cookie/jquery.cookie.js')?>"></script>
<script src="<?=base_url('template/assets/code-prettify/code-prettify.js')?>"></script>
<script src="<?=base_url('template/js/flaty.js')?>"></script>
<script src="<?=base_url('template/js/flaty-demo-codes.js')?>"></script>

<!--JS FORMAT CURRENCY-->
<script type="text/javascript" src="<?=base_url('template/js/jquery.formatCurrency-1.4.0.js')?>"></script>

<!--JS ANGKA-->
<script type="text/javascript" src="<?=base_url('template/js/angka.js')?>"></script>

<script type="text/javascript" src="<?=base_url('template/js/validate.js')?>"></script>


<script>
	var base_url 		= "<?php echo base_url();?>";
	var controller 		= "<?php echo $this->uri->segment(1);?>";
</script>

<script type="text/javascript" >
	function newText(text){   
			if(text == '' || text == undefined)
			{
				return 0;
			}
			else
			{
				var regex=/,/g;
				var replaceWith='';
				return text.replace(regex,replaceWith);
			}
	}

	$(document).ready(function() {
		
		$('.angka').on("keyup",function() {
			$(this).formatCurrency({
				symbol: '',
				positiveFormat: '%s%n',
				negativeFormat: '(%s%n)',
				decimalSymbol: '<?php echo DECIMAL_SEP;?>',
				digitGroupSymbol: '<?php echo THOUSAND_SEP;?>',
				groupDigits: true,
				roundToDecimalPlace: -1,
				colorize: false
			});
		});
	});
</script>

<?php echo  $_scripts ;?>


</body>

</html>