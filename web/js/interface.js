
$(document).ready(function(e) {
    var i = new Interface();
    i.init();
});

function Interface()
{
    var self = this;
    this.init = function()
    {
        this.setupEvents();
    }

    this.setupEvents = function()
    {
        $('.stars').on('click', 'img', function(e) {
            var value = $(this).attr('alt');
            var url = $(this).closest('.stars').data('rate-url');
            self.submit(url, {'rate': value});
        });
    }

    this.submit = function(address, data) {
        $.ajax({
            type: "POST",
            url: address,
            data: data,
            success: function(response) {
            },
            dataType: 'json'
        });
    };
}

