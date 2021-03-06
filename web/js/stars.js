
  $(function() {
      AntiBOT.init('.new_comment');

    CommentResponder.init();

    $('#comment_body').taby();
  });

  $.fn.raty.defaults.path = '../images';

  $(function() {
    $('#default').raty();

$('#score').raty({ score: 3 });

$('#score-callback').raty({
  score: function() {
    return $(this).attr('data-score');
  }
});

$('#scoreName').raty({ scoreName: 'entity[score]' });

$('#number').raty({ number: 10 });

$('#number-callback').raty({
  number: function() {
    return $(this).attr('data-number');
  }
});

$('#numberMax').raty({
  numberMax : 5,
  number    : 100
});

$('#readOnly').raty({ readOnly: true, score: 3 });

$('#readOnly-callback').raty({
  readOnly: function() {
    return 'true becomes readOnly' == 'true becomes readOnly';
  }
});

$('#noRatedMsg').raty({
  readOnly   : true,
  noRatedMsg : "I'am readOnly and I haven't rated yet!"
});

$('#halfShow-true').raty({ score: 3.26 });

$('#halfShow-false').raty({
  halfShow : false,
  score    : 3.26
});

$('#round').raty({
  round : { down: .26, full: .6, up: .76 },
  score : 3.26
});

$('#half').raty({
  half  : true,
  hints : [['bad 1/2', 'bad'], ['poor 1/2', 'poor'], ['regular 1/2', 'regular'], ['good 1/2', 'good'], ['gorgeous 1/2', 'gorgeous']]
});

$('.starHalf').raty({
  half     : true,
  path     : null,
  starHalf : '../images/star-on.png',
  starOff  : '../images/star-off.png',
  starOn   : '../images/star-on.png'
});

$('#click').raty({
  click: function(score, evt) {
    alert('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt.type);
  }
});

$('#click-prevent').raty({
  click: function(score, evt) {
    alert('Score will not change.')
    return false;
  }
});

$('#hints').raty({ hints: ['a', null, '', undefined, '*_*']});

$('#star-off-and-star-on').raty({
  path    : 'demo/images',
  starOff : 'off.png',
  starOn  : 'on.png'
});

$('#cancel').raty({ cancel: true });

$('#cancelHint').raty({
  cancel     : true,
  cancelHint : 'My cancel hint!'
});

$('#cancelPlace').raty({
  cancel      : true,
  cancelPlace : 'right'
});

$('#star-off-and-star-on').raty({
  path    : 'demo/images',
  starOff : 'off.png',
  starOn  : 'on.png'
});

$('#cancel-off-and-cancel-on').raty({
  cancel    : true,
  cancelOff : 'demo/images/cancel-custom-off.png',
  cancelOn  : 'demo/images/cancel-custom-on.png',
  path      : null,
  starOff   : '../lib/images/star-off.png',
  starOn    : '../lib/images/star-on.png'
});

$('#iconRange').raty({
  path      : null,
  starOff   : '../lib/images/star-off.png',
  iconRange : [
    { range: 1, on: 'demo/images/1.png', off: 'demo/images/0.png' },
    { range: 2, on: 'demo/images/2.png', off: 'demo/images/0.png' },
    { range: 3, on: 'demo/images/3.png', off: 'demo/images/0.png' },
    { range: 4, on: 'demo/images/4.png', off: 'demo/images/0.png' },
    { range: 5, on: 'demo/images/5.png', off: 'demo/images/0.png' }
  ]
});

$('#size').raty({
  path      : 'demo/images',
  cancel    : true,
  cancelOff : 'cancel-off.png',
  cancelOn  : 'cancel-on.png',
  half      : true,
  starHalf  : 'star-half.png',
  starOff   : 'star-off.png',
  starOn    : 'star-on.png'
});

$('#target-div').raty({
  cancel : true,
  target : '#target-div-hint'
});

$('#target-text').raty({
  cancel : true,
  target : '#target-text-hint'
});

$('#target-textarea').raty({
  cancel : true,
  target : '#target-textarea-hint'
});

$('#target-select').raty({
  cancel : true,
  target : '#target-select-hint'
});

$('#targetType').raty({
  cancel     : true,
  target     : '#targetType-hint',
  targetType : 'score'
});

$('.targetKeep').raty({
  cancel     : true,
  target     : '.targetKeep-hint',
  targetKeep : true
});

$('#targetText').raty({
  target     : '#targetText-hint',
  targetText : '--'
});

$('#targetFormat').raty({
  target       : '#targetFormat-hint',
  targetFormat : 'Rating: {score}'
});

$('#targetScore').raty({
  targetScore: '#target-score'
});

$('#mouseover').raty({
  mouseover: function(score, evt) {
    alert('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt.type);
  }
});

$('#mouseout').raty({
  mouseout: function(score, evt) {
    alert('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt.type);
  }
});

$('#precision').raty({
  cancel     : true,
  cancelOff  : 'cancel-off.png',
  cancelOn   : 'cancel-on.png',
  path       : 'demo/images',
  starHalf   : 'star-half.png',
  starOff    : 'star-off.png',
  starOn     : 'star-on.png',
  target     : '#precision-hint',
  targetKeep : true,

  precision  : true
});

$('#space').raty({ space: false });

$('#single').raty({ single: true });

$('#starType').raty({
  cancel   : true,
  half     : true,
  starType : 'i'
});

$('#functions').raty({
  cancel     : true,
  cancelOff  : 'cancel-off.png',
  cancelOn   : 'cancel-on.png',
  path       : 'demo/images',
  precision  : true,
  starHalf   : 'star-half.png',
  starOff    : 'star-off.png',
  starOn     : 'star-on.png',
  target     : '#functions-hint',
  targetKeep : true,
  click: function(score, evt) {
    alert('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt.type);
  },
  hints: [
    ['bad 1'      , 'bad 2'      , 'bad 3'      , 'bad 4'      , 'bad 5'      , 'bad 6'      , 'bad 7'      , 'bad 8'      , 'bad 9'      , 'bad'      ], 
    ['poor 1'     , 'poor 2'     , 'poor 3'     , 'poor 4'     , 'poor 5'     , 'poor 6'     , 'poor 7'     , 'poor 8'     , 'poor 9'     , 'poor'     ], 
    ['regular 1'  , 'regular 2'  , 'regular 3'  , 'regular 4'  , 'regular 5'  , 'regular 6'  , 'regular 7'  , 'regular 8'  , 'regular 9'  , 'regular'  ], 
    ['good 1'     , 'good 2'     , 'good 3'     , 'good 4'     , 'good 5'     , 'good 6'     , 'good 7'     , 'good 8'     , 'good 9'     , 'good'     ], 
    ['gorgeous 1' , 'gorgeous 2' , 'gorgeous 3' , 'gorgeous 4' , 'gorgeous 5' , 'gorgeous 6' , 'gorgeous 7' , 'gorgeous 8' , 'gorgeous 9' , 'gorgeous' ]
  ]
});

$('#score-function-run').on('click', function() {
  $('#functions').raty('score', $('#' + this.id.replace('-run', '')).val());
});

$('#click-function-run').on('click', function() {
  $('#functions').raty('click', $('#' + this.id.replace('-run', '')).val());
});

$('#readOnly-function-run').on('click', function() {
var isReadOnly = $('#' + this.id.replace('-run', '')).val() === 'true';

  $('#functions').raty('readOnly', isReadOnly);
});

$('#cancel-function-run').on('click', function() {
var isTrigger = $('#' + this.id.replace('-run', '')).val() === 'true';

  $('#functions').raty('cancel', isTrigger);
});

$('#reload-function-run').on('click', function() {
  $('#functions').raty('reload');
});

$('#get-score-function-run').on('click', function() {
  alert('score: ' + $('#functions').raty('score'));
});

$('#set-score-function-run').on('click', function() {
  $('#functions').raty('score', $('#' + this.id.replace('-run', '')).val());
});

$('#set-function-run').on('click', function() {
  var options = $('#' + this.id.replace('-run', '').val()),
      command = "$('#functions').raty('set', " + options + ");";

  eval(command);
});

$('#destroy-function-run').on('click', function() {
  $('#functions').raty('destroy');
});

$('#move-function-run').on('click', function() {
  $('#functions').raty('move', $('#' + this.id.replace('-run', '')).val());
});
  });