<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
  public function __construct(){
    $this->middleware('auth.api')->except(['index','show']);
  }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $user =  UserResource::collection(User::all());
         return  response()->json($user, 200)->header('Additional Header','True');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try {
        $this->authorize('create',User::class);
        $user= new UserResource(User::create([
          'name' => $request->name,
          'email' => $request->email,
           'password' => Hash::make($request->password),
        ]));
        return response()->json($user, 200);
      } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
      }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
      $user= new UserResource(User::findOrFail($id));
        return response()->json($user, 200)->header('Additional Header','True');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $iduser = User::findOrFail($id);
        $this->authorize('update',$iduser);
        $user= new UserResource(User::findOrFail($id));
        $user->update($request->all());
        return response()->json($user, 200)->header('Additional Header','True');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
         User::find($id)->delete();
         return 204;
    }
}
