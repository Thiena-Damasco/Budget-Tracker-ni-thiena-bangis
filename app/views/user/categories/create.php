<?php
include APP_DIR . 'views/templates/header.php';
?>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

        <div class="flex-1 overflow-auto">
            <div class="max-w-7xl mx-auto px-6 py-8">
                <!-- Header Section -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-semibold text-gray-800">Add New Category</h1>
                </div>

                <!-- Success/Failure Messages -->
                <div id="message-container"></div>

                <!-- Form Section -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <form id="createCategoryForm" class="p-6 space-y-6">
                        <div class="mb-4">
                            <label for="categoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" name="category_name" id="category_name" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        
                        <div class="mb-4">
                            <label for="totalBudget" class="block text-sm font-medium text-gray-700">Total Budget</label>
                            <div class="relative">
                                <span class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">₱</span>
                                <input type="number" name="total_budget" id="total_budget" step="0.01" required class="pl-6 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="savingsGoal" class="block text-sm font-medium text-gray-700">Savings Goal</label>
                            <div class="relative">
                                <span class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">₱</span>
                                <input type="number" name="savings_goal" id="savings_goal" step="0.01" required class="pl-6 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create Category
                            </button>
                            <a href="<?= site_url('categories') ?>" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-600 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include APP_DIR . 'views/templates/footer.php'; ?>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('#createCategoryForm').on('submit', function (e) {
                e.preventDefault(); 
                const formData = $(this).serialize();

                $.ajax({
                    url: '<?= site_url("categories/create"); ?>', // Backend endpoint for adding category
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        // SweetAlert for success
                        Swal.fire({
                            title: 'Success!',
                            text: 'Category added successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        $('#createCategoryForm')[0].reset();
                    },
                    error: function (xhr, status, error) {
                        // SweetAlert for error
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while adding the category.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
