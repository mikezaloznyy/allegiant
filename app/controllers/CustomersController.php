<?php

class CustomersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($page = 1)
	{ 
            // by default, return first 10 records
            $customers = Customer::skip(($page - 1) * 10)->take(10)->get();   
           
           
            return Response::json([
                    'data'  => $customers->toArray()
                ], 200);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $input = Input::json()->all();
            
            if(count($input) > 0){
                // validate our input
                 $validator = Validator::make($input, Customer::$rules);
                 
                 if($validator->passes()){
                     $customer = new Customer();
                     $customer->first_name = $input['first_name'];
                     $customer->last_name = $input['last_name'];
                     $customer->ip = $input['ip'];
                     $customer->latitude = $input['latitude'];
                     $customer->longitude = $input['longitude'];
                     $customer->email = $input['email'];
                     $customer->save();
                     
                     return Response::json([
                        'data'  => $customer->toArray()
                    ], 200);
                 }
                 else {
                     return Response::json([
                        'error'  => $validator->errors()
                    ], 403);
                 }
            }
            else {
                 return Response::json([
                    'error'  => 'No input provided'
                ], 405);
            }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $customer = Customer::find($id);
            
            if($customer){
                return Response::json([
                    'data'  => $customer->toArray()
                ], 200);
            }
            else{
                return Response::json([
                    'error'  => 'Customer with id ' . $id . ' not found'
                ], 404);
            }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            $customer = Customer::find($id);
            if(!$customer){
                 return Response::json([
                    'error'  => 'Customer with id ' . $id . ' not found'
                ], 404);
            }
            
            // we found the customer, let's validate the input
            $input = Input::json()->all();
            
            if(count($input) > 0){
                // validate our input
                 $validator = Validator::make($input, Customer::$rules);
                 
                 if($validator->passes()){
                     // Note: FULL update is performed
                     $customer->first_name = $input['first_name'];
                     $customer->last_name = $input['last_name'];
                     $customer->ip = $input['ip'];
                     $customer->latitude = $input['latitude'];
                     $customer->longitude = $input['longitude'];
                     $customer->email = $input['email'];
                     $customer->save();
                     
                     return Response::json([
                        'data'  => $customer->toArray()
                    ], 200);
                 }
                 else {
                     return Response::json([
                        'error'  => $validator->errors()
                    ], 403);
                 }
            }
            else {
                 return Response::json([
                    'error'  => 'No input provided'
                ], 405);
            }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            $customer = Customer::find($id);
            if($customer){
                $customer->delete();
                return Response::json([
                    'data'  => 'Customer with id ' . $id . ' deleted'
                ], 200);
            }
            else{
                return Response::json([
                    'error'  => 'Customer with id ' . $id . ' not found'
                ], 404);
            }
	}
        
        public function search(){
            $input = Input::json()->all();
            
            if(count($input) > 0){
                $rules = array(
                    'first_name' => array('string'),
                    'last_name'  => array('string'),
                    'email'    => array('email'),
                    
                );
                
                // validate input
                $validator = Validator::make($input, $rules);
                if($validator->passes()){
                    $query = DB::table('customers')->select('id', 'email', 'first_name', 'Last_name', 'latitude', 'longitude', 'ip');
                    if(array_key_exists('email', $input)){
                        $customer = $query->where("email", "=", $input['email']);            
                    }
                    if(array_key_exists('first_name', $input)){
                        $customer = $query->where("first_name", "=", $input['first_name']);            
                    }
                     if(array_key_exists('last_name', $input)){
                        $customer = $query->where("last_name", "=", $input['last_name']);            
                    }
                    
                    $customer = $customer->get();
                    if($customer){
                        return Response::json([
                            'data'  => $customer
                        ], 200);
                    }  
                    else {
                        return Response::json([
                            'error'  => 'Customer not found'
                        ], 404);
                    }
                }
                else {
                      return Response::json([
                        'error'  => $validator->errors()
                    ], 403);
                }
            }
            else {
                return Response::json([
                    'error'  => 'No input provided'
                ], 405);
            }
        }
}
