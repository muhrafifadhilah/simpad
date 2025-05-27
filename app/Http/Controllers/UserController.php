<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = Wp::with(['user'])
            ->get();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found'], 404);
        }
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'userid' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'nohp' => 'nullable|string|max:15',
            'disabled' => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'userid' => $request->userid,
                'password' => bcrypt($request->password),
                'role_id' => 2
            ]);

            $wp = Wp::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'jabatan' => $request->jabatan,
                'nip' => $request->nip,
                'nohp' => $request->nohp,
                'disabled' => $request->disabled ?? false,
            ]);

            DB::commit();
            return response()->json(['message' => 'User created', 'user' => $user, 'wp' => $wp], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'User creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $wp = Wp::findOrFail($id);
        $user = $wp->user;

        $request->validate([
            'userid' => 'sometimes|required|string|max:255|unique:users,userid,' . ($user ? $user->id : 'NULL'),
            'password' => 'nullable|string|max:255',
            'name' => 'sometimes|required|string|max:255',
            'jabatan' => 'sometimes|required|string|max:255',
            'nip' => 'sometimes|required|string|max:20',
            'nohp' => 'nullable|string|max:15',
            'disabled' => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            // Update user jika ada perubahan
            if ($user) {
                $userData = [];
                if ($request->has('userid')) {
                    $userData['userid'] = $request->userid;
                }
                if ($request->filled('password')) {
                    $userData['password'] = bcrypt($request->password);
                }
                if (!empty($userData)) {
                    $user->update($userData);
                }
            }

            // Update wp
            $wp->update($request->only(['name', 'jabatan', 'nip', 'nohp', 'disabled']));

            DB::commit();
            return response()->json(['message' => 'WP and user updated', 'wp' => $wp, 'user' => $user], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'WP/user update failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $wp = Wp::findOrFail($id);

        DB::beginTransaction();
        try {
            // Jika ingin sekalian hapus user terkait:
            $user = $wp->user;
            $wp->delete();
            if ($user) {
                $user->delete();
            }
            DB::commit();
            return response()->json(['message' => 'WP and user deleted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Delete failed', 'error' => $e->getMessage()], 500);
        }
    }
}
