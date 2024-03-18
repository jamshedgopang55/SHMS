@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <div class="top-block d-flex align-items-center justify-content-between">
                        <h5>Revenue</h5>
                        <span class="badge badge-warning">Annual</span>
                    </div>
                    <h3>$<span class="counter">{{ $yearlyTotalRevenue }}</span></h3>
                    <div class="d-flex align-items-center justify-content-between mt-1">
                        <p class="mb-0">{{ $completedYearlyProjectsCount }}/{{ $totalYearlyProjectsCount }}</p>
                        <span class="text-warning">{{ $yearlyTotalRevenuePercentage }}%</span>
                    </div>
                    <div class="iq-progress-bar bg-warning-light mt-2">
                        <span class="bg-warning iq-progress progress-1"
                            data-percent="{{ $yearlyTotalRevenuePercentage }}"></span>
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
                    <h3>$<span class="counter">{{ $monthlySalesRevenue }}</span></h3>
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
                        {{-- <div class="card-body">
                            <ul class="list-inline p-0 mb-0">
                                <li class="mb-1">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">UX / UI Design</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="iq-progress-bar bg-secondary-light">
                                                    <span class="bg-secondary iq-progress progress-1"
                                                        data-percent="65"></span>
                                                </div>
                                                <span class="ml-3">65%</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="iq-media-group text-sm-right">
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/05.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/06.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/07.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-1">
                                    <div class="d-flex align-items-center justify-content-between row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Development</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="iq-progress-bar bg-primary-light">
                                                    <span class="bg-primary iq-progress progress-1"
                                                        data-percent="59"></span>
                                                </div>
                                                <span class="ml-3">59%</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="iq-media-group text-sm-right">
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/08.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/09.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/04.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center justify-content-between row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Testing</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="iq-progress-bar bg-warning-light">
                                                    <span class="bg-warning iq-progress progress-1"
                                                        data-percent="78"></span>
                                                </div>
                                                <span class="ml-3">78%</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="iq-media-group text-sm-right">
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/01.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/02.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/03.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> --}}
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
                                                             
                                                               {{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }} / {{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}
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
                                            <a class="btn btn-white text-primary link-shadow mt-2">{{$project->priority}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    

                    {{-- <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <div id="circle-progress-22"
                                                        class="circle-progress-01 circle-progress circle-progress-secondary"
                                                        data-min-value="0" data-max-value="100" data-value="30"
                                                        data-type="percent"></div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="mt-3 mt-md-0">
                                                        <h5 class="mb-1">Automotive WordPress</h5>
                                                        <p class="mb-0">Dealership-based business WordPress
                                                            theme.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <div class="iq-media-group">
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/07.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/02.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/04.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/08.jpg" alt="">
                                                </a>
                                            </div>
                                            <a class="btn btn-white text-secondary link-shadow mt-2">Medium</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <div id="circle-progress-23"
                                                        class="circle-progress-01 circle-progress circle-progress-warning"
                                                        data-min-value="0" data-max-value="100" data-value="15"
                                                        data-type="percent"></div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="mt-3 mt-md-0">
                                                        <h5 class="mb-1">Online Education</h5>
                                                        <p class="mb-0">Remote students and teachers
                                                            dashboard.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <div class="iq-media-group">
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/01.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/02.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/03.jpg" alt="">
                                                </a>
                                            </div>
                                            <a class="btn btn-white text-warning link-shadow mt-2">Low</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <div id="circle-progress-24"
                                                        class="circle-progress-01 circle-progress circle-progress-success"
                                                        data-min-value="0" data-max-value="100" data-value="40"
                                                        data-type="percent"></div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="mt-3 mt-md-0">
                                                        <h5 class="mb-1">Blog/Magazine Theme</h5>
                                                        <p class="mb-0">Launch visually appealing Blog
                                                            theme.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <div class="iq-media-group">
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/05.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/06.jpg" alt="">
                                                </a>
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/07.jpg" alt="">
                                                </a>
                                            </div>
                                            <a class="btn btn-white text-success  link-shadow mt-2">High</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>

  
    </div>
@endsection















{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    welcome to Dashboard
    <br>
<a href="{{route('admin.department.index')}}">department</a>
    <br>
<a href="{{route('admin.subdepartment.index')}}">subdepartment</a>
    <br>
<a href="{{route('admin.role.index')}}">roles</a>
    <br>
<a href="{{route('admin.position.index')}}">position</a>
    <br>
<a href="{{route('admin.Employee.index')}}">Employee</a>
    <br>
    <br>
<a href="{{route('admin.user.index')}}">user</a>
<br>
<a href="{{route('admin.ticket.index')}}">ticket</a>
<br>
<br>
<br>

<a href="{{route('admin.ticket.accepted')}}">Accepted Ticket</a>
<br>
<a href="{{route('admin.ticket.rejected')}}">Accepted Rejected</a>
<br>
<a href="{{route('user.logout')}}">Logout</a>
<br>
<a href="{{route('admin.project.index')}}">View Projects</a>
<br>


</body>
</html> --}}
