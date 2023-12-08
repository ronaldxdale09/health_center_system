<!-- Confirm Modal for New Family Planning Record -->
<div class="modal fade" id="newFamilyPlanningRecord" tabindex="-1" aria-labelledby="familyPlanningLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="familyPlanningLabel">New Family Planning Record</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/fp.new.php'>
                <div class="modal-body">
                    Are you sure you want to create a new family planning record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="new" class="btn btn-primary" id="confirmFamilyPlanningButton">Yes, Create</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Confirm Modal for Family Planning Record -->
<div class="modal fade" id="confirmFamilyPlanningModal" tabindex="-1" aria-labelledby="familyPlanningLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="familyPlanningLabel">Confirm Family Planning Record Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to complete the family planning record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="confirmFamilyPlanningButton">Yes, Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- Draft Modal for Family Planning Record -->
<div class="modal fade" id="draftFamilyPlanningModal" tabindex="-1" aria-labelledby="familyPlanningDraftLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="familyPlanningDraftLabel">
                    <i class="fas fa-save me-2"></i>Store Family Planning Record Draft
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <i class="fas fa-question-circle fa-4x mb-3 animate__animated animate__wobble"></i>
                </p>
                <p class="text-center">
                    Are you sure you want to save the current state as a family planning draft?
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" class="btn btn-warning saveDraftBtn" id="saveFamilyPlanningDraftBtn">
                    <i class="fas fa-check me-2"></i>Yes, Save Draft
                </button>
            </div>
        </div>
    </div>
</div>






<!-- Modal -->
<div class="modal fade" id="deleteRecord" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="function/fp.new.php" method="POST">
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