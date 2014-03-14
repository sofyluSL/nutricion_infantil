<?php
	/*
		$model:  es una instancia que implementa a CrugeAuthItemEditor
	*/
	
?>
<legend><?php echo ucwords(CrugeTranslator::t("editando")." ".CrugeTranslator::t($model->categoria));?></legend>
<?php $this->renderPartial('_authitemform',array('model'=>$model),false);?>