<?php
class VoceroImportForm extends CFormModel
{
    public $file;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(  
             array('file', 'file', 
                                            'types'=>'csv',
                                            'maxSize'=>1024 * 1024 * 10, // 10MB
                                            'tooLarge'=>'El archivo es mayor que file 10MB. Por favor cargue un archivo menos pesado.',
                                            'allowEmpty' => false
                              ),
                   );
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'file' => 'Seleccione el archivo',
        );
    }
 
}


?>