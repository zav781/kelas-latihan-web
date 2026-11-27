<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

     public function getData()
    {
       try {
            $users = User::all();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data users berhasil diambil.',
                    'data' => $users,
                ],200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal memuat data users.',
                    'error' => $e->getMessage(),
                ],500
            );
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'role' => 'nullable|string',
        ]);
        $validate['password'] = bcrypt($validate['password']);

        $user = User::create($validate);

        return response()->json(
            [
                'success' => true,
                'message' => 'User berhasil dibuat.',
                'data' => $user,
            ],
            201
        );
    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $validate['password'] = bcrypt($validate['password']);
        $validate['role'] = 'user';

        $user = User::create($validate);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'success' => true,
                'message' => 'Registrasi berhasil.',
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],
            201
        );
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validate['email'])->first();

        if (! $user || ! Hash::check($validate['password'], $user->password)) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Email atau password salah.',
                ],
                401
            );
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'success' => true,
                'message' => 'Login berhasil.',
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],
            200
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Logout berhasil.',
            ],
            200
        );
    }

    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data user berhasil diambil.',
                    'data' => $user,
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data user tidak ditemukan.',
                    'error' => $e->getMessage(),
                ],
                404
            );
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $data = $request->all();

            if ($request->has('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $user->update($data);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'User berhasil diperbarui.',
                    'data' => $user,
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data user tidak ditemukan.',
                    'error' => $e->getMessage(),
                ],
                404
            );
        }
    }

    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'User berhasil dihapus.',
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data user tidak ditemukan.',
                    'error' => $e->getMessage(),
                ],
                404
            );
        }
    }
}