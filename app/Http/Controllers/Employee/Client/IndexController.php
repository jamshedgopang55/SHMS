<?php

namespace App\Http\Controllers\Employee\Client;

use App\Models\client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index()
    {
        $clients = client::get();
        return view('employee.clients.index', compact('clients'));
    }
    public function create()
    {
        return view('employee.clients.create');
    }
    public function store(Request $request)
    {
       
        
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:clients,email',
            'company_name' => 'required',
            'country' => 'required|in:Pakistan,India,USA,Uk,Africa',
            'mobile_number' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $client = new client();
            $client->first_name = $request->fname;
            $client->last_name = $request->lname;
            $client->street_address_1 = $request->street_address_1;
            $client->email = $request->email;
            $client->company_name = $request->company_name;
            $client->country = $request->country;
            $client->mobile_number = $request->mobile_number;
            $client->save();
            return response()->json([
                'status' => true,
                'message' => "Client Created SuccessFully."
            ]);
        }
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
    public function edit(client $client)
    {
        return view('employee.clients.edit', compact('client'));
    }
    public function update(Request $request)
    {
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'company_name' => 'required',
            'country' => 'required|in:Pakistan,India,USA,Uk,Africa',
            'mobile_number' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $client = client::find($request->id);
            $client->first_name = $request->fname;
            $client->last_name = $request->lname;
            $client->street_address_1 = $request->street_address_1;
            $client->email = $request->email;
            $client->company_name = $request->company_name;
            $client->country = $request->country;
            $client->mobile_number = $request->mobile_number;
            $client->save();
            return redirect()->route('employee.client.index');
            return response()->json([
                'status' => true,
                'message' => "Client Updated SuccessFully."
            ]);
        }
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
    public function search(Request $req)
    {
        $tempProducts = [];
        $products = null;
        if ($req->term != "") {
            $products = client::where('first_name', 'like', '%' . $req->term . '%')->get();
        }

        if ($products != null) {
            foreach ($products as $product) {
                $tempProducts[] = array('id' => $product->id, 'text' => $product->first_name);
            }
            return response()->json([
                'tags' => $tempProducts,
                'status' => true
            ]);
        }
    }
    public function fetchClient(Request $request)
    {
        $clientId = $request->clientId;

        // Fetch the client record from the database
        $client = Client::findOrFail($clientId);

        // Return the client record as JSON response
        return response()->json($client);
    }
}
