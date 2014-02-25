<?php
/*
    @Class for Statement 
*/
class SqlException extends Exception {}

class sqlServerStatement
{
    CONST PARAM_STR     = 0xA01;
    CONST PARAM_INT     = 0xA02;
    CONST PARAM_BIN     = 0xA03;
    
    CONST FETCH_ARRAY   = 0xB01;
    CONST FETCH_ASSOC   = 0xB02;
    CONST FETCH_BATCH   = 0xB03;
    CONST FETCH_FIELD   = 0xB04;
    CONST FETCH_OBJ     = 0xB05;
    CONST FETCH_ROW     = 0xB06;
    
    protected $query, $database, $resource;
    public function __construct($database, $query)
    {
        $this->database = $database;
        $this->query = $query;
    }
    public function bindValue($parameter, $value, $data_type)
    {
        try
        {
            switch($data_type)
            {
                case self::PARAM_STR:
                    $this->query = str_replace($parameter, $this->escapeCharacters($value), $this->query); 
                    break;
                case self::PARAM_INT:
                    $this->query = str_replace($parameter, (integer)$value, $this->query); 
                    break;
                case self::PARAM_BIN:
                    $this->query = str_replace($parameter, "0x".bin2hex($value), $this->query); 
                    break;
                default:
                    throw new SqlException("Invalid DataType(".$data_type.").");
                    break;
            }
            return $this; 
        }
        catch( SqlException $error )
        {
            printf("<strong>Query Statement Error ldMssql:</strong> %s", $error->getMessage());
        }
        
    }
    public function escapeCharacters($str)
    {
        return "'".str_replace("'", "''", $str)."'";
    }
    public function execute()
    {
        try
        {
            mssql_select_db($this->database);
            $this->resource = @mssql_query( $this->query );
            if($this->resource == false)
            {
                throw new SqlException("Error query. <!-- SQL Message: {$this->query} - ". mssql_get_last_message() ." -->");
            }
        }
        catch( SqlException $error )
        {
            printf("<strong>Query Statement Error ldMssql:</strong> %s", $error->getMessage());
        }    
    }
    public function columnCount()
    {
        return mssql_num_fields($this->resource);
    }
    public function rowsCount()
    {
        return mssql_num_rows($this->resource);
    }
    public function fetchObject()
    {
        return mssql_fetch_object($this->resource);
    }
    public function fetchRow()
    {
        return mssql_fetch_row($this->resource);
    }
    public function fetchAll($fetch_style)
    {
        switch($fetch_style)
        {
            case self::FETCH_ARRAY:
                $results = array();
                while($result = mssql_fetch_array($this->resource))
                {
                    $results[] = $result; 
                }
                break;
            case self::FETCH_ASSOC:
                $results = array();
                while($result = mssql_fetch_assoc($this->resource))
                {
                    $results[] = $result; 
                }
                break;
            case self::FETCH_BATCH:
                $results = array();
                while($result = mssql_fetch_batch($this->resource))
                {
                    $results[] = $result; 
                }
                break;
            case self::FETCH_FIELD:
                $results = array();
                while($result = mssql_fetch_field($this->resource))
                {
                    $results[] = $result; 
                }
                break;
            case self::FETCH_OBJ:
                $results = array();
                while($result = mssql_fetch_object($this->resource))
                {
                    $results[] = $result; 
                }
                break;
            case self::FETCH_ROW:
                $results = array();
                while($result = mssql_fetch_row($this->resource))
                {
                    $results[] = $result; 
                }
                break;
        }
        return $results;
    }
    public function closeCursor()
    {
        unset($this->resource);
    }
    public function errorInfo()
    {
        return mssql_get_last_message();   
    }
    public function errorCode()
    {
        return mssql_get_last_message();  
    }
    public function getLastMessage()
    {
        return mssql_get_last_message();  
    }
}

?>