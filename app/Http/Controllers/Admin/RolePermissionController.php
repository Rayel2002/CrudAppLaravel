<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    /**
     * Haal alle rollen en hun permissies op.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return response()->json([
            'message' => 'Roles and permissions retrieved successfully',
            'data' => $roles,
        ]);
    }

    /**
     * Haal de permissies van een specifieke rol op.
     */
    public function show($roleId)
    {
        $role = Role::with('permissions')->findOrFail($roleId);

        return response()->json([
            'message' => 'Role and permissions retrieved successfully',
            'data' => $role,
        ]);
    }

    /**
     * Wijs permissies toe aan een specifieke rol.
     */
    public function assignPermissions(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        // Validatie
        $validated = $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Permissies toewijzen
        $role->permissions()->sync($validated['permissions']);

        return response()->json([
            'message' => 'Permissions assigned to role successfully',
            'data' => $role->permissions,
        ]);
    }

    /**
     * Maak een nieuwe rol aan.
     */
    public function store(Request $request)
    {
        // Validatie
        $validated = $request->validate([
            'role' => 'required|string|unique:roles,role|max:255',
        ]);

        $role = Role::create($validated);

        return response()->json([
            'message' => 'Role created successfully',
            'data' => $role,
        ]);
    }

    /**
     * Verwijder een rol.
     */
    public function destroy($roleId)
    {
        $role = Role::findOrFail($roleId);

        // Zorg dat kritieke rollen niet worden verwijderd
        if (in_array($role->role, ['Admin', 'Manager', 'User'])) {
            return response()->json(['message' => 'Cannot delete critical role: ' . $role->role], 403);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully']);
    }

    /**
     * Haal de gebruikers met een specifieke rol op.
     */
    public function usersByRole($roleId)
    {
        $role = Role::with('users')->findOrFail($roleId);

        return response()->json([
            'message' => 'Users with the role retrieved successfully',
            'data' => $role->users,
        ]);
    }
}
