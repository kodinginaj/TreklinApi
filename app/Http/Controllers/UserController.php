<?php

namespace App\Http\Controllers;

use App\Complaint;
use Illuminate\Http\Request;
use App\User;
use App\Officer;

class UserController extends Controller
{

    public function getOfficer()
    {
        $result = Officer::getOfficer();

        $data['status'] = '1';
        if (sizeOf($result) > 0) {
            $data['message'] = 'Data tersedia';
        } else {
            $data['message'] = 'Data kosong';
        }
        $data['officer'] = Officer::getOfficer();
        return $data;
    }

    public function userComplaint(Request $request)
    {
        $userid = $request->userid;
        $officerid = $request->officerid;
        $complaint = $request->complaint;

        $insert = Complaint::insertComplaint($userid, $officerid, $complaint);

        if ($insert->exists) {
            $data['status'] = "1";
            $data['message'] = "Berhasil mengajukan complaint";
            return $data;
        } else {
            $data['status'] = "0";
            $data['message'] = "Oops ada kesalahan";
            return $data;
        }
    }
}
