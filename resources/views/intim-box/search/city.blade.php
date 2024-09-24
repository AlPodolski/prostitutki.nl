@if($cityList->first)
    @foreach($cityList as $item)
        <li class="header__location-list__sub-item">
            <a href="https://{{ $item->url }}.{{ $item->info->domain }}" class="header__location-list__sub-link link-reset">
                {{ $item->city }}
            </a>
        </li>
    @endforeach
@endif
