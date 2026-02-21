<?php
namespace App\Models;
use CodeIgniter\Model;

class PatientModel extends Model 
{
    protected $table = 'patients';
    protected $primaryKey = 'id';
    protected $allowedFields = ['practice_id', 'name', 'email', 'phone', 'date_of_birth'];
    protected $useTimestamps = true;
    protected $updatedField   = '';

}