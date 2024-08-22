<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\client;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Milestone;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        // Count all users
        $userCount = User::count();

        // Count all employees
        $employeeCount = Employee::count();
        $clients = client::count();

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // Sum of price for milestones in the current year
        $yearlyReceivedMilestonePrice = Milestone::whereYear('created_at', $currentYear)->sum('price');

        $monthlyMilestonePrices = Milestone::whereMonth('created_at', $currentMonth)->sum('price');
        // return $monthlyMilestonePrices;
        //Projects
        $projects = Project::where('progress', '<', 100)->latest()->take(3)->get();

        // Calculate total sales revenue from completed projects for the current month
        $monthlySalesRevenue = Project::where('progress', 100)
            ->whereYear('projects.created_at', Carbon::now()->year)
            ->whereMonth('projects.created_at', Carbon::now()->month)
            ->join('tickets', 'projects.ticket_id', '=', 'tickets.id')
            ->sum('tickets.price');

        // Calculate total revenue from projects for the current year
        $yearlyTotalRevenue = Project::whereYear('projects.created_at', Carbon::now()->year)
            ->where('progress', 100) // Only consider projects with progress 100%
            ->join('tickets', 'projects.ticket_id', '=', 'tickets.id')
            ->sum('tickets.price');


        // Calculate total revenue from projects for the current week
        $weeklyTotalRevenue = Project::whereBetween('projects.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->join('tickets', 'projects.ticket_id', '=', 'tickets.id')
            ->sum('tickets.price');

        // Calculate total revenue for today
        $todayTotalRevenue = Project::whereDate('projects.created_at', Carbon::today())
            ->join('tickets', 'projects.ticket_id', '=', 'tickets.id')
            ->sum('tickets.price');

        // Calculate percentages
        $monthlyProjectsCount = Project::whereYear('projects.created_at', Carbon::now()->year)
            ->whereMonth('projects.created_at', Carbon::now()->month)
            ->count();

        $completedMonthlyProjectsCount = Project::where('progress', 100)
            ->whereYear('projects.created_at', Carbon::now()->year)
            ->whereMonth('projects.created_at', Carbon::now()->month)
            ->count();

        $totalYearlyProjectsCount = Project::whereYear('projects.created_at', Carbon::now()->year)
            ->count();

        $completedYearlyProjectsCount = Project::where('progress', 100)
            ->whereYear('projects.created_at', Carbon::now()->year)
            ->count();
        // Calculate percentages
        $monthlySalesRevenuePercentage = ($monthlyProjectsCount > 0) ? ($completedMonthlyProjectsCount / $monthlyProjectsCount) * 100 : 0;
        $yearlyTotalRevenuePercentage = ($totalYearlyProjectsCount > 0) ? ($completedYearlyProjectsCount / $totalYearlyProjectsCount) * 100 : 0;

        return view('admin.dashboard', compact(
            'projects',
            'userCount',
            'monthlyMilestonePrices',
            'yearlyReceivedMilestonePrice',
            'employeeCount',
            'monthlySalesRevenue',
            'yearlyTotalRevenue',
            'clients',
            'todayTotalRevenue',
            'monthlyProjectsCount',
            'monthlySalesRevenuePercentage',
            'yearlyTotalRevenuePercentage',
            'monthlyProjectsCount',
            'completedMonthlyProjectsCount',
            'totalYearlyProjectsCount',
            'completedYearlyProjectsCount'
        ));
    }

    public function getEmployee(Request $req)
    {
        $tempProducts = [];
        $products = null;
        if ($req->term != "") {
            $products = Employee::where('name', 'like', '%' . $req->term . '%')->get();
        }

        if ($products != null) {
            foreach ($products as $product) {
                $tempProducts[] = array('id' => $product->id, 'text' => $product->name);
                // $tempProducts[] = array();
            }
            return response()->json([
                'tags' => $tempProducts,
                'status' => true
            ]);
        }
    }
}
