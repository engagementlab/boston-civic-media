module.exports = function() {

    var _helpers = {};

    // Helper for creating responsive img tag to be handled by Cloudinary API
    //
    //  @path: Image path on cloudinary
    //
    //  *Usage example:*
    //  {{{responsiveImg path='/v1494440105/boston-civic-media/layout/background-home.jpg' }}}


    _helpers.checkEmail = function(text) {

        var arr = text.split(' ');

        var check = _.map(arr, function(a){
            if (a.indexOf('@') >= 0) {
               a = '<a href="mailto://' + a + '">' + a + '</a>';
               return a;
            }
            else
               return a;
        });

        return check.join(' ');

    }

    _helpers.even = function(index, options) {

        if((index % 2) == 0) {
            return options.fn(this);
        } else {
            return options.inverse(this);
        }
        
    }

    _helpers.odd = function(index, options) {

        if((index % 2) > 0) {
            return options.fn(this);
        } else {
            return options.inverse(this);
        }
        
    }

        _helpers.responsiveImg = function(data) {

        return '<img data-src="https://res.cloudinary.com/engagement-lab-home/image/upload/w_auto,c_scale' + data.hash.path + '" class="cld-responsive">';

    }


    return _helpers;

};