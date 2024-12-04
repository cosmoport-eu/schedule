<x-gates-layout>
    <main>
        <div class="g-section">
            {{--<div id="message_block" class="coolMessage">Waiting... for the next event.</div>--}}

            <div id="current_event_block">
                <div class="flight__main">
                    <div class="flight__center">
                        <div class="flight__line">
                            <div class="flight__line-title flight-title blue-line-left">
                                <div class="flight-title__top"></div>
                                <div class="flight-title__name ui_caption_type"></div>
                                <div class="flight-title__bottom"></div>
                            </div>
                            <div class="flight__line-body">
                                <div class="flight__name">
                                    <div id="event_category_icon" class="flight__name-icon"></div>
                                    <div class="flight__name-body">
                                        <div id="event_category" class="flight__name-miss"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="blue-line">
                                <div class="blue-line-right-top"></div>
                                <div class="line-middle blue-line-middle"></div>
                                <div class="blue-line-right-bottom"></div>
                            </div>
                        </div>
                        <div class="flight__line">
                            <div class="flight__line-title flight-title blue-line-left">
                                <div class="flight-title__top"></div>
                                <div class="flight-title__name ui_caption_description"></div>
                                <div class="flight-title__bottom"></div>
                            </div>
                            <div class="flight__line-body">
                                <div class="flight__name">
                                    <div id="event_description" class="flight__name-body" style="color: white;"></div>
                                </div>
                            </div>

                            <div class="blue-line">
                                <div class="blue-line-right-top"></div>
                                <div class="line-middle blue-line-middle"></div>
                                <div class="blue-line-right-bottom"></div>
                            </div>
                        </div>
                        <div style="display: flex; width: 100%; margin-top: 10px;">
                            <div style="width: 50%; padding-right: 0.5em;">
                                <div class="flight__line">
                                    <div class="flight__line-title flight-title blue-line-left">
                                        <div class="flight-title__top"></div>
                                        <div class="flight-title__name ui_caption_duration"></div>
                                        <div class="flight-title__bottom"></div>
                                    </div>

                                    <div id="event_duration" class="flight__line-body"></div>

                                    <div class="blue-line">
                                        <div class="blue-line-right-top"></div>
                                        <div class="line-middle blue-line-middle"></div>
                                        <div class="blue-line-right-bottom"></div>
                                    </div>
                                </div>
                            </div>
                            <div style="width: 50%; padding-left: 0.5em;">
                                <div class="flight__line flight__line--status">
                                    <div class="flight__line-title flight-title blue-line-left">
                                        <div class="flight-title__top"></div>
                                        <div class="flight-title__name ui_caption_status"></div>
                                        <div class="flight-title__bottom"></div>
                                    </div>

                                    <div id="event_status" class="flight__line-body"></div>

                                    <div class="blue-line">
                                        <div class="green-line-right-top"></div>
                                        <div class="line-middle green-line-middle"></div>
                                        <div class="green-line-right-bottom"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flight__right">
                        <div class="flight__time">
                            <div class="flight__time-title flight-title _trapeze blue-line-left">
                                <div class="flight-title__top"></div>
                                <div class="flight-title__name flight__time-wrap ui_caption_time_to_departure"></div>
                                <div class="flight-title__bottom"></div>
                            </div>
                            <div class="flight__line flight__time-number">
                                <div class="flight__line-title flight-title" style="width: 0.1em;">
                                    <div class="flight-title__top"></div>
                                    <div class="flight-title__name" style="padding-left: 0;"></div>
                                    <div class="flight-title__bottom"></div>
                                </div>
                                <div id="countdown" class="flight__time-content"></div>
                                <div class="blue-line">
                                    <div class="blue-line-right-top"></div>
                                    <div class="line-middle blue-line-middle"></div>
                                    <div class="blue-line-right-bottom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flight__line">
                    <div class="flight__line-title flight-title" style="width: 1em;">
                        <div class="flight-title__top"></div>
                        <div class="flight-title__name" style="padding-left: 0;"></div>
                        <div class="flight-title__bottom"></div>
                    </div>
                    <div class="flight__line-body">
                        <div id="type_description" class="flight__description-body" style="font-size: 0.6em;">
                        </div>
                    </div>
                    <div class="blue-line">
                        <div class="blue-line-right-top"></div>
                        <div class="line-middle blue-line-middle"></div>
                        <div class="blue-line-right-bottom"></div>
                    </div>
                </div>
            </div>

            <div id="next_events_block" class="flight__bottom">
                <div class="flight__title ui_caption_next_events"></div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="next-events w-full text-lg text-center text-white ">
                        <thead id="next_events_table_thead">
                        <tr>
                            <th class="ui_caption_departing"></th>
                            <th class="ui_caption_type"></th>
                            <th class="ui_caption_name"></th>
                            <th class="ui_caption_duration"></th>
                            <th class="ui_caption_limit"></th>
                            <th class="ui_caption_status"></th>
                        </tr>
                        </thead>
                        <tbody id="next_events_table_body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-gates-layout>

<script>
    const departure_gate_id = @json($departure_gate_id);
    let $currentEventBlock = document.getElementById('current_event_block');
    let $nextEventsBlock = document.getElementById('next_events_block');

    let locale_code = 'en',
        locale_id = '1';

    let translations = [],
        currentTranslations = [];

    function getTranslations() {
        let xhr = new XMLHttpRequest();

        xhr.open('GET', '/translations', true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                translations = JSON.parse(xhr.responseText);
                currentTranslations = translations[locale_code];

                fillUiCaptures();
                getCurrentEvent();
                getNextEvents();
            }
        };

        xhr.send();
    }

    function getCurrentEvent() {
        let xhr = new XMLHttpRequest();

        xhr.open('GET', `/events/get-current-for-gate/${departure_gate_id}`, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText === '') {
                    if (!$currentEventBlock.classList.contains('non-visible')) {
                        $currentEventBlock.classList.add('non-visible');
                    }
                } else {
                    let event = JSON.parse(xhr.responseText);
                    console.log(event);

                    let hours = Math.trunc(event.duration / 60),
                        minutes = event.duration % 60;

                    let category_code = typeof event.type === 'undefined' ? 'unknown' : event.type.i18n_category_code,
                        type_code = typeof event.type === 'undefined' ? 'unknown' : event.type.i18n_description_code,
                        status_code = typeof event.type === 'undefined' ? 'unknown' : event.status.i18n_name_code;

                    document.getElementById('event_category_icon').innerHTML = '';
                    document.getElementById('event_category').innerHTML = getTranslate(category_code);
                    document.getElementById('type_description').innerHTML = getTranslate(type_code);
                    document.getElementById('event_status').innerHTML = getTranslate(status_code);
                    document.getElementById('event_duration').innerHTML = `${hours} h ${minutes} m`;
                    document.getElementById('event_description').innerHTML = event.description;

                    updateCountdown(event);

                    if ($currentEventBlock.classList.contains('non-visible')) {
                        $currentEventBlock.classList.remove('non-visible');
                    }
                }
            }
        };

        xhr.send();
    }

    function getNextEvents() {
        let xhr = new XMLHttpRequest();

        xhr.open('GET', `/events/next-events-for-gate/${departure_gate_id}`, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let events = JSON.parse(xhr.responseText);

                if (events.length === 0) {
                    if (!$nextEventsBlock.classList.contains('non-visible')) {
                        $nextEventsBlock.classList.add('non-visible');
                    }
                } else {
                    let $tBody = document.getElementById('next_events_table_body');

                    $tBody.innerHTML = '';

                    events.forEach(function(event) {
                        console.log(event);
                        let row = document.createElement('tr');

                        let timeStartCell = document.createElement('td'),
                            typeCell = document.createElement('td'),
                            nameCell = document.createElement('td'),
                            durationCell = document.createElement('td'),
                            limitCell = document.createElement('td'),
                            statusCell = document.createElement('td');

                        let hours = Math.trunc(event.duration / 60),
                            minutes = event.duration % 60;

                        let category_code = typeof event.type === 'undefined' ? 'unknown' : event.type.i18n_category_code,
                            type_code = typeof event.type === 'undefined' ? 'unknown' : event.type.i18n_name_code,
                            status_code = typeof event.type === 'undefined' ? 'unknown' : event.status.i18n_name_code;

                        let start_hours = new Date(event.time_start).getHours(),
                            start_minutes = new Date(event.time_start).getMinutes();

                        timeStartCell.textContent = `${start_hours}:${start_minutes}`;
                        typeCell.textContent = getTranslate(category_code);
                        nameCell.textContent = getTranslate(type_code);
                        durationCell.textContent = `${hours} h ${minutes} m`;
                        limitCell.textContent = event.people_limit;
                        statusCell.textContent = getTranslate(status_code);

                        row.appendChild(timeStartCell);
                        row.appendChild(typeCell);
                        row.appendChild(nameCell);
                        row.appendChild(durationCell);
                        row.appendChild(limitCell);
                        row.appendChild(statusCell);

                        $tBody.appendChild(row);
                    });
                }
            }
        };

        xhr.send();
    }

    function fillUiCaptures() {
        if (typeof currentTranslations !== 'undefined') {
            let currentUiTranslations = currentTranslations
                .filter(item => {
                    return item.code.includes('ui_caption_');
                });

            currentUiTranslations.forEach(function(translation) {
                let $elements = document.querySelectorAll(`.${translation.code}`);

                $elements.forEach(function(element) {
                    element.innerText = translation.text;
                });
            });
        }
    }

    function getTranslate(code) {
        let translate = currentTranslations.find(item => item.code === code && item.locale_id === locale_id);

        return typeof translate === 'undefined' ? 'unknown' : translate.text;
    }

    function updateCountdown(event) {
        let now = new Date().getTime();
        let is_boarding = event.status_id == 3;

        let eventTime = new Date(`${is_boarding ? event.time_start : event.time_end}`).getTime();
        // let timeDifference = is_boarding ? now - eventTime : eventTime - now;
        let timeDifference = eventTime - now;

        console.log(`is_boarding: ${is_boarding}`);
        console.log(`eventTime: ${eventTime}`);
        console.log(`timeDifference: ${timeDifference}`);
        console.log(`now - eventTime: ${now - eventTime}`);
        console.log(`eventTime - now: ${eventTime - now}`);

        let hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
            minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60)),
            hours_str = hours.toString().padStart(2, '0'),
            min_str = minutes.toString().padStart(2, '0');

        document.getElementById('countdown').innerText = `${hours_str}:${min_str}`;

        if (timeDifference < 0) {
            document.getElementById('countdown').innerText = '00:00';
        }
    }

    setInterval(getCurrentEvent, 60000);
    setInterval(getNextEvents, 60000);

    document.addEventListener('DOMContentLoaded', getTranslations);
</script>
