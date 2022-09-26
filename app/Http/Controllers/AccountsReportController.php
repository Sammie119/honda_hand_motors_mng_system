<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsReportController extends Controller
{
    public function accountsReports()
    {
        return view('users.services.accounts_reports');
    }

    public function incomeStatement()
    {
        return view('users.services.income_statement_reports');
    }
}
