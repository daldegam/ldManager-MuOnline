<?php
/*
    @Class login;
*/
class login 
{
    public $sentense = NULL;
    public function __construct() 
    {
        try
        {
            if(empty($_POST['username']) == false && empty($_POST['password']) == false)
            {
                $this->autenticate();
            }
        }   
        catch ( Exception $e )
        {
            $this->sentense = $e->getMessage(); 
        }
    }
    public function autenticate()
    {
        global $sqlManager;
        $checkUsername = $sqlManager->prepare("SELECT previlegy FROM [dbo].[webLdManagerUsers] WHERE [username] = :username AND [password] = :password");
        $checkUsername->bindValue(":username", $_POST['username'], sqlServerStatement::PARAM_STR);
        $checkUsername->bindValue(":password", $_POST['password'], sqlServerStatement::PARAM_STR);
        $checkUsername->execute();
        if($checkUsername->rowsCount() > 0)
        {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['previlegy'] = $checkUsername->fetchObject()->previlegy;
            header("Location: ?");
        }
        else
        {
            throw new Exception("LOGIN_BAD_LOGIN");
        }
    } 
}
?>