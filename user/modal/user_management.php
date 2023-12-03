<!-- The Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="function/user.mngmnt.php" method="POST">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="userName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userContact" class="form-label">Contact #:</label>
                        <input type="text" class="form-control" id="userContact" name="contact_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="userUsername" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="userUsername" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="userPassword" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="userType" class="form-label">User Type:</label>
                        <select class="form-select" id="userType" name="userType" required>
                            <option value="">Select a type</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="userAccess" class="form-label">User Access:</label>
                        <select multiple class="form-select" id="userAccess" name="userAccess[]" required>
                            <option value="dashboard">Dashboard</option>
                            <option value="patient">Patient</option>
                            <option value="prenatalService">Prenatal Service</option>
                            <option value="familyPlanningService">Family Planning Service</option>
                            <option value="immunizationService">Immunization Service</option>
                            <option value="deliveriesService">Deliveries Service</option>
                            <option value="medicationList">Medication List</option>
                            <option value="accountManagement">Account Management</option>
                        </select>
                        <small>Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</small>
                    </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary " name="new">Confirm
                </button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Update User Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="function/user.mngmnt.php" method="POST">
                    <input type="hidden" name="user_id" id="updateUserId">
                    <div class="mb-3">
                        <label for="userNameUpdate" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="userNameUpdate" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="userContactUpdate" class="form-label">Contact #:</label>
                        <input type="text" class="form-control" id="userContactUpdate" name="contact_no">
                    </div>
                    <div class="mb-3">
                        <label for="userUsernameUpdate" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="userUsernameUpdate" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="userPasswordUpdate" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="userPasswordUpdate" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="userTypeUpdate" class="form-label">User Type:</label>
                        <select class="form-select" id="userTypeUpdate" name="userType">
                            <option value="Administrator">Administrator</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="userAccess" class="form-label">User Access:</label>
                        <select multiple class="form-select" id="updateUserAccess" name="userAccess[]" required>
                            <option value="dashboard">Dashboard</option>
                            <option value="patient">Patient</option>
                            <option value="prenatalService">Prenatal Service</option>
                            <option value="familyPlanningService">Family Planning Service</option>
                            <option value="immunizationService">Immunization Service</option>
                            <option value="deliveriesService">Deliveries Service</option>
                            <option value="medicationList">Medication List</option>
                            <option value="accountManagement">Account Management</option>
                        </select>
                        <small>Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</small>
                    </div>

            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="update">Update User</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <form action="function/user.mngmnt.php" method="POST">
                    <input type="hidden" name="user_id" id="deleteUserId">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>