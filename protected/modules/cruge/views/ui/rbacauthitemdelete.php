<legend><?php echo ucwords(CrugeTranslator::t("eliminar"));?> <?php echo $model->name; ?></legend>
<div class="form">
<?php
	/*
		$model:  es una instancia que implementa a CrugeAuthItemEditor
	*/
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'crugestoreduser-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>
<p>
	<?php echo ucfirst(CrugeTranslator::t("marque la casilla para confirmar la eliminacion")); ?>
	<?php echo $form->checkBox($model,'deleteConfirmation'); ?>
	<?php echo $form->error($model,'deleteConfirmation'); ?>
</P>
<div class="row buttons">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
                'id' => 'submit',
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => CrugeTranslator::t("Eliminar"),
                'htmlOptions' => array(
                    'name' => 'submit'
                )
        )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'label' => CrugeTranslator::t("Volver"),
                'id' => 'volver',
                'htmlOptions' => array(
                    'name' => 'volver'
                )
        )); ?>
</div>
<?php echo $form->errorSummary($model); ?>
<?php $this->endWidget(); ?>
</div>