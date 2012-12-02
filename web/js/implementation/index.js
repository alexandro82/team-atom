/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 8:04 PM
 * To change this template use File | Settings | File Templates.
 */

var Index = function (options) {
    Variable.call(this, options);
    this.municipality = null;
    this.indicators = [];
    Index.prototype.initObject.call(this, options);
};

Index.prototype = new Variable();
Index.prototype.name = "Index";

Index.prototype.initObject = function(options) {
    var defaults = {

        indicators : [],
    };

    $.extend(true, defaults, options);
    this.initIndicators(defaults.indicators);
};





Index.prototype.createIndicator = function (options) {
    var indicator
    options.parentIndex = this;
    indicator = new Indicator(options);
    return indicator;
};
Index.prototype.initIndicators = function (indicators) {
    var i;
    for (i = 0; i < indicators.length; i += 1) {
        this.indicators.push(this.createIndicator(indicators[i]));
    }
    return this;
};
