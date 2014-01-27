<div class="modal fade" id="foodModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row food-types">
                    @foreach ($foodTypes as $foodType)
                    <button type="button" class="btn btn-lg btn-success" data-value="{{ $foodType->subtype }}">
                        <i class="{{ iconForFood($foodType->subtype ) }}"></i> {{ $foodType->subtype }}
                    </button>
                    @endforeach

                    <button type="button" class="btn btn-lg btn-success" data-value="Other">
                        <i class="icon-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>