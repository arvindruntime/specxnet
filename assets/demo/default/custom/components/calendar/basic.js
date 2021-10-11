var CalendarBasic = {
 init: function() {
  var e = moment().startOf("day"),
   t = e.format("YYYY-MM"),
   i = e.clone().subtract(1, "day").format("YYYY-MM-DD"),
   n = e.format("YYYY-MM-DD"),
   r = e.clone().add(1, "day").format("YYYY-MM-DD");
  $("#m_calendar").fullCalendar({
   isRTL: mUtil.isRTL(),
   header: {
    left: "prev,next today",
    center: "title",
    right: "month,agendaWeek,agendaDay,listWeek"
   },
   editable: !0,
   eventLimit: !0,
   navLinks: !0,
   events: window.activities,
   eventRender: function(e, t) {
    t.hasClass("fc-day-grid-event") ? (t.data("content", e.description), t.data("placement", "top"), mApp.initPopover(t)) : t.hasClass("fc-time-grid-event") ? t.find(".fc-title").append('<div class="fc-description">' + e.description + "</div>") : 0 !== t.find(".fc-list-item-title").lenght && t.find(".fc-list-item-title").append('<div class="fc-description">' + e.description + "</div>")
   }
  })
 }
};
jQuery(document).ready(function() {
 CalendarBasic.init()
});