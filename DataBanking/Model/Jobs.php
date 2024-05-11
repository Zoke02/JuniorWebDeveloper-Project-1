<?php
namespace WIFI\JWE23\DataBanking\Model;

use WIFI\JWE23\DataBanking\Mysql;
use WIFI\JWE23\DataBanking\Model\Row\Job;

class Jobs {

    public function all_jobs(): array
    {
        $all_jobs = array();
        $db = Mysql::getInstanz();
        $result = $db->query("SELECT * FROM job ORDER BY id ASC");
        
        // print_r($result);
        // exit;

        while ($row = $result->fetch_assoc()) 
        {   

            // print_r($row);
            // exit;

            $all_jobs[] = new Job($row);
        }
        return $all_jobs;
    }
}