@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Recruitment Reports</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Summary Table -->
        <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Applicants per Department</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Applicants</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($applicationsByDept as $dept)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dept->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $dept->applications_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Status Summary Chart -->
        <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Status Summary</h3>
            <canvas id="statusChart"></canvas>
             <div class="mt-4 flex flex-col gap-2 text-sm">
                 @foreach($statusSummary as $status)
                     <div class="flex items-center justify-between">
                         <span>Status {{ $status->status }}:</span>
                         <span>{{ $status->total }}</span>
                     </div>
                 @endforeach
             </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    
    // Data from Blade
    const statusData = @json($statusSummary);
    
    const labels = statusData.map(item => {
        if(item.status === 'P') return 'Pending';
        if(item.status === 'A') return 'Approved';
        if(item.status === 'R') return 'Rejected';
        return item.status;
    });
    
    const data = statusData.map(item => item.total);
    const backgroundColors = statusData.map(item => {
        if(item.status === 'P') return '#FCD34D'; // Yellow
        if(item.status === 'A') return '#10B981'; // Green
        if(item.status === 'R') return '#EF4444'; // Red
        return '#6B7280';
    });

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: '# of Applications',
                data: data,
                backgroundColor: backgroundColors,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    display: false
                }
            }
        }
    });
</script>
@endsection
