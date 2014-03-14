<div class="form">
<legend><?php echo ucwords(CrugeTranslator::t("sesiones de usuario"));?></legend>
<?php 
//$this->widget(Yii::app()->user->ui->CGridViewClass, array(
//    'dataProvider'=>$dataProvider,
//    'columns'=>array(
//		'idsession',
//		array('name'=>'iduser','htmlOptions'=>array('width'=>'50px')),
//		array('name'=>'sessionname','filter'=>''),
//		array('name'=>'status','filter'=>array(1=>'Activa',0=>'Cerrada')
//			,'value'=>'$data->status==1 ? \'activa\' : \'cerrada\' '),
//		array('name'=>'created','type'=>'datetime'),
//		array('name'=>'lastusage','type'=>'datetime'),
//		array('name'=>'usagecount','type'=>'number'),
//		array('name'=>'expire','type'=>'datetime'),
//		'ipaddress',
//		array(
//			'class'=>'CButtonColumn',
//			'template' => '{delete}',
//			'deleteConfirmation'=>CrugeTranslator::t("Esta seguro de eliminar esta sesion ?"),
//			'buttons' => array(
//					'delete'=>array(
//						'label'=>CrugeTranslator::t("eliminar sesion"),
//						'imageUrl'=>Yii::app()->user->ui->getResource("delete.png"),
//						'url'=>'array("sessionadmindelete","id"=>$data->getPrimaryKey())'
//					),
//				),	
//		)	
//	),
//	'filter'=>$model,
//));

$this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'llamada-grid',
            'type' => 'striped condensed',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
//		'idsession',
//		array('name'=>'iduser','htmlOptions'=>array('width'=>'50px')),
		array('name'=>'sessionname','filter'=>''),
		array('name'=>'status','filter'=>array(1=>'Activa',0=>'Cerrada')
			,'value'=>'$data->status==1 ? \'activa\' : \'cerrada\' '),
		array(
                    'name'=>'created',
                    'value' => 'date("d M Y h:i:s a",$data->created)',
                ),
//		array(
//                    'name'=>'lastusage',
//                    'value' => 'date("d M Y h:i:s a",$data->lastusage)',
//                ),
//		array('name'=>'usagecount','type'=>'number', 'header'=>'contador'),
		array(
                    'name'=>'expire',
                    'value' => 'date("d M Y h:i:s a",$data->expire)',
                ),
		'ipaddress',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{delete}',
			'deleteConfirmation'=>CrugeTranslator::t("Esta seguro de eliminar esta sesion ?"),
			'buttons' => array(
					'delete'=>array(
						'label'=>CrugeTranslator::t("eliminar sesion"),
						'url'=>'array("sessionadmindelete","id"=>$data->getPrimaryKey())'
					),
				),	
		)	
	)
        ));
?>

</div>