<?php
// Total Prenatal Checkups
$sql = mysqli_query($con, "SELECT COUNT(*) as total_checkups FROM prenatal_checkups");
$total_checkups = mysqli_fetch_array($sql);

// Monthly Checkups
$sql = mysqli_query($con, "SELECT COUNT(*) as monthly_checkups FROM prenatal_checkups WHERE MONTH(checkup_date) = MONTH(CURRENT_DATE()) AND YEAR(checkup_date) = YEAR(CURRENT_DATE())");
$monthly_checkups = mysqli_fetch_array($sql);

// Expected Deliveries
$sql = mysqli_query($con, "SELECT COUNT(*) as expected_deliveries FROM prenatal_checkups WHERE MONTH(edc) = MONTH(CURRENT_DATE()) AND YEAR(edc) = YEAR(CURRENT_DATE())");
$expected_deliveries = mysqli_fetch_array($sql);

// Weight Average
$sql = mysqli_query($con, "SELECT AVG(weight) as average_weight FROM prenatal_checkups");
$average_weight = mysqli_fetch_array($sql);
?>

<div class="row">

    <!-- Total Prenatal Checkups Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-stethoscope"></i>
                </div>
            </div>
            <div class="info-section">
                <span class="stat-title">Total Prenatal Checkups</span>
                <h2 class="stat-value"><?php echo number_format($total_checkups['total_checkups'], 0) ?></h2>
            </div>
        </div>
    </div>

    <!-- This Month's Checkups Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section stat-card__icon stat-card__icon--warning">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-calendar-check"></i>
                </div>
            </div>
            <div class="info-section">
                <span class="stat-title">This Month's Checkups</span>
                <h2 class="stat-value"><?php echo number_format($monthly_checkups['monthly_checkups'], 0) ?></h2>
            </div>
        </div>
    </div>

    <!-- Expected Deliveries Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section stat-card__icon stat-card__icon--primary">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-baby"></i>
                </div>
            </div>
            <div class="info-section">
                <span class="stat-title">Expected Deliveries</span>
                <h2 class="stat-value"><?php echo number_format($expected_deliveries['expected_deliveries'], 0) ?></h2>
            </div>
        </div>
    </div>

    <!-- Average Weight Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-weight"></i>
                </div>
            </div>
            <div class="info-section">
                <span class="stat-title">Average Weight</span>
                <h2 class="stat-value"><?php echo number_format($average_weight['average_weight'], 2) ?> kg</h2>
            </div>
        </div>
    </div>

</div>