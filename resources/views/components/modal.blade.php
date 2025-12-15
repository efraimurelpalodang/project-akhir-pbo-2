<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>

    <div class="modal-dialog {{ $size ?? '' }}" role="document">
        <div class="modal-content">

            {{-- HEADER --}}
            @isset($title)
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <b>{{ $title }}</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
            @endisset

            {{-- BODY --}}
            <div class="modal-body">
                {{ $slot }}
            </div>

            {{-- FOOTER --}}
            @if (isset($footer))
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @elseif (isset($btnLeft) || isset($btnRight))
                <div class="modal-footer">
                    @isset($btnLeft)
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ $btnLeft }}
                        </button>
                    @endisset

                    @isset($btnRight)
                        @if (isset($href))
                            <a href="{{ $href }}" class="btn btn-primary">
                                {{ $btnRight }}
                            </a>
                        @else
                            <button type="submit" class="btn btn-primary">
                                {{ $btnRight }}
                            </button>
                        @endif
                    @endisset
                </div>
            @endif

        </div>
    </div>
</div>
