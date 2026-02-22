<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use App\Models\PatientModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class AppointmentController extends BaseController
{
    protected $practiceId;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger,
    ) {
        parent::initController($request, $response, $logger);
        $this->practiceId = session()->get('practice_id');
    }

    public function index()
    {
        $appointmentModel = new AppointmentModel();
        $appointments = $appointmentModel
            ->where('practice_id', $this->practiceId)
            ->findAll();

        return $this->response
            ->setStatusCode(200)
            ->setJSON($appointments);
    }

   public function create()
    {
        $json = $this->request->getJSON();

        if (!$json || !isset($json->patient_id, $json->appointment_at)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'patient_id and appointment_at are required']);
        }

        $patientModel = new PatientModel();
        $patient = $patientModel
            ->where('id', $json->patient_id)
            ->where('practice_id', $this->practiceId)
            ->first();

        if (!$patient) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Patient not found']);
        }

        $appointmentModel = new AppointmentModel();
        $appointmentModel->insert([
            'practice_id'    => $this->practiceId,
            'patient_id'     => $json->patient_id,
            'user_id'        => session()->get('user_id'),
            'appointment_at' => $json->appointment_at,
            'notes'          => $json->notes ?? null,
        ]);

        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Appointment created']);
    }
}
