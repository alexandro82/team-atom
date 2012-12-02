/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/2/12
 * Time: 1:57 AM
 * To change this template use File | Settings | File Templates.
 */

var Histogram = function (options) {
    Graphic.call(this, options);
    this.xAxis = null;
    this.yAxis = null;
    this.variables = [];

    Histogram.prototype.initObject.call(this, options);
};

Histogram.prototype = new Graphic();

Histogram.prototype