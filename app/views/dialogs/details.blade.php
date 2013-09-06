<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">How long ago was it?</h4>
            </div>
            <div class="modal-body">
                {{ spinner(5, 5, 'minutes ago') }}

                <button type="button" class="btn btn-lg btn-success save">
                    <i class="icon-ok"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>