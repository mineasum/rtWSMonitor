<h3>KV Server</h3>
<table class="table table-striped">
<tr>
<th>Title</th>
<th>Addr</th>
<th>Status</th>
</tr>
<?php foreach( $data['config']['redis'] as $d ) :?>
<tr>
<td><?php echo $d['title']?></td> 
<td><?php echo $d['addr'] ?></td>
<td><?php echo htmlStatus( pingRedis($d['addr']))?></td>
</tr>
<?php endforeach;?>
</table>
<h3>rtWS Server</h3>
<table class="table table-striped">
<tr>
<th>Title</th>
<th>Addr</th>
<th>Status</th>
</tr>
<tr>
<td><?php echo $data['config']['rtws']['title'] ?></td> 
<td><?php echo $data['config']['rtws']['host'] ?></td> 
<td><?php echo htmlStatus(checkRTWS()) ?></td>
</tr>
</table>