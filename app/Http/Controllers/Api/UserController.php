<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccountRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderStatusResource;
use App\Http\Resources\UserAccountResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nameFilter = $request->name;
        $emailFilter = $request->email;
        $phoneFilter = $request->phone;

        $users = User::query()
            ->when(isset($nameFilter), function ($query) use ($nameFilter) {
                $query->whereHas('userProfile', function ($subQuery) use ($nameFilter) {
                    $subQuery->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', '%' . $nameFilter . '%');
                });
            })
            ->when(isset($emailFilter), function ($query) use ($emailFilter) {
                $query->whereLike('email', $emailFilter);
            })
            ->when(isset($phoneFilter), function ($query) use ($phoneFilter) {
                $query->whereHas('userProfile', function ($subQuery) use ($phoneFilter) {
                    $subQuery->whereLike('phone', $phoneFilter);
                });
            })
            ->paginate(10);

        return UserAccountResource::collection($users);
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
    public function store(UserAccountRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $numberUser = User::max('id');
            $uuid = 'KH' . str_pad($numberUser + 1, 6, '0', STR_PAD_LEFT);

            $user = User::create([
                'uuid' => $uuid,
                'email' => $data['email'],
                'status' => $data['status'],
                'password' => bcrypt('12345678'),
            ]);

            $user->userProfile()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'gender' => $data['gender'],
                'birthday' => $data['birthday'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);

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
        $user = User::findOrFail($id);

        $orders = Order::query()
            ->where('user_id', $user->id)
            ->paginate(10);

        return OrderStatusResource::collection($orders);
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
    public function update(UserAccountRequest $request, string $id)
    {
        $data = $request->validated();
        $user = User::findOrFail($id);

        DB::beginTransaction();
        try {
            $user->update([
                'email' => $data['email'],
                'status' => $data['status'],
                'password' => bcrypt('12345678'),
            ]);

            $user->userProfile()->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'gender' => $data['gender'],
                'birthday' => $data['birthday'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);

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
        $user = User::findOrFail($id);

        $user->delete();

        return $this->sendSuccessResponse([], 'Xóa tài khoản thành công');
    }

    public function getAll()
    {
        $users = User::all();

        return UserAccountResource::collection($users);
    }
}
