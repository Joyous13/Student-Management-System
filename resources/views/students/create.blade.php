<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Add New Student') }}
            </h2>
            <a href="{{ route('students.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Card Container -->
            <div class="bg-white shadow-xl shadow-gray-200/50 sm:rounded-xl border border-gray-100 overflow-hidden">
                
                <!-- Form Header -->
                <div class="bg-gray-50/50 px-6 py-5 border-b border-gray-100">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Student Information</h3>
                    <p class="mt-1 text-sm text-gray-500">Fill in the details below to register a new student.</p>
                </div>

                <!-- Form Body -->
                <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data" class="px-6 py-6 sm:p-8">
                    @csrf

                    <!-- SECTION 1: Student Details -->
                    <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6 mb-8">
                        
                        <!-- Name -->
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" required placeholder="e.g. Jane Doe"
                                    class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Age -->
                        <div class="sm:col-span-2">
                            <label for="age" class="block text-sm font-medium leading-6 text-gray-900">Age</label>
                            <div class="mt-2">
                                <input type="number" name="age" id="age" min="1" max="100" placeholder="10"
                                    class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                        </div>

                        <!-- Class Selection -->
                        <div class="sm:col-span-3">
                            <label for="class_id" class="block text-sm font-medium leading-6 text-gray-900">Assigned Class</label>
                            <div class="mt-2">
                                <select id="class_id" name="class_id" 
                                    class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="">Select a Class</option>
                                    @foreach($classes as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Photo Upload -->
                        <div class="sm:col-span-3">
                            <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Student Photo</label>
                            <div class="mt-2">
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent 
                                file:mr-4 file:py-2.5 file:px-4
                                file:rounded-l-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-600 file:text-white
                                hover:file:bg-indigo-700 transition-all" 
                                id="photo" name="photo" type="file">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">PNG, JPG up to 2MB.</p>
                        </div>
                    </div>

                    <div class="relative mb-8">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-start">
                            <span class="bg-white pr-3 text-base font-semibold leading-6 text-gray-900">Guardian Information</span>
                        </div>
                    </div>

                    <!-- SECTION 2: Parent Details -->
                    <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                        
                        <!-- Parent Name -->
                        <div class="sm:col-span-2">
                            <label for="parent_name" class="block text-sm font-medium leading-6 text-gray-900">Guardian Name</label>
                            <div class="mt-2">
                                <input type="text" name="parent_name" id="parent_name" placeholder="Parent or Guardian full name"
                                    class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                        </div>

                        <!-- Parent Phone -->
                        <div>
                            <label for="parent_phone" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                            <div class="mt-2 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input type="text" name="parent_phone" id="parent_phone" placeholder="+1 (555) 000-0000"
                                    class="block w-full rounded-lg border-0 py-2.5 pl-10 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                        </div>

                        <!-- Parent Email -->
                        <div>
                            <label for="parent_email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
                            <div class="mt-2 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input type="email" name="parent_email" id="parent_email" placeholder="guardian@example.com"
                                    class="block w-full rounded-lg border-0 py-2.5 pl-10 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                        <div>
                            <label for="parent_email" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                            <div class="mt-2 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input type="text" name="parent_address" id="parent_address" placeholder="Address Line"
                                    class="block w-full rounded-lg border-0 py-2.5 pl-10 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-8 flex items-center justify-end gap-x-4 border-t border-gray-100 pt-6">
                        <a href="{{ route('students.index') }}" class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">Cancel</a>
                        <button type="submit" 
                            class="rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all transform active:scale-[0.98]">
                            Create Student
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>