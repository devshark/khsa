<?php
require_once('classes/class.status.php');
$id = $_GET['id'] ?: '';
?>
<select name="guard_status">
<?php
foreach(Status::hire_status() as $status){
?>
<option value="<?php echo $status->id;?>" <?php echo $status->id == $id ? 'selected' : '';?>><?php echo $status->status;?></option>
<?php } ?>
</select>