@extends('layouts.app')
@section('content')
<style>
    .admin-welcome-card {
        background: linear-gradient(135deg, #ffffff 0%, #eef6fb 100%);
        border: 1px solid rgba(11, 79, 116, 0.08);
        border-radius: 24px;
        padding: 36px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
    }

    .admin-welcome-logo {
        width: 88px;
        height: 88px;
        object-fit: contain;
        border-radius: 20px;
        background: #ffffff;
        padding: 10px;
        box-shadow: 0 12px 30px rgba(11, 79, 116, 0.12);
    }

    .admin-welcome-title {
        margin: 0;
        color: #0b4f74;
        font-size: 2rem;
        font-weight: 800;
        line-height: 1.25;
    }

	    .admin-welcome-subtitle {
	        margin: 12px 0 0;
	        color: #456274;
	        font-size: 1.35rem;
	        font-weight: 700;
	        line-height: 1.7;
	    }

	    .pagination-wrap {
	        display: flex;
	        justify-content: center;
	        margin-top: 20px;
	    }
	</style>

<div class="container mt-4">
    <div class="admin-welcome-card">
        <div class="d-flex align-items-center gap-4 flex-wrap">
            <img src="{{ asset('img/logo (2).png') }}" alt="IMI Academy Logo" class="admin-welcome-logo">
            <div>
                <h2 class="admin-welcome-title">Pojo Course Pilot</h2>
                <p class="admin-welcome-subtitle">Welcome to admin dashboard</p>
            </div>
        </div>
    </div>

<div class="container mt-4">
    {{-- @php
        $loggedInUser = $sessionUser ?? $authUser;
    @endphp

    @if($loggedInUser)
        <div class="card p-3" style="border: 1px solid #ced4da; border-radius: 12px;">
            <h4 class="mb-3">Logged-in User</h4>
            <ul class="list-unstyled mb-0">
                @if(!empty($loggedInUser->name))
                    <li><strong>Name:</strong> {{ $loggedInUser->name }}</li>
                @endif
                @if(!empty($loggedInUser->email))
                    <li><strong>Email:</strong> {{ $loggedInUser->email }}</li>
                @endif
                @if(!empty($loggedInUser->mobile_no))
                    <li><strong>Mobile:</strong> {{ $loggedInUser->mobile_no }}</li>
                @endif
                @if($sessionUser && !empty($sessionUser->password))
                    <li><strong>Account Type:</strong> Admin/Staff</li>
                @elseif($authUser)
                    <li><strong>Account Type:</strong> Customer</li>
                @else
                    <li><strong>Account Type:</strong> Unknown</li>
                @endif
            </ul>
        </div>
    @else
        <div class="alert alert-warning">No logged-in user found. Please login first.</div>
    @endif --}}

    @if(isset($customerLogins) && $customerLogins->count())
        <div class="card p-3 mt-4" style="border: 1px solid #ced4da; border-radius: 12px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Login History</h4>
                <a href="{{ route('dashboard.login_export') }}" class="btn btn-primary btn-sm text-white" style="background-color: #0b4f74; border-color: #0b4f74;">Export </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $userNames = \App\Models\User::pluck('name', 'mobile_no')->toArray();
                        @endphp
                        @foreach($customerLogins as $i => $login)
                            <tr>
                                <td>{{ $customerLogins->firstItem() + $i }}</td>
                                <td>{{ $login->name }}</td>
                                <td>{{ $login->email }}</td>
                                <td>{{ $login->mobile_no }}</td>
                                <td>{{ optional($login->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i') }}</td>
                                <td>{{ optional($login->updated_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrap">
                {{ $customerLogins->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-info mt-4">No login history records found yet.</div>
    @endif

@endsection
