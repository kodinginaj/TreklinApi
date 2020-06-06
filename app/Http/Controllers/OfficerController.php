<?php

namespace App\Http\Controllers;

use App\Complaint;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function getComplaintByIdOfficer(Request $request)
    {
        $id = $request->id;
        $complaint = Complaint::getComplaintByIdOfficer($id);
        if ($complaint->count() > 0) {
            $data['status'] = "1";
            $data['message'] = "Data tersedia";
            $data['data'] = $complaint->toArray();
            return $data;
        } else {
            $data['status'] = "1";
            $data['message'] = "Data kosong";
            $data['data'] = [];
            return $data;
        }
    }
}
