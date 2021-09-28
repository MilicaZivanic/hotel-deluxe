$(document).ready(function () {
  let min = parseInt($('.min').val());
  let max = parseInt($('.max').val());
  $('#slider').slider({
    min: min,
    max: max,
    step: 1,
    values: [min, max],
    slide: function (event, ui) {
      for (var i = 0; i < ui.values.length; ++i) {
        $('input.sliderValue[data-index=' + i + ']').val(ui.values[i]);
      }
    },
  });

  $('input.sliderValue').change(function () {
    var $this = $(this);
    $('#slider').slider('values', $this.data('index'), $this.val());
  });
});
