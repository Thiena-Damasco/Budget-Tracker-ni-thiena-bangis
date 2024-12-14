<?php
include APP_DIR . 'views/templates/header.php';
?>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create Transaction</h1>

                <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                    <form id="transactionForm" class="space-y-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="category_id" name="category_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="">Select a category</option>
                                <?php
                                foreach ($categories as $category) :
                                ?>
                                    <option value="<?= $category['id']; ?>"><?= $category['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="amount" id="amount" step="0.01" required class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                            </div>
                        </div>

                        <div>
                            <label for="timestamp" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="datetime-local" name="timestamp" id="timestamp" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="button" onclick="window.history.back()" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </button>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Create Transaction
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include APP_DIR . 'views/templates/footer.php'; ?>    
    
    <script>
        $(document).ready(function () {
            $('#transactionForm').on('submit', function (e) {
                e.preventDefault(); 
                const formData = $(this).serialize();

                $.ajax({
                    url: '<?= site_url("transactions/create"); ?>', // Backend endpoint for adding user
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        alert('success')
                        $('#transactionForm')[0].reset();
                    },
                    error: function (xhr, status, error) {
                        alert('success')
                        $('#transactionForm')[0].reset();
                    }
                });
            });
        });
    </script>
</body>
</html>