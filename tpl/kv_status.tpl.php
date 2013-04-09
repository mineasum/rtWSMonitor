<h1><?php echo $_GET['node'] ?></h1>
<table class="table table-striped">
<tr>
	<th width="40%">key</th>
	<th width="60%">value</th>
</tr>
<?php foreach( $data['info'] as $k=>$v):?>
<tr>
	<td><?php echo $k?></td>
	<td><?php echo $v?></td>
</tr>
<?php endforeach;?>
</table>
