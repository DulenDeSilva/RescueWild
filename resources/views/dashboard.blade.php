<x-app-layout>
    <x-slot name="header">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboardstyles.css') }}">
        <link rel="shortcut icon" href="letter-r (1).png" type="image/x-icon">
        <title>Rescuewild.lk</title>
    </x-slot>

<div class="bg-image">
        @if(Auth::user()->user_type == "client")
            @php
                $complaintsCollection = collect($complaints ?? []);
                $totalComplaints = $complaintsCollection->count();
                $pendingComplaints = $complaintsCollection->where('complaint_status', 'pending')->count();
                $acceptedComplaints = $complaintsCollection->where('complaint_status', 'accepted')->count();
                $rejectedComplaints = $complaintsCollection->where('complaint_status', 'rejected')->count();
            @endphp
            <div class="dashboard-shell">
                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="dashboard-header">
                    <div>
                        <p class="dashboard-eyebrow">Client Dashboard</p>
                        <h2 class="dashboard-title">Welcome back, {{ Auth::user()->name }}</h2>
                        <p class="dashboard-subtitle">Add new complaints, review updates, and track progress.</p>
                    </div>
                    <div class="dashboard-actions">
                        <button id="addComplaintBtn" class="btn dashboard-action-btn is-active">Add Complaint</button>
                        <button id="viewComplaintBtn" class="btn btn-outline dashboard-action-btn">View Complaints</button>
                    </div>
                </div>

                <div class="dashboard-stats">
                    <div class="stat-card">
                        <p class="stat-label">Total Complaints</p>
                        <p class="stat-value">{{ $totalComplaints }}</p>
                    </div>
                    <div class="stat-card">
                        <p class="stat-label">Pending</p>
                        <p class="stat-value">{{ $pendingComplaints }}</p>
                    </div>
                    <div class="stat-card">
                        <p class="stat-label">Accepted</p>
                        <p class="stat-value">{{ $acceptedComplaints }}</p>
                    </div>
                    <div class="stat-card">
                        <p class="stat-label">Rejected</p>
                        <p class="stat-value">{{ $rejectedComplaints }}</p>
                    </div>
                </div>

                <div class="dashboard-panels">
                    <div class="panel" id="complaintForm">
                        <div class="panel-header">
                            <h3 class="panel-title">Add a Complaint</h3>
                            <p class="panel-subtitle">Provide location details so we can dispatch a rescuer quickly.</p>
                        </div>
                        <form action="{{ route('complaint.add') }}" method="POST" class="panel-body">
                            @csrf
                            <div class="input-field mb-3">
                                <label for="location" class="form-label">Complaint Location</label>
                                <input type="text" name="location" id="location" class="form-control" placeholder="Street, city, landmark">
                            </div>
                            <div class="input-field mb-3">
                                <label for="description" class="form-label">Complaint Description</label>
                                <input type="text" name="description" id="description" class="form-control" placeholder="Describe the situation">
                            </div>
                            <button type="submit" class="btn">Submit Complaint</button>
                        </form>
                    </div>

                    <div class="panel" id="complaintsList" style="display: none;">
                        <div class="panel-header">
                            <h3 class="panel-title">Your Complaints</h3>
                            <p class="panel-subtitle">Track status updates as rescuers respond.</p>
                        </div>
                        <div class="panel-body">
                            @if(isset($complaints) && $complaints->count() > 0)
                                @foreach($complaints as $complaint)
                                    @php
                                        $statusClass = $complaint->complaint_status == 'pending'
                                            ? 'status-pending'
                                            : ($complaint->complaint_status == 'rejected' ? 'status-rejected' : 'status-accepted');
                                    @endphp
                                    <div class="card list-card mt-3">
                                        <div class="card-body">
                                            <p class="card-title"><strong>Location:</strong> {{ $complaint->complaint_location }}</p>
                                            <p class="card-text"><strong>Details:</strong> {{ $complaint->complaint_description }}</p>
                                            <p class="card-text">
                                                <strong>Status:</strong>
                                                <span class="status-pill {{ $statusClass }}">{{ ucfirst($complaint->complaint_status) }}</span>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No complaints to display.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Get the elements
                const addComplaintBtn = document.getElementById('addComplaintBtn');
                const viewComplaintBtn = document.getElementById('viewComplaintBtn');
                const complaintForm = document.getElementById('complaintForm');
                const complaintsList = document.getElementById('complaintsList');
                const clientButtons = [addComplaintBtn, viewComplaintBtn];

                addComplaintBtn.addEventListener('click', function() {
                    complaintForm.style.display = 'block';
                    complaintsList.style.display = 'none';
                    clientButtons.forEach((btn) => btn.classList.remove('is-active'));
                    addComplaintBtn.classList.add('is-active');
                });

                viewComplaintBtn.addEventListener('click', function() {
                    complaintsList.style.display = 'block';
                    complaintForm.style.display = 'none';
                    clientButtons.forEach((btn) => btn.classList.remove('is-active'));
                    viewComplaintBtn.classList.add('is-active');
                });
            </script>

        @elseif(Auth::user()->user_type == "rescuer")
            @php
                $pendingCount = collect($complaints ?? [])->count();
                $recordCount = collect($animalRecords ?? [])->count();
                $coverageArea = data_get(Auth::user(), 'rescuer_location') ?: 'Not set';
            @endphp
            <div class="dashboard-shell">
                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="dashboard-header">
                    <div>
                        <p class="dashboard-eyebrow">Rescuer Dashboard</p>
                        <h2 class="dashboard-title">Ready for the next rescue, {{ Auth::user()->name }}</h2>
                        <p class="dashboard-subtitle">Review complaints, log rescue reports, and coordinate coverage.</p>
                    </div>
                    <div class="dashboard-actions">
                        <button id="viewComplaintsBtn" class="btn dashboard-action-btn is-active">View Complaints</button>
                        <button id="viewAnimalRecordsBtn" class="btn btn-outline dashboard-action-btn">Rescue Reports</button>
                        <button id="addAnimalRecordsBtn" class="btn btn-outline dashboard-action-btn">Add New Report</button>
                    </div>
                </div>

                <div class="dashboard-stats">
                    <div class="stat-card">
                        <p class="stat-label">Pending Complaints</p>
                        <p class="stat-value">{{ $pendingCount }}</p>
                    </div>
                    <div class="stat-card">
                        <p class="stat-label">Rescue Reports</p>
                        <p class="stat-value">{{ $recordCount }}</p>
                    </div>
                    <div class="stat-card">
                        <p class="stat-label">Coverage Area</p>
                        <p class="stat-value stat-text">{{ $coverageArea }}</p>
                    </div>
                </div>

                <div class="dashboard-panels">
                    <div class="panel" id="complaintsSection">
                        <div class="panel-header">
                            <h3 class="panel-title">Pending Complaints</h3>
                            <p class="panel-subtitle">Review details and respond quickly.</p>
                        </div>
                        <div class="panel-body">
                            @if(isset($complaints) && $complaints->count() > 0)
                                <div class="row complaint-grid">
                                    @foreach($complaints as $complaint)
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="card list-card mt-3">
                                                <div class="card-body">
                                                    <p><strong>Complaint ID:</strong> {{ $complaint->id }}</p>
                                                    <p><strong>Client ID:</strong> {{ $complaint->client_id }}</p>
                                                    <p><strong>Location:</strong> {{ $complaint->complaint_location }}</p>
                                                    <p><strong>Description:</strong> {{ $complaint->complaint_description }}</p>
                                                    <p><strong>Status:</strong>
                                                        <span class="badge bg-warning text-dark">{{ ucfirst($complaint->complaint_status) }}</span>
                                                    </p>

                                                    <div class="d-flex gap-2 flex-wrap">
                                                        <form action="{{ route('rescuer.complaints.accept', $complaint->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" name="accept" class="btn btn-success">Accept</button>
                                                        </form>
                                                        <form action="{{ route('rescuer.complaints.reject', $complaint->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No pending complaints available.</p>
                            @endif
                        </div>
                    </div>

                    <div class="panel" id="animalRecordsSection" style="display: none;">
                        <div class="panel-header">
                            <h3 class="panel-title">Rescue Reports</h3>
                            <p class="panel-subtitle">Review the animals you've helped.</p>
                        </div>
                        <div class="panel-body">
                            @if(isset($animalRecords) && $animalRecords->count() > 0)
                                @foreach($animalRecords as $record)
                                    <div class="card list-card mt-3">
                                        <div class="card-body">
                                            <p class="card-title"><strong>Animal ID:</strong> {{ $record->id }}</p>
                                            <p class="card-text"><strong>Species:</strong> {{ $record->species }}</p>
                                            <p class="card-text"><strong>Breed:</strong> {{ $record->breed }}</p>
                                            <p class="card-text"><strong>Age:</strong> {{ $record->age }}</p>
                                            <p class="card-text"><strong>Health Status:</strong> {{ $record->health_status }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No animal records to display.</p>
                            @endif
                        </div>
                    </div>

                    <div class="panel" id="addAnimalRecordSection" style="display: none;">
                        <div class="panel-header">
                            <h3 class="panel-title">Add New Animal Record</h3>
                            <p class="panel-subtitle">Log rescue details for future follow-ups.</p>
                        </div>
                        <form action="{{ route('rescuer.animal.records.add') }}" method="POST" class="panel-body">
                            @csrf
                            <div class="input-field mb-3">
                                <label for="rescuer_name" class="form-label">Your Name</label>
                                <input type="text" name="rescuer_name" id="rescuer_name" class="form-control" required>
                            </div>
                            <div class="input-field mb-3">
                                <label for="animal_species" class="form-label">Animal Species</label>
                                <input type="text" name="animal_species" id="animal_species" class="form-control" required>
                            </div>
                            <div class="input-field mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <div class="input-field mb-3">
                                <label for="medical_condition" class="form-label">Medical Condition</label>
                                <input type="text" name="medical_condition" id="medical_condition" class="form-control" required>
                            </div>
                            <button type="submit" class="btn">Submit Report</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Get the elements
                const viewComplaintsBtn = document.getElementById('viewComplaintsBtn');
                const viewAnimalRecordsBtn = document.getElementById('viewAnimalRecordsBtn');
                const addAnimalRecordsBtn = document.getElementById('addAnimalRecordsBtn');
                const complaintsSection = document.getElementById('complaintsSection');
                const animalRecordsSection = document.getElementById('animalRecordsSection');
                const addAnimalRecordSection = document.getElementById('addAnimalRecordSection');
                const rescuerButtons = [viewComplaintsBtn, viewAnimalRecordsBtn, addAnimalRecordsBtn];

                viewComplaintsBtn.addEventListener('click', function() {
                    complaintsSection.style.display = 'block';
                    animalRecordsSection.style.display = 'none';
                    addAnimalRecordSection.style.display = 'none';
                    rescuerButtons.forEach((btn) => btn.classList.remove('is-active'));
                    viewComplaintsBtn.classList.add('is-active');
                });

                viewAnimalRecordsBtn.addEventListener('click', function() {
                    animalRecordsSection.style.display = 'block';
                    complaintsSection.style.display = 'none';
                    addAnimalRecordSection.style.display = 'none';
                    rescuerButtons.forEach((btn) => btn.classList.remove('is-active'));
                    viewAnimalRecordsBtn.classList.add('is-active');
                });

                addAnimalRecordsBtn.addEventListener('click', function() {
                    addAnimalRecordSection.style.display = 'block';
                    complaintsSection.style.display = 'none';
                    animalRecordsSection.style.display = 'none';
                    rescuerButtons.forEach((btn) => btn.classList.remove('is-active'));
                    addAnimalRecordsBtn.classList.add('is-active');
                });
          </script>

        @endif
</div>
        
</x-app-layout>
