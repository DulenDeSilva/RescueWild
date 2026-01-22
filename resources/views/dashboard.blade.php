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
            <div class="container mx-auto py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Background Image Section -->
                    <div class="p-6 text-center">
                        <h2 class="text-xl font-semibold leading-tight">Welcome to Client Dashboard</h2>
                        <!-- User logged in info -->
                        <p class="mt-4">Hello <strong>{{ Auth::user()->name }}</strong>!</p>

                        <!-- Buttons to Toggle Views -->
                        <button id="addComplaintBtn" class="btn btn-primary mt-4">Add Complaint</button>
                        <button id="viewComplaintBtn" class="btn btn-primary mt-4">View Complaints</button>

                        <!-- Complaint Form Section -->
                        <div class="card mt-5" id="complaintForm" style="display: none;">
                            <div class="card-header">Add a Complaint</div>
                            <div class="card-body">
                                <form action="{{ route('complaint.add') }}" method="POST">
                                    @csrf
                                    <div class="input-field mb-3">
                                        <label for="location" class="form-label">Complaint Location</label>
                                        <input type="text" name="location" id="location" class="form-control" value="">
                                    </div>
                                    <div class="input-field mb-3">
                                        <label for="description" class="form-label">Complaint Description</label>
                                        <input type="text" name="description" id="description" class="form-control" value="">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>

                        <!-- Complaint List Section -->
                        <div id="complaintsList" style="display: none;">
                            @if(isset($complaints) && $complaints->count() > 0)
                                <div class="mt-5">
                                    <h3>Your Complaints:</h3>
                                    @foreach($complaints as $complaint)
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <p class="card-title"><strong>Complaint location:</strong> {{ $complaint->complaint_location }}</p>
                                                <p class="card-text"><strong>Complaint description:</strong> {{ $complaint->complaint_description }}</p>
                                                <p class="card-text">
                                                    <strong>Status:</strong>
                                                    <span style="color: {{ $complaint->complaint_status == 'pending' ? 'yellow' : ($complaint->complaint_status == 'rejected' ? 'red' : 'green') }};">
                                                        {{ ucfirst($complaint->complaint_status) }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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

                addComplaintBtn.addEventListener('click', function() {
                    complaintForm.style.display = 'block';  
                    complaintsList.style.display = 'none';  
                });

                viewComplaintBtn.addEventListener('click', function() {
                    complaintsList.style.display = 'block';  
                    complaintForm.style.display = 'none';    
                });
            </script>

        @elseif(Auth::user()->user_type == "rescuer")
            <div class="container mx-auto py-12" >
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                    <!-- Rescuer Dashboard -->
                    <div class="p-6 text-center">
                        <h2 class="text-xl font-semibold leading-tight">Welcome to Rescuer Dashboard</h2>
                        <p class="mt-4">Hello <strong>{{ Auth::user()->name }}</strong>!</p>

                        <!-- Buttons to Toggle Views -->
                        <button id="viewComplaintsBtn" class="btn btn-primary mt-4">View Complaints</button>
                        <button id="viewAnimalRecordsBtn" class="btn btn-primary mt-4">View Rescue Reports</button>
                        <button id="addAnimalRecordsBtn" class="btn btn-primary mt-4">Add New Report</button>


                        <!-- Display Pending Complaints -->
                        <div id="complaintsSection" style="display: none;"> 
                            <h3 class="mt-5">Pending Complaints:</h3>
                            @if(isset($complaints) && $complaints->count() > 0)
                            <div class="row d-flex  justify-content-center">

                                @foreach($complaints as $complaint)
                                        <div class="col-4">
                                        <div class="card mt-3"  style="width: 350px;">
                                        <div class="card-body">
                                            <p><strong>Complaint ID:</strong> {{ $complaint->id }}</p>
                                            <p><strong>Client ID:</strong> {{ $complaint->client_id }}</p>
                                            <p><strong>Location:</strong> {{ $complaint->complaint_location }}</p>
                                            <p><strong>Description:</strong> {{ $complaint->complaint_description }}</p>
                                            <p><strong>Status:</strong>
                                                <span class="badge bg-warning text-dark">{{ ucfirst($complaint->complaint_status) }}</span>
                                            </p>

                                            <!-- Buttons to Accept or Reject Complaint -->
                                            <form action="{{ route('rescuer.complaints.accept', $complaint->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" name="accept" class="btn btn-success">Accept</button>
                                            </form>
                                            <br>
                                            <form action="{{ route('rescuer.complaints.reject', $complaint->id) }}" method="POST">
                                                @csrf     
                                                <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                           </form>
                                        </div>
                                    </div>
                                        </div>
                                @endforeach
                                </div>

                            @else
                                <p>No pending complaints available.</p>
                            @endif
                        </div>

                        <!-- Animal Records Section -->
                        <div id="animalRecordsSection" style="display: none;"> 
                            <h3>Your Animal Records:</h3>
                            @if(isset($animalRecords) && $animalRecords->count() > 0)
                                @foreach($animalRecords as $record)
                                    <div class="card mt-3">
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

                         <!-- Form to add animal record -->
                            <div class="card mt-5" id="addAnimalRecordSection" style="display: none;">
                                <h3 class="card-header">Add New Animal Record</h3>
                                <div class="card-body">
                                    <form action="{{ route('rescuer.animal.records.add') }}" method="POST">
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
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>

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

                viewComplaintsBtn.addEventListener('click', function() {
                    complaintsSection.style.display = 'block';  
                    animalRecordsSection.style.display = 'none'; 
                    addAnimalRecordSection.style.display = 'none'; 
                });

                viewAnimalRecordsBtn.addEventListener('click', function() {
                    animalRecordsSection.style.display = 'block'; 
                    complaintsSection.style.display = 'none';     
                    addAnimalRecordSection.style.display = 'none'; 
                });

                addAnimalRecordsBtn.addEventListener('click', function() {
                    addAnimalRecordSection.style.display = 'block'; 
                    complaintsSection.style.display = 'none';       
                    animalRecordsSection.style.display = 'none';   
                });
          </script>

        @endif
</div>
        
</x-app-layout>
