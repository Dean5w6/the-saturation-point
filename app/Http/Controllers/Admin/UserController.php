<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'role', 'is_active']);

            return DataTables::of($users)
                ->addColumn('status', function($row){ 
                    return $row->is_active 
                        ? '<span class="badge text-uppercase" style="background-color: #198754; border-radius: 2px;">ACTIVE</span>' 
                        : '<span class="badge text-uppercase" style="background-color: #dc3545; border-radius: 2px;">INACTIVE</span>';
                })
                ->addColumn('action', function ($row) { 
                    if($row->id === auth()->id()) { 
                        return '<div class="d-flex justify-content-center align-items-center w-100" style="height: 31px;">
                                    <span class="text-muted small fw-bold ls-1">CURRENT USER</span>
                                </div>';
                    }
                     
                    return '<a href="'.route('admin.users.edit', $row->id).'" class="btn btn-primary btn-sm text-nowrap d-flex align-items-center justify-content-center" style="border-radius: 2px; height: 31px;">EDIT ROLE / STATUS</a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role === 'admin' && $request->is_active == 0) {
            return back()->with('error', 'Security Protocol: Administrative accounts cannot be deactivated.');
        }

        $request->validate([
            'role' => 'required|in:admin,customer',
            'is_active' => 'required|boolean'
        ]);

        $user->update([
            'role' => $request->role,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}