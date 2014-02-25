<?php
class ldVault
{
    public $binaryCode, $itemSize, $dbVersion, $account, $codeGroup, $slotNumbers;
    public function __construct($account, $dbVersion) 
    {
        try
        {
            global $sqlMu;
            $this->clearVars();
            if(is_numeric($dbVersion) == false)
                throw new Exception("dbVersion must be numeric.");
            if($dbVersion < 1 || $dbVersion > 3)
                throw new Exception("dbVersion invalid.");
            $this->dbVersion = $dbVersion;                               
            $this->account = $account;
            
            if($this->dbVersion == 3)
            {
                $getLenghts = $sqlMu->query("SELECT [length] FROM [syscolumns] WHERE OBJECT_NAME([id]) = 'warehouse' AND [name] = 'Items';");
                $getLenghts = mssql_fetch_object($getLenghts);
                $this->slotNumbers = ($getLenghts->length * 2) / 32;
            }
        } 
        catch ( Exception $msg )
        {
            exit("Vault class error: ". $msg->getMessage());
        }
    } 
    
    private function clearVars()
    {
        $this->binaryCode = NULL;
        $this->itemSize = NULL;
        $this->dbVersion = NULL;
        $this->account = NULL;
        $this->codeGroup = array();
    }
    
    public function getVault()
    {
        global $sqlMu;
        try
        {
            switch($this->dbVersion)
            {
                case 1: case 2:
                    $this->itemSize = 10*120;
                    break;
                case 3:
                    $this->itemSize = 16*$this->slotNumbers;
                    break;   
            }
            $getVault = $sqlMu->prepare("DECLARE @BINARYITEMS VARBINARY(:itemSize); SELECT @BINARYITEMS = [Items] FROM [dbo].[warehouse] WHERE [AccountID] = :AccountId; PRINT @BINARYITEMS;");
            $getVault->bindValue(":itemSize", $this->itemSize, sqlServerStatement::PARAM_INT);
            $getVault->bindValue(":AccountId", $this->account, sqlServerStatement::PARAM_STR);
            $getVault->execute();
            $this->binaryCode = substr($getVault->getLastMessage(),2);
        } 
        catch ( Exception $msg )
        {
            exit("Vault error: ". $msg->getMessage());
        }
    }
    public function cutCode()
    {
        try
        {
            switch($this->dbVersion)
            {
                case 1: case 2:
                    if(strlen($this->binaryCode) <> 10*120*2)
                        throw new Exception("Invalid vault size");
                    $codeGroup = str_split($this->binaryCode, 20);
                    break;
                case 3:                       
                    if(strlen($this->binaryCode) <> 16*$this->slotNumbers*2)
                        throw new Exception("Invalid vault size");
                    $codeGroup = str_split($this->binaryCode, 32);
                    break;   
            }
            foreach($codeGroup as $slot => $code)
            {
                ldItemParse::parseHexItem($code, $this->dbVersion);
                ldItemParse::getPositionBySlot($slot);
                array_push($this->codeGroup, array("Code" => $code, "Details" => ldItemParse::$dumpTemp));
            }  
            //print_r($this->binaryCode);
            //print_r($this->codeGroup);
        } 
        catch ( Exception $msg )
        {
            exit("Vault error: ". $msg->getMessage());
        }  
    } 
    public function structureVault()
    {
        try
        {
            $slot = 0;
            for($y = 0; $y < 15; $y++)
            {
                for($x = 0; $x < 8; $x++)
                {
                    if($this->codeGroup[$slot]['Details']['IsItem'] == true)
                    {
                        for($cY = 0; $cY < $this->codeGroup[$slot]['Details']['Item']['Y']; $cY++)
                        {
                            $this->codeGroup[$slot+($cY*8)]['Details']['IsFree'] = false; 
                            for($cX = 0; $cX < $this->codeGroup[$slot]['Details']['Item']['X']; $cX++)
                            {
                                $this->codeGroup[$slot+($cY*8)+$cX]['Details']['IsFree'] = false;
                            }
                        }     
                    }
                    $slot++;
                }       
            }
        } 
        catch ( Exception $msg )
        {
            exit("Vault structure error: ". $msg->getMessage());
        }  
    } 
    public function searchSlotsInVault($sX, $sY, $fix = false)
    {
        try
        {
            $slot = 0;
            for($y = 0; $y < 15; $y++)
            {
                for($x = 0; $x < 8; $x++)
                {
                    if($this->codeGroup[$slot]['Details']['IsFree'] == true)
                    {
                        $free = true;
                        if($y+$sY <= 15 && $x+$sX <= 8) 
                        {
                            for($cY = 0; $cY < $sY; $cY++)
                            {
                                if($this->codeGroup[$slot+($cY*8)]['Details']['IsFree'] == false) $free = false; 
                                for($cX = 0; $cX < $sX; $cX++)
                                {
                                    if($this->codeGroup[$slot+($cY*8)+$cX]['Details']['IsFree'] == false) $free = false;
                                }
                            }
                            if($free == true && $fix === false) return $slot;
                            elseif($free == true && $fix == $slot) return $slot; 
                        }
                    }
                    $slot++;
                }       
            }
            return -1;
        } 
        catch ( Exception $msg )
        {
            exit("Vault structure error: ". $msg->getMessage());
        }  
    }
    public function insertItemInSlot($hex, $slot)
    {
        $this->codeGroup[$slot]['Code'] = $hex; 
        ldItemParse::parseHexItem($hex, $this->dbVersion);
        ldItemParse::getPositionBySlot($slot);
        $this->codeGroup[$slot]["Details"] = ldItemParse::$dumpTemp;
    }
    public function writeVault($sqlWrite = false)
    {
        $this->binaryCode = NULL;
        foreach($this->codeGroup as $slot)
        {
            $this->binaryCode .= $slot['Code'];
        }
        if($sqlWrite == true)
        {
            global $sqlMu;
            $update = $sqlMu->prepare("UPDATE [dbo].[warehouse] SET [Items] = 0x{$this->binaryCode} WHERE [AccountId] = :AccountId");
            $update->bindValue(":AccountId", $this->account, sqlServerStatement::PARAM_STR);
            $update->execute();
        }
        //echo $this->binaryCode;   
    }
    public function drawVault()
    {
        $i = (int) 0;
        echo "<div class=\"quadros\" style=\"width:320px;\">";
        for($Line = 0; $Line < 15; $Line++)
        {
            for($Column = 0; $Column < 8; $Column++)
            {    
                if($this->codeGroup[$i++]['Details']['IsFree'] == true) 
                {
                    echo "<input type=\"button\" style=\"margin: 0px; padding: 0px; background: #FAFAFA; border: 3px solid #EFEFEF; display: marker; width:40px; height:40px; font-size:10px;\" value=\" "; echo $i-1; echo " \" />";
                }
                else 
                {
                    echo "<input type=\"button\" style=\"margin: 0px; padding: 0px; color:#000000; background: #FF3737; border: 3px solid #D80E0E; display: marker; width:40px; height:40px; font-size:10px;\" value=\" "; echo $i-1; echo " \" />";
                }
            }
        }
        echo "</div>";
    } 
}
?>