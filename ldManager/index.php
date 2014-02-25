<?php                                
error_reporting(E_ALL & ~E_NOTICE);
require("application/autoload.function.php");
require("application/settings.php");  
session_name(new Settings("sessionLoad"));
session_start();

$timeCheck = new timeCheck();
$language = new language();
$sqlMu = new ldMssql("mssqlLibMu");                                   
$sqlManager = new ldMssql("mssqlLibManager");                                   

if(isset($_GET['call']) && $_GET['call'] == "languageSet" && empty($_GET['language']) == false)
    new language($_GET['language']);
    
if(empty($_SESSION['username']) == true)
{
        $login = new login();
        require("public/templates/login.tpl.php");
} 
else                       
    switch(isset($_GET['call']) ? $_GET['call'] : '')
    {       
        case "logout":
            session_destroy();
            header("Location: ?");
            break;
        case "managerAccounts": 
            switch(isset($_GET['subCall']) ? $_GET['subCall'] : '')
            {
                case "createAccount":
                    $managerAccounts = new managerAccounts(); 
                    if(isset($_GET['action']) && $_GET['action'] == "register") 
                        $managerAccounts->createAccount();
                    require("public/templates/managerAccounts.createAccount.tpl.php");
                    break;
                case "editAccount":
                    $managerAccounts = new managerAccounts();
                    switch(isset($_GET['action']) ? $_GET['action'] : '')
                    {
                        case "check": 
                            $managerAccounts->checkAccount("EA", "editAccount", "edit");
                            require("public/templates/managerAccounts.editAccount.tpl.php");
                            break;
                        case "edit": 
                            $managerAccounts->loadAccount($_GET['account']);
                            require("public/templates/managerAccounts.editAccount.edit.tpl.php");
                            break;
                        case "write": 
                            $managerAccounts->writeAccount();
                            $managerAccounts->loadAccount((isset($_POST['username']) ? $_POST['username'] : ''));
                            require("public/templates/managerAccounts.editAccount.edit.tpl.php");
                            break;
                        default:                             
                            require("public/templates/managerAccounts.editAccount.tpl.php");
                            break;
                    }
                    break;  
                case "removeAccount":
                    $managerAccounts = new managerAccounts();
                    switch(isset($_GET['action']) ? $_GET['action'] : '')
                    {
                        case "remove": 
                            $managerAccounts->removeAccount();
                            require("public/templates/managerAccounts.removeAccount.tpl.php");
                            break;
                        default:                             
                            require("public/templates/managerAccounts.removeAccount.tpl.php");
                            break;
                    }
                    break;
                case "editVault":       
                    $managerAccounts = new managerAccounts();
                    switch(isset($_GET['action']) ? $_GET['action'] : '')
                    {          
                        case "check":                        
                            $managerAccounts->checkAccount("EV", "editVault", "load");
                            require("public/templates/managerAccounts.editVault.tpl.php");
                            break;
                        case "load":
                            $managerAccounts->loadVault();                        
                            require("public/templates/managerAccounts.editVault.load.tpl.php");
                            break;
                        case "modifyItem":
                            $managerAccounts->modifyItem(); 
                            require("public/templates/managerAccounts.editVault.modifyItem.tpl.php");                       
                            break;
                        case "loadSelect":                
                            $managerAccounts->loadSelect();                      
                            break;
                        case "getSerial":                
                            $managerAccounts->getSerial();                      
                            break;
                        case "insertItem":   
                            $managerAccounts->insertItem();             
                            //var_dump($_POST,$_GET);                      
                            break;
                        default:                             
                            require("public/templates/managerAccounts.editVault.tpl.php");
                            break;
                    }
                    break;
                default:
                    require("public/templates/managerAccounts.tpl.php");
            }                                                   
            break;
        case "about":             
            require("public/templates/about.tpl.php");
            break; 
        default:
            require("public/templates/index.tpl.php");  
    }
?>