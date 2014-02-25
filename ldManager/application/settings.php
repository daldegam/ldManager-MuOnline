<?php  
/*
    @Class settings;
*/
class Settings {
    public function __construct($module = NULL)
    {
        switch($module)
        {
            case "license": $this->license(); return;
            case "mssqlLibMu": $this->mssqlLibMu(); return;
            case "mssqlLibManager": $this->mssqlLibManager(); return;    
            case "sessionLoad": $this->sessionLoad(); return;
            case "languageLoad": $this->languageLoad(); return;
            case "managerAccounts": $this->managerAccounts(); return;
        } 
    } 
    
    public function license()
    {
        define("countryPreference", 0x02); // Para Brasil 0x01, Estados Unidos da América 0x02
        define("autenticationCache", true); // Guarda a chave de segurança em cache para não fazer requisições a cada pagina acessada.
    }
    
    public function __toString()
    {
        return $this->sessionName;
    } 
    protected function sessionLoad()
    {
        $this->sessionName = "ldMuEditor";
    }    
    protected function languageLoad()
    {
        $this->languageDir      = "application/languages/";
        $this->languageDefault  = "pt_br";   
    }
    protected function mssqlLibManager()  //Configurações de onde o SITE esta instalado
    {
        $this->mssqlLibDatabase  = "webSite";
        $this->mssqlLibHost      = "localhost";
        $this->mssqlLibUser      = "sa";
        $this->mssqlLibPassword  = "microsoft";
    }
    protected function mssqlLibMu()  //Configurações de onde o JOGO esta instalado
    {
        $this->mssqlLibDatabase  = "MuOnline";
        $this->mssqlLibHost      = "localhost";
        $this->mssqlLibUser      = "sa";
        $this->mssqlLibPassword  = "microsoft";
    }
    protected function managerAccounts()
    {
        $this->vi_curr_info  = true; //Joinserver com sistema de idade, TRUE para sim, FALSE para nao
        $this->md5_encode    = true; //Servidor usa MD5
        $this->dbversion     = 3;    //1 = (Versões antigas sem personal store [97d]), 2 = (Versões antigas com personal store [1.0]), 3 = (Versões novas com personal store e harmony [1.02n ou acima]) 
    }
}
?>