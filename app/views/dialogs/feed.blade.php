<div class="modal fade" id="feedModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row feed-types">
                    <button type="button" class="btn btn-lg btn-info" data-value="left">
                        <i class="icon-arrow-left"></i> Left
                    </button>

                    <button type="button" class="btn btn-lg btn-info" data-value="right">
                        <i class="icon-arrow-right"></i> Right
                    </button>

                    <button type="button" class="btn btn-lg btn-info" data-value="pumped">
                        <i class="icon-tint"></i> Pumped
                    </button>

                    <button type="button" class="btn btn-lg btn-info" data-value="formula">
                        <i class="icon-magic"></i> Formula
                    </button>
                </div>

                <div class="row hide time-options">
                    {{ spinner(5, 30, 'minutes') }}

                    <button type="button" class="btn btn-lg btn-success save">
                        <i class="icon-ok"></i> Save
                    </button>
                </div>

                <div class="row hide bottle-options">
                    {{ spinner(0.5, 4, 'ounces') }}

                    <button type="button" class="btn btn-lg btn-success save">
                        <i class="icon-ok"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>