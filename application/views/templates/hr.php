<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?=$title?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?=base_url()?>public/stylesheets/base.css">
	<link rel="stylesheet" href="<?=base_url()?>public/stylesheets/skeleton.css">
	<link rel="stylesheet" href="<?=base_url()?>public/stylesheets/layout.css">
	<link rel="stylesheet" href="<?=base_url()?>public/stylesheets/menu.css">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?=base_url()?>public/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?=base_url()?>public/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url()?>public/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url()?>public/images/apple-touch-icon-114x114.png">
	<!-- Javascript
  ================================================== -->
	<script src="<?=base_url()?>public/js/jquery-1.9.1.js"></script>
	<!--
	<script>
	$(function() 
	{
		if ($.browser.msie && $.browser.version.substr(0,1)<7)
		{
			$('li').has('ul').mouseover(function()
			{$(this).children('ul').css('visibility','visible');}).mouseout(function(){$(this).children('ul').css('visibility','hidden');})
		}
	}); 
	</script>
	-->
</head>
<body>
	<!-- Primary Page Layout
	================================================== -->
	<!-- Delete everything in this .container and get started on your own site! -->
	<div class="container">
		<div id="sixteen columns">
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?=base_url()?>hr/viewEmp">
				<img src="<?=base_url()?>public/images/berlitz.jpg" height="30%" width="20%"/>
			</a>
		</div>
		<div id="sixteen columns">
			<nav>
				<ul id="menu">
					<li class="active"><a href="<?=base_url()?>hr/viewEmp">Employees</a></li>
					<li><a href="<?=base_url()?>leave/view">Leave</a>
						<!--
						<ul>
							<li><a href="<?=base_url()?>leave/view">View</a></li>
							<li><a href="<?=base_url()?>leave">Add</a></li>
						</ul>
						-->
					</li>
					<li>
						<a href="#">Reports</a>
						<ul>
							<li><a href="<?=base_url()?>report">Leave Transactions</a></li>
							<li><a href="<?=base_url()?>report/accrual">Accrual</a></li>
						</ul>
					</li>
					<li class="active"><a href="#">Settings</a>
						<ul>
							<li><a href="<?=base_url()?>setting/leave">Leave</a></li>
<<<<<<< HEAD
							<li><a href="<?=base_url()?>setting/editAccount">Account</a></li>
=======
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
						</ul>
					</li>
				</ul>
			</nav>
		</div>
		<div class="sixteen columns" ><!--style="background-color:#FF8000;"-->
			<h6>
				<?$session=$this->session->userdata('logged_in');?><?="&nbsp;Hello,&nbsp;<b>".$session['name']."</b>";?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?=base_url()?>hr/logout">Log Out</a>
			</h6>
			<!--<hr />-->
			</br>
		</div>
		<div class="sixteen columns"><?=$body?></div><!-- style="background-color:#E0E0E0;"-->
		<div class="sixteen columns">
			<hr/>
			<footer class="footer"><center><strong>Copyright © 2014 Dar Al Khibra Company<br/>Version 2.2.3</strong></center></footer>
			</br/>
		</div>	
	</div><!-- container -->
<!-- End Document
================================================== -->
</body>
</html>