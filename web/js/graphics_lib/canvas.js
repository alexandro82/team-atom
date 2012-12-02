/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 12:23 PM
 * To change this template use File | Settings | File Templates.
 */

var Canvas = function (options) {
    GenericObject.call(this, options);
    this.graphics = null;
    Canvas.prototype.initObject.call(this, options);
};

Canvas.prototype = new GenericObject();
Canvas.prototype.initObject = function (options) {

    var defaults = {

    };
    $.extend(true, defaults, options);
    this.createHTML();
    this.graphics = [];
};
Canvas.prototype.getHTMLDiv = function () {
    return document.getElementById(this.id);
};


Canvas.prototype.addElement = function (element, x, y) {
    element.setPosition(x, y);
    this.html.appendChild(element.getHTML());
    element.attachListeners();
    this.graphics.push(element);
    return this;
};




