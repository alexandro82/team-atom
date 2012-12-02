/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 1:27 PM
 * To change this template use File | Settings | File Templates.
 */

var Circle = function (options) {
    GenericObject.call(this, options);
    this.center = null;
    this.radius = 0;
    this.color = null;
    this.svgCircle = null;

    Circle.prototype.initObject.call(this, options);
};

Circle.prototype = new GenericObject();

Circle.prototype.initObject = function (options) {
    var defaults = {
        center : {
            x : 0,
            y : 0
        },
        radius : 0,
        color : "black"
    };
    $.extend(true, defaults, options);
    this.center = new Point(defaults.center);
    this.radius = defaults.radius;
    this.color = defaults.color;

};

Circle.prototype.createHTML = function () {

    var svg
    this.html = document.createElement("div");
    this.html.style.position = "absolute";
    this.html.style.zIndex = 10;
    svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    this.svgCircle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
    this.svgCircle.setAttribute("cx", this.center.x);
    this.svgCircle.setAttribute("cy", this.center.y);
    this.svgCircle.setAttribute("r", this.radius);
    this.svgCircle.setAttribute("fill", "black");

    svg.appendChild(this.svgCircle);
    this.html.appendChild(svg);

    return this.html;

};

Circle.prototype.setPosition = function (x, y) {
    this.setCenter(x, y);
    return this;
};

Circle.prototype.setCenter = function (cx, cy) {
    this.center.x = cx;
    this.center.y = cy;
    if (this.html) {
        this.svgCircle.setAttribute("cx", cx);
        this.svgCircle.setAttribute("cy", cy);
    }
    return this;
};
Circle.prototype.setRadius = function (r) {
    this.radius = r;
    if (this.html) {
        this.svgCircle.setAttribute("r", r);
    }
    return this;
};

Circle.prototype.setColor = function (color) {
    this.color = color;
    if (this.html) {
        this.svgCircle.setAttribute("fill", color);
    }
};

