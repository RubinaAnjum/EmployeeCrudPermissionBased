<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\DB;
use App\Jobs\sendWelcomeMail;

class UserDetailsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::has('userDetails')->with('userDetails')->get();
    }


    public function list()
    {
        return view('users.userlist');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'building_no' => 'required|alpha_num',
                'street_name' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'country' => 'required|string',
                'pincode' => 'required|numeric|digits:6',
            ]);

            $User = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt(str_replace(" ", "",  strtolower($request->get('name')) . '@123')),
                'employee_id' => time()
            ]);

            $UserDetails = UserDetails::create([
                'user_id' => $User->id,
                'building_no' =>  $request->get('building_no'),
                'street_name' => $request->get('street_name'),
                'city' =>  $request->get('city'),
                'state' =>  $request->get('state'),
                'country' =>  $request->get('country'),
                'pincode' =>  $request->get('pincode')
            ]);

            DB::commit();

            sendWelcomeMail::dispatch($User);
            // dispatch((new sendWelcomeMail($User))->onQueue('high'));

            return ['message' => 'User Created Successfully', 'status' => 200, 'data' => $UserDetails];
        } catch (\Exception $e) {
            DB::rollback();
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);

            if (!$user) {
                throw new \Exception('User not found');
            }

            $userDetails = $user->userDetails;

            DB::commit();

            return view('users.updateUserData', compact('user', 'userDetails'));
        } catch (\Exception $e) {
            DB::rollback();
            return ['error' => $e->getMessage()];
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            
            $user = User::find($id);
           
            if (!$user) {
                throw new \Exception('User not found');
            }

            $user->update($request->only(['name']));

            if ($user->userDetails) {
                $user->userDetails->update($request->only(['building_no', 'street_name', 'city', 'state', 'pincode', 'country']));
            }

            DB::commit();
            return ['message' => 'User Updated Successfully', 'data' => $user];
        } catch (\Exception $e) {
            DB::rollback();
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $user = User::find($id);

            if (!$user) {
                throw new \Exception('User not found');
            }

            if ($user->userDetails) {
                UserDetails::destroy($user->userDetails->id);
            }

            User::destroy($id);

            DB::commit();
            return ['msg' => 'User and related details deleted successfully'];
        } catch (\Exception $e) {
            DB::rollback();
            return ['error' => $e->getMessage()];
        }
    }


    /**
     * search the specified user from storage.
     */
    public function search($UserId)
    {
        return UserDetails::where('user_id', $UserId)->get();
    }
}
