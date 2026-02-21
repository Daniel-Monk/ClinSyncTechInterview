<?php
namespace App\Models;
use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['practice_id', 'patient_id', 'user_id', 'appointment_at', 'notes'];
    protected $useTimestamps = true;
    protected $updatedField   = '';
}