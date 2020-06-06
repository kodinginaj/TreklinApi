<?php

namespace App\Http\Controllers;

use App\Article;
use App\Complaint;
use Illuminate\Http\Request;
use App\User;
use App\Officer;
use Carbon\Carbon;

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

    public function insertArticle(Request $request)
    {
        $judul = $request->judul;
        $penulis = $request->penulis;
        $isi = $request->isi;

        $angka = mt_rand(0, 100);

        $images = $request->foto->getClientOriginalName();
        $array = explode(".", $images);
        $gabung = "img-article/" . $angka . $array[0] . Carbon::now()->format('ymd') . "ART." . end($array);
        $simpan = $angka . $array[0] . Carbon::now()->format('ymd') . "ART." . end($array);
        $request->foto->move(public_path() . "/img-article", $simpan);
        $save['judul'] = $judul;
        $save['penulis'] = $penulis;
        $save['foto'] = $gabung;
        $save['isi'] = $isi;

        $insert = Article::insertArticle($save);
        if ($insert->exists) {
            $data['status'] = "1";
            $data['message'] = "Berhasil menambah article";
            return $data;
        } else {
            $data['status'] = "0";
            $data['message'] = "Oops ada kesalahan";
            return $data;
        }
    }
}
