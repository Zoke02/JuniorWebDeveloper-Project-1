<?php

use WIFI\JWE23\DataBanking\Model\Jobs;
use WIFI\JWE23\DataBanking\Model\Row\Job;


function hide_after_90_days() {
    $jobs = new Jobs;
    $all_jobs = $jobs->all_jobs_admin();
    foreach ($all_jobs as $job) 
    {
        // Create and Modified + 90 Days
        $hide_after_created = date("Y-m-d", strtotime($job->created_on. "+90 days"));
        if ($job->modified_on != null) {
            $hide_after_modified = date("Y-m-d", strtotime($job->modified_on. "+90 days"));
        } 
        else {
            $hide_after_modified = null;
        }

        if (date("Y-m-d") > $hide_after_created && !$job->modified_on) {
            $job = new Job(array(
                "id" => $job->id,
                "status" => "Hidden"
            ));
            $job->save();

        } 
        elseif (date("Y-m-d") > $hide_after_modified && $job->modified_on) {
            $job = new Job(array(
                "id" => $job->id,
                "status" => "Hidden"
            ));
            $job->save();
        }

    }
}

function delete_after_365_days() {
    $jobs = new Jobs;
    $all_jobs = $jobs->all_jobs_admin();
    foreach ($all_jobs as $job) 
    {
        // Delete and Modified + 1 Year
        $delete_after_created = date("Y-m-d", strtotime($job->created_on. "+1 year"));
        if ($job->modified_on != null) {
            $delete_after_modified = date("Y-m-d", strtotime($job->modified_on. "+1 year"));
        } 
        else {
            $delete_after_modified = null;
        }

        if (date("Y-m-d") > $delete_after_created && !$job->modified_on) {
            $job->delete();
        } 
        elseif (date("Y-m-d") > $delete_after_modified && $job->modified_on) {
            $job->delete();
        }

    }
}