<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectAssignUserRequest;
use App\Models\AssignedUser;
use Gate;

class AssignUserController extends Controller
{
    public function assignUser(int $project_id, ProjectAssignUserRequest $request)
    {
        $request->validated();
        if ($assignedUser = AssignedUser::where(['project_id' => $project_id, 'user_id' => $request->user_id])->first()) {
            $assignedUser->is_admin = (bool) $request->is_admin;
            if ($assignedUser->save()) {
                return $assignedUser;
            } else {
                return response()->json(['message' => 'Cannot assign user'], 500);
            }
        }
        return AssignedUser::create(['project_id' => $project_id, 'user_id' => $request->user_id, 'is_admin' => $request->is_admin]);
    }

    public function removeUser(int $project_id, int $user_id)
    {
        if (!Gate::allows('configure-project', $project_id)) {
            abort(403);
        }
        if ($assignedUser = AssignedUser::where(['project_id' => $project_id, 'user_id' => $user_id])->first()) {
            if ($assignedUser->delete()) {
                return response()->json(['message' => 'Successfully']);
            } else {
                return response()->json(['message' => 'Cannot remove user: internal error'], 500);
            }
        }
        return response()->json(['message' => 'Cannot remove user: doesnt exist'], 404);
    }
}
