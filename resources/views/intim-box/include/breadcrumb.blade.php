@if(isset($breadMicro))
    {!! $breadMicro !!}
@endif
<nav class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__item">
            <a href="/" class="breadcrumbs__link link-reset">
                Главная
            </a>
        </li>
        <li class="breadcrumbs__item breadcrumbs__link link-reset">
            {{ $title }}
        </li>
    </ul>
</nav>
