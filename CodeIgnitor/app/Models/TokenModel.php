<?php
namespace App\Models;
use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table = 'tokens';
    protected $primary_key = 'id';
    protected $allowedFields = ['user_id', 'practice_id', 'token', 'expires_at', 'revoked_at'];
    protected $useTimestamps = true;
}