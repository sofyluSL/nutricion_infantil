<legend><?php echo ucwords(CrugeTranslator::t("roles"));?></legend>

<div class='auth-item-create-button'>
<?php echo CHtml::link(CrugeTranslator::t("Crear Nuevo Rol")
	,Yii::app()->user->ui->getRbacAuthItemCreateUrl(CAuthItem::TYPE_ROLE));?>
</div>

<?php $this->renderPartial('_listauthitems',array('dataProvider'=>$dataProvider),false);?>