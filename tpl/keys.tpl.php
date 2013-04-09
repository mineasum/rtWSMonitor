<table class="table table-striped">
<tr>
<th>no</th>
<th>stockId</th>
<th>kline</th>
<th>last ptr</th>
<th>lost ptr</th>
</tr>
<?php $i=0?>
<?php foreach( $data['datalist'] as $k=>$v ) : ?>
	<tr>
	<td>
	<?php echo $i++?>		
	</td>
	<td>
	<a href="tick.php?key=<?php echo $k?>"><?php echo $k?></a>
	</td>
<td>
	<a href="kline.php?key=<?php echo $k?>">1min</a>
</td>
	<td>
	<?php echo $v['lostInfo'][0]?>
	</td>
	<td>
	<?php foreach( $v['lostInfo'][3] as $_k=>$lost_ptr ):?>
		<?php echo $lost_ptr ?>
	<?php endforeach;?>
	</td>
	</tr>
<?php endforeach;?>
</table>
