<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Country</th>
		<th>Actions</th>
	</tr>
<?php foreach( $artists as $artist ) :?>
	<tr>
		<td><?php echo $artist['id']; ?></td>
		<td><?php echo $artist['name']; ?></td>
		<td><?php echo $artist['country']; ?></td>
		<td>
			<a href="<?php echo DX_ROOT_URL; ?>admin/artists/edit/<?php echo $artist['id']; ?>">Edit</a>
			<a href="<?php echo DX_ROOT_URL; ?>admin/artists/delete/<?php echo $artist['id']; ?>">Delete</a>
		</td>
	</tr>
<?php endforeach; ?>
</table>