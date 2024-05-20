<?php
namespace WIFI\JWE23\DataBanking\Model;

use WIFI\JWE23\DataBanking\Mysql;
use WIFI\JWE23\DataBanking\Model\Row\Job;

class Jobs {

    public function all_jobs(): array
    {
        $all_jobs = array();
        $db = Mysql::getInstanz();
        $result = $db->query("SELECT * FROM job WHERE status = 1 ORDER BY created_on DESC");
        
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

    public function all_jobs_admin(): array
    {
        $all_jobs = array();
        $db = Mysql::getInstanz();
        $result = $db->query("SELECT * FROM job ORDER BY created_on DESC");
        
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


    public function last_jobs_vissible(): array
    {
        $last_jobs = array();
        $db = Mysql::getInstanz();
        $result = $db->query("SELECT * FROM job WHERE status = 1 ORDER BY id DESC LIMIT 3");
        
        // print_r($result);
        // exit;

        while ($row = $result->fetch_assoc()) 
        {   

            // print_r($row);
            // exit;

            $last_jobs[] = new Job($row);
        }
        return $last_jobs;
    }

    public function all_jobs_from_user($sql_id): array
    {
        $all_jobs = array();
        $db = Mysql::getInstanz();
        // $sql_id = $_SESSION["id"];
        $result = $db->query("SELECT * FROM job WHERE user_id = '{$sql_id}' ORDER BY id ASC");
        
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

    public function get_all_jobs(): array
    {
        $all_categories = array();
        $db = Mysql::getInstanz();
        $result = $db->query("SELECT * FROM jobs ORDER BY name ASC");
        
        // print_r($result);
        // exit;

        while ($row = $result->fetch_assoc()) 
        {   

            // print_r($row);
            // exit;

            $all_categories[] = $row;
        }
        return $all_categories;
    }
}