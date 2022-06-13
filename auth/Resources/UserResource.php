<?php

namespace Auth\models;

use Auth\models\User;
use Config\common\Models\Model;

class UserResource extends Model {



    public function getUserInfo(){
        
        return $this->query("
            SELECT u.* 
            FROM users u
            WHERE id = ?
            ", $this->id
        );
    }
}