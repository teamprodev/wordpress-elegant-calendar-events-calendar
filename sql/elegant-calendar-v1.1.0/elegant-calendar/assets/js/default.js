(function($){

  "use strict";

  function init() {
    if (typeof(cal) !== 'undefined') {
      setRenderRangeText();
      setEventListener();
      cal.on({
        'clickTimezonesCollapseBtn': function(timezonesCollapsed) {
          if (timezonesCollapsed) {
            cal.setTheme({
              'week.daygridLeft.width': '77px',
              'week.timegridLeft.width': '77px'
            });
          } else {
            cal.setTheme({
              'week.daygridLeft.width': '60px',
              'week.timegridLeft.width': '60px'
            });
          }

          return true;
        }
      });
      console.log(Elegant_Event_Data);
      cal.createSchedules(Elegant_Event_Data);
    }
  }

  function getDataAction(target) {
    return target.dataset ? target.dataset.action : target.getAttribute('data-action');
  }

  function setDropdownCalendarType() {
    var calendarTypeName = document.getElementById('calendarTypeName');
    var calendarTypeIcon = document.getElementById('calendarTypeIcon');
    var options = cal.getOptions();
    var type = cal.getViewName();
    var iconClassName;

    if (type === 'day') {
      type = 'Daily';
      iconClassName = 'calendar-icon ic_view_day';
    } else if (type === 'week') {
      type = 'Weekly';
      iconClassName = 'calendar-icon ic_view_week';
    } else if (options.month.visibleWeeksCount === 2) {
      type = '2 weeks';
      iconClassName = 'calendar-icon ic_view_week';
    } else if (options.month.visibleWeeksCount === 3) {
      type = '3 weeks';
      iconClassName = 'calendar-icon ic_view_week';
    } else {
      type = 'Monthly';
      iconClassName = 'calendar-icon ic_view_month';
    }

    calendarTypeName.innerHTML = type;
    calendarTypeIcon.className = iconClassName;
  }

  function onClickMenu(e) {
    var target = $(e.target).closest('a[role="menuitem"]')[0];
    var action = getDataAction(target);
    var options = cal.getOptions();
    var viewName = '';

    switch (action) {
      case 'toggle-daily':
        viewName = 'day';
        break;
      case 'toggle-weekly':
        viewName = 'week';
        break;
      case 'toggle-monthly':
        options.month.visibleWeeksCount = 0;
        viewName = 'month';
        break;
      case 'toggle-weeks2':
        options.month.visibleWeeksCount = 2;
        viewName = 'month';
        break;
      case 'toggle-weeks3':
        options.month.visibleWeeksCount = 3;
        viewName = 'month';
        break;
      case 'toggle-narrow-weekend':
        options.month.narrowWeekend = !options.month.narrowWeekend;
        options.week.narrowWeekend = !options.week.narrowWeekend;
        viewName = cal.getViewName();

        target.querySelector('input').checked = options.month.narrowWeekend;
        break;
      case 'toggle-start-day-1':
        options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
        options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
        viewName = cal.getViewName();

        target.querySelector('input').checked = options.month.startDayOfWeek;
        break;
      case 'toggle-workweek':
        options.month.workweek = !options.month.workweek;
        options.week.workweek = !options.week.workweek;
        viewName = cal.getViewName();

        target.querySelector('input').checked = !options.month.workweek;
        break;
      default:
        break;
    }

    cal.setOptions(options, true);
    cal.changeView(viewName, true);

    setDropdownCalendarType();
    setRenderRangeText();
  }

  function onClickNavi(e) {
    var action = getDataAction(e.target);

    console.log(action);

    switch (action) {
      case 'move-prev':
        cal.prev();
        break;
      case 'move-next':
        cal.next();
        break;
      case 'move-today':
        cal.today();
        break;
      default:
        return;
    }

    setRenderRangeText();
  }

  function onClickFilter(e) {
    console.log('click filter');
    $(".events-filter-list").toggleClass("show");
  }

  function onClickFilterSelect(e) {
    console.log('click filter select');
    $(this).closest('.events-filter-select-container').siblings().find('.events-filter-select').removeClass('show');
    $(this).toggleClass('show');
    $(this).closest('.events-filter-select-container').siblings().find('.events-filter-dropdown').removeClass("show");
    $(this).closest('.events-filter-select-container').find('.events-filter-dropdown').toggleClass('show');
  }

  function triggerFilterChange(e) {
    $(this).siblings().removeClass('select');

    if(!$(this).hasClass('select')){
      $(this).addClass('select');
    }

    var selectFilter = document.querySelectorAll('.events-filter-dropdown .filter.select');

    var filterQuery = [];

    selectFilter.forEach(function(item) {
      filterQuery.push({
        "attribute": item.classList[1],
        "value": item.dataset.filter_val.toString()
      });
    });

    console.log(filterQuery);

    cal.filterSchedules(filterQuery);
  }

  function setRenderRangeText() {
    var renderRange = document.getElementById('renderRange');
    var options = cal.getOptions();
    var viewName = cal.getViewName();
    var html = [];
    if (viewName === 'day') {
      html.push(moment(cal.getDate().getTime()).format('YYYY.MM.DD'));
    } else if (viewName === 'month' &&
      (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
      html.push(moment(cal.getDate().getTime()).format('YYYY.MM'));
    } else if (viewName === 'list' &&
    (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)){
      html.push(moment(cal.getDate().getTime()).format('YYYY.MM'));
    } else if (viewName === 'grid' &&
    (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)){
      html.push(moment(cal.getDate().getTime()).format('YYYY.MM'));
    } else {
      html.push(moment(cal.getDateRangeStart().getTime()).format('YYYY.MM.DD'));
      html.push(' ~ ');
      html.push(moment(cal.getDateRangeEnd().getTime()).format(' MM.DD'));
    }
    renderRange.innerHTML = html.join('');
  }

  function refreshScheduleVisibility() {
    var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));

    CalendarList.forEach(function(calendar) {
      console.log(calendar.checked);
      cal.toggleSchedules(calendar.id, !calendar.checked, false);
    });

    cal.render(true);

    calendarElements.forEach(function(input) {
      var span = input.nextElementSibling;
      span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
    });
  }

  var resizeThrottled = tui.util.throttle(function() {
    cal.render();
  }, 50);

  function setEventListener() {
    $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
    $('#menu-navi').on('click', onClickNavi);
    $('#events-filter').on('click', onClickFilter);
    $('.events-filter-select').on('click', onClickFilterSelect);
    $('.events-filter-dropdown .filter').on('click', triggerFilterChange);
    window.addEventListener('resize', resizeThrottled);
  }

  init();

})(jQuery);