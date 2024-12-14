<?php include APP_DIR . 'views/templates/header.php'; ?>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6">Transactions</h1>

                <!-- Search and Add Transaction -->
                <div class="mb-6 flex justify-between items-center">
                    <div class="w-1/3 flex space-x-4">
                        <form method="GET" action="">
                            <input type="text" name="search" placeholder="Search transactions..." value="<?= htmlspecialchars($_GET['search'] ?? ''); ?>" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </form>
                        <button type="submit" form="searchForm" class="bg-[#4D869C] hover:bg-[#4D869C] text-white font-bold py-2 px-4 rounded">
                            Search
                        </button>
                    </div>
                    <button class="bg-[#4D869C] hover:bg-[#4D869C] text-white font-bold py-2 px-4 rounded">
                        <a href="<?= site_url('transactions/create') ?>">Add Transaction</a>
                    </button>
                </div>

                <!-- Transactions Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Category</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Amount</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Date</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Total Budget</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-[#2D9596] text-left text-xs font-semibold text-white uppercase tracking-wider">Remaining Budget</th>
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

                            // Filter transactions based on the search term
                            $filteredTransactions = array_filter($transactions, function($transaction) use ($searchQuery) {
                                return stripos($transaction['category_name'], $searchQuery) !== false;
                            });

                            // Pagination for filtered results
                            $totalTransactions = count($filteredTransactions);
                            $totalPages = ceil($totalTransactions / $perPage);

                            // Slice the filtered transactions for the current page
                            $currentTransactions = array_slice($filteredTransactions, $offset, $perPage);

                            foreach ($currentTransactions as $index => $transaction) :
                                // Determine the background color based on the index
                                $bgColor = $index % 2 == 0 ? '#FFFFFF' : '#CDE8E5'; // Alternating white and CDE8E5
                            ?>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;"><?= $transaction['category_name']; ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;">₱<?= number_format($transaction['amount'], 2); ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;"><?= date('Y-m-d', strtotime($transaction['timestamp'])); ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;">₱<?= number_format($transaction['total_budget'], 2); ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200" style="background-color: <?= $bgColor; ?>;">₱<?= number_format($transaction['remaining_amount'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Numbers -->
                <div class="flex justify-center mt-6">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm">
                        <!-- Numbered page links -->
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
