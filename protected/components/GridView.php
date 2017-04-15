<?php
Yii::import('zii.widgets.grid.CGridView');
class GridView extends CGridView
{
    public function run()       
    {
        $this->registerClientScript();  
        echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";

        $total=$this->dataProvider->getTotalItemCount();//added line
        echo "<h3>Total de personas en cola: ".$total."</h3>";//added line
	if($total > 0){
	    $ticket=$this->dataProvider->getData()[0]['cedula'].'-'.$this->dataProvider->getData()[0]['id']; //added line
            echo "<h3>Numero de Ticket: ".$ticket."</h3>";//added line
	}else
            echo "<h3>Numero de Ticket: - </h3>";//added line
	
        $this->renderContent();
        $this->renderKeys();

        echo CHtml::closeTag($this->tagName);
    }
        
}
?>
