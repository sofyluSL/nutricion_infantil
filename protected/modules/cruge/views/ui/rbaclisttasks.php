<legend><?php echo ucwords(CrugeTranslator::t("tareas"));?></legend>

<div class='auth-item-create-button'>
<?php echo CHtml::link(CrugeTranslator::t("Crear Nueva Tarea")
	,Yii::app()->user->ui->getRbacAuthItemCreateUrl(CAuthItem::TYPE_TASK));?>
</div>

<?php $this->renderPartial('_listauthitems',array('dataProvider'=>$dataProvider),false);?>
