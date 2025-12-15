<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (isset($title))
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel"><b>{{ $title }}</b></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            <div class="modal-body">{{ $slot }}</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ $btnLeft }}</button>
                <a class="btn btn-primary" href="login.html">{{ $btnRight }}</a>
            </div>
        </div>
    </div>
</div>
