<?php

namespace App\Http\Controllers;

use App\Exports\BulkExport;
use App\Imports\BulkImport;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    public function index()
    {
        $dataList = Task::all();
        return view('task.index', compact('dataList'));
    }

    public function uploadBulkView()
    {
        return view('task');
    }

    public function uploadBulkFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,xlsx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error uploading file: ' . $validator->messages()->first());
        }
        try {
            Excel::import(new BulkImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data uploaded successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Internal processing error');
        }
    }

    public function downloadAllData()
    {
        return Excel::download(new BulkExport, 'data.csv');
    }

    public function addSingleDataView()
    {

        $details = Session::get('details', []);

        return view('task.add_single_data', compact('details'));
    }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'mobile' => 'required|numeric|min:10',
            'role' => 'required|string',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error In Adding Data : ' . $validator->messages()->first());
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }
        $details = Session::get('details', []);

        // Add new data
        $details[] = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile' => $request->mobile,
            'role' => $request->role,
            'date' => $request->date,
            'image' => $imagePath,
        ];

        Session::put('details', $details);
        return redirect()->route('addSingle')->with('success', 'Detail added successfully!');
    }

    public function editData($index)
    {
        $details = Session::get('details', []);
        if (!isset($details[$index])) {
            return redirect()->route('addSingle')->with('error', 'Detail not found.');
        }
        $detail = $details[$index];
        return view('task.edit_single_data', compact('detail', 'index'));
    }

    public function updateData(Request $request, $index)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'mobile' => 'required|numeric|min:10',
            'role' => 'required|string',
            'date' => 'required|date',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error In Updating Data : ' . $validator->messages()->first());
        }

        $details = Session::get('details', []);

        if (!isset($details[$index])) {
            return redirect()->route('addSingle')->with('error', 'Detail not found.');
        }
        $details[$index]['name'] = $request->name;
        $details[$index]['email'] = $request->email;
        $details[$index]['mobile'] = $request->mobile;
        $details[$index]['role'] = $request->role;
        $details[$index]['date'] = $request->date;
        $details[$index]['password'] = $request->password;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $details[$index]['image'] = 'images/' . $imageName;
        }

        Session::put('details', $details);

        return redirect()->route('addSingle')->with('success', 'Detail updated successfully!');
    }

    public function deleteData($index)
    {
        $details = Session::get('details', []);
        unset($details[$index]);
        Session::put('details', $details);
        return redirect()->route('addSingle')->with('success', 'Detail deleted successfully!');
    }

    public function finalSubmit(Request $request)
    {

        $details = Session::get('details', []);


        foreach ($details as $detail) {
            Task::create([
                'name' => $detail['name'],
                'email' => $detail['email'],
                'password' => Hash::make($detail['password']),
                'mobile' => $detail['mobile'],
                'role' => $detail['role'],
                'date' => $detail['date'],
                'image' => $detail['image'],
            ]);
        }
        Session::forget('details');

        return redirect()->route('addSingle')->with('success', 'All details stored successfully in the database!');
    }
}
