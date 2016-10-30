<?php
namespace backend\models;
use common\models\User;
use yii\base\Model;
use Yii;
use common\models\ValueHelpers;

/**
 * Signup form
 */
class Upload extends Model
{
    

    public function uploadFileBD($inputFile){
          
       try{

            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);


            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $higheColumn = $sheet->getHighestColumn();
            $mensaje=1;
            for ($row=1; $row <=$highestRow ; $row++) { 
                
                $rowData = $sheet->rangeToArray('A'.$row.':'.$higheColumn.$row,NULL,TRUE,FALSE);              
                if($row == 1){//Este if es por si el archivo tiene nombre de los atributos y  de ser asi no tome la primera fila encuenta
                    continue;
                }
               
                $ced = $rowData[0][1];   
                $clave = "Univalle".$ced;
                $user = new User();
                $user->passwordNueva = 'nueva';
                $user->passwordConfirmada = 'nueva';
                $user->nombre_completo = $rowData[0][0];
                $user->cedula = $rowData[0][1];               
                $user->telefono = $rowData[0][2];    
                $user->email = $rowData[0][3];  
                $rolId = ValueHelpers::getRoleValue($rowData[0][4]);                
                $user->role_id = $rolId;                  
                $user->setPassword($clave);
                $user->generateAuthKey();        
                $user->save();   
            }
            return true;
           
        }catch(yii\db\Exception $e){
            return false;           
        }
   }

}