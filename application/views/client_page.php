
	<h2>List Of Racks</h2>
	<table  class="pure-table pure-table-bordered">
	<thead>
	<tr>
		<th>Name</th>
		<th>Total Books</th>
		<th>View</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($racks as $rack): ?>
	<tr>
		<td><?=$rack->name?></td>
		<td><?=$rack->books?></td>
		<td><a href="<?php echo base_url() ?>index.php/client/view_rack?id=<?=$rack->id?>">View</a></td>
	</tr>
	<?php endforeach;?>
	</tbody>
	</table>
    <br/>
</body>

</html>