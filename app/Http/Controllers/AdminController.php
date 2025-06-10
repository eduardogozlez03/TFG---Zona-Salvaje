<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when(request('role'), function ($query, $role) {
                if ($role == 'admin') {
                    $query->where('role', 'admin');
                } elseif ($role == 'vip') {
                    $query->where('subscription', 'vip');
                } elseif ($role == 'user') {
                    $query->where('role', '!=', 'admin')
                        ->where('subscription', '!=', 'vip');
                }
            })
            ->paginate(10);

        $clases = ClassModel::with('instructor')->get();
        $admins = User::where('role', 'admin')->get();
        $totalUsers = User::count();

        return view('area_admin', compact('users', 'clases', 'admins', 'totalUsers'));
    }
    //area_admin

    // Para obtener datos de un usuario específico
    public function show(User $user)
    {
        return response()->json([
            'user' => $user,
            'success' => true
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user',
            'subscription' => 'required|in:vip,Básico',
        ]);

        $user->role = $request->role;
        $user->subscription = $request->subscription;

        // Actualizar fecha de expiración solo si es VIP
        if ($request->subscription === 'vip') {
            $user->subscription_ends_at = now()->addDays(30);
        } else {
            $user->subscription_ends_at = null;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado correctamente'
        ]);
    }



    public function updateClass(Request $request, $id)
    {
        $clase = ClassModel::findOrFail($id);
        $clase->admin_id = $request->admin_id;
        $clase->class_date = $request->class_date;
        $clase->capacity = $request->capacity;
        $clase->save();

        return redirect()->back()->with('success', 'Clase actualizada correctamente');
    }

    public function storeClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'admin_id' => 'required|exists:users,id',
            'class_date' => 'required|date',
            'capacity' => 'required|integer|min:1',
        ]);

        ClassModel::create([
            'name' => $request->name,
            'admin_id' => $request->admin_id,
            'class_date' => $request->class_date,
            'capacity' => $request->capacity,
        ]);

        return redirect()->back()->with('success', 'Clase creada correctamente.');
    }

    public function destroyClass($id)
    {
        $class = ClassModel::findOrFail($id);
        $class->delete();

        return response()->json(['success' => true]);
    }

    public function destroyUser(User $user)
    {
        $user->delete();

        return response()->json(['success' => true, 'message' => 'Usuario eliminado correctamente']);
    }
}
