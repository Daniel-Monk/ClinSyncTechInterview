<?php

namespace App\Models;

use CodeIgniter\Model;

class PracticeModel extends Model
{
    protected $table = 'practices';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
    protected $useTimestamps = true;
    protected $updatedField   = '';
}
