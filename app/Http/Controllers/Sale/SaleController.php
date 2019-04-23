<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

use App\Sale;

class SaleController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = DB::table('sales')
            ->join('transactions', 'sales.transaction_id', '=', 'sales.id')
            ->get();

        return $this->showCollectionResponse($sales, 200);
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
        try {

            $rules = [
                'customer_first_name' => 'required|string',
                'customer_last_name' => 'required|string',
                'phone' => 'required|string',
                'transaction_id' => 'required|integer|lte:1',
            ];

            $this->validate($request, $rules);

            $data = $request->all();

            $sale = Sale::create($data);

            if (!$sale->id || empty($sale->id)) {
                throw new \ErrorException("There was an error in creating a new sale");
            }

            return $this->showModelResponse($sale, 201, 'Successfully created Sale');

        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception->errors(), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 20);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $sale = DB::table('sales')
                ->join('transactions', 'sales.transaction_id', '=', 'sales.id')
                ->where('sales.id', '=', $id)
                ->get();

            return $this->showCollectionResponse($sale, 200);

        } catch (\Exception $e)
        {
            /**
             * User not found
             */
            return $this->errorResponse("Cannot find a sale with the id $id", 200);
        }
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
        try {
            $sale = Sale::findOrFail($id);

            $rules = [
                'customer_first_name' => 'required|string',
                'customer_last_name' => 'required|string',
                'phone' => 'required|string',
                'transaction_id' => 'required|integer|lte:1',
            ];

            $this->validate($request, $rules);

            if ($request->has('customer_first_name')) {
                $sale->customer_first_name = $request->customer_first_name;
            }

            if ($request->has('customer_last_name')) {
                $sale->customer_last_name = $request->customer_last_name;
            }

            if ($request->has('phone')) {
                $sale->phone = $request->phone;
            }

            if ($request->has('transaction_id')) {
                // TODO : Sean Ask Eds if we will edit/change transaction id for good or create new one.
                $sale->transaction_id = $request->transaction_id;
            }

            $sale->save();

            /**
             *
             */
            return $this->showModelResponse($sale, 201, "Successfully updated a sale");
            /**
             *
             */
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         * Only perform soft delete. NEVER delete!
         */
        try {
            $sale = Sale::findOrFail($id);

            $sale->deleted = 1;

            $response['status'] = 'success';
            $response['message'] = 'Successfully deleted sale';
            $response['data'] = $sale;

            return $this->showModelResponse($sale, 201, 'Successfully deleted Sale');

        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
}
