<legend><?php echo ucwords(CrugeTranslator::t("crear nuevo usuario"));?>  </legend>
<div class="form">
<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'crugestoreduser-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>
<div class="row form-group">
	<div class="col">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<div class="col">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="col">
		<?php echo $form->labelEx($model,'newPassword'); ?>
		<?php echo $form->textField($model,'newPassword'); ?>
		<?php echo $form->error($model,'newPassword'); ?>
		
		<script>
			function fnSuccess(data){
				$('#CrugeStoredUser_newPassword').val(data);
			}
			function fnError(e){
				alert("error: "+e.responseText);
			}
		</script>
		<?php echo CHtml::ajaxbutton(
			CrugeTranslator::t("Generar una nueva clave")
			,Yii::app()->user->ui->ajaxGenerateNewPasswordUrl
			,array('success'=>'js:fnSuccess','error'=>'js:fnError')
		); ?>
		
	</div>
</div>
<!-- inicio de campos extra definidos por el administrador del sistema -->
<?php 
	if(count($model->getFields()) > 0){
		echo "<div class='row form-group'>";
		echo "<div class='separator-form span11'>".ucfirst(CrugeTranslator::t("datos de la cuenta"))."</div>";
                echo '<div class="clear"></div>';
		foreach($model->getFields() as $f){
			// aqui $f es una instancia que implementa a: ICrugeField
			echo "<div class='col'>";
			echo Yii::app()->user->um->getLabelField($f);
			echo Yii::app()->user->um->getInputField($model,$f);
			echo $form->error($model,$f->fieldname);
			echo "</div>";
		}
		echo "</div>";
	}
?>
<!-- fin de campos extra definidos por el administrador del sistema -->
<div class="row buttons">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => CrugeTranslator::t("Crear Usuario"),
    )); ?>
</div>
<?php echo $form->errorSummary($model); ?>
<?php $this->endWidget(); ?>
</div>