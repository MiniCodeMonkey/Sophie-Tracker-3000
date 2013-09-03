<div class="modal fade" id="pumpModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row pump-types">
                    <button type="button" class="btn btn-lg btn-info" data-value="left">
                        <i class="icon-arrow-left"></i> Left
                    </button>

                    <button type="button" class="btn btn-lg btn-info" data-value="right">
                        <i class="icon-arrow-right"></i> Right
                    </button>

                    <button type="button" class="btn btn-lg btn-info" data-value="both">
                        <i class="icon-resize-horizontal"></i> Both
                    </button>
                </div>

                <div class="row hide pump-options">
                    {{ spinner(0.5, 4, 'ounces') }}

                    <button type="button" class="btn btn-lg btn-success save">
                        <i class="icon-ok"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>