<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Sector;

class AddressController extends Controller
{

    // ADDRESS LIST
    public function index()
    {

        $addresses = Address::where('user_id', auth()->id())
                        ->latest()
                        ->get();

        return response()->json([

            'status' => true,

            'data' => $addresses
        ]);
    }


    // ADD ADDRESS
    // public function store(Request $request)
    // {

    //     $address = Address::create([

    //         'user_id' => auth()->id(),

    //         'full_name' => $request->full_name,

    //         'phone' => $request->phone,

    //         'house_no' => $request->house_no,

    //         'street' => $request->street,

    //         'city' => $request->city,

    //         'pincode' => $request->pincode,

    //         'address_type' => $request->address_type

    //     ]);

    //     return response()->json([

    //         'status' => true,

    //         'message' => 'Address Added',

    //         'data' => $address
    //     ]);
    // }

    public function store(Request $request)
{

    $address = Address::create([

        'user_id' => auth()->id(),

        'full_name' => $request->full_name,

        'phone' => $request->phone,

        'house_no' => $request->house_no,

        'street' => $request->street,

        'city' => $request->city,

        'pincode' => $request->pincode,

        'address_type' => $request->address_type

    ]);

    // Sector List
    $sector_list = Sector::where('status', 1)->get();

    return response()->json([

        'status' => true,

        'message' => 'Address Added',

        'data' => $address,

        'sector_list' => $sector_list

    ]);
}


    // SINGLE ADDRESS
    // public function show($id)
    // {

    //     $address = Address::where('user_id', auth()->id())
    //                 ->where('id', $id)
    //                 ->first();

    //     return response()->json([

    //         'status' => true,

    //         'data' => $address
    //     ]);
    // }

    public function show($id)
{

    $address = Address::where('user_id', auth()->id())
                ->where('id', $id)
                ->first();

    if (!$address) {

        return response()->json([

            'status' => false,

            'message' => 'Address Not Found'

        ], 404);
    }

    // Sector List
    $sector_list = Sector::where('status',1)
                    ->select('id','sector_name')
                    ->get();

    return response()->json([

        'status' => true,

        'data' => $address,

        'sector_list' => $sector_list

    ]);
}


    // UPDATE ADDRESS
    // public function update(Request $request, $id)
    // {

    //     $address = Address::where('user_id', auth()->id())
    //                 ->where('id', $id)
    //                 ->first();

    //     if (!$address) {

    //         return response()->json([

    //             'status' => false,

    //             'message' => 'Address Not Found'
    //         ]);
    //     }

    //     $address->full_name = $request->full_name;

    //     $address->phone = $request->phone;

    //     $address->house_no = $request->house_no;

    //     $address->street = $request->street;

    //     $address->city = $request->city;

    //     $address->pincode = $request->pincode;

    //     $address->address_type = $request->address_type;

    //     $address->save();

    //     return response()->json([

    //         'status' => true,

    //         'message' => 'Address Updated'
    //     ]);
    // }

    public function update(Request $request, $id)
{

    $address = Address::where('user_id', auth()->id())
                ->where('id', $id)
                ->first();

    if (!$address) {

        return response()->json([

            'status' => false,

            'message' => 'Address Not Found'

        ], 404);
    }

    $address->update([

        'full_name' => $request->full_name,

        'phone' => $request->phone,

        'house_no' => $request->house_no,

        'street' => $request->street,

        'city' => $request->city,

        'pincode' => $request->pincode,

        'address_type' => $request->address_type

    ]);

    // Sector List
    $sector_list = Sector::where('status',1)
                    ->select('id','sector_name')
                    ->get();

    return response()->json([

        'status' => true,

        'message' => 'Address Updated Successfully',

        'data' => $address,

        'sector_list' => $sector_list

    ]);
}


    // DELETE ADDRESS
    public function destroy($id)
    {

        $address = Address::where('user_id', auth()->id())
                    ->where('id', $id)
                    ->first();

        if (!$address) {

            return response()->json([

                'status' => false,

                'message' => 'Address Not Found'
            ]);
        }

        $address->delete();

        return response()->json([

            'status' => true,

            'message' => 'Address Deleted'
        ]);
    }


    public function sectorList()
{
    $sector_list = Sector::where('status', 1)
                    ->select('id', 'sector_name')
                    ->get();

    return response()->json([

        'status' => true,

        'message' => 'Sector List',

        'data' => $sector_list

    ]);
}
}
