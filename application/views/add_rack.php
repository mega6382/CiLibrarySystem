
    <div>
        <div>
<?php
 echo "<div>";
 echo validation_errors();
 echo "</div>";
 echo form_open('admin/add_rack', ['class'=> "pure-form pure-form-stacked"]);
 ?>
     <fieldset>
        <legend>Add New Rack</legend>
<?php
 echo form_label('Choose Name: ', 'name');
 echo form_input('name', '',"placeholder=\"Name\"");
 echo form_submit('submit', 'Add', "class=\"pure-button pure-button-primary\"");
 echo "</fieldset>";
 echo form_close();
 ?>
        </div>
    </div>
</body>

</html>