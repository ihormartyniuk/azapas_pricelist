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
            if($this->pricelist->extension =='xls'){
                $this->xls2csv('/var/www/azapasprice/frontend/web/' . $file_pricelist_path, '/var/www/azapasprice/frontend/web/'. $this->pricelist->baseName .'.csv');
            }
            if($this->pricelist->extension =='xlsx'){
                $this->xlsx2csv('/var/www/azapasprice/frontend/web/' . $file_pricelist_path, '/var/www/azapasprice/frontend/web/'. $this->pricelist->baseName .'.csv');
            }
            $this->csv_to_array('/var/www/azapasprice/frontend/web/'. $this->pricelist->baseName .'.csv');
        }else{
            return false;
        }
    }

    public static function xls2csv($from_file, $to_file) {
        $comand = "xls2csv -x " .$from_file. " -s cp1252 -d 8859-1 > " . $to_file;
        exec($comand);
    }

    public static function xlsx2csv($from_file, $to_file) {
        $comand = "xlsx2csv " .$from_file. " " . $to_file;
        exec($comand);
    }

    function csv_to_array($filename='')
    {

        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while(!feof($handle))
            {
                $string = fgetcsv($handle);
                $count = count($string);
                for($i=0; $i< $count; $i++){
                    if($i>10)
                    {
                        unset($string[$i]);
                    }

                }
                print_r($string);
            }
            fclose($handle);
            var_dump('ddd');exit;
        }
    }
}