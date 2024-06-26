<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferingTypes;
use App\Http\Requests\StoreOfferingsType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;


class OfferingsTypeController extends Controller
{
    public function offeringTypeListing(Request $request){
        if ($request->ajax()) {
            $data = OfferingTypes::query();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('type', function ($row) {
                    return $row->type;
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Active</span>' :
                        '<span class="badge rounded-pill  bg-label-danger">Deactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $div = $row->status == 1 ?
                        '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" title="Deactivate" onclick="changeStatus(' . $row->id . ', 0)"><i class="bx bxs-x-circle" ></i></a>' :
                        '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" title="Active" onclick="changeStatus(' . $row->id . ', 1)"><i class="bx bxs-check-circle" ></i></a>';
                    return $div;
                })
                ->rawColumns(['id', 'type', 'status', 'action'])
                ->make(true);
        }
    }
    public function offeringType()
    {
        return view('admin.offerings.offerings_type');
    }

    public function createType()
    {
        return view('admin.offerings.createOfferingsType');
    }

    public function storeType(StoreOfferingsType $request)
    {
        $offeringType = new OfferingTypes;
        $offeringType->type = $request->type;
        $offeringType->status = $request->status == "on" ? 1 : 0;
        $offeringType->created_at = Carbon::now();
        $offeringType->updated_at = Carbon::now();

        $offeringType->save();

        Session::flash('success', 'Offering Type Created Successfully.');
        return redirect()->back();
    }

    public function typeStatusChange(Request $request)
    {
        try {
            $offeringType = OfferingTypes::findorfail($request->id);
            if ($offeringType) {
                $offeringType->status = $request->status;
                $offeringType->save();
                return response()->json([
                    'status' => true,
                    'message' => "Offering Type status changed successfully!"
                ], 200);
            } else{
                return response()->json([
                    'status' => false,
                    'message' => "Offering Type Not found"
                ], 402);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
