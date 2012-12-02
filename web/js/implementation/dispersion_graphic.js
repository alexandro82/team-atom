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
    this.year = 2005;
    this.xValId = 0;
    this.yValId = 0;
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
    options.canvas = this.canvas;
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
    this.xVariables = [];
    this.initVariables(this.xVariables, variables);
    return this;
};
DispersionGraphic.prototype.initYVariables = function (variables) {
    this.yVariables = [];
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
    var i, j;


    for (i = 0; i < this.points.length; i += 1) {
        this.html.removeChild(this.points[i].html);
    }

    this.points = [];
    this.elements = [];

    for (i = 0;  i < this.xVariables.length; i += 1) {
        for (j = 0; j < this.yVariables.length; j += 1) {

            if (this.xVariables[i].getMunicipality().id == this.yVariables[j].getMunicipality().id) {

                this.addPoint(this.xVariables[i], this.yVariables[j]);
            }
        }
    }
    //console.log(this.points.length);

    return this;
};
DispersionGraphic.prototype.addPoint = function (xVar, yVar) {
    var municipality = xVar.getMunicipality(),

        posx = this.xAxis.getValPosition(xVar.value),
        posy = this.yAxis.getValPosition(yVar.value);
        var xv =  posx * this.xAxis.factor + this.xAxis.labels[posx] - xVar.value + this.xAxis.x,
        yv =  posy * this.yAxis.factor + yVar.value - this.yAxis.labels[posy] + this.yAxis.y;


    this.points.push(municipality);
    this.addElement(municipality, xv, yv);
    return this;
};

DispersionGraphic.prototype.createHTML = function () {
    var i;
    Graphic.prototype.createHTML.call(this);
    //this.initPoints();
    return this.html;
};

DispersionGraphic.prototype.loadPoints = function (xVariables, yVariables, dontInit) {
    if (!dontInit) {
    this.initXVariables(xVariables)
        .initYVariables(yVariables);
    }
        this.setMiddlePoint()
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


DispersionGraphic.prototype.compFunction = function (data1, data2) {
    return data1.municipio_id < data2.municipio_id;
};
DispersionGraphic.prototype.setIndex = function (data,mun, catneeded, y) {
    var i,
        sum = 0,
        varData = [];

    if (catneeded) {
        for (i = 0; i < data.length; i += 1) {
            if (data[i].gestion == this.year && data[i].categoria == mun.category) {

                    varData.push(data[i]);
                    sum += parseFloat(data[i].valor);

            }
        }
    }
    else {

        for (i = 0; i < data.length; i += 1) {
            if (data[i].gestion == this.year) {

                    varData.push(data[i]);
                    sum +=  parseFloat(data[i].valor);

            }
        }
    }

    if (y) {

        this.initYVariables(varData);
        this.yVariables[0].criteria = (sum / varData.length)/100;

    } else {

        this.initXVariables(varData);
        this.xVariables[0].criteria = (sum / varData.length)/100;

    }
};

DispersionGraphic.prototype.setParameters = function (index1, index2, year, municip) {

    var catneed1 = false,
        catneed2 = false,
        municipality = this.canvas.getMunicipality(municip);
    if (!municipality) {
        return;
    }
    municipality.setSelected(true);
    if (index1 == "1" || index1 == "2" || index1 == "31") {
        catneed1 = true;
    }
    if (index2 == "1" || index2 == "2" || index2 == "31") {
        catneed2 = true;
    }

    if (index1 == index2) {
        return;
    }

    var that = this;

    $.post('/dispersion/indice.php',{'index':index1} ,  function (data) {

        that.setIndex(data, municipality,catneed1);

    });
    $.post('/dispersion/indice.php', {'index':index2},  function (data) {
        that.setIndex(data, municipality, catneed2, true);
        that.loadPoints(this.xVariables, this.yVariables, true);
    });
};