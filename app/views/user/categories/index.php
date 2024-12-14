<?php include APP_DIR . 'views/templates/header.php'; ?>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="container mx-auto px-6 py-8">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6">Categories</h1>

                <!-- Search and Add Category -->
                <div class="mb-6 flex justify-between items-center">
                    <div class="w-1/3 flex space-x-4">
                        <form method="GET" action="">
                            <input type="text" name="search" placeholder="Search categories..." value="<?= htmlspecialchars($_GET['search'] ?? ''); ?>" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </form>
                        <button type="submit" form="searchForm" class="bg-[#4D869C] hover:bg-[#4D869C] text-white font-bold py-2 px-4 rounded">
                            Search
                        </button>
                    </div>
                    <button class="bg-[#4D869C] hover:bg-[#4D869C] text-white font-bold py-2 px-4 rounded">
                        <a href="<?= site_url('categories/create') ?>">Add Category</a>
                    </button>
                </div>

                <!-- Categories Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Category Name</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Total Budget</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Remaining Budget</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Savings Goal</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
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

                            // Filter categories based on the search term
                            $filteredCategories = array_filter($categories, function($category) use ($searchQuery) {
                                return stripos($category['category_name'], $searchQuery) !== false;
                            });

                            // Pagination for filtered results
                            $totalCategories = count($filteredCategories);
                            $totalPages = ceil($totalCategories / $perPage);

                            // Slice the filtered categories for the current page
                            $currentCategories = array_slice($filteredCategories, $offset, $perPage);

                            foreach ($currentCategories as $index => $category) :
                                // Determine the background color based on the index
                                $bgColor = $index % 2 == 0 ? '#FFFFFF' : '#CDE8E5'; // Alternating white and CDE8E5
                            ?>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;"><?= htmlspecialchars($category['category_name']); ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;">₱<?= number_format($category['total_budget'], 2); ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;">₱<?= number_format($category['remaining_budget'], 2); ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;">₱<?= number_format($category['savings_goal'], 2); ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;">
                                        <a href="<?= site_url('categories/edit/' . $category['id']) ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <a href="<?= site_url('categories/delete/' . $category['id']) ?>" class="text-red-600 hover:text-red-900 ml-4">Delete</a>
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
