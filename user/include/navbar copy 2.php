<nav class="sidebar locked">
    <div class="logo_items flex">
        <span class="nav_image">
            <img src="assets/img/logo.png" alt="logo_img" />
        </span>
        <span class="logo_name">HC System</span>
        <!-- <i class="bx bx-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
        <i class="bx bx-x" id="sidebar-close"></i> -->
    </div>
    <div class="menu_container">
        <div class="menu_items">
            <!-- Dashboard Section -->
            <ul class="menu_item">
                <div class="menu_title flex">
                    <span class="title">Main</span>
                    <span class="line"></span>
                </div>
                <li class="item">
                    <a href="dashboard.php" class="link flex">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="item">
                    <a href="patient_list.php" class="link flex">
                        <i class="fas fa-user"></i>
                        <span>Patient</span>
                    </a>
                </li>
            </ul>

            <!-- Services Section with Dropdown -->
            <ul class="menu_item">
                <div class="menu_title flex">
                    <span class="title">Services</span>
                    <span class="line"></span>
                </div>
                <li class="item">
                    <a href="prenatal.php" class="link flex">
                        <i class="fas fa-baby-carriage"></i>
                        <span>Prenatal</span>
                    </a>
                </li>
                <li class="item">
                    <a href="fp_record.php" class="link flex">
                        <i class="fas fa-users"></i>
                        <span>Family Planning</span>
                    </a>
                </li>
                <!-- Additional Dropdown Items -->
                <li class="item">
                    <a href="immunization_record.php" class="link flex">
                        <i class="fas fa-book"></i>
                        <span>Immunization</span>
                    </a>
                </li>
                <li class="item">
                    <a href="deliveries_record.php" class="link flex">
                        <i class="fas fa-baby"></i>
                        <span>Deliveries</span>
                    </a>
                </li>
                <li class="item">
                    <a href="vaccination_record.php" class="link flex">
                        <i class="fas fa-book"></i>
                        <span>Vaccination</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar_profile flex">
            <span class="nav_image">
                <img src="images/profile.jpg" alt="profile_img" />
            </span>
            <div class="data_text">
                <span class="name">David Oliva</span>
                <span class="email">david@gmail.com</span>
            </div>
        </div>
        <button class="logout-btn flex">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </div>
</nav>
<!-- Navbar -->