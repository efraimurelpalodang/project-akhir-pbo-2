<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="{{ $dropdownId }}" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="{{ $icon }} fa-fw"></i>
        <!-- Counter -->
        <span class="badge badge-danger badge-counter">{{ $counter }}</span>
    </a>

    <!-- Dropdown -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="{{ $dropdownId }}">

        <h6 class="dropdown-header">{{ $title }}</h6>

        {{-- Loop items --}}
        @foreach ($items as $item)
            <a class="dropdown-item d-flex align-items-center" href="#">
                {{-- Jika ada icon --}}
                @if (isset($item['icon']))
                    <div class="mr-3">
                        <div class="icon-circle {{ $item['bg'] ?? 'bg-primary' }}">
                            <i class="{{ $item['icon'] }} text-white"></i>
                        </div>
                    </div>
                @endif

                {{-- Jika pakai image seperti messages --}}
                @if (isset($item['img']))
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="{{ $item['img'] }}">
                        <div class="status-indicator {{ $item['status'] ?? '' }}"></div>
                    </div>
                @endif

                <div class="{{ isset($item['bold']) ? 'font-weight-bold' : '' }}">
                    <div class="text-truncate">{{ $item['text'] }}</div>
                    <div class="small text-gray-500">{{ $item['time'] }}</div>
                </div>
            </a>
        @endforeach

        <a class="dropdown-item text-center small text-gray-500" href="#">
            {{ $footerText }}
        </a>
    </div>
</li>