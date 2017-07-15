

    <div>
        <div>
<?php
$options = [];
foreach($racks as $rack)
{
	$options[$rack->id] = $rack->name;
}
 echo "<div>";
 echo validation_errors();
 echo "</div>";
 echo form_open('admin/edit_book', ['class'=> "pure-form pure-form-stacked"]);
 ?>
     <fieldset>
        <legend>Edit Book</legend>
<?php
 echo form_hidden('id', $book->id);
 echo form_label('Book Name: ', 'name');
 echo form_input('name', $book->name,"placeholder=\"Name\"");
 echo form_label('Author Name: ', 'author');
 echo form_input('author', $book->author,"placeholder=\"Author\"");
 echo form_label('Published year: ', 'pub_year');
 echo form_input('pub_year', $book->pub_year,"placeholder=\"Published Year\"");
 echo form_label('Rack: ', 'rack');
 echo form_dropdown('rack', $options, $book->rack_id);
 echo form_submit('submit', 'Add', "class=\"pure-button pure-button-primary\"");
 echo "</fieldset>";
 echo form_close();
 ?>
        </div>
    </div>
</body>

</html>