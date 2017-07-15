
    <div>
        <div>
<?php
$id = $this->input->get('id', TRUE);
 echo "<div>";
 echo validation_errors();
 echo "</div>";
 echo form_open('admin/edit_rack', ['class'=> "pure-form pure-form-stacked"]);
 ?>
     <fieldset>
        <legend>Edit Rack</legend>
<?php
 echo form_label('Change Name: ', 'name');
 echo form_hidden('id', $id);
 echo form_input('name', $name,"placeholder=\"Name\"");
 echo form_submit('submit', 'Edit', "class=\"pure-button pure-button-primary\"");
 echo "</fieldset>";
 echo form_close();
 ?>
        </div>
    </div>
</body>

</html>