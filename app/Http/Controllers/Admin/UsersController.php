<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestmentLimits;
use App\Models\InvestorInvestments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role_id', 2)->orderByDesc('created_at');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    $div = '<div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        <img src="'.$row->image.'" alt="Avatar" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="emp_name text-truncate">'.$row->name.'</span>
                                </div>
                            </div>';
                    return $div;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('date_joined', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at));
                })
                ->addColumn('accredited_investor', function ($row) {
                    if($row->accredited_investor == 1){
                        return '<span class="badge rounded-pill  bg-label-success">Yes</span>';
                    } elseif ($row->accredited_investor == 2){
                        return '<span class="badge rounded-pill  bg-label-warning">Pending</span>';
                    } else{
                        return '<span class="badge rounded-pill  bg-label-warning">No</span>';
                    }
                })
                ->addColumn('username', function ($row) {
                    return $row->username;
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone ? $row->phone : '-';
                })
                ->addColumn('recieve_digi_updates', function ($row) {
                    return $row->recieve_digi_updates == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Yes</span>' :
                        '<span class="badge rounded-pill  bg-label-warning">No</span>';
                })
                ->addColumn('tax_filled', function ($row) {
                    return $row->is_tax_form == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Yes</span>' :
                        '<span class="badge rounded-pill  bg-label-warning">No</span>';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Active</span>' :
                        '<span class="badge rounded-pill  bg-label-warning">Disabled</span>';
                })
                ->addColumn('action', function ($row) {
                    $show_btn_html = '<a href="'.route('admin.users.show', $row->id).'" class="btn btn-sm btn-icon" title="View Details"><i class="bx bx-street-view me-1"></i></a>';
                    $div = $row->status == 1 ?
                        '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" title="Deactivate" onclick="changeStatus(' . $row->id . ', 0)"><i class="bx bxs-x-circle"></i></a>' :
                        '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" title="Active" onclick="changeStatus(' . $row->id . ', 1)"><i class="bx bxs-check-circle"></i></a>';
                    return $div.$show_btn_html;
                })
                ->rawColumns(['id', 'name', 'email', 'username', 'date_joined', 'accredited_investor', 'recieve_digi_updates', 'tax_filled', 'status', 'action'])
                ->make(true);
        }
    }

    public function users()
    {
        return view('admin.users.users');
    }

    public function show(User $user)
    {
        return view('admin.users.show')
            ->with('user', $user);
    }

    public function usersStatusChange(Request $request)
    {
        try {
            $user = User::findorfail($request->id);
            if ($user) {
                $user->status = $request->status;
                $user->save();
                return response()->json([
                    'status' => true,
                    'message' => "User status changed successfully!"
                ], 200);
            } else{
                return response()->json([
                    'status' => false,
                    'message' => "User Not found"
                ], 402);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function settings(User $user)
    {
        $user = User::where('role_id', 1)->first();
        $investor_limit = InvestmentLimits::first();
        return view('admin.settings.userEdit')
            ->with('user', $user)
            ->with('investor_limit', $investor_limit);
    }

    public function settingsUpdate(User $user, Request $request)
    {
        $request->validate([
            'password' => 'confirmed',
            'image' => 'nullable|image|mimes:png, jpg, jpeg',
            'investor_limit' => 'numeric'
        ]);
         $user = User::findorfail(Auth::user()->id);
         $user->first_name = $request->first_name;
         $user->last_name = $request->last_name;
         $user->password = !empty($request->password) ? Hash::make($request->password) : $user->password;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $profileimg = 'profile-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $location = public_path('profiles/' . $profileimg);

            Image::make($image)->resize(225, 225)->save($location, 60);
            $file_path = public_path('profiles/') . $user->image;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $user->image = $profileimg;
        }

        $limit = InvestmentLimits::first();
        $limit->limit = $request->investor_limit;
        $limit->save();

         $user->save();
         Session::flash('success', 'Profile Updated');
        return redirect()->back();
    }

    public function showOfferingInvestments(Request $request, $user_id)
    {
        if ($request->ajax()) {
            $data = InvestorInvestments::whereHas('user', function ($query) use ($user_id) {
                $query->where('id', $user_id);
            })
                ->join('offerings', 'investor_investments.offering_id', '=', 'offerings.id')
                ->selectRaw("investor_investments.id, offerings.name, SUM(investor_investments.amount_invested) as amount_invested, SUM(investor_investments.no_of_shares) as no_of_shares")
                ->groupBy('offering_id');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('offering_id', function ($row) {
                    return $row->name;
                })
                ->addColumn('amount_invested', function ($row) {
                    return '$'.number_format($row->amount_invested);
                })
                ->addColumn('no_of_shares', function ($row) {
                    return number_format($row->no_of_shares);
                })
                ->rawColumns(['id', 'offering_id', 'amount_invested', 'no_of_shares'])
                ->make();
        }
    }
}
