    <div>
        <div>
<?php
$id = $this->input->get('id', TRUE);
 echo "<div>";
 echo validation_errors();
 echo "</div>";
 echo form_open('client/search_result', ['class'=> "pure-form"]);
 ?>
     <fieldset>
        <legend>Search Books</legend>
<?php
 echo form_input('query', '', ["placeholder" => "Name, Author or Published Year", "style" => "width: 280px;", "class" => "pure-input-rounded"]);
 echo form_submit('submit', 'Search', "class=\"pure-button\"");
 echo "</fieldset>";
 echo form_close();
 ?>
        </div>
    </div>
	

</body>

</html>