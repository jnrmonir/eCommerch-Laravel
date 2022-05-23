<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    function dashboard(){
        $today_user=User::whereDate('created_at',Carbon::now())->count();
        $yester_day_user=User::whereDate('created_at',Carbon::now()->subDays(1))->count();
        $two_days_ago=User::whereDate('created_at',Carbon::now()->subDays(2))->count();
        $cat_count = Category::count();
        return view('backend.dashboard',[
            'cat_count'=>$cat_count,
            'today_user'=>$today_user,
            'yester_day_user'=>$yester_day_user,
            'two_days_ago'=>$two_days_ago,
            

        ]);
    }

    function Order(){
        $order=Order::latest()->paginate();
        return view('backend.Order.order',[
            'order'=>$order,
        ]);
    }
    public function ExportExcel() 
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
