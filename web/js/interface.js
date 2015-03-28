$(function() {
    Interface.initialize();
});
var Interface = function() {
    var _this;
    return {
        initialize: function() {
            _this = this;
            this.initJscroll();
        },
        initJscroll: function() {
            $('[data-ui="jscroll"]').jscroll({
                debug: true
            });
            $('[data-ui="jscroll-example2"]').jscroll({
                autoTrigger: false,
                debug: true
            });
            $('[data-ui="jscroll-example3"]').jscroll({
                autoTriggerUntil: 3,
                debug: true
            });
        }
    };
}();