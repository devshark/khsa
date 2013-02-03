<?php
require_once('classes/class.manufacturer.php');
$id = $_GET['Manufacturer_ID'] ?: '';
?>
<select name="Manufacturer_ID">
<?php
foreach(Manufacturer::get_list() as $name){
?>
<option value="<?php echo $name->Manufacturer_ID;?>" <?php echo $name->Manufacturer_ID == $id ? 'selected' : '';?>><?php echo $name->Manufacturer_Name;?></option>
<?php } ?>
</select>