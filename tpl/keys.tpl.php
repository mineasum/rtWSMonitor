<table class="table table-striped">
<tr>
<th>no</th>
<th>stockId</th>
<th>cname</th>
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
		<?php echo $v['cname'] ?>
	</td>
<td>
	<a href="kline.php?key=<?php echo $k?>&type=1M">1M</a>
	<a href="kline.php?key=<?php echo $k?>&type=D">D</a>
	<a href="kline.php?key=<?php echo $k?>&type=W">W</a>
	<a href="kline.php?key=<?php echo $k?>&type=M">M</a>
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
