
<table class="table table-striped">
<tr>
<th>Email</th>
<th>Flag</th>
</tr>
<?php foreach( $data['datalist'] as $line ) :?>
<?php if(empty($line['email']) ) continue;?>
<tr>
<td>
<?php echo $line['email'];?>
</td>
<td>
<?php echo $line['flag'];?>
</td>
</tr>
<?php endforeach;?>
</table>
