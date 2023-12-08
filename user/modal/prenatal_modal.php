<!-- Confirm Modal for New Prenatal Record -->
<div class="modal fade" id="newPrenatalRecord" tabindex="-1" aria-labelledby="prenatalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prenatalLabel">New Prenatal Record</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/prenatal_record.php'>

                <div class="modal-body">
                    Are you sure you want to create a new prenatal record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="new" class="btn btn-primary" id="confirmPrenatalButton">Yes,
                        Create</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Return Modal for Prenatal Record -->
<div class="modal" tabindex="-1" role="dialog" id="confirmPrenatalReturnModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Prenatal Record Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to return without saving the prenatal record?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmPrenatalReturn">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
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
                <form action="function/prenatal_record.php" method="POST">
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