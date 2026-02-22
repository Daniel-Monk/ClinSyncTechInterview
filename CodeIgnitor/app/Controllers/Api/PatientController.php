<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class PatientController extends BaseController
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
        $patientModel = new PatientModel();
        $patients = $patientModel
            ->where('practice_id', $this->practiceId)
            ->findAll();
        return $this->response
            ->setStatusCode(200)
            ->setJSON($patients);
    }

    public function create()
    {
        $json = $this->request->getJSON();

        if (!$json || !isset($json->name, $json->email, $json->phone)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Name, email and phone are required']);
        }

        $patientModel = new PatientModel();
        $patientModel->insert([
            'practice_id'   => $this->practiceId,
            'name'          => $json->name,
            'email'         => $json->email,
            'phone'         => $json->phone,
            'date_of_birth' => $json->date_of_birth ?? null,
        ]);

        return $this->response
            ->setStatusCode(201)->setJSON(['message' => 'Patient created']);
    }
}
