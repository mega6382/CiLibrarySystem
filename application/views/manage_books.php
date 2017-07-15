
	<h2>Manage books</h2>
	<table  class="pure-table pure-table-bordered">
	<thead>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Author</th>
		<th>Published</th>
		<th>Rack</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($books as $book): ?>
	<tr>
		<td><?=$book->id?></td>
		<td><?=$book->name?></td>
		<td><?=$book->author?></td>
		<td><?=$book->pub_year?></td>
		<td><?=$racks[$book->rack_id]?></td>
		<td><a href="<?php echo base_url() ?>index.php/admin/edit_book?id=<?=$book->id?>">Edit</a></td>
	</tr>
	<?php endforeach;?>
	</tbody>
	</table>
    <br/>
</body>

</html>