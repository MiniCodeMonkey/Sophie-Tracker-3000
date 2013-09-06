<div class="modal fade" id="suppliesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row supplies-types">
                    <button type="button" class="btn btn-lg btn-info" data-value="diaper">
                        <i class="icon-baby-diaper"></i> Diapers
                    </button>

                    <button type="button" class="btn btn-lg btn-info" data-value="wipe">
                        <i class="icon-inbox"></i> Wipes
                    </button>

                    <button type="button" class="btn btn-lg btn-info" data-value="other">
                        <i class="icon-plus"></i> Other
                    </button>
                </div>

                <div class="row hide supplies-options">
                    {{ spinner(10, 100, 'items') }}

                    <button type="button" class="btn btn-lg btn-success save">
                        <i class="icon-ok"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>