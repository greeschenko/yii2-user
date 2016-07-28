var userpass = {
    field: [],
    msgplace: [],
    indicator: [],
    check: function() {
        var self = this;
        $.ajax({
            url: '/user/password/check-strong',
            type: 'POST',
            dataType: 'json',
            data: 'password=' + self.field.val(),
            success: function(data, textStatus, jqXHR) {
                self.msgplace.html(data.msg);
                self.indicator.attr('class', '');
                self.indicator.addClass('strong-' + data.strong);
                self.msgplace.show();
                self.indicator.parent().show();
            },
        });
    },
};

$('#user-newpassword').on('keyup', function() {
    var thispass = Object.create(userpass);
    thispass.field = $(this);
    thispass.msgplace = $('#strongmsg');
    thispass.indicator = $('#strongind');
    thispass.check();
});
