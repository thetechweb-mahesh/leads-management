


<aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
    <!-- Logo -->
    <!-- <div class="flex items-center justify-center py-4 border-b border-gray-700"> -->
        <!-- <img src="/logo.png" alt="Logo" class="h-10"> -->
    <!-- </div> -->

    <!-- Navigation -->
    <nav class="space-y-2" x-data="{ leadMenuOpen: false }">
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded">
           <span class="ml-2">Dashboard</span>
        </a>

        <!-- Lead Management Dropdown -->
        <div>
            <button @click="leadMenuOpen = !leadMenuOpen"
                class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded focus:outline-none">
                <div class="flex items-center">
                  <span class="ml-2">Lead Management</span>
                </div>
                <svg :class="{'rotate-180': leadMenuOpen}" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="leadMenuOpen" x-cloak class="ml-6 mt-2 space-y-1">
                <a href="{{ route('leads.index') }}" class="block px-2 py-1 text-sm hover:bg-gray-800 rounded">All Leads</a>
                <a href="{{ route('leads.create') }}" class="block px-2 py-1 text-sm hover:bg-gray-800 rounded">Add Leads</a>
                <!-- <a href="#" class="block px-2 py-1 text-sm hover:bg-gray-800 rounded">Trash</a> -->
                <!-- <a href="#" class="block px-2 py-1 text-sm hover:bg-gray-800 rounded">Duplicates</a> -->
                <!-- <a href="#" class="block px-2 py-1 text-sm hover:bg-gray-800 rounded">Junk/Spam</a> -->
                <!-- <a href="#" class="block px-2 py-1 text-sm hover:bg-gray-800 rounded">Expiring</a> -->
            </div>
        </div>

        <!-- Other Menu Items -->
        <!-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded"> -->
            <!-- <span class="ml-2">Marketing Campaigns</span> -->
        <!-- </a> -->
        <!-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded"> -->
            <!-- <span class="ml-2">Properties</span> -->
        <!-- </a> -->
        <!-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded"> -->
            <!-- <span class="ml-2">Appointment Calendar</span> -->
        <!-- </a> -->
    </nav>
</aside>
