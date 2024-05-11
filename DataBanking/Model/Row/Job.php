<?php
namespace WIFI\JWE23\DataBanking\Model\Row;

class Job extends RowAbstract
{
    protected string $tabel = "job";

    public function get_brand(): Brand 
    {
        return new Brand($this->brand_id);
    }
}