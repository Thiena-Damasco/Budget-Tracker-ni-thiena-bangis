<?php
include APP_DIR . 'views/templates/header.php';
?>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Fixed Sidebar -->
        <div class="w-64 h-screen fixed top-0 left-0 z-10">
            <?php include APP_DIR . 'views/templates/sidenav.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64 p-6 overflow-auto h-screen min-h-screen">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Notifications</h1>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Notification List -->
                <ul class="max-h-[calc(100vh-160px)] overflow-y-auto">
                    <?php 
                    foreach ($notifications as $index => $notification): 
                        // Alternating background colors
                        $bgColor = ($index % 2 === 0) ? 'bg-gray-50' : 'bg-gray-100';
                    ?>
                    <li class="border-b last:border-none">
                        <div class="flex items-start p-4 hover:bg-gray-200 transition-all duration-200 <?= $bgColor ?>">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            <div class="ml-4 w-full">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-medium text-gray-700"><?=htmlspecialchars($notification['message']);?></p>
                                    <p class="text-xs text-gray-400"><?=htmlspecialchars($notification['timestamp']);?></p>
                                </div>
                                <!-- Optional: Add extra info or icons here -->
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <?php include APP_DIR . 'views/templates/footer.php'; ?>
</body>
</html>
