<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Expense::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="group-checkable" value="">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">
                            <button type="button" class="btn btn-info">Action</button>
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                              <span class="sr-only">Toggle Dropdown</span>
                              <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" onClick="edit_rec(this)" data-action="'.route('expense.edit',$row->id).'" href="#" data-modal="add-new" data-id="'.$row->id.'"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item text-danger del_rec" href="#"><i class="fas fa-trash"></i> Delete</a>
                              </div>
                            </button>
                          </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('accounts.expenses.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
        ]);
        DB::beginTransaction();
        $data = $request->all();
        $id = $request->id;
        try {
            if ($id == 0 || $id == '') {
                $ret = Expense::create($data);
            } else {
                $ret = Expense::where('id', $id)->update($data);
            }
            DB::commit();
            return $ret;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
        }
    }

    public function show(string $id)
    {
        $res=Expense::where('id',$id)->get();
        return response()->json($res);
    }

    public function edit(string $id)
    {
        return Expense::find($id);
    }

    public function destroy(string $id)
    {
        return Expense::destroy($id);
    }
}
