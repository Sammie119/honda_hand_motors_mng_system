<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\MonthlyStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MonthlyStockCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $mcheck = MonthlyStock::select('status')->orderByDesc('id')->first()->status;

        $day1 = date('Y-m-01');
        $day2 = date('Y-m-02');
        $day3 = date('Y-m-03');
        $last_day = date('Y-m-t');

        $curr = date('Y-m-d');

        if(($mcheck == 0) && ($last_day == $curr || $day1 == $curr || $day2 == $curr || $day3 == $curr)){
            DB::select("INSERT INTO monthly_stocks (item, stock, price, mdate, status, created_at, updated_at)
                        SELECT item, stock, price, '$curr' as mdate, 1 as status, now() as created_at, now() as updated_at FROM items");

            Session::flash('success', 'Monthly Stock taken Successfull!!!');
            
            MonthlyStock::where('status', 0)->update(array('status' => 1));
        }
        elseif(($mcheck == 1) && ($last_day == $curr || $day1 == $curr || $day2 == $curr || $day3 == $curr)) {
            
            MonthlyStock::where('status', 1)->update(array('status' => 1));
        }
        else {

            MonthlyStock::where('status', 1)->update(array('status' => 0));
        }

        return $next($request);
    }
}
