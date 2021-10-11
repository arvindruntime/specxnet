<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * This library hel to import a php excel.
 * @package      CodeIgniter
 * @subpackage   Libraries
 * @category     Libraries
 * @author       Bimal Sharma <sharma.bimal226@gmail.com> 
 */

require_once APPPATH."/third_party/PHPExcel.php";

class Excel extends PHPExcel{

    protected $validateType = array('xlsx','csv','xls');
    protected $objPHPExcel = null;
    protected $tableColumn = array();
    protected $tableData = array();
    protected $excelResponse = array();
    protected $heighestCoumn = 'A';
    protected $headerColumn = '';
    protected $cellData = array();

    public function __construct() {
        parent::__construct();
    }

    /**
     * set maximum coul
     */
    public function setHeaderColumn($coulmn) {
        $this->headerColumn = $coulmn;
        $keys = array_keys($coulmn); 
        if(!empty($keys)) {
            $this->heighestCoumn = $keys[count($keys)-1];
        }
    }

    /**
     * validate excel import type
     * @param $file string file path or file name with extention
     * @return boolean send file executions
     * @author Bimal Sharma <sharma.bimal226@gmail.com>
     */
    public function validateFileType($file) {
        try {
            $fileExtention = pathinfo($file, PATHINFO_EXTENSION);
            if(in_array($fileExtention, $this->validateType)) {
                return true;
            }else {
                $this->_setResponseMessage(418,'Invalide excel format');
                return false;
            }
        }catch (Exception $e) {
            $this->_setResponseMessage($e->getCode(),$e->getMessage());
            return false;
        }
    }

    /**
     * load excel of given path
     * @param $file String file location from where file data get feach
     * @return boolean object is initialized or not
     * @author Bimal Sharma <sharma.bimal226@gmail.com>
     */
    public function loadExcel($file) {
        try {
            $this->objPHPExcel = PHPExcel_IOFactory::load($file);
            return true;
        }catch (Exception $e) {
            $this->_setResponseMessage($e->getCode(),$e->getMessage());
            return false;
        }
        
    }

    

    /**
     * create array data from excel. This array data is going to insert into a respective table 
     * @param null
     * @return boolean send function executions
     * @author Bimal Sharma <sharma.bimal226@gmail.com>    
     */
    public function importExcel($excelHeaders=null, $module=null) {
        try {
            if(!$this->objPHPExcel) {
                $this->_setResponseMessage(418,'file not found');
                return false;
            }
            // get Cell Collection
            $activeSheet = $this->objPHPExcel->getActiveSheet();
            $cellArray = $activeSheet->toArray(null,true,true,true);
            $this->cellData = $cellArray[1];
            // get Each Row Value
            for ($row=1; $row <=count($cellArray); $row++) { 
                $n = array_keys($cellArray[$row]); 
                $count = array_search($this->heighestCoumn, $n); 
                $cellCollection = array_slice($cellArray[$row], 0, $count + 1, true);

                foreach ($cellCollection as $column => $dataValue) {
                    // $row 1 should contain name of column
                    if ($row == 1) {
                        $this->tableColumn[] = $dataValue;
                    } else {
                        if(!isset($this->headerColumn[$column]) || ($this->headerColumn[$column]['require']) && (!isset($dataValue) || empty($dataValue)) && (isset($module) && $module !='Proposal')) { 
                            //Change Done in above condition to skip blanck values in Proposal section @Sagar Kodalkar.
                            $this->tableData = array();
                            $this->tableColumn = array();
                            $this->_setResponseMessage(418,'Data is not set for column :'.$column.' row :'.$row);
                            return false;
                        }else {
                            $this->tableData[($row-1)][$this->headerColumn[$column]['name']] = $dataValue;
                        }
                    }
                    
                }
            }
            return true;
        } catch (Exception $e) {
            $this->_setResponseMessage($e->getCode(),$e->getMessage());
            return false;
        }
    }

    /**
     * get table column here
     * @param null
     * @return array polished data for inserting into a array
     * @author Bimal Sharma <sharma.bimal226@gmail.com>  
     */
    public function getImportData() {
        // creating an array for import
        $data['column'] = $this->tableColumn;
        $data['rows'] = $this->tableData;
        $data['cellArray'] = $this->cellData;
        return $data;
    }

    /**
     * set excel response message
     * @param $code int response code 
     * @param $message string response message
     * @author Bimal Sharma <sharma.bimal226@gmail.com>
     */
    protected function _setResponseMessage($code = 404,$message = 'not found') {
        $this->excelResponse['code'] = $code;
        $this->excelResponse['message'] = $message;
    }

    /**
     * get Excel response message
     * @return Array excel response message
     * @author Bimal Sharma <sharma.bimal226@gmail.com>
     */
    public function getResponseMessage() {
        return $this->excelResponse;
    }

} 




