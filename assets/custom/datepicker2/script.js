$(document).ready(function() {
  if (!Modernizr.touch || !Modernizr.inputtypes.date) {
    $('input[type="datetime-local"]').each(function() {
      var defaultVal = $(this).val();
      console.log(this.name, defaultVal);
      $(this).attr('type', 'text')
        .val(moment(defaultVal).format('M/D/YYYY h:mm A'))
        .datetimepicker({
          format: 'M/D/YYYY h:mm A',
          // widgetParent: ???,
          widgetPositioning: {
            horizontal: "auto",
            vertical: "auto"
          }
        });
    });
  }
});