<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Country</th>
	</tr>
<?php foreach( $artists as $artist ) :?>
	<tr>
		<td><?php echo $artist['id']; ?></td>
		<td><?php echo $artist['name']; ?></td>
		<td><?php echo $artist['country']; ?></td>
	</tr>
<?php endforeach; ?>
</table>