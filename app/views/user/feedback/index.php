<?php include APP_DIR . 'views/templates/header.php'; ?>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="container mx-auto px-6 py-8">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6">Feedback and Ratings</h1>

                <!-- Search and Add Feedback -->
                <div class="mb-6 flex justify-between items-center">

                    <button class="bg-[#4D869C] hover:bg-[#4D869C] text-white font-bold py-2 px-4 rounded">
                        <a href="<?= site_url('feedback/create') ?>">Add Feedback</a>
                    </button>
                </div>

                <!-- Feedback Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Feedback Text</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Get search query
                            $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

                            // Pagination logic
                            $perPage = 10;
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $offset = ($page - 1) * $perPage;

                            // Filter feedback based on the search term
                            $filteredFeedback = array_filter($feedback, function($item) use ($searchQuery) {
                                return stripos($item['feedback_text'], $searchQuery) !== false;
                            });

                            // Pagination for filtered results
                            $totalFeedback = count($filteredFeedback);
                            $totalPages = ceil($totalFeedback / $perPage);

                            // Slice the filtered feedback for the current page
                            $currentFeedback = array_slice($filteredFeedback, $offset, $perPage);

                            foreach ($currentFeedback as $index => $item) :
                                // Determine the background color based on the index
                                $bgColor = $index % 2 == 0 ? '#FFFFFF' : '#CDE8E5'; // Alternating white and CDE8E5
                            ?>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;"><?= htmlspecialchars($item['feedback_text']); ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;">
                                        <!-- Display rating as stars -->
                                        <?php 
                                            $rating = $item['rating']; 
                                            for ($i = 1; $i <= 5; $i++) :
                                                $starClass = $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; // Yellow for rated stars, gray for empty ones
                                        ?>
                                            <svg class="inline-block w-5 h-5 <?= $starClass; ?>" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M10 15.27l-6.18 3.73 1.64-7.03-5.43-4.73 7.12-.61L10 0l2.85 6.63 7.12.61-5.43 4.73 1.64 7.03L10 15.27z"></path>
                                            </svg>
                                        <?php endfor; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Numbers -->
                <div class="flex justify-center mt-6">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm">
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <a href="?page=<?= $i; ?>&search=<?= urlencode($searchQuery); ?>" class="px-4 py-2 text-sm font-medium <?= $page == $i ? 'text-blue-700' : 'text-blue-500 hover:text-blue-700'; ?>">
                                <?= $i; ?>
                            </a>
                        <?php endfor; ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php include APP_DIR . 'views/templates/footer.php'; ?>
</body>
</html>
