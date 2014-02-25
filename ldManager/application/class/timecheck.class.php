<?php
/*
    @Class time;
*/
class timeCheck 
{
    public $Start_time;
    public $End_time;
    public function __construct() 
    {
        $this->StartTime();
    }
    public function StartTime()
    {
        $this->Start_time = explode(" ", microtime());
        $this->Start_time = $this->Start_time[1]+$this->Start_time[0];
    }
    public function EndTime()
    {
        $this->End_time = explode(" ", microtime());
        $this->End_time = $this->End_time[1]+$this->End_time[0];
    }
    public function Result_Time()
    {
        $this->EndTime();
        return (real) substr(($this->End_time - $this->Start_time),0,5);
    }
}
?>