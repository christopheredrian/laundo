<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showCollectionResponse(Transaction::all(), 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'total_amount' => 'required|between:1,99999999.99',
            'details' => 'required|string',
            'user_id' => 'required|integer|lte:1',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $transaction = Transaction::create($data);

        if (!$transaction->id || empty($transaction->id)) {
            throw new \ErrorException("There was an error in creating a new transaction");
        }

        return $this->showModelResponse($transaction, 201, 'Successfully created transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return $this->showCollectionResponse($transaction, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $rules = [
            'total_amount' => 'required|between:1,99999999.99',
            'details' => 'required|string',
            'user_id' => 'required|integer|lte:1',
        ];

        $this->validate($request, $rules);

        if ($request->has('total_amount')) {
            $transaction->total_amount = $request->total_amount;
        }

        if ($request->has('details')) {
            $transaction->details = $request->details;
        }

        if ($request->has('user_id')) {
            $transaction->user_id = $request->user_id;
        }

        $transaction->save();

        return $this->showModelResponse($transaction, 201, "Successfully updated a transaction");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         * Only perform soft delete. NEVER delete!
         */
        $transaction = Transaction::findOrFail($id);

        $transaction->delete;

        $response['status'] = 'success';
        $response['message'] = 'Successfully deleted transaction';
        $response['data'] = $transaction;

        return $this->showModelResponse($transaction, 201, 'Successfully deleted transaction');
    }
}
