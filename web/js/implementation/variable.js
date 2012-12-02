/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 8:00 PM
 * To change this template use File | Settings | File Templates.
 */

var Variable = function (options) {
    this.value = -1;
    this.year = 2012;
    this.municipality = null;
    this.canvas = null;

    Variable.prototype.initObject.call(this, options);
};

Variable.prototype.identifier = "variable";
Variable.prototype.criteria = .5;

Variable.prototype.initObject = function (options) {
    var defaults = {
        valor : 0,
        gestion : 2012,
        "municipio_id" : "",
        canvas : null
    };

    $.extend(true, defaults, options);

        this.setCanvas(defaults.canvas)
        .setValue(defaults.valor)
        .setYear(defaults.gestion)
        .setMunicipality(defaults.municipio_id)
};
Variable.prototype.setMunicipality = function (id) {
    if (!this.canvas) {
        return null;
    }
    this.municipality = this.canvas.getMunicipality(id);
    return this;
};
Variable.prototype.setValue = function (value) {
    value = ""+value;
    this.value = parseFloat(value);
    return this;
};

Variable.prototype.setYear = function (year) {
    this.year = year;
    return this;
};

Variable.prototype.getMunicipality = function () {
    return this.municipality;
};
Variable.prototype.setCanvas = function (newCanvas) {

    this.canvas = newCanvas;
    return this;
};