<!DOCTYPE HTML>
<html>
  <head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
		<style>
			body{
				font-size:1em;
			}
		</style>
  </head>
	<body>
<div style="width:1000px;margin:10px auto;">
<div>
TDATE:<?php echo $global['tdate']?>
</div>
<div style="width:900px;margin:10px;">
<form action="keys.php" method="get" class="form-search form-inline" >
<a class="btn" href="overview.php">Overview</a> 
<a class="btn" href="clearCache.php">Clear cache</a> 
<a class="btn" href="notify.php">Notify</a> 
<a class="btn" href="kv_status.php?node=kv.master">kv.master status</a>
<a class="btn" href="kv_status.php?node=kv.slave">kv.slave status</a> 
<input class="input-medium search-query" type="text" name="key" placeholder="stockId" value="<?php if( preg_match( '/keys\.php/' , $_SERVER['REQUEST_URI']  )) echo @$_GET['key']?>">
<label class='checkbox'>
<input type="checkbox" name="empty" <?php if( preg_match( '/keys\.php/' , $_SERVER['REQUEST_URI']  ) && @$_GET['empty'] ) echo 'checked'?>/>
empty
</label>
<label class='checkbox'>
<input type="checkbox" name="lost" <?php if( preg_match( '/keys\.php/' , $_SERVER['REQUEST_URI']  ) && @$_GET['lost'] ) echo 'checked' ?> />
lost
</label>
<input type="submit" class="btn" value="search" name="do" >
</form>
</div>
<div class="result" style="margin-top:10px;">
	
