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
                    @foreach ($pumpLevels as $ounces => $name)
                    <button type="button" class="btn btn-success" data-value="{{ $ounces }}">
                        {{ $name}}
                        @if (!is_integer($ounces))
                            <span>({{ (intval($ounces) > 0) ? intval($ounces) : '' }}&half; oz.)</span>
                        @else
                            <span>(~ {{ $ounces }} oz.)</span>
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>