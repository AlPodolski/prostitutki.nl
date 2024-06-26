<div class="header-bottom-area" itemscope itemtype="https://schema.org/SiteNavigationElement">
    <div class="container">
        <div class="d-flex">
            <div class="all-menu position-relative" id="all-menu">
                <div class="open-menu-btn" onclick="toggle_class_to_block('all-menu', 'open-menu')">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24.75px" height="24.75px"
                         viewBox="0 0 24.75 24.75" style="enable-background:new 0 0 24.75 24.75;" xml:space="preserve"><g>
                            <path
                                d="M0,3.875c0-1.104,0.896-2,2-2h20.75c1.104,0,2,0.896,2,2s-0.896,2-2,2H2C0.896,5.875,0,4.979,0,3.875z M22.75,10.375H2		c-1.104,0-2,0.896-2,2c0,1.104,0.896,2,2,2h20.75c1.104,0,2-0.896,2-2C24.75,11.271,23.855,10.375,22.75,10.375z M22.75,18.875H2		c-1.104,0-2,0.896-2,2s0.896,2,2,2h20.75c1.104,0,2-0.896,2-2S23.855,18.875,22.75,18.875z"/>
                        </g></svg>
                    <div class="menu-text">
                        Все категории
                    </div>
                </div>
                <nav class="sub-menu">
                    <div class="close" onclick="toggle_class_to_block('all-menu', 'open-menu')">
                        <img src="/img/close.svg" alt="">
                    </div>


                    <div class="sub-menu-item-wrap">
                        <a href="#" onclick="show_sub_menu(this)"
                           class="sub-menu-item">{{ $data['current_city']->city  }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="sub-menu-list position-absolute">
                            @foreach($data['city_list'] as $item)
                                @php
                                    /* @var $item \App\Models\City */
                                @endphp
                                <a href="https://{{ $item->url }}.{{ env('DOMAIN') }}"
                                   class="sub-menu-list-item">{{ $item->city }}</a>
                            @endforeach
                        </div>
                    </div>


                    @if($data['metro'] and $data['metro']->first())
                        <div class="sub-menu-item-wrap">
                            <a href="#" onclick="show_sub_menu(this)" class="sub-menu-item">Метро
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </a>
                            <div class="sub-menu-list position-absolute">
                                @foreach($data['metro'] as $item)
                                    @php
                                        /* @var $item \App\Models\Metro */
                                    @endphp
                                    <a href="/{{ $item->filter_url }}" class="sub-menu-list-item">{{ $item->value }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($data['rayon'] and $data['rayon']->first())
                        <div class="sub-menu-item-wrap">
                            <a href="#" onclick="show_sub_menu(this)" class="sub-menu-item">Район
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </a>
                            <div class="sub-menu-list position-absolute">
                                @foreach($data['rayon'] as $item)
                                    @php
                                        /* @var $item \App\Models\Rayon */
                                    @endphp
                                    <a itemprop="url" href="/{{ $item->filter_url }}" class="sub-menu-list-item">
                                        <span itemprop="name">{{ $item->value }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="sub-menu-item-wrap">
                        <a href="#" onclick="show_sub_menu(this)" class="sub-menu-item">Услуги
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="sub-menu-list position-absolute">
                            @foreach($data['service'] as $item)
                                @php
                                    /* @var $item \App\Models\Service */
                                @endphp
                                <a itemprop="url" href="/{{ $item->filter_url }}" class="sub-menu-list-item">
                                    <span itemprop="name">{{ $item->value }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="sub-menu-item-wrap">
                        <a href="#" onclick="show_sub_menu(this)" class="sub-menu-item">Национальность
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="sub-menu-list position-absolute">
                            @foreach($data['national'] as $item)
                                @php
                                    /* @var $item \App\Models\National */
                                @endphp
                                <a itemprop="url" href="/{{ $item->filter_url }}" class="sub-menu-list-item">
                                    <span itemprop="name">{{ $item->value }}</span>
                                </a>
                            @endforeach

                        </div>
                    </div>
                    <div class="sub-menu-item-wrap position-relative">
                        <a href="#" onclick="show_sub_menu(this)" class="sub-menu-item">Цвет волос
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="sub-menu-list position-absolute">
                            @foreach($data['hair'] as $item)
                                @php
                                    /* @var $item \App\Models\HairColor */
                                @endphp
                                <a itemprop="url" href="/{{ $item->filter_url }}" class="sub-menu-list-item">
                                    <span itemprop="name">{{ $item->value }}</span>
                                </a>
                            @endforeach

                        </div>
                    </div>
                    <div class="sub-menu-item-wrap position-relative">
                        <a href="#" onclick="show_sub_menu(this)" class="sub-menu-item">Интимная стрижка
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="sub-menu-list position-absolute">
                            @foreach($data['intimHair'] as $item)
                                @php
                                    /* @var $item \App\Models\IntimHair */
                                @endphp
                                <a itemprop="url" href="/{{ $item->filter_url }}" class="sub-menu-list-item">
                                    <span itemprop="name">{{ $item->value }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="sub-menu-item-wrap position-relative">
                        <a href="#" onclick="show_sub_menu(this)" class="sub-menu-item">Место встречи
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="sub-menu-list position-absolute">
                            @foreach($data['place'] as $item)
                                @php
                                    /* @var $item \App\Models\Place */
                                @endphp
                                <a itemprop="url" href="/{{ $item->filter_url }}" class="sub-menu-list-item">
                                    <span itemprop="name">{{ $item->value }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="sub-menu-item-wrap position-relative">
                        <a href="#" onclick="show_sub_menu(this)" class="sub-menu-item">Время встречи
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="sub-menu-list position-absolute">
                            @foreach($data['time'] as $item)
                                @php
                                    /* @var $item \App\Models\Time */
                                @endphp
                                <a itemprop="url" href="/{{ $item->filter_url }}" class="sub-menu-list-item">
                                    <span itemprop="name">{{ $item->value }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="sub-menu-item-wrap position-relative">
                        <a href="#" onclick="show_sub_menu(this)" class="sub-menu-item">Вес
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="sub-menu-list position-absolute">
                            <a itemprop="url" href="/tolstye" class="sub-menu-list-item"><span
                                    itemprop="name">Толстые</span></a>
                            <a itemprop="url" href="/hudye" class="sub-menu-list-item"><span
                                    itemprop="name">Худые</span></a>
                        </div>
                    </div>
                    <div class="sub-menu-item-wrap">
                        <a itemprop="url" href="/molodye-prostitutki" class="sub-menu-item"><span itemprop="name">Молодые проститутки</span></a>
                    </div>
                    <div class="sub-menu-item-wrap">
                        <a itemprop="url" href="/starye-prostitutki" class="sub-menu-item"><span itemprop="name">Старые проститутки</span></a>
                    </div>
                    <div class="sub-menu-item-wrap">
                        <a itemprop="url" href="/dorogie-prostitutki" class="sub-menu-item"><span itemprop="name">Дорогие проститутки</span></a>
                    </div>
                    <div class="sub-menu-item-wrap">
                        <a itemprop="url" href="/deshevye-prostitutki" class="sub-menu-item"><span itemprop="name">Дешевые проститутки</span></a>
                    </div>
                </nav>
            </div>
            <nav class="main-menu">
                <a itemprop="url" href="/" class="main-menu-item"><span itemprop="name">Главная</span></a>
                <a itemprop="url" href="/proverennye" class="main-menu-item"><span
                        itemprop="name">Проверенные</span></a>
                <a itemprop="url" href="/video" class="main-menu-item"><span itemprop="name">Анкеты с видео</span></a>
                <a itemprop="url" href="/novye" class="main-menu-item"><span itemprop="name">Новые</span></a>
            </nav>
            <div class="mobile-search-btn" onclick="showSearchForm()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 50 50" width="35px" height="35px"><path d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z"/></svg>
            </div>
        </div>
    </div>
</div>
