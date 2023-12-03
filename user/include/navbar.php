<?php

function hasAccess($feature)
{
    // Check if 'userAccess' is set in the session and is an array
    if (isset($_SESSION['userAccess']) && is_array($_SESSION['userAccess'])) {
        return in_array($feature, $_SESSION['userAccess']);
    }
    return false; // Return false if 'userAccess' is not set or not an array
}


?>

<nav id="navbar">
    <div id="toggle-nav-btn">
        <i class="fa-solid fa-ellipsis"></i>
    </div>
    <div class="nav-title" style="font-weight:bold;">
        <img src="assets/img/logo.png" alt="Q-cart Logo" width="35" height="35" style="margin-right:5px;"> <span
            class="nav-text">HC System</span>
    </div>
    <hr style="color:white">

    <?php if (hasAccess('dashboard')): ?>
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-home"></i> <span class="nav-text">Dashboard</span>
        </a>
    <?php endif; ?>

    <?php if (hasAccess('patient')): ?>
        <a class="nav-link" href="patient_list.php">
            <i class="fas fa-user"></i> <span class="nav-text">Patient</span>
        </a>
    <?php endif; ?>

    <hr style="color:white">
    <div class="dropdown">
        <a class="dropbtn nav-link" id="dropbtnServices">
            <span class="icon-wrapper"><i class="fas fa-hospital"></i></span>
            <span class="nav-text">Services</span>
            <i class="fas fa-caret-down"></i>
        </a>
        <div class="dropdown-content">
            <?php if (hasAccess('prenatalService')): ?>
                <a href="prenatal.php"> <span class="icon-wrapper"><i class="fas fa-baby-carriage"></i></span> Prenatal</a>
            <?php endif; ?>

            <?php if (hasAccess('familyPlanningService')): ?>
                <a href="fp_record.php"> <span class="icon-wrapper"><i class="fas fa-users"></i></span> Family Planning</a>
            <?php endif; ?>

            <?php if (hasAccess('immunizationService')): ?>
                <a href="immunization_record.php"> <span class="icon-wrapper"><i class="fas fa-book"></i></span>
                    Immunization</a>
            <?php endif; ?>

            <?php if (hasAccess('deliveriesService')): ?>
                <a href="deliveries_record.php"> <span class="icon-wrapper"><i class="fas fa-baby"></i></span>
                    Deliveries</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (hasAccess('medicationList')): ?>
        <a class="nav-link" href="medicine_list.php">
            <i class="fas fa-book"></i> <span class="nav-text">Medication List</span>
        </a>
    <?php endif; ?>

    <?php if (hasAccess('accountManagement')): ?>
        <a class="nav-link" href="acc_mng.php">
            <i class="fas fa-user"></i> <span class="nav-text">Account Management</span>
        </a>
    <?php endif; ?>
    <!-- <div class='logout-container'>
        <span class='nav-text'></span>
        <a class='nav-link logout' href='function/logout.php'>
            <i class='fa fa-sign-out'></i> Signout
        </a>

        <button class="logout-btn flex">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>


    </div> -->
    <div class=" sidebar_profile flex">
        <span class="nav_image">
            <img src="assets/img/avatar2.png" alt="profile_img" />
        </span>
        <div class="data_text">
            <span class="name"><?php echo $_SESSION["full_name"] ?></span>
            <span class="email"><?php echo $_SESSION["type"] ?></span>
        </div>
        <button class="logout-btn flex" id="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>

    </div>

</nav>
<script src="js/navbar.js"></script>

<script>
    // Function to toggle the dropdown
    function toggleDropdown(id) {
        var dropdownContent = document.getElementById(id).nextElementSibling;
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
        // Save the state to localStorage
        localStorage.setItem("expandedDropdown", dropdownContent.style.display === "block" ? id : "");
    }

    // Event listeners for the dropdown buttons
    document.getElementById("dropbtnServices").addEventListener("click", function () {
        toggleDropdown("dropbtnServices");
    });

    // On page load, check the localStorage to see if a dropdown should be expanded
    window.onload = function () {
        var expandedDropdown = localStorage.getItem("expandedDropdown");
        if (expandedDropdown) {
            toggleDropdown(expandedDropdown);
        }
    };

    document.getElementById('logout-btn').addEventListener('click', function () {
        window.location.href = 'function/logout.php'; // Redirect to the logout script
    });
</script>