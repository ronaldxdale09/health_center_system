<!-- Confirm Modal for New Immunization Record -->
<div class="modal fade" id="newImmunizationRecord" tabindex="-1" aria-labelledby="immunizationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="immunizationLabel">New Immunization Record</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/immunization_function.php'>

                <div class="modal-body">
                    Are you sure you want to create a new immunization record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="new" class="btn btn-primary" id="confirmImmunizationButton">Yes, Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirm Modal for Immunization Record Details -->
<div class="modal fade" id="confirmImmunizationModal" tabindex="-1" aria-labelledby="immunizationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="immunizationLabel">Confirm Immunization Record Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to complete the immunization record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="confirmImmunizationButton">Yes, Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- Draft Modal for Immunization Record -->
<div class="modal fade" id="draftImmunizationModal" tabindex="-1" aria-labelledby="immunizationDraftLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="immunizationDraftLabel">
                    <i class="fas fa-save me-2"></i>Store Immunization Record Draft
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <i class="fas fa-question-circle fa-4x mb-3 animate__animated animate__wobble"></i>
                </p>
                <p class="text-center">
                    Are you sure you want to save the current state as an immunization draft?
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" class="btn btn-warning saveDraftBtn" id="saveImmunizationDraftBtn">
                    <i class="fas fa-check me-2"></i>Yes, Save Draft
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Return Modal for Immunization Record -->
<div class="modal" tabindex="-1" role="dialog" id="confirmImmunizationReturnModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Immunization Record Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to return without saving the immunization record?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmImmunizationReturn">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="deleteRecord" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="function/immunization_function.php" method="POST">
                    <input type="text" name="record_id" value="<?php echo $id; ?>" hidden>

                    Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="delete" class="btn btn-danger" id="confirmDelete">Delete Record</button>
            </div>
            </form>

        </div>
    </div>
</div>

