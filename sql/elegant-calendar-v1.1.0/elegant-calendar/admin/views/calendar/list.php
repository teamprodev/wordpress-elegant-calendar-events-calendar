<div class="alignwide">
    <div id="elegant-menu">
      <?php
        if($filter === 'yes') :
      ?>
        <span id="events-filter">Show Filter</span>
      <?php endif; ?>
      <span id="menu-navi">
        <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Today</button>
        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
          <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
        </button>
        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
          <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
        </button>
      </span>
      <span id="renderRange" class="render-range"></span>
    </div>
    <?php
      if($filter === 'yes'){
        include ELEGANT_CALENDAR_DIR . 'admin/views/calendar/filter.php';
      }
    ?>
    <div id="list-calendar"></div>
  </div>
