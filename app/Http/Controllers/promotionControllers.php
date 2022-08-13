<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class promotionControllers extends Controller
{
    public function index()
    {
        $promotion = Promotion::orderBy('id', 'DESC')->paginate(5);

        return view('admin.promotion.index', [
            'promotion' => $promotion
        ]);
    }
    public function create_promotion()
    {
        return view('admin.promotion.create');
    }
    public function store(Request $request)
    {
        if ($request->type == 1) {
            $type = '%';
            if ($request->detail > 100) {
                return redirect()->route('admin.promotion')->with('error', 'Không thể khuyến mãi vượt quá 100%');
            }
        } else {
            $type = '$';
        };
        $na = Promotion::orderBy('id', 'DESC')->limit(1)->get();
        $day = new Carbon($request->dayStart);
        // if ($na[0]->time_end < $day) {
        //     dd($na[0]->time_end . ' ' . $day);
        // } else {
        //     dd("error");
        // }
        // || new Carbon($request->dayStart) > new Carbon($request->dayEnd)
        if (date($na[0]->time_end) > date($day) || new Carbon($request->dayStart) > new Carbon($request->dayEnd)) {
            // dd(date($na[0]->time_end) . '  -  ' . date($day));
            // dd($na[0]->time_end . '  -  ' . $day);
            return redirect()->route('admin.promotion')->with('error', 'Vui lòng kiểm tra thời gian khuyến mãi phù hợp');
        }
        // dd('dung');

        $data = [
            'name' => $request->name,
            'time_start' => $request->dayStart,
            'time_end' => $request->dayEnd,
            'type' => $type,
            'create_by' => Auth::user()['id'],
            'detail' => $request->detail
        ];
        Promotion::create($data);
        return redirect()->route('admin.promotion')->with('success', 'Thêm khuyến mãi thành công');
    }
    public function edit($id)
    {
        $promotion = Promotion::find($id);
        // dd($promotion);
        return view('admin.promotion.edit', [
            'promotion' => $promotion
        ]);
    }
    public function storeEdit(Request $request)
    {
        if ($request->type == 1) {
            $type = '%';
            if ($request->detail > 100) {
                return redirect()->route('admin.promotion')->with('error', 'Không thể khuyến mãi vượt quá 100%');
            }
        } else {
            $type = '$';
        };
        $na = Promotion::orderBy('id', 'DESC')->offset(1)->limit(1)->get();
        $day = new Carbon($request->dayStart);
        if (date($na[0]->time_end) > date($day) || new Carbon($request->dayStart) > new Carbon($request->dayEnd)) {
            // dd(date($na[0]->time_end) . '  -  ' . date($day));
            // dd($na[0]->time_end . '  -  ' . $day);
            return redirect()->route('admin.promotion')->with('error', 'Vui lòng kiểm tra thời gian khuyến mãi phù hợp');
        }
        $data = [
            'name' => $request->name,
            'time_start' => $request->dayStart,
            'time_end' => $request->dayEnd,
            'type' => $type,
            'detail' => $request->detail,
            'status' => $request->status,
        ];
        Promotion::where('id', '=', $request->id_promotion)->update($data);
        return redirect()->route('admin.promotion')->with('success', 'Cập nhật thông tin thành công');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotion.index')->with('success', 'Xóa thông tin thành công');
    }
}