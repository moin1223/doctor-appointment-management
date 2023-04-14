<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;


class PatientController extends Controller
{
    public function index()
    {

        $contentData = User::orderBy('id', 'desc')->paginate(10);
        return response()->jason($contentData);

    }

    public function store(PatientStoreRequest $request)
    {
        // dd($request->all());
        User::create([
            'event_place' => $request->event_place,
            'address' => $request->address,
            'district_id' => $request->district_id,
        

        ]);
        return redirect()->route('location.index')->with('message', 'Location  Successfully Created!');
        // return response()->json('Location Successfully Created!');
    }

    public function show($patientId)
    {

        $dataItem = User::findOrFail($patientId);
        return response()->jason($dataItem);
    }
    public function edit($patientId)
    {

        $dataItem = User::findOrFail($patientId);
        return response()->jason($dataItem);
    }

    public function update(PatientUpdateRequest $request, $userId)
    {

        $user = User::findOrFail($userId);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('user.index')->with('message', 'User  Successfully Updated!');
    }

    public function destroy($userId)
    {

        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->route('user.index');
    }
}
