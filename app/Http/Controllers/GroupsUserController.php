<?php

namespace App\Http\Controllers;

use App\Models\GroupUser;
use App\Models\Wp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupsUserController extends Controller
{
    public function index()
    {
        $groupsUsers = GroupUser::all();

        if ($groupsUsers->isEmpty()) {
            return response()->json(['message' => 'No groups users found'], 404);
        }

        return response()->json($groupsUsers, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
           'kode' => 'required|string|max:255',
           'nama' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $groupUser = GroupUser::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
            ]);

            DB::commit();
            return response()->json(['message' => 'Group user created', 'group_user' => $groupUser], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Group user creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function assignToWp(Request $request)
    {
        $request->validate([
            'wp_id' => 'required|exists:wp,id',
            'groups_user_id' => 'required|exists:groups_user,id',
        ]);

        DB::beginTransaction();
        try {
            $wp = Wp::findOrFail($request->wp_id);
            $wp->hasGroupsUsers()->create([
                'groups_user_id' => $request->groups_user_id,
            ]);

            DB::commit();
            return response()->json(['message' => 'Group assigned to user successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to assign group to user', 'error' => $e->getMessage()], 500);
        }
    }

    public function unassignFromWp(Request $request)
    {
        $request->validate([
            'wp_id' => 'required|exists:wp,id',
            'groups_user_id' => 'required|exists:groups_user,id',
        ]);

        DB::beginTransaction();
        try {
            $deleted = \App\Models\HasGroupsUser::where('wp_id', $request->wp_id)
                ->where('groups_user_id', $request->groups_user_id)
                ->delete();

            DB::commit();
            if ($deleted) {
                return response()->json(['message' => 'Group unassigned from user successfully'], 200);
            } else {
                return response()->json(['message' => 'Assignment not found'], 404);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to unassign group from user', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $groupUser = GroupUser::findOrFail($id);

        $request->validate([
            'kode' => 'sometimes|required|string|max:255',
            'nama' => 'sometimes|required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $groupUser->update($request->only(['kode', 'nama']));
            DB::commit();
            return response()->json(['message' => 'Group user updated', 'group_user' => $groupUser], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Group user update failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $groupUser = GroupUser::findOrFail($id);

        DB::beginTransaction();
        try {
            $groupUser->delete();
            DB::commit();
            return response()->json(['message' => 'Group user deleted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Group user delete failed', 'error' => $e->getMessage()], 500);
        }
    }
}
