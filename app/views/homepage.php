<?php
include APP_DIR.'views/templates/header.php';
?>
<body>
    <div id="app" class="d-flex">
        <?php include APP_DIR.'views/templates/sidenav.php'; ?>

        <div class="content p-4 w-100">
            <div class="container">
                <!-- Budget Overview -->
                <div class="mb-4">
                    <h2 class="text-primary">Budget Overview</h2>
                    <div class="row">
                        <?php if (!empty($budget_overview)) : ?>
                            <?php foreach ($budget_overview as $row) : ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">Category: <?= $row['category_name'] ?></h5>
                                            <p>Budget ID: <?= $row['budget_id'] ?></p>
                                            <p>Amount Limit: <?= $row['amount_limit'] ?></p>
                                            <p>Total Spent: <?= $row['total_spent'] ?></p>
                                            <p>Remaining Budget: <?= $row['remaining_budget'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-muted">No budget data available.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Goal Progress -->
                <div class="mb-4">
                    <h2 class="text-success">Goal Progress</h2>
                    <div class="row">
                        <?php if (!empty($goal_progress)) : ?>
                            <?php foreach ($goal_progress as $row) : ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">Goal: <?= $row['goal_name'] ?></h5>
                                            <p>Target Amount: <?= $row['target_amount'] ?></p>
                                            <p>Saved Amount: <?= $row['saved_amount'] ?></p>
                                            <p>Start Date: <?= $row['start_date'] ?></p>
                                            <p>End Date: <?= $row['end_date'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-muted">No goal data available.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="mb-4">
                    <h2 class="text-info">Recent Transactions</h2>
                    <?php if (!empty($recent_transactions)) : ?>
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_transactions as $row) : ?>
                                    <tr>
                                        <td><?= $row['transaction_id'] ?></td>
                                        <td><?= $row['category_name'] ?></td>
                                        <td><?= $row['amount'] ?></td>
                                        <td><?= $row['date'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p class="text-muted">No recent transactions available.</p>
                    <?php endif; ?>
                </div>

                <!-- Spending Notifications -->
                <div class="mb-4">
                    <h2 class="text-warning">Spending Notifications</h2>
                    <?php if (!empty($spending_notifications)) : ?>
                        <ul class="list-group">
                            <?php foreach ($spending_notifications as $row) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= $row['message'] ?>
                                    <span class="badge <?= $row['seen'] ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $row['seen'] ? 'Seen' : 'Not Seen' ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p class="text-muted">No spending notifications available.</p>
                    <?php endif; ?>
                </div>

                <!-- Feedback and Ratings -->
                <div class="mb-4">
                    <h2 class="text-dark">Feedback and Ratings</h2>
                    <?php if (!empty($feedbacks_and_ratings)) : ?>
                        <p>Average Rating: <strong><?= $feedbacks_and_ratings[0]['average_rating'] ?></strong></p>
                        <?php foreach ($feedbacks_and_ratings as $row) : ?>
                            <div class="alert alert-secondary">
                                <p>Feedback: <?= $row['feedback_text'] ?></p>
                                <p>Rating: <?= $row['rating'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-muted">No feedback available.</p>
                    <?php endif; ?>
                </div>

                <!-- Login History -->
                <div class="mb-4">
                    <h2 class="text-secondary">Login History</h2>
                    <?php if (!empty($login_history)) : ?>
                        <ul class="list-group">
                            <?php foreach ($login_history as $row) : ?>
                                <li class="list-group-item">
                                    Login: <?= $row['login_time'] ?>, Logout: <?= $row['logout_time'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p class="text-muted">No login history available.</p>
                    <?php endif; ?>
                </div>

                <!-- Profile Summary -->
                <div class="mb-4">
                    <h2 class="text-primary">Profile Summary</h2>
                    <?php if (!empty($profile_summary)) : ?>
                        <?php foreach ($profile_summary as $row) : ?>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p>First Name: <?= $row['firstname'] ?></p>
                                    <p>Last Name: <?= $row['lastname'] ?></p>
                                    <p>Email: <?= $row['email'] ?></p>
                                    <p>Gender: <?= $row['gender'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-muted">No profile summary available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
