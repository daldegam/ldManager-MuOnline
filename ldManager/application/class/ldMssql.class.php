<?php
/*
    @Class ldMssql 
*/

require_once("sqlServerStatement.class.php");

class ldMssql
{
    private $objCon, $serverName, $username, $password, $database;
    public function __construct($settingsName)
    {
        $this->Settings = new Settings($settingsName);        
        
        $this->mssqlLibHost        = $this->Settings->mssqlLibHost;    
        $this->mssqlLibUser        = $this->Settings->mssqlLibUser;    
        $this->mssqlLibPassword    = $this->Settings->mssqlLibPassword;
        $this->mssqlLibDatabase    = $this->Settings->mssqlLibDatabase;           
        
        try
        {
            if($this->objCon == false)
                $this->connection();   
        }
        catch( SqlException $error )
        {
            exit( sprintf("<strong>Fatal Error ldMssql:</strong> %s", $error->getMessage()) );
        } 
    }
    private function connection()
    {
        $this->objCon = @mssql_pconnect($this->mssqlLibHost, $this->mssqlLibUser, $this->mssqlLibPassword);
        if($this->objCon == false)
        {
            throw new SqlException("Connection error.\n<!-- SQL Message: ". mssql_get_last_message() ." -->");
        } 
        if(@mssql_select_db($this->mssqlLibDatabase, $this->objCon) == false)
        {
            throw new SqlException("Database error.\n<!-- SQL Message: ". mssql_get_last_message() ." -->");
        }   
    }
    public function disconnect()
    {
        @mssql_close($this->objCon);   
    }
    public function prepare($query = "")
    {
        try
        {
            if(empty($query) == true)
                throw new SqlException("Query empty.");   
            
            return new sqlServerStatement($this->mssqlLibDatabase, $query);
        }
        catch( SqlException $error )
        {
            printf("<strong>Query Error ldMssql:</strong> %s", $error->getMessage());
        }
    }
}

?>