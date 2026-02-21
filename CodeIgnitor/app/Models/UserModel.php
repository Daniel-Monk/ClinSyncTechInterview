<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['practice_id', 'name', 'email', 'password'];
    protected $useTimestamps = true;
    protected $updatedField   = '';

    protected $hidden = ['password'];
}