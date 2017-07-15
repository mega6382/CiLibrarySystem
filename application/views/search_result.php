
	<h2>Search Result For: <?= $query ?></h2>
	<table  class="pure-table pure-table-bordered">
	<thead>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Author</th>
		<th>Published</th>
		<th>Rack</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($books as $book): ?>
	<tr>
		<td><?=$book->id?></td>
		<td><?=$book->name?></td>
		<td><?=$book->author?></td>
		<td><?=$book->pub_year?></td>
		<td><?= $racks[$book->rack_id]?></td>
	</tr>
	<?php endforeach;?>
	</tbody>
	</table>
    <br/>
</body>

</html>