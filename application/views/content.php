
<?php
require_once "menu_builder.php";;
 ?>

<?php //echo "<pre>"; ?>
<?php if(isset($page_content)){ echo $page_content; }  ?>
<div class='errors h4 bg-danger text-center'
>
    
        <?php echo validation_errors(); ?>
</div>
