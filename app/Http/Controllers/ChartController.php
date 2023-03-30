<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Currency;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function index()
    {
        $role=Auth::user() ? Auth::user()['role'] : '';
        if ($role!='admin') {
        return inertia('Chart');
        }
        $chartValues = Account::getChartValues();
        $labels = $chartValues['labels'];
        $datasets = $chartValues['datasets'];
        $percentages = $chartValues['percentages'];

        return inertia('Chart', compact('labels','datasets', 'percentages'));
    }
}
