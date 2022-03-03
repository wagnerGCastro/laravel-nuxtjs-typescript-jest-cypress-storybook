<?php
namespace App\Http\Controllers\TestRelationships\OneToMany;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use App\Models\Resource;
use App\Models\Permission;
use DB;

class PermissionController extends Controller
{

    public function oneToMany(Request $request)
    {
        try {
            $roles = Role::select('id', 'name', 'description')->where('status', 'a')->get();

            $permissions = Permission::get();

            $resultRolesPermissions =  DB::select(
                "SELECT
                    u.id as userId, u.first_name as userFirstName,
                    res.name as resources,
                    r.name as roleName,
                    p.name as perName,
                    r.status as roleStatus,
                    ru.status as roleUserStataus,
                    pr.status as perRoleStatus,
                    null as perUserStatus,
                    p.status as permStatus
                FROM users                AS u
                INNER JOIN role_user        AS ru ON ru.user_id = u.id
                INNER JOIN permission_role  AS pr ON pr.role_id = ru.role_id
                INNER JOIN roles            AS r  ON r.id = ru.role_id
                INNER JOIN permissions    AS p  ON p.id = pr.permission_id
                INNER JOIN resources    AS res ON res.id = p.resource_id

                UNION

                SELECT
                    u.id as userId, u.first_name as userFirstName,
                    res.name as resources,
                    null as roleName,
                    p.name as perName,
                    null as roleStatus,
                    null as roleUserStataus,
                    null as perRoleStatus,
                    pu.status as perUserStatus,
                    p.status as permStatus
                FROM permissions            as p
                INNER JOIN permission_user  as pu ON pu.permission_id = p.id
                INNER JOIN resources    AS res ON res.id = p.resource_id
                INNER JOIN users            as u  ON u.id = pu.user_id",
                [

                ]
            );


        } catch (\Exception $e) {
            return response()->json([
                'error'=> 'Error internal server!',
                'message' => $e->getMessage(),
            ], 500);
        }


        return response()->json([
            'roles' => $roles,
            'permissions ' => $permissions,
            'resultRolesPermissions' => $resultRolesPermissions
        ], Response::HTTP_OK);
    }

}
