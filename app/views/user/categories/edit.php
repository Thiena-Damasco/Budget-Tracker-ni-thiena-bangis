<?php
include APP_DIR . 'views/templates/header.php';
?>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

        <div class="flex-1 overflow-auto p-6">
            <main class="max-w-7xl mx-auto">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Edit Category</h1>

                <!-- Success/Failure Messages -->
                <div id="message-container"></div>

                <div class="bg-white shadow overflow-hidden sm:rounded-lg max-w-lg mx-auto">
                    <form id="editCategoryForm" class="p-6">
                        <input type="hidden" id="categoryId" name="id" value="<?= $c['id']; ?>">
                        <div class="mb-4">
                            <label for="categoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" name="category_name" id="categoryName" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?= html_escape($c['category_name']); ?>">
                        </div>
                        <div class="mb-4">
                            <label for="totalBudget" class="block text-sm font-medium text-gray-700">Total Budget</label>
                            <input type="number" name="total_budget" id="totalBudget" step="0.01" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?= number_format($c['total_budget'], 2); ?>">
                        </div>
                        <div class="mb-4">
                            <label for="savingsGoal" class="block text-sm font-medium text-gray-700">Savings Goal</label>
                            <input type="number" name="savings_goal" id="savingsGoal" step="0.01" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?= number_format($c['savings_goal'], 2); ?>">
                        </div>
                        <div class="flex justify-between space-x-4">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Category
                            </button>
                            <!-- Cancel Button -->
                            <a href="<?= site_url('categories') ?>" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-600 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include APP_DIR . 'views/templates/footer.php'; ?>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function () {
        $('#editCategoryForm').on('submit', function (e) {
            e.preventDefault(); 

            const formData = $(this).serialize();

            $.ajax({
                url: '<?= site_url("categories/edit/" . $c["id"]) ?>', 
                method: 'POST',
                data: formData,
                success: function (response) {
                    // SweetAlert for success
                    Swal.fire({
                        title: 'Success!',
                        text: 'Category updated successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function (xhr, status, error) {
                    // SweetAlert for error
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while updating the category.',
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
