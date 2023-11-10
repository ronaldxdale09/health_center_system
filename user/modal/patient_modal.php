<!-- Add Customer Modal -->


<div class="modal fade" id="newPatient" tabindex="-1" role="dialog" aria-labelledby="newCoffeeProductForm"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark border-bottom">
                <h5 class="modal-title" id="newCoffeeProductForm">NEW | PATIENT RECORD</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>


            <form method='POST' action="function/patient_record.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">

                                <div class="card-body text-center">
                                    <!-- Avatar Image -->
                                    <img src="assets/img/avatar2.png" alt="avatar" class="rounded-circle profile-avatar"
                                        id="preview_image" width="150" height="150"> <!-- Upload Button -->
                                    <div class="mt-3">
                                        <label for="profile_picture" class="form-label">Upload Profile Picture</label>
                                        <input type="file" class="btn btn-success form-control" id="profile_picture"
                                            name="profile_picture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Religion:</label>
                                    <select class="form-select" name="religion">
                                        <option selected>Select Religion</option>
                                        <option value="Roman Catholic">Roman Catholic</option>
                                        <option value="Islam">Islam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Contact #:</label>
                                    <input type="text" class="form-control" name="contact_number"
                                        placeholder="Enter contact number">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Occupation:</label>
                                    <input type="text" class="form-control" name="occupation"
                                        placeholder="Enter occupation">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Gender:</label>
                                    <select class="form-select" name="gender">
                                        <option selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Date of Birth:</label>
                                    <input type="date" class="form-control" name="dob"
                                        placeholder="Select date of birth">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="col-form-label">Complete Address:</label>
                                    <input type="text" class="form-control" name="address"
                                        placeholder="Enter complete address">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Spouse Name:</label>
                                    <input type="text" class="form-control" name="spouse_name"
                                        placeholder="Spouse Name">
                                </div>
                                <div class="col">
                                    <label class="col-form-label">Birthdate:</label>
                                    <input type="date" class="form-control" name="spouse_date">
                                </div>
                                <div class="col">
                                    <label class="col-form-label">Occupation:</label>
                                    <input type="text" class="form-control" name="spouse_occupation"
                                        placeholder="Enter Occupation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">Blood Type:</label>
                                            <input type="text" class="form-control" name="blood_type"
                                                placeholder="Enter blood type">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Emergency Contact:</label>
                                            <input type="text" class="form-control" name="emergency_contact"
                                                placeholder="Enter emergency contact number">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">Allergies:</label>
                                            <input type="text" class="form-control" name="allergies"
                                                placeholder="Enter allergies">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Existing Conditions:</label>
                                            <input type="text" class="form-control" name="existing_conditions"
                                                placeholder="Enter existing conditions">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label class="col-form-label">Notes:</label>
                                            <textarea class="form-control" name="notes"
                                                placeholder="Enter additional notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name='add' class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('profile_picture').addEventListener('change', function (event) {
        const reader = new FileReader();
        reader.onload = function () {
            const img = document.getElementById('preview_image');
            img.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }, false);
</script>