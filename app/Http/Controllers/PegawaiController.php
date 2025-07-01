<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pegawai::with('user')
                ->leftJoin('users', 'pegawai.user_id', '=', 'users.id')
                ->select('pegawai.*', 'users.userid as userid');
            return DataTables::of($data)
                ->filterColumn('userid', function($query, $keyword) {
                    $query->where('users.userid', 'like', "%$keyword%");
                })
                ->orderColumn('userid', 'users.userid $1')
                ->toJson();
        }
        return view('pegawai.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'userid' => $request->nip,
                'password' => bcrypt($request->password),
                'role_id' => 3
            ]);

            $pegawai = Pegawai::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'nip' => $request->nip,
                'disabled' => $request->disabled ?? false,
            ]);

            DB::commit();
            return response()->json(['message' => 'User created', 'user' => $user, 'pegawai' => $pegawai], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'User creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $pegawai = Pegawai::with('user')->find($id);
        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }
        return response()->json($pegawai);
    }

    public function update(Request $request, $id)
    {
        // Ambil data pegawai beserta user-nya
        $pegawai = Pegawai::with('user')->find($id);
        if (!$pegawai) {
            // Debugging: log id yang diterima dan id pegawai yang ada
            \Log::error('Pegawai tidak ditemukan', [
                'id_dikirim' => $id,
                'id_pegawai_ada' => Pegawai::pluck('id')->toArray()
            ]);
            return response()->json(['message' => 'Pegawai tidak ditemukan', 'id_dikirim' => $id], 404);
        }
        $user = $pegawai->user;

        $request->validate([
            'password' => 'nullable|string|max:255',
            'nama' => 'sometimes|required|string|max:255',
            'jabatan' => 'sometimes|required|string|max:255',
            'nip' => 'sometimes|required|string|max:20|unique:pegawai,nip,' . $pegawai->id,
        ]);

        DB::beginTransaction();
        try {
            // Update user jika ada perubahan
            if ($user) {
                $userData = [];
                // Update userid jika nip berubah
                if ($request->has('nip') && $request->nip !== $pegawai->nip) {
                    $userData['userid'] = $request->nip;
                }
                if ($request->filled('password')) {
                    $userData['password'] = bcrypt($request->password);
                }
                if (!empty($userData)) {
                    $user->update($userData);
                }
            }

            // Update pegawai
            $pegawai->update($request->only(['nama', 'jabatan', 'nip']));

            DB::commit();
            return response()->json(['message' => 'Pegawai and user updated', 'pegawai' => $pegawai, 'user' => $user], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Pegawai/user update failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        DB::beginTransaction();
        try {
            // Jika ingin sekalian hapus user terkait:
            $user = $pegawai->user;
            $pegawai->delete();
            if ($user) {
                $user->delete();
            }
            DB::commit();
            return response()->json(['message' => 'Pegawai and user deleted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Delete failed', 'error' => $e->getMessage()], 500);
        }
    }
}
