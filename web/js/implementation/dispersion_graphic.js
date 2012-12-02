/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 8:34 PM
 * To change this template use File | Settings | File Templates.
 */

var DispersionGraphic = function (options) {
    Graphic.call(this, options);
    this.xAxis = null;
    this.yAxis = null;
    this.middlePoint = null;
        this.xVariables = [];
    this.yVariables = [];
    this.points = [];
    DispersionGraphic.prototype.initObject.call(this, options);
};

DispersionGraphic.prototype = new Graphic();

DispersionGraphic.prototype.initObject = function (options) {
    var defaults = {
        xVariables : [],
        yVariables : []
    };
    $.extend(true, defaults, options);


    this.initXVariables(defaults.xVariables)
        .initYVariables(defaults.yVariables)
        .initAxis()
        .setMiddlePoint();

};

DispersionGraphic.prototype.createVariable = function (options) {
    var variable = new Variable(options);
    return variable;
};

DispersionGraphic.prototype.initVariables = function (array, variables) {
    var i;
    for (i = 0; i < variables.length; i += 1) {
        array.push(this.createVariable(variables[i]));
    }
    return this;
};

DispersionGraphic.prototype.initXVariables = function (variables) {
    this.initVariables(this.xVariables, variables);
    return this;
};
DispersionGraphic.prototype.initYVariables = function (variables) {
    this.initVariables(this.yVariables, variables);
    return this;
};
DispersionGraphic.prototype.initAxis = function () {
    if (this.axis.length < 2) {
        return this;
    }
    this.xAxis = this.axis[0];
    this.yAxis = this.axis[1];
    return this;
};

DispersionGraphic.prototype.setMiddlePoint = function () {
    if (this.xVariables.length > 0 && this.yVariables.length > 0 &&
            this.xAxis && this.yAxis) {
        this.middlePoint = new Point ({
            x : this.xAxis.width * this.xVariables[0].criteria,
            y : this.yAxis.height * this.yVariables[0].criteria

        });
    } else {
        this.middlePoint = new Point ({
           x : this.xAxis.width *.5,
           y : this.yAxis.height *.5
        });

    }
    this.yAxis.setPosition(this.middlePoint.x, this.yAxis.originalY - this.middlePoint.y);


    return this;
};

DispersionGraphic.prototype.initPoints = function () {
    var i;
    this.points = [];
    for (i = 0; i < this.xVariables.length && i < this.yVariables.length; i += 1) {
        this.addPoint(this.xVariables[i], this.yVariables[i]);
    }
    return this;
};
DispersionGraphic.prototype.addPoint = function (xVar, yVar) {
    var municipality = xVar.getMunicipality(),
        x = this.xAxis.getValPosition(xVar.value) * this.xAxis.factor + this.xAxis.x,
        y = this.yAxis.getValPosition(yVar.value) * this.yAxis.factor + this.yAxis.y;

    console.log(x + " " + y);
    this.points.push(municipality);
    this.addElement(municipality, x, y);
    return this;
};

DispersionGraphic.prototype.createHTML = function () {
    var i;
    Graphic.prototype.createHTML.call(this);
    //this.initPoints();
    return this.html;
};

DispersionGraphic.prototype.loadPoints = function (xVariables, yVariables) {
    this.initXVariables(xVariables)
        .initYVariables(yVariables)
        .setMiddlePoint()
        .initPoints()
        .paint();
};

DispersionGraphic.prototype.paint = function () {
    var i;
    Graphic.prototype.paint.call(this);
    for (i = 0; i < this.points.length; i += 1) {
        this.points[i].paint();
    }
    return this;
};