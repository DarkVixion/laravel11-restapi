<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Fungsi;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleAndFungsiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function showRole($id)
    {
        $role = Role::find($id);
        if ($role) {
            return response()->json($role);
        }
        return response()->json(['message' => 'Role not found'], 404);
    }
    
    public function showFungsi($id){
    $fungsis = Fungsi::find($id);
    if ($fungsis) {
        return response()->json($fungsis);
    }
    return response()->json(['message' => 'Fungsi not found'], 404);
    }

}