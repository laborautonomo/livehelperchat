<?php 

$filter = array('filter' => array('disabled' => 0, 'hidden' => 0));

if (isset($input_data->departament_id_array)){
	$filter['filterin']['id'] = $input_data->departament_id_array;
}

$departments = erLhcoreClassModelDepartament::getList($filter);

// Show only if there are more than 1 department
if (count($departments) > 1) : ?>

<?php if (isset($input_data->departament_id_array)) : foreach ($input_data->departament_id_array as $definedDep) : ?>
<input type="hidden" name="DepartmentIDDefined[]" value="<?php echo $definedDep?>" />
<?php endforeach;endif;?>

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Department');?></label>
<select name="DepartamentID">
    <?php
    $departments = erLhcoreClassDepartament::sortByStatus($departments);
    foreach ($departments as $departament) : ?>
        <option <?php if ($departament->is_online === false) : ?>class="offline-dep"<?php endif;?> value="<?php echo $departament->id?>" <?php isset($input_data->departament_id) && $input_data->departament_id == $departament->id ? print 'selected="selected"' : '';?> ><?php echo htmlspecialchars($departament->name)?><?php if ($departament->is_online === false) : ?>&nbsp;&nbsp;--=<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Offline');?>=--<?php endif;?></option>
    <?php endforeach; ?>
</select>
<?php endif; ?>