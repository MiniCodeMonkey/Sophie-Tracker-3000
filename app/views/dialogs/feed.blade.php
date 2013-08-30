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
                    @foreach ($timeLevels as $minutes => $name)
                    <button type="button" class="btn btn-success" data-value="{{ $minutes }}">
                        {{ $name }} <span>(~ {{ $minutes }} min.)</span>
                    </button>
                    @endforeach
                </div>

                <div class="row hide bottle-options">
                    @foreach ($bottleLevels as $ounces => $name)
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