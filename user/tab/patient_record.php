<?php
$tab = '';
if (isset($_GET['tab'])) {
    $tab = filter_var($_GET['tab']);
}

?>
<link rel='stylesheet' href='css/patient_record.css'>

<div class="wrapper" id="myTab">
    <input type="radio" name="slider" id="home" <?php if ($tab == '') {
        echo 'checked';
    } else {
        echo '';
    } ?>>
    <input type="radio" name="slider" id="blog" <?php if ($tab == '2') {
        echo 'checked';
    } else {
        echo '';
    } ?>>
    <input type="radio" name="slider" id="drying" <?php if ($tab == '3') {
        echo 'checked';
    } else {
        echo '';
    } ?>>
    <input type="radio" name="slider" id="code" <?php if ($tab == '4') {
        echo 'checked';
    } else {
        echo '';
    } ?>>
    <input type="radio" name="slider" id="help" <?php if ($tab == '5') {
        echo 'checked';
    } else {
        echo '';
    } ?>>

    <nav>
        <label for="home" class="home"><i class="fas fa-baby-carriage"></i> Prenatal </label>
        <label for="blog" class="blog"><i class="fas fa-users"></i> FP </label>
        <label for="drying" class="drying"><i class="fas fa-syringe"></i> Immunization </label>
        <label for="code" class="code"><i class="fas fa-baby"></i> Deliveries </label>
        <label for="help" class="help"><i class="fas fa-pills"></i> Vaccination </label>


        <div class="slider"></div>
    </nav>
    <section>
        <div class="content content-1">
            <?php
            include "tab/record.prenatal.php";
            ?>
        </div>
        <div class="content content-2">
        </div>
        <div class="content content-3">
            <?php
            include "tab/record.immunization.php";
            ?>
        </div>
        <div class="content content-4">
            <?php
            include "tab/record.delivery.php";
            ?>
        </div>
        <div class="content content-5">

    </section>
</div>