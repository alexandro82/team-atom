/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 1:03 PM
 * To change this template use File | Settings | File Templates.
 */

var Point = function (options) {
    this.x = 0;
    this.y = 0;
    Point.prototype.initObject.call(this, options);
};

Point.prototype.initObject = function (options) {
    var defaults = {
        x : 0,
        y : 0
    };
    $.extend(true, defaults, options);
    this.x = defaults.x;
    this.y = defaults.y;
};