<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         *
         */
        return $this->showCollectionResponse(User::all(), 200);
        /**
         *
         */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {

        try {

            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                Rule::in(User::VALID_USER_ROLES)
            ];

            $this->validate($request, $rules);

            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            $data['verified'] = User::UNVERIFIED_USER;
            $data['verification_token'] = User::generateVerificationCode();

            $user = User::create($data);

            if (!$user->id || empty($user->id)) {
                throw new \ErrorException("There was an error in creating new user");
            }

            return $this->showModelResponse($user, 201, 'Successfully Created User');

        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception->errors(), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 20);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id); // throws an exception when the user is not found

            return $this->showModelResponse($user, 200);
        } catch (\Exception $exception) {
            /**
             * User not found
             */
            return $this->errorResponse("Cannot find a user with the id $id", 200);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $user = User::findOrFail($id);

            $rules = [
                'email' => 'email|unique:users,email,' . $user->id, // same user email is valid
                'password' => 'min:6|confirmed',
                Rule::in(User::VALID_USER_ROLES)
            ];

            $this->validate($request, $rules);

            if ($request->has('first_name')) {
                $user->first_name = $request->first_name;
            }

            if ($request->has('last_name')) {
                $user->last_name = $request->last_name;
            }

            if ($request->has('email') && $user->email !== $request->email) {
                $user->verification_token = User::generateVerificationCode();
                $user->verified = User::UNVERIFIED_USER;
                $user->email = $request->email;
            }

            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }

            if ($request->has('role')) {

                if ($user->isVerified()) {
                    throw new \ErrorException("Only verified users can change the role field");
                    $statusCode = 409; // created
                }
                $user->role = $request->role;
            }

            if (!$user->isDirty()) {
                throw new \ErrorException("You need to specify a different value to update.");
                $statusCode = 422; // created
            }

            $user->save();

            if (!$user->id || empty($user->id)) {
                throw new \ErrorException("There was an error in creating new user");
            }

            /**
             *
             */
            return $this->showModelResponse($user, 201, "Successfully updated a user");

        } catch (ValidationException $exception) {
            /**
             *
             */
            return $this->validationErrorResponse($exception->errors(), 200);
            /**
             *
             */
        } catch (\Exception $exception) {
            /**
             * Unhandled exception
             */
            return $this->validationErrorResponse($exception->getMessage(), 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $user = User::findOrFail($id);

            $user->delete();

            $response['status'] = 'success';
            $response['message'] = 'Successfully deleted user';
            $response['data'] = $user;

            return $this->showModelResponse($user, 201, 'Successfully Deleted User');

        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }

    }
}
