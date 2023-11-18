<?php
// Assuming $con is your database connection variable

// Total Number of Patients
$totalPatientsQuery = mysqli_query($con, "SELECT COUNT(*) as total_patients FROM patient_record");
$totalPatients = mysqli_fetch_array($totalPatientsQuery);

// Number of Immunizations This Month
$monthlyImmunizationsQuery = mysqli_query($con, "SELECT COUNT(*) as monthly_immunizations FROM immunization WHERE MONTH(dateRecording) = MONTH(CURRENT_DATE()) AND YEAR(dateRecording) = YEAR(CURRENT_DATE())");
$monthlyImmunizations = mysqli_fetch_array($monthlyImmunizationsQuery);

// Total Prenatal Checkups
$totalPrenatalQuery = mysqli_query($con, "SELECT COUNT(*) as total_prenatal FROM prenatal_record");
$totalPrenatal = mysqli_fetch_array($totalPrenatalQuery);

// Current Medicine Inventory
$medicineInventoryQuery = mysqli_query($con, "SELECT SUM(quantity) as total_medicine FROM med_inv");
$medicineInventory = mysqli_fetch_array($medicineInventoryQuery);

// Total Deliveries This Year
$yearlyDeliveriesQuery = mysqli_query($con, "SELECT COUNT(*) as yearly_deliveries FROM delivery_record WHERE YEAR(dateTimeDelivery) = YEAR(CURRENT_DATE())");
$yearlyDeliveries = mysqli_fetch_array($yearlyDeliveriesQuery);

// Family Planning Consultations
$fpConsultationsQuery = mysqli_query($con, "SELECT COUNT(*) as total_fp_consultations FROM family_planning_rec");
$fpConsultations = mysqli_fetch_array($fpConsultationsQuery);
?>

<div class="row">
    <!-- Each of these divs represents a col-sm-3umn for a stat card -->

    <!-- Total Number of Patients Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section total-patients-icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="info-section">
                <span class="stat-title">Total Patients</span>
                <span class="stat-value"><?php echo number_format($totalPatients['total_patients'], 0); ?></span>
            </div>
        </div>
    </div>

    <!-- Number of Immunizations This Month Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section active-cas
            0.
            0.00.
            .0e
            
            
               
            s-icon">
                <i class="fa fa-book"></i>
            </div>
            <div class="info-section">
                <span class="stat-title">Monthly Immunizations</span>
                <span class="stat-value"><?php echo number_format($monthlyImmunizations['monthly_immunizations'], 0); ?></span>
            </div>
        </div>
    </div>

    <!-- Total Prenatal Checkups Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section recovered-patients-icon">
                <i class="fa fa-book"></i>
            </div>
            <div class="info-section">
                <span class="stat-title">Total Prenatal Checkups</span>
                <span class="stat-value"><?php echo number_format($totalPrenatal['total_prenatal'], 0); ?></span>
            </div>
        </div>
    </div>

    <!-- Current Medicine Inventory Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section available-beds-icon">
                <i class="fa fa-book"></i>
            </div>
            <div class="info-section">
                <span class="stat-title">Medicine Inventory</span>
                <span class="stat-value"><?php echo number_format($medicineInventory['total_medicine'], 0); ?></span>
            </div>
        </div>
    </div>

    <!-- Total Deliveries This Year Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section staff-members-icon">
                <i class="fa fa-book"></i>
            </div>
            <div class="info-section">
                <span class="stat-title">Yearly Deliveries</span>
                <span class="stat-value"><?php echo number_format($yearlyDeliveries['yearly_deliveries'], 0); ?></span>
            </div>
        </div>
    </div>

    <!-- Family Planning Consultations Card -->
    <div class="col-sm-3">
        <div class="modern-stat-card">
            <div class="icon-section ongoing-surgeries-icon">
                <i class="fa fa-book"></i>
            </div>
            <div class="info-section">
                <span class="stat-title">FP Consultations</span>
                <span class="stat-value"><?php echo number_format($fpConsultations['total_fp_consultations'], 0); ?></span>
            </div>
        </div>
    </div>
</div>
