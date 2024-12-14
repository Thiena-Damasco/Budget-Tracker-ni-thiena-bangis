<?php
include APP_DIR . 'views/templates/header.php';
?>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Fixed Sidebar -->
        <div class="w-64 h-screen fixed top-0 left-0 z-10">
            <?php include APP_DIR . 'views/templates/sidenav.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64 p-6 overflow-y-auto h-screen">
            <div class="container mx-auto space-y-6">
                <!-- Page Header -->
                <header class="flex justify-between items-center">
                    <h1 class="text-4xl font-bold text-gray-800">Dashboard</h1>
                </header>

                <!-- Dashboard Section -->
                <div class="bg-white shadow-lg rounded-lg p-6 space-y-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Budget and Savings Overview</h2>

                    <!-- Charts in One Row -->
                    <div class="flex flex-wrap md:flex-nowrap -mx-2">
                        <!-- Remaining Budget Chart -->
                        <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
                            <div class="bg-gray-50 border rounded-lg shadow-md p-4 h-96">
                                <h3 class="text-lg font-semibold text-gray-600 mb-2">Remaining Budget</h3>
                                <canvas id="budgetChart" class="w-full h-full"></canvas>
                            </div>
                        </div>

                        <!-- Savings Goals Chart -->
                        <div class="w-full md:w-1/2 px-2">
                            <div class="bg-gray-50 border rounded-lg shadow-md p-4 h-96">
                                <h3 class="text-lg font-semibold text-gray-600 mb-2">Savings Goals</h3>
                                <canvas id="savingsChart" class="w-full h-full"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Combined Table -->
                    <div class="bg-gray-50 border rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-semibold text-gray-600 mb-2">Budget Details</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left table-auto border-collapse">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Category</th>
                                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Goal</th>
                                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Spent</th>
                                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Total</th>
                                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Remaining</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($budgets as $index => $budget): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($budget['category_name']); ?></td>
                                        <td class="px-4 py-2 text-gray-700">₱<?= number_format($savings[$index]['savings_goal'], 2); ?></td>
                                        <td class="px-4 py-2 text-<?= $savings[$index]['spent'] > $savings[$index]['savings_goal'] ? 'red-500' : 'green-500'; ?>">
                                            ₱<?= number_format($savings[$index]['spent'], 2); ?>
                                        </td>
                                        <td class="px-4 py-2 text-gray-700">₱<?= number_format($budget['total_budget'], 2); ?></td>
                                        <td class="px-4 py-2 text-<?= $budget['remaining_budget'] < 0 ? 'red-500' : 'green-500'; ?>">
                                            ₱<?= number_format($budget['remaining_budget'], 2); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Budget Chart Data
        const budgetCtx = document.getElementById('budgetChart').getContext('2d');
        const budgetChart = new Chart(budgetCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($budgets, 'category_name')); ?>,
                datasets: [{
                    label: 'Remaining Budget',
                    data: <?= json_encode(array_column($budgets, 'remaining_budget')); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Savings Chart Data
        const savingsCtx = document.getElementById('savingsChart').getContext('2d');
        const savingsChart = new Chart(savingsCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode(array_column($savings, 'category_name')); ?>,
                datasets: [{
                    label: 'Savings Goals',
                    data: <?= json_encode(array_column($savings, 'savings_goal')); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: ₱${context.raw.toFixed(2)}`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
