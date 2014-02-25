<?php
/*
    @Class language;
*/
class language
{
    public $sentence = array();
    private $sentence_count = 0; 
    public function __construct($setLanguage = '')
    {    
        if(empty($setLanguage) == false)
        {
            switch($setLanguage)
            {
                case "en": $_SESSION['languageSet'] = "en"; break;
                case "pt_br": $_SESSION['languageSet'] = "pt_br"; break;
            }
            header("Location: ".(empty($_SERVER["HTTP_REFERER"]) ? '?' : $_SERVER["HTTP_REFERER"]));
        }
        if(isset($_SESSION['languageSet']) == false)        
            $this->languageBrowser = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
        else
            $this->languageBrowser[0] = $_SESSION['languageSet'];
        switch(strtolower($this->languageBrowser[0]))
        {                                                       
            case "pt_br": $this->loadLanguage("pt_br"); return;  //Português Brasil    
            case "en": case "en-us": $this->loadLanguage("en"); return;     //Inglês
            case "es": $this->loadLanguage("es"); return;        //Espanhol 
            default: $this->loadLanguage("default");             //Configurada no settings.php
        }   
    }
    private function loadLanguage($language)
    {
        $this->Settings = new Settings("languageLoad");
        $this->fileLanguage = $this->Settings->languageDir . ($language == "default" ? $this->Settings->languageDefault : $language) . ".lang.php"; 
        try {
            if(file_exists($this->fileLanguage)) 
                return require($this->fileLanguage); 
            else
                throw new Exception($this->fileLanguage);
        } catch(Exception $e) {
            die("Error: Language file <strong>". $e->getMessage() ."</strong> not found.");
        }   
    }
    protected function languegeSet($var, $value)
    {                                  
        $this->sentence[$var] = $value;
    }
}
	

?>