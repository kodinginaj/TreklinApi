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

        $user = User::where('email', $email)->get();
        $countUser = $user->count();
        $petugas = Officer::where('email', $email)->get();
        $countPetugas = $petugas->count();

        if ($countUser > 0) {
            $user = $user->first();
            $cek = password_verify($password, $user['password']);
            if ($cek) {
                $data['status'] = "1";
                $data['message'] = "Berhasil masuk";
                $data['role'] = "user";
                $data['id'] = $user['id'];
                $data['nama'] = $user['nama'];
                return $data;
            } else {
                $data['status'] = "0";
                $data['message'] = "Oops password anda salah";
                return $data;
            }
        } elseif ($countPetugas > 0) {
            $petugas = $petugas->first();
            $cek = password_verify($password, $petugas['password']);
            if ($cek) {
                $data['status'] = "1";
                $data['message'] = "Berhasil masuk";
                $data['role'] = "officer";
                $data['id'] = $petugas['id'];
                $data['nama'] = $petugas['nama'];
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
        $cekemail = $this->CheckUser($email);
        if ($cekemail > 0) {
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

    public function registerOfficer(Request $request)
    {
        $email = $request->email;
        $nama = $request->nama;
        $password = $request->password;
        $kendaraan = $request->kendaraan;
        $peralatan = $request->peralatan;
        $enkripsi = password_hash($password, PASSWORD_BCRYPT);
        $cekemail = $this->CheckUser($email);
        if ($cekemail > 0) {
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

    public function CheckUser($email)
    {
        $user = User::where('email', $email)->get();
        $countUser = $user->count();

        $petugas = Officer::where('email', $email)->get();
        $countPetugas = $petugas->count();

        $count = $countUser + $countPetugas;

        if ($count > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
