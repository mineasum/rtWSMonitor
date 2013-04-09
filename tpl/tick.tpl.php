
<table class="table table-striped">
<tr>
	<th>no</th>
	<th>raw</th>
</tr>
<?php foreach( $data['datalist'] as $k=> $d ) :?>
	<tr>
	<td>
	<?php echo $k?>
	</td>
	<td>
	<?php echo $d?>
	</td>
	</tr>
<?php endforeach;?>
</table>
