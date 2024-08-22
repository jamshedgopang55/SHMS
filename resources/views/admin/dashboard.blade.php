@extends('admin.layout.app')
@section('content')
<style>
        .date{
        background-color: #928985;
    color: white;
    border-radius: 5px;
    padding: 3px 10px;
    }
</style>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <div class="top-block d-flex align-items-center justify-content-between">
                        <h5>Revenue</h5>
                        <span class="badge badge-warning">Annual</span>
                    </div>
                    <h3>PKR : <span class="counter">{{ $yearlyTotalRevenue }}</span></h3>
                    {{-- <h3>PKR : <span class="counter">{{ $yearlyTotalRevenue + $yearlyReceivedMilestonePrice }}</span></h3> --}}
                    <div class="d-flex align-items-center justify-content-between mt-1">
                        <p class="mb-0">{{ $completedYearlyProjectsCount }}/{{ $totalYearlyProjectsCount }}</p>
                        <span class="text-warning">{{ round($yearlyTotalRevenuePercentage,2) }}%</span>
                    </div>
                    <div class="iq-progress-bar bg-warning-light mt-2">
                        <span class="bg-warning iq-progress progress-1"
                            data-percent="{{ $yearlyTotalRevenuePercentage  }}"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <div class="top-block d-flex align-items-center justify-content-between">
                        <h5>Revenue</h5>
                        <span class="badge badge-primary">Monthly</span>
                    </div>
                    <h3>PKR : <span class="counter">{{ $monthlySalesRevenue   }}</span></h3>
                    {{-- <h3>PKR : <span class="counter">{{ $monthlySalesRevenue + $monthlyMilestonePrices }}</span></h3> --}}
                    <div class="d-flex align-items-center justify-content-between mt-1">
                        <p class="mb-0">{{ $completedMonthlyProjectsCount }}/{{ $monthlyProjectsCount }}</p>
                        <span class="text-primary">{{ $monthlyProjectsCount != 0 ? round(($completedMonthlyProjectsCount / $monthlyProjectsCount) * 100) : 0 }}%</span>

                    </div>
                    <div class="iq-progress-bar bg-primary-light mt-2">
                        <span class="bg-primary iq-progress progress-1"
                            data-percent="{{ $monthlyProjectsCount != 0 ? ($completedMonthlyProjectsCount / $monthlyProjectsCount) * 100 : 0 }}"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <div class="top-block d-flex align-items-center justify-content-between">
                        <h5>clients</h5>
                        <span class="badge badge-success">Total</span>
                    </div>
                    <h3><span class="counter">{{ $clients }}</span></h3>


                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <div class="top-block d-flex align-items-center justify-content-between">
                        <h5>Employee</h5>
                        <span class="badge badge-info">Total</span>
                    </div>
                    <h3><span class="counter">{{ $employeeCount }}</span></h3>

                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card-transparent card-block card-stretch card-height">
                <div class="card-body p-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Ongoing Projects</h4>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        @foreach ($projects as $project)
                            @php
                                $departmentName = $project->ticket->department->name;
                                $class = '';
                                switch ($departmentName) {
                                    case 'web':
                                        $class = 'success';
                                        break;
                                    case 'Android':
                                        $class = 'warning';
                                        break;
                                    default:
                                        $class = 'primary';
                                        break;
                                }
                            @endphp
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="row align-items-center">
                                                    <div class="col-md-3">
                                                        <div id="circle-progress-2{{ $project->id }}"
                                                            class="circle-progress-01 circle-progress circle-progress-{{$class}}"
                                                            data-min-value="0" data-max-value="100"
                                                            data-value="{{ $project->progress }}" data-type="percent">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="mt-3 mt-md-0">
                                                            <a href="{{ route('admin.project.edit', $project->id) }}" class="mb-1"> <h4 class="mb-1">{{ $project->name }}</h4></a>
                                                            
                                                            <p class="mb-0">{{ $project->ticket->department->name }}</p>
                                                            <p class="mb-0">
                                                                <span class="date">
                                                                 {{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }} / {{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}
                                                                </span>
                                                               <br>
                                                               Duration: {{ \Carbon\Carbon::parse($project->start_date)->diffInDays($project->end_date) }} days
                                                               <br>
                                                               @php
                                                               $daysLeft = \Carbon\Carbon::now()->diffInDays($project->end_date, false);
                                                               if ($daysLeft < 0) {
                                                                   $daysLeft = abs($daysLeft) . ' days overdue';
                                                                   $style = 'color: red;'; // Set font color to red and font weight to bold
                                                               } else if ($daysLeft == 1) {
                                                                   $daysLeft = 'LAST DAY'; // Display "LAST DAY" if it's the last day
                                                                   $style = 'color: red;font-weight: bold;'; // Set font weight to bold
                                                               } else {
                                                                   $daysLeft = $daysLeft . ' days left';
                                                                   $style = ''; // No additional style
                                                               }
                                                           @endphp
                                                           <span style="{{ $style }}">{{ $daysLeft }}</span>
                                                           
                                                           
                                                            </p>
                                                            <button style="text-transform: capitalize"  @if( $project->priority == 'high') 
                                                                class="btn btn-danger mt-2"
                                                                @elseif($project->priority == 'medium')
                                                                class="btn btn-warning mt-2"
                                                                @else 
                                                                class="btn btn-info mt-2"
                                                                @endif>{{$project->priority}}
                                                            </button>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                                @if ($project->assign_members != null)
                                                    @php
                                                        $assignedMemberIds = explode(',', $project->assign_members);
                                                        $assignedMembers = App\Models\Employee::whereIn(
                                                            'id',
                                                            $assignedMemberIds,
                                                        )->get();
                                                    @endphp
                                                    <div class="iq-media-group">
                                                        @foreach ($assignedMembers as $member)
                                                          <a href="{{ url('admin/Employee/edit', $member->id) }}" class="iq-media">
                                                                <img class="img-fluid avatar-40 rounded-circle"
                                                                    title="{{ $member->name }}"
                                                                    src="{{ asset($member->pic) }}" alt="profile pic">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p>No assigned members</p>
                                                @endif

                                            </div>
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    </div>
@endsection
