<nav id="navbar">
    <div id="toggle-nav-btn">
        <i class="fa-solid fa-ellipsis"></i>
    </div>
    <div class="nav-title" style="font-weight:bold;">
        <img src="assets/img/logo.png" alt="Q-cart Logo" width="35" height="35" style="margin-right:5px;"> <span
            class="nav-text">HC System</span>
    </div>
    <hr style="color:white">

    <a class="nav-link" href="dashboard.php">
        <i class="fas fa-home"></i> <span class="nav-text">Dashboard</span>
    </a>

    <a class="nav-link" href="patient_list.php">
        <i class="fas fa-user"></i> <span class="nav-text">Patient</span>
    </a>

    <hr style="color:white">
    <div class="dropdown">
        <a class="dropbtn nav-link" id="dropbtnServices">
            <span class="icon-wrapper"><i class="fas fa-hospital"></i></span>
            <span class="nav-text">Services</span>
            <i class="fas fa-caret-down"></i>
        </a>
        <div class="dropdown-content">
            <a href="prenatal.php"> <span class="icon-wrapper"><i class="fas fa-baby-carriage"></i></span> Prenatal</a>
            <a href="family_planning.php"> <span class="icon-wrapper"><i class="fas fa-users"></i></span> Family
                Planning</a>
            <a href="immunization_record.php"> <span class="icon-wrapper"><i class="fas fa-book"></i></span>
                Immunization</a>
            <a href="deliveries_record.php"> <span class="icon-wrapper"><i class="fas fa-baby"></i></span>
                Deliveries</a>
            <a href="vaccination_record.php"> <span class="icon-wrapper"><i class="fas fa-book"></i></span>
                Vaccination</a>
        </div>
    </div>
    <hr style="color:white">

    <a class="nav-link" href="medicine_list.php">
        <i class="fas fa-book"></i></i> <span class="nav-text">Medication List</span>
    </a>
    <div class='logout-container'>
        <span class='nav-text'></span>
        <a class='nav-link logout' href='function/logout.php'>
            <i class='fa fa-sign-out'></i> Signout
        </a>
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
</script>