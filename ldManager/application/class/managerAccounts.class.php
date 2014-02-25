<?php
/*
    @Class managerAccounts;
*/
class managerAccounts 
{
    public $sentense = NULL;
    public function __construct() {}      
    public function createAccount()
    {
        global $sqlMu;
        try
        {
            foreach($_POST as $post) if(empty($post)) throw new Exception("MNG_ACC_CA_EMPTY_FIELDS");
            if(isset($_POST['username']) == false) throw new Exception("MNG_ACC_CA_EMPTY_FIELDS");
            $checkAccount = $sqlMu->prepare("SELECT [memb___id] FROM [dbo].[MEMB_INFO] WHERE [memb___id] = :memb___id");
            $checkAccount->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR);
            $checkAccount->execute();
            if($checkAccount->rowsCount() > 0)
                throw new Exception("MNG_ACC_CA_LOGIN_EXISTS");
            
            $settings = new Settings("managerAccounts");
            
            $createAccount = $sqlMu->prepare("INSERT INTO MEMB_INFO (memb___id, memb__pwd, memb_name, sno__numb, mail_addr, bloc_code, ctl1_code, fpas_ques, fpas_answ) 
            VALUES (:memb___id, :memb__pwd, :memb_name, :sno__numb, :mail_addr, '0', '1', :fpas_ques, :fpas_answ)");
            $createAccount->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR);
            if($settings->md5_encode == true)
            {
                $getMD5 = $sqlMu->prepare("DECLARE @btOutVal BINARY(16); EXEC master..XP_MD5_EncodeKeyVal :password, :username, @btOutVal OUT; SELECT @btOutVal as md5;");
                $getMD5->bindValue(":password", $_POST['password'], sqlServerStatement::PARAM_STR);
                $getMD5->bindValue(":username", $_POST['username'], sqlServerStatement::PARAM_STR);
                $getMD5->execute();
                $createAccount->bindValue(":memb__pwd", $getMD5->fetchObject()->md5, sqlServerStatement::PARAM_BIN);   
            }
            else 
            {
                $createAccount->bindValue(":memb__pwd", $_POST['password'], sqlServerStatement::PARAM_STR);
            }
            $createAccount->bindValue(":memb_name", $_POST['name'], sqlServerStatement::PARAM_STR);
            $createAccount->bindValue(":sno__numb", $_POST['personalid'], sqlServerStatement::PARAM_STR);
            $createAccount->bindValue(":mail_addr", $_POST['email'], sqlServerStatement::PARAM_STR);
            $createAccount->bindValue(":fpas_ques", $_POST['question'], sqlServerStatement::PARAM_STR);
            $createAccount->bindValue(":fpas_answ", $_POST['answer'], sqlServerStatement::PARAM_STR);
            $createAccount->execute();
            
            $createVault = $sqlMu->prepare("INSERT INTO [dbo].[warehouse] ([AccountID],[Items],[Money],[DbVersion],[pw]) VALUES ( :AccountID, 0x". ($settings->dbversion > 2 ? str_repeat("F", 1920*2) : str_repeat("F", 1200*2)) ." , 0 , :DbVersion , 0)");
            $createVault->bindValue(":AccountID", $_POST['username'], sqlServerStatement::PARAM_STR);
            $createVault->bindValue(":DbVersion", $settings->dbversion, sqlServerStatement::PARAM_INT);
            $createVault->execute();
            
            if($settings->vi_curr_info == true)
            {
                $createAccountJoinServer = $sqlMu->prepare("INSERT INTO [dbo].[VI_CURR_INFO] (ends_days,chek_code,used_time,memb___id,memb_name,memb_guid,sno__numb,Bill_Section,Bill_value,Bill_Hour,Surplus_Point,Surplus_Minute,Increase_Days) VALUES ('2005','1',1234,:memb___id,:memb_name,1,'7','6','3','6','6','2003-11-23 10:36:00','0')");
                $createAccountJoinServer->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR);
                $createAccountJoinServer->bindValue(":memb_name", $_POST['name'], sqlServerStatement::PARAM_STR);
                $createAccountJoinServer->execute();
            }

            throw new Exception("MNG_ACC_CA_LOGIN_DONE");
        }
        catch ( Exception $e )
        {
            $this->sentense = $e->getMessage(); 
        }
    } 
    public function checkAccount($sentence, $subcall, $action)
    {
        global $sqlMu;
        try
        {
            if(isset($_POST['username']) == false) throw new Exception("MNG_ACC_{$sentence}_EMPTY_FIELDS");
            $checkAccount = $sqlMu->prepare("SELECT [memb___id] FROM [dbo].[MEMB_INFO] WHERE [memb___id] = :memb___id");
            $checkAccount->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR);
            $checkAccount->execute();
            if($checkAccount->rowsCount() == 0)
                throw new Exception("MNG_ACC_{$sentence}_LOGIN_NOT_EXISTS");
            header("Location: ?call=managerAccounts&subCall={$subcall}&action={$action}&account=".$_POST['username']);
        }
        catch ( Exception $e )
        {
            $this->sentense = $e->getMessage(); 
        }
    } 
    public function loadAccount($account)
    {
        global $sqlMu;
        try
        {
            if(isset($account) == false) throw new Exception("MNG_ACC_EA_EMPTY_FIELDS");
            $checkAccount = $sqlMu->prepare("SELECT memb___id, memb__pwd, memb_name, sno__numb, mail_addr, bloc_code, ctl1_code, fpas_ques, fpas_answ FROM [dbo].[MEMB_INFO] WHERE [memb___id] = :memb___id");
            $checkAccount->bindValue(":memb___id", $account, sqlServerStatement::PARAM_STR);
            $checkAccount->execute();
            if($checkAccount->rowsCount() == 0)
                throw new Exception("MNG_ACC_EA_LOGIN_NOT_EXISTS");
                                                    
            $this->infos = $checkAccount->fetchObject();
            
            $this->settings = new Settings("managerAccounts");
            if($this->settings->md5_encode == true)
                $this->infos->memb__pwd = null;
            
        }
        catch ( Exception $e )
        {
            $this->sentense = $e->getMessage(); 
        }
    }   
    public function writeAccount()
    {
        global $sqlMu;
        try
        {
            if(
                (isset($_POST['username']) == false || empty($_POST['username']) == true ) || 
                (isset($_POST['name']) == false || empty($_POST['name']) == true ) || 
                (isset($_POST['personalid']) == false || empty($_POST['personalid']) == true ) || 
                (isset($_POST['email']) == false || empty($_POST['email']) == true ) || 
                (isset($_POST['question']) == false || empty($_POST['question']) == true ) || 
                (isset($_POST['answer']) == false || empty($_POST['answer']) == true ) 
              )
                throw new Exception("MNG_ACC_EA_EMPTY_FIELDS");
            $checkAccount = $sqlMu->prepare("SELECT memb___id FROM [dbo].[MEMB_INFO] WHERE [memb___id] = :memb___id");
            $checkAccount->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR);
            $checkAccount->execute();
            if($checkAccount->rowsCount() == 0)
                throw new Exception("MNG_ACC_EA_LOGIN_NOT_EXISTS");
            
            $this->settings = new Settings("managerAccounts");
                                                        
            $this->infos = $checkAccount->fetchObject();
            
            $editAccount = $sqlMu->prepare("UPDATE MEMB_INFO SET memb_name = :memb_name, sno__numb = :sno__numb, mail_addr = :mail_addr, fpas_ques = :fpas_ques, fpas_answ = :fpas_answ WHERE memb___id = :memb___id");
            $editAccount->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR);
            $editAccount->bindValue(":memb_name", $_POST['name'], sqlServerStatement::PARAM_STR);
            $editAccount->bindValue(":sno__numb", $_POST['personalid'], sqlServerStatement::PARAM_STR);
            $editAccount->bindValue(":mail_addr", $_POST['email'], sqlServerStatement::PARAM_STR);
            $editAccount->bindValue(":fpas_ques", $_POST['question'], sqlServerStatement::PARAM_STR);
            $editAccount->bindValue(":fpas_answ", $_POST['answer'], sqlServerStatement::PARAM_STR);
            $editAccount->execute();
            
            if(empty($_POST['password']) == false)
            {
                $editPassword = $sqlMu->prepare("UPDATE MEMB_INFO SET memb__pwd = :memb__pwd WHERE memb___id = :memb___id");
                $editPassword->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR);
            
                if($this->settings->md5_encode == true)
                {
                    $getMD5 = $sqlMu->prepare("DECLARE @btOutVal BINARY(16); EXEC master..XP_MD5_EncodeKeyVal :password, :username, @btOutVal OUT; SELECT @btOutVal as md5;");
                    $getMD5->bindValue(":password", $_POST['password'], sqlServerStatement::PARAM_STR);
                    $getMD5->bindValue(":username", $_POST['username'], sqlServerStatement::PARAM_STR);
                    $getMD5->execute();
                    $editPassword->bindValue(":memb__pwd", $getMD5->fetchObject()->md5, sqlServerStatement::PARAM_BIN);   
                }
                else 
                {
                    $editPassword->bindValue(":memb__pwd", $_POST['password'], sqlServerStatement::PARAM_STR);
                }
                $editPassword->execute();   
            }
            
            throw new Exception("MNG_ACC_EA_DONE");
        }
        catch ( Exception $e )
        {
            $this->sentense = $e->getMessage(); 
        }
    } 
    public function removeAccount()
    {
        global $sqlMu;
        try
        {
            if(isset($_POST['username']) == false || empty($_POST['username']) == true) throw new Exception("MNG_ACC_RA_EMPTY_FIELDS");
            $checkAccount = $sqlMu->prepare("SELECT memb___id FROM [dbo].[MEMB_INFO] WHERE [memb___id] = :memb___id");
            $checkAccount->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR);
            $checkAccount->execute();
            if($checkAccount->rowsCount() == 0)
                throw new Exception("MNG_ACC_EA_LOGIN_NOT_EXISTS");
             
            $sqlMu->prepare("DELETE FROM MEMB_INFO WHERE memb___id = :memb___id")->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR)->execute();
            
            
            $this->settings = new Settings("managerAccounts");
            if($this->settings->vi_curr_info == true)
                $sqlMu->prepare("DELETE FROM VI_CURR_INFO WHERE memb___id = :memb___id")->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR)->execute(); 
            
            $sqlMu->prepare("DELETE FROM AccountCharacter WHERE Id = :memb___id")->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR)->execute(); 
            $sqlMu->prepare("DELETE FROM warehouse WHERE AccountID = :memb___id")->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR)->execute(); 
            
            $findCharsQ = $sqlMu->prepare("SELECT Name FROM Character WHERE AccountID = :memb___id")->bindValue(":memb___id", $_POST['username'], sqlServerStatement::PARAM_STR);
            $findCharsQ->execute();
            if($findCharsQ->rowsCount() > 0)
            {
                foreach($findCharsQ->fetchAll(sqlServerStatement::FETCH_OBJ) as $character)
                {
                    $findGuildMasterQ = $sqlMu->prepare("SELECT G_Name FROM Guild WHERE G_Master = :name")->bindValue(":name", $character->Name, sqlServerStatement::PARAM_STR);    
                    $findGuildMasterQ->execute();    
                    if($findGuildMasterQ->rowsCount() > 0)
                    {
                        $findGuildMaster = $findGuildMasterQ->fetchObject();
                        $sqlMu->prepare("DELETE FROM GuildMember WHERE G_Name = :name")->bindValue(":name", $findGuildMaster->G_Name, sqlServerStatement::PARAM_STR)->execute();
                        $sqlMu->prepare("DELETE FROM Guild WHERE G_Name = :name")->bindValue(":name", $findGuildMaster->G_Name, sqlServerStatement::PARAM_STR)->execute();
                    }
                    else  
                    {
                        $sqlMu->prepare("DELETE FROM GuildMember WHERE Name = :name")->bindValue(":name", $character->Name, sqlServerStatement::PARAM_STR)->execute();
                        $sqlMu->prepare("DELETE FROM Character WHERE Name = :name")->bindValue(":name", $character->Name, sqlServerStatement::PARAM_STR)->execute();
                    }
                }
            } 
            throw new Exception("MNG_ACC_RA_DONE");
        }
        catch ( Exception $e )
        {
            $this->sentense = $e->getMessage(); 
        }
    }  
    public function loadVault()
    {
        global $sqlMu, $language;
        try
        {
            if(isset($_GET['account']) == false || empty($_GET['account']) == true) header("Location: ?call=managerAccounts&subCall=editVault");
            $checkAccount = $sqlMu->prepare("SELECT memb___id FROM [dbo].[MEMB_INFO] WHERE [memb___id] = :memb___id");
            $checkAccount->bindValue(":memb___id", $_GET['account'], sqlServerStatement::PARAM_STR);
            $checkAccount->execute();
            if($checkAccount->rowsCount() == 0)
                header("Location: ?call=managerAccounts&subCall=editVault");
                          
            require_once("ldItem/ldItemDatabase.class.php");
            require_once("ldItem/ldItemOptionsDatabase.class.php");
            require_once("ldItem/ldItemMake.class.php");
            require_once("ldItem/ldItemParse.class.php");     
            require_once("ldItem/ldVault.class.php");
            require_once("ldItem/ldInventory.class.php");
            
            ldItemDatabase::setDatabases("application/", "item.txt", "class/ldItem/data/item.serialize.txt");
            if(ldItemDatabase::checkDatabaseExists() == false)
            {
                ldItemDatabase::createDatabase();   
            }
            if(ldItemDatabase::checkDatabaseExists() == false)
            {
                throw new Exception("DATABASE_CANT_LOAD");   
            }
            
            $settings = new Settings("managerAccounts");
            $this->ldVault = new ldVault($_GET['account'], $settings->dbversion);
            $this->ldVault->getVault();   
            $this->ldVault->cutCode();  
            $this->ldVault->structureVault();
            foreach($this->ldVault->codeGroup as $key => $item)
            {   
                if($item['Details']['IsItem'] == true)
                {
                    //var_dump($item);
                    $this->tempJQuery .= "var boxDetails{$key} = \"<div class='boxDetails'>\
                                                <h2 ". (in_array(true,$item['Details']['ItemExcellents'],true) ? "class='Gcolor'>".$language->sentence['MNG_ACC_EV_TOOLTIP_EXCELLENT']." " : ">") ."".utf8_encode($item['Details']['ItemName'])."</h2>\
                                                <p class='info'>\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_LEVEL'].": +".$item['Details']['ItemLevel']."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_LUCK'].": ". ($item['Details']['ItemLuck'] == true ? "Sim":"N&atilde;o") ."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_SKILL'].": ". ($item['Details']['ItemSkill'] == true ? "Sim":"N&atilde;o") ."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_ADDITIONAL'].": +".($item['Details']['ItemOption']*4)."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_DURABILITY'].": ".$item['Details']['ItemDurability']."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_SERIAL'].": ".$item['Details']['ItemSerial']."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_ANCIENT'].": ".ldItemParse::getAncientName($item['Details']['ItemAncient'], $item['Details']['ItemIdSection'], $item['Details']['ItemIdIndex'])."\
                                                </p>\
                                                <p class='blue'>\
                                                   ". ($item['Details']['ItemExcellents'][5] == true ? ldItemParse::getExcellentName(5, $item['Details']['ItemIdSection'], $item['Details']['ItemIdIndex']) : "")."\
                                                    ". ($item['Details']['ItemExcellents'][4] == true ? ldItemParse::getExcellentName(4, $item['Details']['ItemIdSection'], $item['Details']['ItemIdIndex']) : "")."\
                                                    ". ($item['Details']['ItemExcellents'][3] == true ? ldItemParse::getExcellentName(3, $item['Details']['ItemIdSection'], $item['Details']['ItemIdIndex']) : "")."\
                                                    ". ($item['Details']['ItemExcellents'][2] == true ? ldItemParse::getExcellentName(2, $item['Details']['ItemIdSection'], $item['Details']['ItemIdIndex']) : "")."\
                                                    ". ($item['Details']['ItemExcellents'][1] == true ? ldItemParse::getExcellentName(1, $item['Details']['ItemIdSection'], $item['Details']['ItemIdIndex']) : "")."\
                                                    ". ($item['Details']['ItemExcellents'][0] == true ? ldItemParse::getExcellentName(0, $item['Details']['ItemIdSection'], $item['Details']['ItemIdIndex']) : "")."\
                                                </p>\
                                                ". ($item['Details']['ItemRefine'] > 0 ? "<p class='purple'>\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_OPTION_REFINE'].": ".ldItemParse::getRefineName($item['Details']['ItemIdSection'], $item['Details']['ItemIdIndex'])."\
                                                </p>\\" : "\\") . "
                                                ". ($item['Details']['HarmonyType'] > 0 ? "<p class='yellow'>\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_OPTION_HARMONY'].": ".ldItemParse::getHarmonyName($item['Details']['ItemIdSection'], $item['Details']['ItemIdIndex'], $item['Details']['HarmonyType'], $item['Details']['HarmonyLevel'])."\
                                                </p>\\" : "\\") . "
                                                <p class='blue'>\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_OPTION_SOCKET'].":<br />\
                                                    1: ".ldItemParse::getSocketName(0, $item['Details']['Sockect'][0])."<br />\
                                                    2: ".ldItemParse::getSocketName(1, $item['Details']['Sockect'][1])."<br />\
                                                    3: ".ldItemParse::getSocketName(2, $item['Details']['Sockect'][2])."<br />\
                                                    4: ".ldItemParse::getSocketName(3, $item['Details']['Sockect'][3])."<br />\
                                                    5: ".ldItemParse::getSocketName(4, $item['Details']['Sockect'][4])."\
                                                </p>\
                                            </div>\";
                                        \$('#slot_{$key}').tooltip(boxDetails{$key}, { hook: true, width: 200, mode: 'auto', tooltipClass: 'sexy-tooltipCM'});
                                        ";
                    
                    $this->tempJQuery .= "\$('#slot_{$key}').unbind('click').removeClass('slot').addClass('slotNoEmpty').width(32*{$item['Details']['Item']['X']}).height( ((32*{$item['Details']['Item']['Y']})/2)+6 ).css({'padding-top': $('#slot_{$key}').height()-12, 'z-index': 50}).html('{$item['Details']['ItemName']}');";   
                    
                    $this->tempJQuery .= "\$('#slot_{$key}').click(function(){
                        callModifyItem({$key});
                    });";   
                }
            }
        }
        catch ( Exception $e )
        {
            $this->sentense = $e->getMessage(); 
        }
    }
    public function modifyItem()
    {
        global $sqlMu;
        try
        {
            if(isset($_GET['account']) == false || empty($_GET['account']) == true) throw new Exception("MNG_ACC_EV_EMPTY_FIELDS");
            $checkAccount = $sqlMu->prepare("SELECT memb___id FROM [dbo].[MEMB_INFO] WHERE [memb___id] = :memb___id");
            $checkAccount->bindValue(":memb___id", $_GET['account'], sqlServerStatement::PARAM_STR);
            $checkAccount->execute();
            if($checkAccount->rowsCount() == 0)
                header("Location: ?call=managerAccounts&subCall=editVault");
                                                                
            require_once("ldItem/ldItemDatabase.class.php");
            require_once("ldItem/ldItemOptionsDatabase.class.php");
            require_once("ldItem/ldItemMake.class.php");
            require_once("ldItem/ldItemParse.class.php");     
            require_once("ldItem/ldVault.class.php");
            require_once("ldItem/ldInventory.class.php");
            
            ldItemDatabase::setDatabases("application/", "item.txt", "class/ldItem/data/item.serialize.txt");
            if(ldItemDatabase::checkDatabaseExists() == false)
            {
                ldItemDatabase::createDatabase();   
            }
            if(ldItemDatabase::checkDatabaseExists() == false)
            {
                throw new Exception("DATABASE_CANT_LOAD");   
            }
            
            $settings = new Settings("managerAccounts");
            $this->ldVault = new ldVault($_GET['account'], $settings->dbversion);
            $this->ldVault->getVault();   
            $this->ldVault->cutCode();
            
            if($this->ldVault->codeGroup[$_POST['item']]['Details']['IsItem'] == false)
            {
                throw new Exception("MNG_ACC_EV_INVALID_ITEM");  
            }
            
            if(isset($_GET['subAction']) == true && $_GET['subAction'] == "deleteItem")
            {
                $this->ldVault->insertItemInSlot( ($settings->dbversion > 2 ? str_repeat("F", 32) : str_repeat("F", 20)) , $_POST['item']);
                $this->ldVault->writeVault(true);
                exit("<script type=\"text/javascript\">
                        $(document).ready(function(){
                            $(\"#slot_{$_POST['item']}\").remove();
                            $(\".vaultStructure\").append(\"<div class='slot' id='slot_{$_POST['item']}'></div>\");
                            $(\"#slot_{$_POST['item']}\").click(function(){
                                $('.slot').removeClass('slotAttention'); 
				serialCheck();
                                $.post('?call=managerAccounts&subCall=editVault&action=insertItem&account=". (isset($_GET['account']) ? $_GET['account'] : '') ."&slot={$_POST['item']}', $(\"#form\").serialize(), 
                                function(response)
                                {
                                    $(\"#itemLeftInfo\").html( response );
                                }, 'html'); 
                            });
                        });
                      </script>");
            }
        }
        catch ( Exception $e )
        {
            $this->sentense = $e->getMessage(); 
        }
    }
    public function loadSelect()
    {
        global $sqlManager;
        try
        {    
            require_once("ldItem/ldItemDatabase.class.php");
            require_once("ldItem/ldItemOptionsDatabase.class.php");
            require_once("ldItem/ldItemMake.class.php");
            require_once("ldItem/ldItemParse.class.php");     
            require_once("ldItem/ldVault.class.php");
            require_once("ldItem/ldInventory.class.php");
            
            ldItemDatabase::setDatabases("application/", "item.txt", "class/ldItem/data/item.serialize.txt");
            if(ldItemDatabase::checkDatabaseExists() == false)
            {
                ldItemDatabase::createDatabase();   
            }
            if(ldItemDatabase::checkDatabaseExists() == false)
            {
                throw new Exception("DATABASE_CANT_LOAD");   
            }
            
            if(isset($_POST['type']) == true && $_POST['type'] == "item" && $_POST['value'] >= 0)
            {
                foreach(ldItemDatabase::$dbItem[$_POST['value']] as $item)
                {
                    echo "<option value='{$item["Index"]}'>{$item["Name"]}</option>";
                }
            }
            elseif(isset($_POST['type']) == true && $_POST['type'] == "details")
            {
                $jqueryTemp = NULL;
                $jqueryTemp .= "$('#excText5').html('".ldItemOptionsDatabase::getExcellents($_POST['section'], $_POST['index'])->opt5."');";  
                $jqueryTemp .= "$('#excText4').html('".ldItemOptionsDatabase::getExcellents($_POST['section'], $_POST['index'])->opt4."');";  
                $jqueryTemp .= "$('#excText3').html('".ldItemOptionsDatabase::getExcellents($_POST['section'], $_POST['index'])->opt3."');";  
                $jqueryTemp .= "$('#excText2').html('".ldItemOptionsDatabase::getExcellents($_POST['section'], $_POST['index'])->opt2."');";  
                $jqueryTemp .= "$('#excText1').html('".ldItemOptionsDatabase::getExcellents($_POST['section'], $_POST['index'])->opt1."');";  
                $jqueryTemp .= "$('#excText0').html('".ldItemOptionsDatabase::getExcellents($_POST['section'], $_POST['index'])->opt0."');"; 
                                                                                                     
                for($i = 0; $i < 16; $i++)
                {
                    for($il = 0; $il < 16; $il++)
                    {
                        $tempOption = ldItemOptionsDatabase::getHarmony($_POST['section'], $i, $il);
                        if(substr($tempOption, 0, 9) == "No option") continue;
                        $optHarmony .= "<option value=\'".$i.":".$il."\'>".$tempOption."</option>\\n";
                    }
                }
                $jqueryTemp .= "$('#itemHarmony').html('<option value=\'-1\'>No effect</option>{$optHarmony}');";   
                
                
                $optionSocket = array(NULL, NULL, NULL, NULL, NULL);
                $socketOptions = ldItemOptionsDatabase::getSocket();
                foreach($socketOptions["socketTypeNumber"] as $socketType => $socket)
                {
                    for($socketArgs = 1; $socketArgs <= 5; $socketArgs++)
                    {
                        if($socketOptions["socketTypeNumber"][$socketType]["socketTypeName"] == "No socket" || $socketOptions["socketTypeNumber"][$socketType]["socketTypeName"] == "Empty socket") continue;
                        
                        $optionSocket[$socketArgs] .= "<option value=\'". ($socketType + (($socketArgs-1)*50)) ."\'>".$socketOptions["socketTypeNumber"][$socketType]["socketTypeName"] .": ". $socketOptions["socketTypeNumber"][$socketType]["socketName"] ." + ".$socketOptions["socketTypeNumber"][$socketType]["socketsArgs"][$socketArgs]."</option>";
                    }
                }
                $jqueryTemp .= "$('#socketOp0').html('<option value=\'255\'>No Socket Option</option><option value=\'254\'>Avaliable slot</option>{$optionSocket[1]}');";
                $jqueryTemp .= "$('#socketOp1').html('<option value=\'255\'>No Socket Option</option><option value=\'254\'>Avaliable slot</option>{$optionSocket[2]}');";
                $jqueryTemp .= "$('#socketOp2').html('<option value=\'255\'>No Socket Option</option><option value=\'254\'>Avaliable slot</option>{$optionSocket[3]}');";
                $jqueryTemp .= "$('#socketOp3').html('<option value=\'255\'>No Socket Option</option><option value=\'254\'>Avaliable slot</option>{$optionSocket[4]}');";
                $jqueryTemp .= "$('#socketOp4').html('<option value=\'255\'>No Socket Option</option><option value=\'254\'>Avaliable slot</option>{$optionSocket[5]}');";
                
                
                $jqueryTemp .= "$('#refineText').html('".ldItemOptionsDatabase::getRefine($_POST['section'], $_POST['index'])->opt0." / ".ldItemOptionsDatabase::getRefine($_POST['section'], $_POST['index'])->opt1."');";
                
                echo "<script type=\"text/javascript\">
                       $(document).ready(function(){
                            {$jqueryTemp}
                       });
                      </script>";
            }
            else
                throw new Exception("Error");
        }
        catch ( Exception $e )
        {
            echo $e->getMessage(); 
        }
    }
    public function getSerial()
    {
        global $sqlMu;
        try
        {    
            $getSerial = $sqlMu->prepare("EXEC [dbo].[WZ_GetItemSerial]");
            $getSerial->execute();
            $getSerial = $getSerial->fetchRow();
            echo str_pad(strtoupper(dechex($getSerial[0])), 8, 0, STR_PAD_LEFT);
        }
        catch ( Exception $e )
        {
            echo $e->getMessage(); 
        }
    }
    public function insertItem()
    {
        global $sqlMu, $language;
        try
        {
            if(isset($_GET['account']) == false || empty($_GET['account']) == true) throw new Exception("MNG_ACC_EV_EMPTY_FIELDS");
            $checkAccount = $sqlMu->prepare("SELECT memb___id FROM [dbo].[MEMB_INFO] WHERE [memb___id] = :memb___id");
            $checkAccount->bindValue(":memb___id", $_GET['account'], sqlServerStatement::PARAM_STR);
            $checkAccount->execute();
            if($checkAccount->rowsCount() == 0)
                header("Location: ?call=managerAccounts&subCall=editVault");
                                                    
            require_once("ldItem/ldItemDatabase.class.php");
            require_once("ldItem/ldItemOptionsDatabase.class.php");
            require_once("ldItem/ldItemMake.class.php");
            require_once("ldItem/ldItemParse.class.php");     
            require_once("ldItem/ldVault.class.php");
            require_once("ldItem/ldInventory.class.php");
            
            ldItemDatabase::setDatabases("application/", "item.txt", "class/ldItem/data/item.serialize.txt");
            if(ldItemDatabase::checkDatabaseExists() == false)
            {
                ldItemDatabase::createDatabase();   
            }
            if(ldItemDatabase::checkDatabaseExists() == false)
            {
                throw new Exception("DATABASE_CANT_LOAD");   
            }
            
            $settings = new Settings("managerAccounts");
            $this->ldVault = new ldVault($_GET['account'], $settings->dbversion);
            $this->ldVault->getVault();   
            $this->ldVault->cutCode();  
            $this->ldVault->structureVault();
            
            if($this->ldVault->codeGroup[$_GET['slot']]['Details']['IsFree'] == false)
                throw new Exception("Sexy.error('".$language->sentence['MNG_ACC_EV_SEXY_HAVE_ITEM_SLOT']."');");
            
             
            $HexItem = NULL;
            $harmony = explode(":", isset($_POST['itemHarmony']) ? $_POST['itemHarmony'] : '');
            $properties = array("Level" => $_POST['itemLevel'], 
                                 "Option" => $_POST['itemOption'], 
                                 "Skill" => (isset($_POST['skillOp']) && $_POST['skillOp'] == 1 ? true : false), 
                                 "Luck" => (isset($_POST['luckOp']) && $_POST['luckOp'] == 1 ? true : false), 
                                 "Serial" => (isset($_POST['itemSerialText']) ? $_POST['itemSerialText'] : "FFFFFFFF"), 
                                 "Durability" => 255, 
                                 "Excellent" => array(
                                    (isset($_POST['excOp0']) && $_POST['excOp0'] == 1 ? true : false), 
                                    (isset($_POST['excOp1']) && $_POST['excOp1'] == 1 ? true : false), 
                                    (isset($_POST['excOp2']) && $_POST['excOp2'] == 1 ? true : false), 
                                    (isset($_POST['excOp3']) && $_POST['excOp3'] == 1 ? true : false), 
                                    (isset($_POST['excOp4']) && $_POST['excOp4'] == 1 ? true : false), 
                                    (isset($_POST['excOp5']) && $_POST['excOp5'] == 1 ? true : false) 
                                 ), 
                                 "Ancient" => (isset($_POST['itemAncient']) && $_POST['itemAncient'] > -1 ? $_POST['itemAncient'] : 0), // Item Set 1 : 1, Item Set 2 : 2 
                                 "Refine" => (isset($_POST['refineOp']) && $_POST['refineOp'] == 1 ? true : false), 
                                 "HarmonyType" => (isset($_POST['itemHarmony']) && $_POST['itemHarmony'] > -1 ? $harmony[0] : 0), 
                                 "HarmonyLevel" => (isset($_POST['itemHarmony']) && $_POST['itemHarmony'] > -1 ? $harmony[1] : 0), 
                                 "SocketOption" => array(
                                    (isset($_POST['socketOp0']) ? $_POST['socketOp0'] : 255),      
                                    (isset($_POST['socketOp1']) ? $_POST['socketOp1'] : 255),      
                                    (isset($_POST['socketOp2']) ? $_POST['socketOp2'] : 255),      
                                    (isset($_POST['socketOp3']) ? $_POST['socketOp3'] : 255),      
                                    (isset($_POST['socketOp4']) ? $_POST['socketOp4'] : 255),      
                                 )
            );
                 
            if(ldItemMake::makeHexItem($HexItem, $_POST['itemIndex'], $_POST['itemSection'], $settings->dbversion, $properties) == false)
            {
                throw new Exception("Sexy.error('ItemMaker error.');");
            }
            
            $slot = $this->ldVault->searchSlotsInVault(ldItemDatabase::$dbItem[$_POST['itemSection']][$_POST['itemIndex']]['X'], ldItemDatabase::$dbItem[$_POST['itemSection']][$_POST['itemIndex']]['Y'], $_GET['slot']);
            if($slot == -1)
            {
                $slot = $this->ldVault->searchSlotsInVault(ldItemDatabase::$dbItem[$_POST['itemSection']][$_POST['itemIndex']]['X'], ldItemDatabase::$dbItem[$_POST['itemSection']][$_POST['itemIndex']]['Y']);
                if($slot > -1)
                    throw new Exception("Sexy.error('".sprintf($language->sentence['MNG_ACC_EV_SEXY_ITEM_SLOT_NO_SPACE_TRY'], $slot)."'); $('#slot_{$slot}').addClass('slotAttention');");
                else
                    throw new Exception("Sexy.error('".$language->sentence['MNG_ACC_EV_SEXY_ITEM_SLOT_NO_SPACE']."');");
            }
            else
            {   
                $this->ldVault->insertItemInSlot($HexItem, $slot);
                $this->ldVault->writeVault(true); 
                throw new Exception("$('#slot_{$slot}').unbind('click').removeClass('slot').addClass('slotNoEmpty').width(32*".ldItemDatabase::$dbItem[$_POST['itemSection']][$_POST['itemIndex']]['X'].").height( ((32*".ldItemDatabase::$dbItem[$_POST['itemSection']][$_POST['itemIndex']]['Y'].")/2)+6 ).css({'padding-top': $('#slot_{$slot}').height()-12, 'z-index': 50}).html('".ldItemDatabase::$dbItem[$_POST['itemSection']][$_POST['itemIndex']]['Name']."');
                                     $('#slot_{$slot}').click(function(){ callModifyItem({$slot}); });
                                     $('.slot').removeClass('slotAttention');
                                     var boxDetails{$slot} = \"<div class='boxDetails'>\
                                                <h2 ". (in_array(true,$this->ldVault->codeGroup[$slot]['Details']['ItemExcellents'],true) ? "class='Gcolor'>".$language->sentence['MNG_ACC_EV_TOOLTIP_EXCELLENT']." " : ">") ."".utf8_encode($this->ldVault->codeGroup[$slot]['Details']['ItemName'])."</h2>\
                                                <p class='info'>\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_LEVEL'].": +".$this->ldVault->codeGroup[$slot]['Details']['ItemLevel']."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_LUCK'].": ". ($this->ldVault->codeGroup[$slot]['Details']['ItemLuck'] == true ? "Sim":"N&atilde;o") ."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_SKILL'].": ". ($this->ldVault->codeGroup[$slot]['Details']['ItemSkill'] == true ? "Sim":"N&atilde;o") ."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_ADDITIONAL'].": +".($this->ldVault->codeGroup[$slot]['Details']['ItemOption']*4)."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_DURABILITY'].": ".$this->ldVault->codeGroup[$slot]['Details']['ItemDurability']."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_SERIAL'].": ".$this->ldVault->codeGroup[$slot]['Details']['ItemSerial']."<br />\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_ANCIENT'].": ".ldItemParse::getAncientName($this->ldVault->codeGroup[$slot]['Details']['ItemAncient'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdSection'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdIndex'])."\
                                                </p>\
                                                <p class='blue'>\
                                                   ". ($this->ldVault->codeGroup[$slot]['Details']['ItemExcellents'][5] == true ? ldItemParse::getExcellentName(5, $this->ldVault->codeGroup[$slot]['Details']['ItemIdSection'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdIndex']) : "")."\
                                                    ". ($this->ldVault->codeGroup[$slot]['Details']['ItemExcellents'][4] == true ? ldItemParse::getExcellentName(4, $this->ldVault->codeGroup[$slot]['Details']['ItemIdSection'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdIndex']) : "")."\
                                                    ". ($this->ldVault->codeGroup[$slot]['Details']['ItemExcellents'][3] == true ? ldItemParse::getExcellentName(3, $this->ldVault->codeGroup[$slot]['Details']['ItemIdSection'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdIndex']) : "")."\
                                                    ". ($this->ldVault->codeGroup[$slot]['Details']['ItemExcellents'][2] == true ? ldItemParse::getExcellentName(2, $this->ldVault->codeGroup[$slot]['Details']['ItemIdSection'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdIndex']) : "")."\
                                                    ". ($this->ldVault->codeGroup[$slot]['Details']['ItemExcellents'][1] == true ? ldItemParse::getExcellentName(1, $this->ldVault->codeGroup[$slot]['Details']['ItemIdSection'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdIndex']) : "")."\
                                                    ". ($this->ldVault->codeGroup[$slot]['Details']['ItemExcellents'][0] == true ? ldItemParse::getExcellentName(0, $this->ldVault->codeGroup[$slot]['Details']['ItemIdSection'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdIndex']) : "")."\
                                                </p>\
                                                ". ($this->ldVault->codeGroup[$slot]['Details']['ItemRefine'] > 0 ? "<p class='purple'>\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_OPTION_REFINE'].": ".ldItemParse::getRefineName($this->ldVault->codeGroup[$slot]['Details']['ItemIdSection'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdIndex'])."\
                                                </p>\\" : "\\") . "
                                                ". ($this->ldVault->codeGroup[$slot]['Details']['HarmonyType'] > 0 ? "<p class='yellow'>\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_OPTION_HARMONY'].": ".ldItemParse::getHarmonyName($this->ldVault->codeGroup[$slot]['Details']['ItemIdSection'], $this->ldVault->codeGroup[$slot]['Details']['ItemIdIndex'], $this->ldVault->codeGroup[$slot]['Details']['HarmonyType'], $this->ldVault->codeGroup[$slot]['Details']['HarmonyLevel'])."\
                                                </p>\\" : "\\") . "
                                                <p class='blue'>\
                                                    ".$language->sentence['MNG_ACC_EV_TOOLTIP_OPTION_SOCKET'].":<br />\
                                                    1: ".ldItemParse::getSocketName(0, $this->ldVault->codeGroup[$slot]['Details']['Sockect'][0])."<br />\
                                                    2: ".ldItemParse::getSocketName(1, $this->ldVault->codeGroup[$slot]['Details']['Sockect'][1])."<br />\
                                                    3: ".ldItemParse::getSocketName(2, $this->ldVault->codeGroup[$slot]['Details']['Sockect'][2])."<br />\
                                                    4: ".ldItemParse::getSocketName(3, $this->ldVault->codeGroup[$slot]['Details']['Sockect'][3])."<br />\
                                                    5: ".ldItemParse::getSocketName(4, $this->ldVault->codeGroup[$slot]['Details']['Sockect'][4])."\
                                                </p>\
                                            </div>\";
                                        \$('#slot_{$slot}').tooltip(boxDetails{$slot}, { hook: true, width: 200, mode: 'auto', tooltipClass: 'sexy-tooltipCM'});
                                     ");
            }            
        }
        catch ( Exception $e )
        {
            echo "<script>".$e->getMessage()."</script>"; 
        }
    }
}
?>