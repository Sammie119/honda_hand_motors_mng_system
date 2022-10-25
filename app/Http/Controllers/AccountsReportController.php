<?php

namespace App\Http\Controllers;

use App\Models\CarServiceRequest;
use App\Models\Expenditure;
use App\Models\MonthlyStock;
use App\Models\Rent;
use App\Models\ReturnItems;
use App\Models\StoresTransaction;
use App\Models\SupplyReceived;
use Illuminate\Http\Request;

class AccountsReportController extends Controller
{
    protected function getDates($from, $to){
        return [
            'from' => $from,
            'to' => $to,
        ];
    }

    protected function incomeStatementFromDates($month, $year)
    {
        $date = $year.'-'.$month;
        return [
            'from1' => date('Y-m-d', strtotime("$date-00")),
            'from2' => date("$date-01"),
            'from3' => date("$date-02"),
            'from4' => date("$date-03"),
        ];        
    }

    protected function incomeStatementToDates($month, $year)
    {
        $currentMonth = $year.'-'.$month.'-01';
        $nextMonth = date('Y-m', mktime(0, 0, 0, $month+1, 1, $year));
        
        return [
            'to1' => date("Y-m-t", strtotime($currentMonth)),
            'to2' => date("$nextMonth-01"),
            'to3' => date("$nextMonth-02"),
            'to4' => date("$nextMonth-03"),
        ];        
        
    }

    public function accountsReports()
    {
        return view('accounts_reports');
    }

    public function incomeStatement()
    {
        return view('income_statement_reports');
    }

    public function debtorListReport()
    {
        $debtors = CarServiceRequest::selectRaw("customer_id, car_no, fault, ser_charge, engineer, sum(amount_paid) as amount_paid, service_date, service_no")
                    ->groupBy('customer_id', 'car_no', 'ser_charge', 'engineer', 'fault', 'service_date', 'service_no')
                    ->get();
                    
        return view('users.services.debtors_list', ['debtors' => $debtors]);
    }

    public function specificCarReport()
    {
        return view('users.services.specific_car_report');
    }

    public function incomeAccountsReport(Request $request)
    {
        // dd($request->all());
        switch ($request->report_type) {
            case 'ServicesAccounts':

                $key = 'ServicesAccounts';

                $dates = $this->getDates($request->report_from, $request->report_to);

                $query = CarServiceRequest::selectRaw('service_no, ser_charge, sum(amount_paid) as amount_paid')
                                ->whereBetween('service_date', [$request->report_from, $request->report_to])
                                ->groupBy('service_no', 'ser_charge')
                                ->get();
            
                $total_charges = 0;
                $total_amount_paid = 0;
                            
            
                foreach ($query as $value){
                    $total_charges += $value->ser_charge;
                    $total_amount_paid += $value->amount_paid;
                }
                
                $results = [
                    'total_charges' => $total_charges,
                    'total_amount_paid' => $total_amount_paid,
                ];
                    
                break;

            case 'PettyCash':

                $key = 'PettyCash';

                $dates = $this->getDates($request->report_from, $request->report_to);

                $expenditures = Expenditure::whereBetween('exp_date', [$request->report_from, $request->report_to])
                                    ->orderByDesc('exp_date')
                                    ->get();

                $total_expenses = Expenditure::selectRaw('sum(amount) as amount')
                                ->whereBetween('exp_date', [$request->report_from, $request->report_to])
                                ->first();

                $portfolio_totals = Expenditure::selectRaw('portfolio, SUM(amount) AS amount')
                                    ->whereBetween('exp_date', [$request->report_from, $request->report_to])
                                    ->groupBy('portfolio')
                                    ->get();

                $results = [
                    'expenditures' => $expenditures,
                    'total_expenses' => $total_expenses->amount,
                    'portfolio_totals' => $portfolio_totals,
                    'portfolio_totals_sum' => $total_expenses->amount,
                ];

                break;
            
            case 'CashBook':

                $key = 'CashBook';

                $dates = $this->getDates($request->report_from, $request->report_to);

                $total_service = CarServiceRequest::selectRaw('sum(amount_paid) as amount_paid')
                                ->whereBetween('service_date', [$request->report_from, $request->report_to])
                                ->first();

                $total_stores = StoresTransaction::selectRaw('sum(amount_paid) as amount_paid')
                                ->whereBetween('transaction_date', [$request->report_from, $request->report_to])
                                ->first();

                $total_rent = Rent::selectRaw('sum(amount) as amount')
                                ->whereBetween('rent_date', [$request->report_from, $request->report_to])
                                ->first();

                $total_expenses = Expenditure::selectRaw('sum(amount) as amount')
                                ->whereBetween('exp_date', [$request->report_from, $request->report_to])
                                ->first();

                $results = [
                    'total_service' => $total_service->amount_paid,
                    'total_stores' => $total_stores->amount_paid,
                    'total_rent' => $total_rent->amount,
                    'total_expenses' => $total_expenses->amount
                ];

                break;

            case 'MainLabour':

                $key = 'MainLabour';

                $dates = $this->getDates($request->report_from, $request->report_to);

                $total_service = CarServiceRequest::selectRaw('sum(amount_paid) as amount_paid')
                                ->whereBetween('service_date', [$request->report_from, $request->report_to])
                                ->first();

                $total_expenses = Expenditure::selectRaw('sum(amount) as amount')
                                ->whereBetween('exp_date', [$request->report_from, $request->report_to])
                                ->first();

                $results = [
                    'total_service' => $total_service->amount_paid,
                    'total_expenses' => $total_expenses->amount
                ];

                break;

            case 'RentAccount':

                $key = 'RentAccount';

                $dates = $this->getDates($request->report_from, $request->report_to);

                $rent = Rent::selectRaw('master_id, amount, month_year, rent_date')
                                ->whereBetween('rent_date', [$request->report_from, $request->report_to])
                                ->get();

                $total_rent = Rent::selectRaw('sum(amount) as amount')
                                ->whereBetween('rent_date', [$request->report_from, $request->report_to])
                                ->first();

                $results = [
                    'rent' => $rent,
                    'total_rent' => $total_rent->amount,
                ];

                break;

            case 'LabourIncome':

                $key = 'LabourIncome';

                $dates = $this->getDates($request->report_from, $request->report_to);

                $services = CarServiceRequest::selectRaw('customer_id, service_no, ser_charge, sum(amount_paid) as amount_paid, engineer, fault, service_date')
                                ->whereBetween('service_date', [$request->report_from, $request->report_to])
                                ->groupBy('customer_id', 'service_no', 'ser_charge', 'engineer', 'fault', 'service_date')
                                ->get();

                $services_engineer = CarServiceRequest::selectRaw('sum(amount_paid) as amount_paid, engineer')
                                ->whereBetween('service_date', [$request->report_from, $request->report_to])
                                ->groupBy('engineer')
                                ->get();
                
                $services_total = CarServiceRequest::selectRaw('sum(amount_paid) as amount_paid')
                                ->whereBetween('service_date', [$request->report_from, $request->report_to])
                                ->first();

                $services_charge = CarServiceRequest::selectRaw('service_no, ser_charge')
                                ->whereBetween('service_date', [$request->report_from, $request->report_to])
                                ->groupBy('service_no', 'ser_charge')
                                ->get();

                $services_charge_total = 0;
                foreach ($services_charge as $value){
                    $services_charge_total += $value->ser_charge;
                }

                $results = [
                    'services' => $services,
                    'services_engineer' => $services_engineer,
                    'services_total' => $services_total->amount_paid,
                    'services_charge' => $services_charge_total,
                ];

                // dd($results);

                break;

            case 'IncomeStatement':

                $key = 'IncomeStatement';

                $from = $this->incomeStatementFromDates($request->report_month_from, $request->report_year_from);
                $to = $this->incomeStatementToDates($request->report_month_to, $request->report_year_to);

                // Sales
                $total_sales = StoresTransaction::selectRaw('sum(total_amount) as total_amount')
                                ->where('amount_paid', 0)
                                ->whereBetween('transaction_date', [$from['from2'], $to['to1']])
                                ->first()->total_amount;

                $total_cash = StoresTransaction::selectRaw('sum(amount_paid) as amount_paid')
                                ->where('amount_paid', '>', 0)
                                ->whereBetween('transaction_date', [$from['from2'], $to['to1']])
                                ->first()->amount_paid;

                $total_return = ReturnItems::selectRaw('sum(total_amount) as total_amount')
                                ->whereBetween('transaction_date', [$from['from2'], $to['to1']])
                                ->first()->total_amount;
                
                // Service
                $service_total = CarServiceRequest::selectRaw('service_no, ser_charge')
                                ->whereBetween('service_date', [$from['from2'], $to['to1']])
                                ->groupBy('service_no', 'ser_charge')
                                ->get();
                $service_total = $service_total->sum('ser_charge');

                $service_cash = CarServiceRequest::selectRaw('sum(amount_paid) as amount_paid')
                                ->whereBetween('service_date', [$from['from2'], $to['to1']])
                                ->first()->amount_paid;

                //Rent Totals
                #SELECT SUM(amount) AS amount FROM rents_episode WHERE re_date BETWEEN '$from2' AND '$to1'
                $rent_total = Rent::selectRaw('sum(amount) as amount')
                                ->whereBetween('rent_date', [$from['from2'], $to['to1']])
                                ->first()->amount;

                //Opening Stock
                #SELECT SUM(stock*price) AS open_stock  FROM monthly_stock WHERE (mdate = '$from1' OR mdate = '$from2' OR mdate = '$from3' OR mdate = '$from4')
                #SELECT SUM(stock*price) AS close_stock  FROM monthly_stock WHERE (mdate = '$to1' OR mdate = '$to2' OR mdate = '$to3' OR mdate = '$to4')
                $open_stock = MonthlyStock::selectRaw("sum(stock*price) as open_stock")
                            ->where('mdate', $from['from1'])->orWhere('mdate', $from['from2'])->orWhere('mdate', $from['from3'])->orWhere('mdate', $from['from4'])
                            ->first()->open_stock;
                
                //Closing Stock
                $close_stock = MonthlyStock::selectRaw("sum(stock*price) as close_stock")
                            ->where('mdate', $to['to1'])->orWhere('mdate', $to['to2'])->orWhere('mdate', $to['to3'])->orWhere('mdate', $to['to4'])
                            ->first()->close_stock;
                                
                //Cariage Inwards
                #SELECT SUM(amount) AS cariage_total  FROM expenditures WHERE exp_date BETWEEN '$from2' AND '$to1' AND active = 'Yes' AND portfolio = 'Cariage Inwards'
                $cariage_total = Expenditure::selectRaw("sum(amount) as cariage_total")
                            ->whereBetween('exp_date', [$from['from2'], $to['to1']])
                            ->where('portfolio', 'Cariage Inwards')
                            ->first()->cariage_total;

                //Add Purchases
                #SELECT SUM(paid) AS purchase_paid  FROM supply_received WHERE sup_date BETWEEN '$from2' AND '$to1'"
                $purchase_paid = SupplyReceived::selectRaw("sum(paid) as purchase_paid")
                            ->whereBetween('sup_date', [$from['from2'], $to['to1']])
                            ->first()->purchase_paid;

                $purchase_amount = SupplyReceived::selectRaw('supply_no, total_amount')
                            ->whereBetween('sup_date', [$from['from2'], $to['to1']])
                            ->groupBy('supply_no', 'total_amount')
                            ->get();
                $purchase_amount = $purchase_amount->sum('total_amount');

                #SELECT portfolio, amount FROM expenditures WHERE exp_date BETWEEN '$from2' AND '$to1' AND active = 'Yes' AND portfolio <> 'Cariage Inwards'
                $expenditure = Expenditure::select('portfolio', 'amount')
                            ->whereBetween('exp_date', [$from['from2'], $to['to1']])
                            ->where('portfolio', '!=', 'Cariage Inwards')
                            ->get();

                $expenses_total = $expenditure->sum('amount');

                $dates = [
                    'from' => $from['from2'],
                    'to' => $to['to1'],
                ];

                $results = [
                    'total_sales' => (float)$total_sales,
                    'total_cash' => (float)$total_cash,
                    'total_return' => (float)$total_return,
                    'service_total' => (float)$service_total,
                    'service_total' => $service_total,
                    'service_cash' => (float)$service_cash,
                    'rent_total' => (float)$rent_total,
                    'open_stock' => (float)$open_stock,
                    'close_stock' => (float)$close_stock,
                    'cariage_total' => (float)$cariage_total,
                    'purchase_paid' => (float)$purchase_paid,
                    'purchase_amount' => (float)$purchase_amount,
                    'expenditures' => $expenditure,
                    'expenses_total' => (float)$expenses_total,
                ];

                // dd($results);

                break;

            case 'StoresAccounts':

                $key = 'StoresAccounts';

                $dates = $this->getDates($request->report_from, $request->report_to);

                $total_stores_sales = StoresTransaction::selectRaw('sum(total_amount) as total_amount')
                                ->where('amount_paid', 0)
                                ->whereBetween('transaction_date', [$request->report_from, $request->report_to])
                                ->first()->total_amount;

                $total_amount_received = StoresTransaction::selectRaw('sum(amount_paid) as amount_paid')
                                ->where('amount_paid', '>', 0)
                                ->whereBetween('transaction_date', [$request->report_from, $request->report_to])
                                ->first()->amount_paid;
                                
                $total_amount_returned_items = ReturnItems::selectRaw('sum(total_amount) as total_amount')
                                ->whereBetween('transaction_date', [$request->report_from, $request->report_to])
                                ->first()->total_amount;

                // dd($total_stores_sales, $total_amount_received, $total_amount_returned_items);
                $results = [
                    'total_stores_sales' => $total_stores_sales,
                    'total_amount_received' => $total_amount_received,
                    'total_amount_returned_items' => $total_amount_returned_items
                ];

                break;
            
            case 'Supplies':

                $key = 'Supplies';

                $dates = $this->getDates($request->report_from, $request->report_to);

                $received_payment = SupplyReceived::whereBetween('sup_date', [$request->report_from, $request->report_to])
                                    ->orderBy('receipt_no')
                                    ->get();

                $total_amount_debt = SupplyReceived::selectRaw('supply_no, total_amount')
                                    ->whereBetween('sup_date', [$request->report_from, $request->report_to])
                                    ->groupBy('supply_no', 'total_amount')
                                    ->get();
                $total_amount_debt = $total_amount_debt->sum('total_amount');
                
                $total_amount_paid = SupplyReceived::selectRaw('sum(paid) as paid')
                                    ->whereBetween('sup_date', [$request->report_from, $request->report_to])
                                    ->first()->paid;
                // dd($received_payment, $total_amount_debt, $total_amount_paid);

                $results = [
                    'received_payment' => $received_payment,
                    'total_amount_debt' => $total_amount_debt,
                    'total_amount_paid' => $total_amount_paid
                ];
                break;

            case 'Debtors':

                $debtors = json_decode($request->debtors);

                $key = 'Debtors';

                $dates = date('Y-m-d');

                $results = [
                    'debtors' => $debtors
                ];

                break;

            case 'Car_info':

                // dd($request->all());

                $cars = CarServiceRequest::selectRaw("customer_id, car_no, fault, ser_charge, engineer, sum(amount_paid) as amount_paid, service_date, service_no")
                    ->where('car_no', $request->car_info)
                    ->groupBy('customer_id', 'car_no', 'ser_charge', 'engineer', 'fault', 'service_date', 'service_no')
                    ->get();

                $key = 'Car_info';

                $dates = date('Y-m-d');

                $results = [
                    'cars' => $cars
                ];

                break;
            
            default:
                return "No report Selected";
                break;
        }

        return view('reports_print', ['key' => $key, 'results' => $results, 'dates' => $dates]);
    }
}
