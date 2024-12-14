<?php include APP_DIR . 'views/templates/header.php'; ?>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="max-w-7xl mx-auto px-6 py-8">
                <!-- Header Section -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-semibold text-gray-800">Add New Feedback</h1>
                </div>

                <!-- Success/Failure Messages -->
                <div id="message-container"></div>

                <!-- Form Section -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <form id="createFeedbackForm" class="p-6 space-y-6">
                        <div class="mb-4">
                            <label for="feedbackText" class="block text-sm font-medium text-gray-700">Feedback Text</label>
                            <textarea name="feedback_text" id="feedback_text" rows="4" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                            <select name="rating" id="rating" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Select Rating</option>
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Submit Feedback
                            </button>
                            <a href="<?= site_url('feedback') ?>" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-600 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
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
            $('#createFeedbackForm').on('submit', function (e) {
                e.preventDefault(); 
                const formData = $(this).serialize();

                $.ajax({
                    url: '<?= site_url("feedback/store"); ?>', // Backend endpoint for storing feedback
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        // SweetAlert for success
                        Swal.fire({
                            title: 'Success!',
                            text: 'Feedback submitted successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        $('#createFeedbackForm')[0].reset();
                    },
                    error: function (xhr, status, error) {
                        // SweetAlert for error
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while submitting the feedback.',
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
