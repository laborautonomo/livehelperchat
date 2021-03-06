<h2><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/sendnotice','Send a message to the user');?></h2>

<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php if (isset($message_saved) && $message_saved == 'true') : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('chat/sendnotice','Message was sent to the user'); ?>

<script>
setTimeout(function(){
    parent.$.colorbox.close();
},3000);
</script>

	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>	
<?php endif; ?>

<p><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/sendnotice','If the message was already sent, this will mark it as not delivered and the user will be shown the chat message again.');?></p>

<form action="" method="post">

	<textarea name="Message" id="sendMessageContent" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/sendnotice','Type your message to the user');?>"><?php echo htmlspecialchars($visitor->operator_message) ?></textarea>
	
	<div class="row">
		<div class="columns small-6"><label><input type="checkbox" name="RequiresEmail" value="on" <?php $visitor->requires_email == 1 ? print 'checked="checked"' : ''?> />&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/sendnotice','Requires e-mail')?></label></div>
		<div class="columns small-6"><label><input type="checkbox" name="RequiresUsername" value="on" <?php $visitor->requires_username == 1 ? print 'checked="checked"' : ''?> />&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/sendnotice','Requires name')?></label></div>
	</div>
	
	<select id="id_CannedMessage-<?php echo $chat->id?>" onchange="$('#sendMessageContent').val(($(this).val() > 0) ? $(this).find(':selected').text() : '');">
		        <option value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/adminchat','Select a canned message')?></option>
		        <?php foreach (erLhcoreClassModelCannedMsg::getCannedMessages($chat->dep_id,erLhcoreClassUser::instance()->getUserID()) as $item) : ?>
		            <option value="<?php echo $item->id?>"><?php echo htmlspecialchars(str_replace('{nick}', $chat->nick, $item->msg))?></option>
		       <?php endforeach;?>
	</select>
	      
	<input type="submit" class="button small" name="SendMessage" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/sendnotice','Send the message');?>" />

</form>