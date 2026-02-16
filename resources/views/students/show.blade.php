<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ $student->name }}
            </h2>
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card 1: Edit Student Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl ring-1 ring-gray-900/5">
                <div class="p-6 sm:p-8">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Edit Student Details</h3>
                        <p class="text-sm text-gray-500">Update personal information and photo.</p>
                    </div>

                    <form method="POST" action="{{ route('students.update', $student) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Left Column: Photo -->
                            <div class="col-span-1 flex flex-col items-center text-center">
                                <div class="relative w-48 h-48 mb-4 overflow-hidden rounded-full border-4 border-white shadow-lg bg-gray-100 flex items-center justify-center group">
                                    @if($student->photo_path)
                                        <img src="{{ Storage::url($student->photo_path) }}" class="w-full h-full object-cover" alt="Student Photo">
                                    @else
                                        <svg class="h-20 w-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    @endif
                                </div>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Change Photo</label>
                                <input type="file" name="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                            </div>

                            <!-- Right Column: Inputs -->
                            <div class="col-span-1 md:col-span-2 space-y-5">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 mb-1">Name</label>
                                        <input type="text" name="name" value="{{ old('name', $student->name) }}" required
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 mb-1">Age</label>
                                        <input type="number" name="age" value="{{ old('age', $student->age) }}"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    
                                    <div class="sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1">Class</label>
                                        <select name="class_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">-- Select Class --</option>
                                            @foreach(\App\Models\ClassModel::all() as $class)
                                                <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 mb-1">Parent Name</label>
                                        <input type="text" name="parent_name" value="{{ old('parent_name', $student->parent_name) }}"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 mb-1">Parent Phone</label>
                                        <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1">Parent Email</label>
                                        <input type="email" name="parent_email" value="{{ old('parent_email', $student->parent_email) }}"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                                
                                <div class="pt-4 flex justify-end">
                                    <button class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Update Student
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card 2: Files -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl ring-1 ring-gray-900/5">
                <div class="p-6 sm:p-8">
                    <div class="mb-6 border-b border-gray-100 pb-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Documents</h3>
                            <p class="text-sm text-gray-500">Manage attached files and certificates.</p>
                        </div>
                    </div>

                    @if(count($student->files))
                        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-8">
                            @foreach($student->files as $file)
                                @php
                                    $url = Storage::url($file->path);
                                    $isImage = str_starts_with($file->mime, 'image/');
                                @endphp
                                <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow border border-gray-200 hover:border-indigo-300 transition-colors">
                                    <div class="flex w-full items-center justify-between space-x-6 p-4">
                                        <div class="flex-1 truncate">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    @if($isImage)
                                                        <img class="h-10 w-10 rounded-full bg-gray-300 object-cover" src="{{ $url }}" alt="">
                                                    @else
                                                        <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v15a2 2 0 002 2z"></path></svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <h3 class="truncate text-sm font-medium text-gray-900" title="{{ $file->original_name }}">{{ $file->original_name }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="-mt-px flex divide-x divide-gray-200">
                                        <div class="flex w-0 flex-1">
                                            <a href="{{ route('students.files.download', $file) }}" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center rounded-bl-lg border border-transparent py-4 text-sm font-medium text-gray-700 hover:text-indigo-600">
                                                <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                                Download
                                            </a>
                                        </div>
                                        <div class="flex w-0 flex-1">
                                            <form method="POST" action="{{ route('students.files.destroy', $file) }}" class="flex-1 h-full">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="relative inline-flex w-full h-full items-center justify-center rounded-br-lg border border-transparent py-4 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50">
                                                    <svg class="h-5 w-5 text-red-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else 
                        <div class="text-sm text-gray-500 italic mb-6 bg-gray-50 p-4 rounded-lg">No files uploaded yet.</div>
                    @endif

                    <form method="POST" action="{{ route('students.files.store', $student) }}" enctype="multipart/form-data" class="bg-gray-50 rounded-lg p-4 border border-dashed border-gray-300">
                        @csrf
                        <div class="flex items-end gap-4">
                            <div class="flex-grow">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Upload new documents</label>
                                <input type="file" name="files[]" multiple 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300">
                            </div>
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 h-9">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card 3: Exams -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl ring-1 ring-gray-900/5">
                <div class="p-6 sm:p-8">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Exam Records</h3>
                        <p class="text-sm text-gray-500">View and add academic performance records.</p>
                    </div>

                    <div class="overflow-x-auto border rounded-lg mb-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Term</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marks</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($student->exams as $exam)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $exam->term }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $exam->subject }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $exam->marks }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="{{ route('exams.destroy', $exam) }}" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button class="text-red-600 hover:text-red-900 transition">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No exam records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-5 border border-gray-100">
                        <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-4">Add New Exam Entry</h4>
                        <form method="POST" action="{{ route('students.exams.store', $student) }}">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Term Name</label>
                                <input name="term" placeholder="e.g. First Semester 2024" required 
                                       class="w-full sm:w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            
                            <div id="subjects-container" class="space-y-3">
                                <div class="subject-row grid grid-cols-1 md:grid-cols-3 gap-4 p-3 bg-white rounded border border-gray-200 shadow-sm">
                                    <div class="col-span-1">
                                        <input name="subjects[0][subject]" placeholder="Subject" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </div>
                                    <div class="col-span-1">
                                        <input name="subjects[0][marks]" placeholder="Marks" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </div>
                                    <div class="col-span-1">
                                        <input name="subjects[0][remarks]" placeholder="Remarks" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 flex gap-3">
                                <button type="button" onclick="addSubjectRow()" 
                                        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Add Another Subject
                                </button>
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save Exam Records
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        let subjectIndex = 1;
        function addSubjectRow(){
            const container = document.getElementById('subjects-container');
            const div = document.createElement('div');
            // Updated class names to match Tailwind grid
            div.className = 'subject-row grid grid-cols-1 md:grid-cols-3 gap-4 p-3 bg-white rounded border border-gray-200 shadow-sm';
            div.innerHTML = `
                <div class="col-span-1">
                    <input name="subjects[${subjectIndex}][subject]" placeholder="Subject" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>
                <div class="col-span-1">
                    <input name="subjects[${subjectIndex}][marks]" placeholder="Marks" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>
                <div class="col-span-1">
                    <input name="subjects[${subjectIndex}][remarks]" placeholder="Remarks" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>
            `;
            container.appendChild(div);
            subjectIndex++;
        }
    </script>
</x-app-layout>