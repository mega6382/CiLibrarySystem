
	<h2>Manage Racks</h2>
	<table  class="pure-table pure-table-bordered">
	<thead>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($racks as $rack): ?>
	<tr>
		<td><?=$rack->id?></td>
		<td><?=$rack->name?></td>
		<td><a href="<?php echo base_url() ?>index.php/admin/edit_rack?id=<?=$rack->id?>">Edit</a></td>
	</tr>
	<?php endforeach;?>
	</tbody>
	</table>
    <br/>
</body>

</html>