<legend><?php echo ucwords(CrugeTranslator::t("operaciones"));?></legend>

<div class='auth-item-create-button'>
<?php echo CHtml::link(CrugeTranslator::t("Crear Nueva Operacion")
	,Yii::app()->user->ui->getRbacAuthItemCreateUrl(CAuthItem::TYPE_OPERATION));?>
</div>

<?php 
	echo CrugeTranslator::t("Filtrar:");
	$ar = array(
		'4'=>CrugeTranslator::t('Ver Todo'),
		'1'=>CrugeTranslator::t('Módulos'),
		'2'=>CrugeTranslator::t('Usuarios'),
		//'3'=>CrugeTranslator::t('Controladoras'),
	);
//	foreach(Yii::app()->user->rbac->enumControllers() as $c)
//		$ar[$c] = $c;
	// build list
	echo "<ul class='cruge_filters'>";
	foreach($ar as $filter=>$text)
		echo "<li>".CHtml::link($text, array('/cruge/ui/rbaclistops',
			'filter'=>$filter))."</li>";
	echo "</ul>";
?>

<?php $this->renderPartial('_listauthitems'
	,array('dataProvider'=>$dataProvider)
	,false
	);?>
