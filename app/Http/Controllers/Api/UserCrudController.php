<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class UserCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   $validateUser = User::find($user);
        return UserResource::collection($validateUser);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   if(empty($request)){
        return response(["error"=>'You should edit the fields that you want update!']);
        }
        $validatedData=$request->validate([
            'name'=>'max:255',
            'last_name'=>'max:255',
            'email'=>'email|unique:users',
        ]);

       $user->update($validatedData);

       return  new UserResource($user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $validatedUser=User::find($user);

        if (count(User::all())<2) {
            return response(['error'=>"You can not delete all the users (Esto para que pueda seguir probando la api sin tener que crearse otro usuario)"]);
        }elseif(auth()->user()->id == (int)$user->id){
            return response(['error'=>"You can not delete your own user (Esto para que pueda seguir probando la api sin tener que crearse otro usuario)"]);
        }else{
            $user->delete(); // That should be the line XXX
            return response(['message'=>"User deleted"]);
        }


    }
}