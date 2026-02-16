<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Overview') }}
            </h2>
            <span class="text-sm text-gray-500">{{ now()->format('F d, Y') }}</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                <form method="GET" action="{{ route('dashboard') }}">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-semibold text-gray-900">Filter Data</h3>
                        <button type="submit" class="hidden text-sm text-indigo-600 font-medium hover:text-indigo-500">Apply Filters</button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Class Filter -->
                        <div>
                            <label for="class_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                Class
                            </label>
                            <div class="relative">
                                <select name="class_id" id="class_id" onchange="this.form.submit()" 
                                    class="block w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-2.5 transition ease-in-out duration-150">
                                    <option value="">All Classes</option>
                                    @foreach($allClasses as $c)
                                        <option value="{{ $c->id }}" {{ $c->id == $classId ? 'selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Subject Filter -->
                        <div>
                            <label for="subject" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                Subject
                            </label>
                            <div class="relative">
                                <select name="subject" id="subject" onchange="this.form.submit()" 
                                    class="block w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-2.5 transition ease-in-out duration-150">
                                    <option value="">All Subjects</option>
                                    @foreach($allSubjects as $s)
                                        <option value="{{ $s->subject }}" {{ $s->subject == $subject ? 'selected' : '' }}>
                                            {{ $s->subject }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Term Filter -->
                        <div>
                            <label for="term" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                Term
                            </label>
                            <div class="relative">
                                <select name="term" id="term" onchange="this.form.submit()" 
                                    class="block w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-2.5 transition ease-in-out duration-150">
                                    <option value="">All Terms</option>
                                    @foreach($allTerms as $t)
                                        <option value="{{ $t->term }}" {{ $t->term == $term ? 'selected' : '' }}>
                                            {{ $t->term }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Dashboard Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                
                <!-- Left Column: Stats Card -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Total Students Card -->
                    <div class="bg-white overflow-hidden rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-indigo-50 rounded-md p-3">
                                    <!-- Users Icon -->
                                    <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Total Students
                                        </dt>
                                        <dd>
                                            <div class="text-3xl font-bold text-gray-900">
                                                {{ $totalStudents }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 py-3">
                            <div class="text-sm">
                                <a href="{{ route('students.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500 flex items-center gap-1 group">
                                    View all students
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Placeholder for future stats cards can go here -->
                </div>

                <!-- Right Column: Chart -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-full">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Analytics Overview</h3>
                        <div class="relative w-full h-64 sm:h-72 lg:h-80">
                            <canvas id="studentsByClassChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Data Table Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Students Distribution by Class</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Class Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Student Count
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($perClass as $c)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $c->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        {{ $c->student_count }} students
                                    </span>
                                </td>
            
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="h-10 w-10 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        No data available for the selected filters.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = {!! json_encode($classLabels) !!};
        const data = {!! json_encode($classCounts) !!};

        const ctx = document.getElementById('studentsByClassChart').getContext('2d');
        
        // Slightly customized chart config for better visuals
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Students',
                    data: data,
                    backgroundColor: 'rgba(79, 70, 229, 0.8)', // Indigo-600
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                       
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false 
                    }
                }
            }
        });
    </script>
</x-app-layout>