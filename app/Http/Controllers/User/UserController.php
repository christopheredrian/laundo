<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        // @TODO: Chris - paginate / limit
        return response()->json([
            'data' => $users
        ], 200);
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

        $statusCode = 500;
        $response = [
            'data' => [],
            'status' => 'error',
            'message' => 'There was an error in processing your request'
        ];

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

            $response['status'] = 'success';
            $response['message'] = 'Successfully created a user';
            $response['data'] = $user;
            $statusCode = 201; // created

        } catch (ValidationException $exception) {
            $statusCode = 200; // created
            $response['status'] = 'error';
            $response['errors'] = $exception->errors();
        } catch (\Exception $exception) {
            // return default response
            $response['status'] = 'error';
            $response['message'] = $exception->getMessage();
        }

        return response()
            ->json($response, $statusCode);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'data' => $user
        ], 200);
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
        $statusCode = 500;
        $response = [
            'data' => [],
            'status' => 'error',
            'message' => 'There was an error in processing your request'
        ];

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

            $response['status'] = 'success';
            $response['message'] = 'Successfully updated a user';
            $response['data'] = $user;
            $statusCode = 201; // updated

        } catch (ValidationException $exception) {
            $statusCode = 200; // created
            $response['status'] = 'error';
            $response['errors'] = $exception->errors();
        } catch (\Exception $exception) {
            // return default response
            $response['status'] = 'error';
            $response['message'] = $exception->getMessage();
        }

        return response()
            ->json($response, $statusCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $statusCode = 500;
        $response = [
            'data' => [],
            'status' => 'error',
            'message' => 'There was an error in processing your request'
        ];

        try {
            $user = User::findOrFail($id);

            $user->delete();

            $response['status'] = 'success';
            $response['message'] = 'Successfully deleted user';
            $response['data'] = $user;
            $statusCode = 201; // updated

        } catch (\Exception $exception) {
            // return default response
            $response['status'] = 'error';
            $response['message'] = "User does not exist";
        }

        return response()
            ->json($response, $statusCode);
    }
}
