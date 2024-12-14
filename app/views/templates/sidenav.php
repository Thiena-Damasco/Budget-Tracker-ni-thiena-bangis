<aside id="sidebar" class="bg-[#9EC8B9] dark:bg-gray-800 w-64 h-screen overflow-y-auto transition-transform duration-300 transform -translate-x-full lg:translate-x-0 lg:static">
    <div class="flex flex-col h-full">
        <div class="flex items-center justify-between h-16 px-4">
            <img src="public\pics\Screenshot 2024-11-17 011236.png" alt="Logo" class="h-11 w-auto rounded-full">
            <h2 class="text-xl font-semibold text-green">BudgetWise</h2>
        </div>
        <div class="px-4 py-6">
            <nav class="space-y-2">
                <a href="<?= site_url('dashboard') ?>" class="flex items-center space-x-2 text-[#4A628A] dark:text-[#4A628A] hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md p-2 transition-colors duration-200">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="<?= site_url('categories'); ?>" class="flex items-center space-x-2 text-[#4A628A] dark:text-[#4A628A] hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md p-2 transition-colors duration-200">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span>Categories</span>
                </a>
                <a href="<?= site_url('transactions'); ?>" class="flex items-center space-x-2 text-[#4A628A] dark:text-[#4A628A] hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md p-2 transition-colors duration-200">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span>Transactions</span>
                </a>
                <a href="<?= site_url('notifications'); ?>" class="flex items-center space-x-2 text-[#4A628A] dark:text-[#4A628A] hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md p-2 transition-colors duration-200">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span>Notifications</span>
                </a>

                <!-- Feedback and Ratings Section -->
                <a href="<?= site_url('feedback'); ?>" class="flex items-center space-x-2 text-[#4A628A] dark:text-[#4A628A] hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md p-2 transition-colors duration-200">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9h6m2 0h3m-7 6h4m2 0h3m-9-6a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Feedback & Ratings</span>
                </a>
            </nav>
        </div>
        <div class="mt-auto p-4">
            <!-- User info moved above logout button -->
            <div class="flex items-center space-x-4 mb-6">
                <div>
                    <h4 class="text-sm font-semibold text-[#4A628A]"><?= html_escape(get_email(get_user_id())); ?></h4>
                </div>
            </div>
            <a href="<?= site_url('auth/logout'); ?>" class="flex items-center space-x-2 text-red-600 hover:bg-red-100 rounded-md p-2 transition-colors duration-200">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </a>
        </div>
    </div>
</aside>
