<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Yajra\DataTables\DataTables;
use DB;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Currency::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">Action <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item"  href="'.route('currency.edit',$row->id).'" data-modal="add-new" data-id="'.$row->id.'"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item text-danger del_rec" href="javascript:void(0)" data-id="'.$row->id.'" data-action="'.url('currency').'" ><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('currency.index');
    }

    public function create()
    {
        return view('currency.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $currency = Currency::create($request->all());
            DB::commit();
            return redirect()->route('currency.index')->with('message', 'Currency created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $currency = Currency::findOrFail($id);
        return view('currency.show', compact('currency'));
    }

    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('currency.edit', compact('currency'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $currency = Currency::findOrFail($id);
            $currency->update($request->all());
            DB::commit();
            return redirect()->route('currency.index')->with('message', 'Currency updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return redirect()->route('currency.index')->with('message', 'Currency deleted successfully!');
    }
}
