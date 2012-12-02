/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 12:38 PM
 * To change this template use File | Settings | File Templates.
 */

var Graphic = function (options) {
    GenericObject.call(this, options);
    this.axis = [];
    this.elements = [];
    this.middlePoint = null;

    Graphic.prototype.initObject.call(this, options); 
};

Graphic.prototype = new GenericObject();

Graphic.prototype.initObject = function (options) {
    var defaults = {
        axis : []
    };

    $.extend(true, defaults, options);
    this.setAxis(defaults.axis);
};

Graphic.prototype.setAxis = function (axis) {
    var i;
    for (i = 0; i < axis.length; i += 1) {
        this.createAxis(axis[i]);
    }
    return this;
};

Graphic.prototype.createAxis = function (options) {
    var axis = new Axis(options);
    this.axis.push(axis);
    return this;
};

Graphic.prototype.addElement = function (element, x, y) {
    element.setPosition(x, y);
    console.log(x + " " + y);
    this.html.appendChild(element.getHTML());
    element.attachListeners();
    this.elements.push(element);
};


Graphic.prototype.createHTML = function () {
    var i;
    GenericObject.prototype.createHTML.call(this);
    for (i = 0; i < this.axis.length; i += 1) {
        this.html.appendChild(this.axis[i].getHTML(this.middlePoint));
    }
    return this.html;
};

Graphic.prototype.paint = function () {
    var i;
    for (i = 0; i < this.axis.length; i += 1) {
        this.axis[i].paint();
    }
    for (i = 0; i < this.elements.length; i += 1) {
        this.elements[i].paint();
    }
};
