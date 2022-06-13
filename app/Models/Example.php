<?php

namespace App\Models;

use DateTime;
use Config\common\Models\Model;


class Example extends Model{

    protected $table = 'Example';

    public function findByExampleName(int $exampleName): Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE exampleName = ?", [$exampleName], true);
    }
    
    // Your Function Here


}