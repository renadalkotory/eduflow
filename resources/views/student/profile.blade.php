@extends('layouts.student')

@section('title', 'My Profile')

@section('content')

<div class="container py-4">

    <!-- Page Header -->
    <div class="mb-4">
        <h2 class="fw-bold">My Profile</h2>
        <p class="text-muted">
            View and manage your personal information.
        </p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif


    <div class="row g-4">

        <!-- Profile Card -->
        <div class="col-lg-4">

            <div class="card shadow-sm border-0 text-center">

                <div class="card-body p-4">

                    <!-- Avatar -->
                    <div
                        class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width: 110px; height: 110px; font-size: 42px;">

                        {{ strtoupper(substr($student->full_name, 0, 1)) }}

                    </div>

                    <h4 class="fw-bold mb-1">
                        {{ $student->full_name }}
                    </h4>

                    <p class="text-muted mb-3">
                        {{ $student->email }}
                    </p>

                    <span class="badge bg-primary px-3 py-2">
                        {{ ucfirst($student->role) }}
                    </span>

                </div>
            </div>

        </div>


        <!-- Personal Information -->
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Personal Information
                    </h4>


                    <!-- Full Name -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Full Name
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $student->full_name }}"
                            readonly>

                    </div>


                    <!-- Email -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Email Address
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            value="{{ $student->email }}"
                            readonly>

                    </div>


                    <!-- Role -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Account Type
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ ucfirst($student->role) }}"
                            readonly>

                    </div>


                    <!-- Student ID -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Student ID
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $student->user_id }}"
                            readonly>

                    </div>


                    <!-- Phone Form -->
                    <form
                        action="{{ route('student.profile.update') }}"
                        method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-8 mb-4">

                                <label class="form-label fw-semibold">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    value="{{ $student->phone ?? '' }}"
                                    readonly>

                            </div>


                            <div class="col-md-4 mb-3">

                                <!-- Edit Button -->
                                <button
                                    type="button"
                                    id="editBtn"
                                    class="btn btn-primary mt-4"
                                    onclick="editProfile()">

                                    Edit

                                </button>


                                <!-- Save Button -->
                                <button
                                    type="submit"
                                    id="saveBtn"
                                    class="btn btn-success mt-4"
                                    style="display: none;">

                                    Save

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- Account Information -->

    <div class="card shadow-sm border-0 mt-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">
                Account Information
            </h4>

            <div class="row">

                <!-- Account Role -->
                <div class="col-md-6 mb-3">

                    <div class="p-3 bg-light rounded">

                        <small class="text-muted">
                            Account Role
                        </small>

                        <h6 class="fw-bold mt-1 mb-0">
                            {{ ucfirst($student->role) }}
                        </h6>

                    </div>

                </div>


                <!-- Member Since -->
                <div class="col-md-6 mb-3">

                    <div class="p-3 bg-light rounded">

                        <small class="text-muted">
                            Member Since
                        </small>

                        <h6 class="fw-bold mt-1 mb-0">

                            {{ $student->created_at
                                ? \Carbon\Carbon::parse($student->created_at)->format('M d, Y')
                                : 'N/A'
                            }}

                        </h6>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- JavaScript -->

<script>

function editProfile() {

    // Enable phone input
    document.getElementById('phone').readOnly = false;

    // Focus on phone input
    document.getElementById('phone').focus();

    // Hide Edit button
    document.getElementById('editBtn').style.display = 'none';

    // Show Save button
    document.getElementById('saveBtn').style.display = 'inline-block';
}

</script>

@endsection