<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?=$page_title?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?=base_url()?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" media="screen">
  <script src="<?=base_url()?>assets/scripts/modernizr-2.5.3.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?=base_url()?>assets/scripts/jquery-1.7.2.min.js"><\/script>')</script>
</head>
<body>
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a><![endif]-->
  <header>
    <?php $this->load->view('includes/header_view'); ?>
  </header>
  <article>
    <?php $this->load->view($main_content); ?>
  </article>
  <footer class="clearfix">
	 <?php $this->load->view('includes/footer_view'); ?>
  </footer>
  <!-- JavaScript  -->
  <script src="<?=base_url()?>assets/scripts/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/scripts/script.js"></script>
  <!-- end scripts -->
  <script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
 </body>
</html>

