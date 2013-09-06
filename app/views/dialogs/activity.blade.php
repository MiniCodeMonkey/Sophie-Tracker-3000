<div class="modal fade" id="activityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row activity-types">
                    <button type="button" class="btn btn-lg btn-info" data-value="Walk">
                        <i class="icon-baby-carrier"></i> Walk
                    </button>

                    <button type="button" class="btn btn-lg btn-info long-text" data-value="Tummy Time">
                        <i class="icon-heart"></i> Tummy<br />time
                    </button>

                    <button type="button" class="btn btn-lg btn-info" data-value="Other">
                        <i class="icon-plus"></i> Other
                    </button>
                </div>

                <div class="row hide activity-options">
                    {{ spinner(5, 15, 'minutes') }}

                    <button type="button" class="btn btn-lg btn-success save">
                        <i class="icon-ok"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>