<?php
/**
 * Created by PhpStorm.
 * User: ihor
 * Date: 09.11.16
 * Time: 16:30
 */
namespace frontend\modules\mart\models;

use yii\web\UploadedFile;

class LoadFile extends \yii\base\Model{
    public $title;
    public $pricelist;


    function rules(){
        return [
            ['title', 'string'],
            ['pricelist', 'file']
        ];
    }

    function getFile(){
        $this->pricelist = UploadedFile::getInstance($this, 'pricelist');
        $file_pricelist_path =  $this->pricelist->baseName . '.' . $this->pricelist->extension;
        if($this->pricelist->saveAs( $this->pricelist->baseName . '.' . $this->pricelist->extension)){
            chmod($file_pricelist_path, 777);
            $this->xls2csv('/var/www/azapasprice/frontend/web/' . $file_pricelist_path, '/var/www/azapasprice/frontend/web/'. $this->pricelist->baseName .'.csv');
            //var_dump('MD5-хэш файла : ' . md5_file($this->pricelist->baseName . '.csv'));exit;
        }

    }

    public static function xls2csv($from_file, $to_file) {
        $comand = "xls2csv -x " .$from_file. " -s cp1252 -d 8859-1 > " . $to_file;
        exec($comand);
    }
}