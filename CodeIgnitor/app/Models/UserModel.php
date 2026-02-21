<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primary_key = 'id';
    protected $allowedFields = ['practice_id', 'name', 'email', 'password'];
    protected $useTimesetamps = true;
    protected $hidden = ['password'];
}