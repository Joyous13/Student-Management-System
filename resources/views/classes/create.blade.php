<x-app-layout>
    <!-- Page Header -->
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Add New Class') }}
        </h2>
    </x-slot>

    <!-- Main Content Wrapper -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Card Container -->
            <div class="bg-white overflow-hidden shadow-lg shadow-gray-200/50 sm:rounded-xl border border-gray-100">
                
                <!-- Card Header/Description (Optional Visual Enhancement) -->
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Class Details</h3>
                    <p class="mt-1 text-sm text-gray-500">Please enter the information for the new class below.</p>
                </div>

                <!-- Form Content -->
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('classes.store') }}" class="space-y-6">
                        @csrf

                        <!-- Class Name Input -->
                        <div>
                            <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">
                                Class Name
                            </label>
                            <div class="relative mt-2">
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    required 
                                    placeholder="e.g. Introduction to Computer Science"
                                    class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200 ease-in-out hover:ring-gray-400"
                                >
                            </div>
                            <!-- Error Message Placeholder (if you have validation) -->
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-x-4 border-t border-gray-100 pt-6 mt-6">
                            <!-- Cancel Button (Optional UX Improvement - acts as Back) -->
                            <button type="button" onclick="history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 transition-colors">
                                Cancel
                            </button>

                            <!-- Save Button -->
                            <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all transform active:scale-[0.98]">
                                Save Class
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>