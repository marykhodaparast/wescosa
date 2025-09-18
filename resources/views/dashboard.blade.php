<x-app-layout>
    {{-- Optional: Page title --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Main Content --}}
    <main class="p-4 content">

        <!-- Top Bar (User Info) -->
        <div class="row mb-4">
            <div class="col-10">
                <h4><b>Welcome {{auth()->user()->name}}</b></h4>
            </div>
            <div class="col-2">
                <div class="profile d-flex align-items-center">
                    <img src="{{ asset('user1.jpg') }}" alt="Profile Image" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                    <div class="profile-text">
                        <h6 class="mb-0">{{auth()->user()->name}}</h6>
                        <small style="white-space:nowrap !important;">Production Manager</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Cards -->
        <div class="row mb-4 analytics">
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <h4>Total Users</h4>
                    <p>1,234</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <h4>Active Sessions</h4>
                    <p>56</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <h4>New Reports</h4>
                    <p>12</p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- User Chart -->
            <div class="col-md-8">
                <div class="card p-3">
                    <canvas id="userChart"></canvas>
                </div>
            </div>

            <!-- Circular Progress -->
            <div class="col-md-4">
                <div class="card p-3 text-center" style="height: 360px;">
                    <h4>Expected progress</h4>
                    <svg width="200" height="200">
                        <circle class="bg" cx="100" cy="100" r="70" stroke="#eee" stroke-width="10" fill="none"></circle>
                        <circle class="progress" cx="100" cy="100" r="70" stroke="#4e73df" stroke-width="10" fill="none" stroke-dasharray="440" stroke-dashoffset="110"></circle>
                    </svg>
                    <div class="progress-text mt-2">75%</div>
                </div>
            </div>

            <!-- Chat Box -->
            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-header">Chat - Production Team</div>
                    <div class="card-body">
                        <div class="chat-box mb-3" style="height: 160px; overflow-y: scroll; border: 1px solid #ddd; padding: 10px;">
                            <div><strong style="color: #34495e;">John:</strong> Any updates on PO002?</div>
                            <div><strong style="color: #547e9b;">Sarah:</strong> It's still pending, waiting on materials.</div>
                            <div><strong style="color: cadetblue;">David:</strong> I'll check with the supplier.</div>
                            <div><strong style="color: #34495e;">John:</strong> Thanks, let me know ASAP.</div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type a message">
                            <button class="btn btn-primary" style="background-color: #3030b7 !important;">Send</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Production Growth Chart -->
            <div class="col-md-6">
                <div class="card mt-4 p-3">
                    <canvas id="productionGrowthChart"></canvas>
                </div>
            </div>
        </div>

    </main>
</x-app-layout>



