<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdminRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAccountRequest;
use App\Http\Resources\AdminAccountResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Throwable;

class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentUser = auth()->user();
        $nameFilter = $request->name;
        $emailFilter = $request->email;
        $phoneFilter = $request->phone;

        $admins = Admin::query()
            ->when($currentUser->hasRoleCode(AdminRoleEnum::MASTER_ADMIN), function ($query) {
                $query->whereHas('roles', function ($subQuery) {
                    $subQuery->whereNot('role_code', AdminRoleEnum::MASTER_ADMIN);
                });
            })
            ->when($currentUser->hasRoleCode(AdminRoleEnum::HEAD_TRANSACTION_ADMIN), function ($query) {
                $query->whereHas('roles', function ($subQuery) {
                    $subQuery->where('role_code', AdminRoleEnum::MANAGER_TRANSACTION_ADMIN);
                });
            })
            ->when($currentUser->hasRoleCode(AdminRoleEnum::HEAD_CONCENTRATE_ADMIN), function ($query) {
                $query->whereHas('roles', function ($subQuery) {
                    $subQuery->where('role_code', AdminRoleEnum::MANAGER_CONCENTRATE_ADMIN);
                });
            })
            ->when(isset($nameFilter), function ($query) use ($nameFilter) {
                $query->whereHas('adminProfile', function ($subQuery) use ($nameFilter) {
                    $subQuery->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', '%' . $nameFilter . '%');
                });
            })
            ->when(isset($emailFilter), function ($query) use ($emailFilter) {
                $query->whereLike('email', $emailFilter);
            })
            ->when(isset($phoneFilter), function ($query) use ($phoneFilter) {
                $query->whereHas('adminProfile', function ($subQuery) use ($phoneFilter) {
                    $subQuery->whereLike('phone', $phoneFilter);
                });
            })
            ->paginate(10);

        return AdminAccountResource::collection($admins);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminAccountRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $numberAdmin = Admin::max('id');
            $uuid = 'NV' . str_pad($numberAdmin + 1, 6, '0', STR_PAD_LEFT);

            $admin = Admin::create([
                'uuid' => $uuid,
                'email' => $data['email'],
                'status' => $data['status'],
                'password' => $data['password'],
                'password_not_hash' => Crypt::encryptString($data['password']),
            ]);

            $admin->adminProfile()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);

            $roleName = Role::where('role_code', $data['role'])->first();
            $admin->assignRole($roleName->name);

            DB::commit();
            return $this->sendSuccessResponse([], 'Tạo tài khoản thành công');
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendErrorResponse(__('Something went wrong.'), $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminAccountRequest $request, string $id)
    {
        $data = $request->validated();

        $admin = Admin::findOrFail($id);

        DB::beginTransaction();
        try {
            $admin->update([
                'email' => $data['email'],
                'status' => $data['status'],
                'password' => $data['password'],
                'password_not_hash' => Crypt::encryptString($data['password']),
            ]);

            $admin->adminProfile()->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);

            $roleName = Role::where('role_code', $data['role'])->first();
            $admin->roles()->sync($roleName);

            DB::commit();
            return $this->sendSuccessResponse([], 'Cập nhật tài khoản thành công');
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendErrorResponse(__('Something went wrong.'), $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);

        $admin->delete();

        return $this->sendSuccessResponse([], 'Xóa tài khoản thành công');
    }
}
