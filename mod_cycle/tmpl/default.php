<?php defined('_JEXEC') or die('Restricted access'); ?> 

<?php if(isset($output)): ?>
<div id="<?php echo $params->get('moduleclass_sfx');?>" style="	position: relative;
	margin: 0 auto;">
	<div id="<?php echo $IdSelector; ?>" class="<?php echo $class; ?>" style="width: <?php echo $width; ?>px;  height: <?php echo $height; ?>px;">
		<?php echo $output; ?>
	</div>
</div>

<?php else : ?>
	<div>
		Output is not set		
	</div>
<?php endif ?>