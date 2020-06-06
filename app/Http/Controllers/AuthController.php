<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Officer;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $lat = $request->latitude;
        $long = $request->longitude;

        $user = User::where('email', $email)->get();
        $countUser = $user->count();
        if ($countUser > 0) {
            $user = $user->first();
            $cek = password_verify($password, $user['password']);
            if ($cek) {
                $updateLokasi = User::where('email', $email)->update([
                    'latitude' => $lat,
                    'longitude' => $long
                ]);
                $user = User::where('email', $email)->get()->first();
                $data['status'] = "1";
                $data['message'] = "Berhasil masuk";
                $data['dataUser'] = $user;
                return $data;
            } else {
                $data['status'] = "0";
                $data['message'] = "Oops password anda salah";
                return $data;
            }
        } else {
            $data['status'] = "0";
            $data['message'] = "Maaf anda belum terdaftar";
            return $data;
        }
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $nama = $request->nama;
        $password = $request->password;
        $enkripsi = password_hash($password, PASSWORD_BCRYPT);
        $user = User::where('email', $email)->get();
        $countUser = $user->count();
        if ($countUser > 0) {
            $data['status'] = "0";
            $data['message'] = "Email sudah digunakan";
            return $data;
        } else {
            $insert = User::create([
                'nama' => $nama,
                'email' => $email,
                'password' => $enkripsi
            ]);
            if ($insert->exists) {
                $data['status'] = "1";
                $data['message'] = "Berhasil mendaftar";
                return $data;
            } else {
                $data['status'] = "0";
                $data['message'] = "Oops ada kesalahan";
                return $data;
            }
        }
    }

    public function loginOfficer(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $lat = $request->latitude;
        $long = $request->longitude;

        $officer = Officer::where('email', $email)->get();
        $countOfficer = $officer->count();


        if ($countOfficer > 0) {
            $officer = $officer->first();
            $cek = password_verify($password, $officer['password']);
            if ($cek) {
                $updateLokasi = Officer::where('email', $email)->update([
                    'latitude' => $lat,
                    'longitude' => $long
                ]);
                $officer = Officer::where('email', $email)->get()->first();
                $data['status'] = "1";
                $data['message'] = "Berhasil masuk";
                $data['dataOfficer'] = $officer;
                return $data;
            } else {
                $data['status'] = "0";
                $data['message'] = "Oops password anda salah";
                return $data;
            }
        } else {
            $data['status'] = "0";
            $data['message'] = "Maaf anda belum terdaftar";
            return $data;
        }
    }

    public function registerOfficer(Request $request)
    {
        $email = $request->email;
        $nama = $request->nama;
        $password = $request->password;
        $kendaraan = $request->kendaraan;
        $peralatan = $request->peralatan;
        $enkripsi = password_hash($password, PASSWORD_BCRYPT);
        $petugas = Officer::where('email', $email)->get();
        $countPetugas = $petugas->count();
        if ($countPetugas > 0) {
            $data['status'] = "0";
            $data['message'] = "Email sudah digunakan";
            return $data;
        } else {
            $insert = Officer::create([
                'nama' => $nama,
                'email' => $email,
                'password' => $enkripsi,
                'kendaraan' => $kendaraan,
                'peralatan' => $peralatan
            ]);
            if ($insert->exists) {
                $data['status'] = "1";
                $data['message'] = "Berhasil mendaftar";
                return $data;
            } else {
                $data['status'] = "0";
                $data['message'] = "Oops ada kesalahan";
                return $data;
            }
        }
    }


    public function getAll()
    {
        $user = User::select('*')->get();
        if ($user->count() > 0) {
            $data['status'] = 1;
            $data['message'] = 'Data tersedia';
            $data['data'] = $user->toArray();
            return $data;
        } else {
            $data['status'] = 0;
            $data['message'] = 'Data tidak tersedia';
            return $data;
        }
    }
}
