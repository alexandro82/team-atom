/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 8:27 PM
 * To change this template use File | Settings | File Templates.
 */

var Indicator = function (options) {
    Variable.call(this, options);
    this.parentIndex = null;
    Indicator.prototype.initObject.call(this, options);
};

Indicator.prototype = new Variable();
Indicator.prototype.name = "Indicator";

Indicator.prototype.initObject = function (options) {
    var defaults = {
        parentIndex : null
    };

    $.extend(true, defaults, options);
    this.setParent(defaults.parentIndex);
};

Indicator.prototype.setParent = function (parent) {
    this.parentIndex = parent;
    return this;
};

Indicator.prototype.getMunicipality = function () {
    return this.parent.getMunicipality();
};