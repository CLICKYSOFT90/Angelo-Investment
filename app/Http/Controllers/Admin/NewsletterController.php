<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsLettersExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where(['role_id' => 2, 'recieve_digi_updates' => 1]);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    $div = '<div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        <img src="' .$row->image. '" alt="Avatar" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="emp_name text-truncate">' . $row->name . '</span>
                                </div>
                            </div>';
                    return $div;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" title="Remove" onclick="removeUser(' . $row->id . ')"><i class="bx bxs-x-circle" ></i></a>';
                })
                ->rawColumns(['id', 'name', 'email', 'action'])
                ->make(true);
        }
    }

    public function exportCsv()
    {
        return Excel::download(new NewsLettersExport(), 'users.csv');
//        $data = User::where('recieve_digi_updates', 1)->get()->toArray();
//
//        return Excel::create('newsletter_users', function($excel) use ($data) {
//            $excel->sheet('users', function($sheet) use ($data)
//            {
//                $sheet->fromArray($data);
//            });
//        })->download('csv');
    }

    public function exportExcel()
    {
        return Excel::download(new NewsLettersExport(), 'users.xlsx');

//        $data = User::where('recieve_digi_updates', 1)->get()->toArray();
//
//        return Excel::create('newsletter_users', function($excel) use ($data) {
//            $excel->sheet('users', function($sheet) use ($data)
//            {
//                $sheet->fromArray($data);
//            });
//        })->download('xlsx');
    }

    public function newsletter()
    {
        return view('admin.newsletter.newsletter');
    }

    public function newsletterRemove(Request $request)
    {
        try {
            $user = User::findorfail($request->id);
            $user->recieve_digi_updates = 0;
            $user->save();
            return response()->json([
                'status' => true,
                'message' => 'User removed successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
