/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 12:44 PM
 * To change this template use File | Settings | File Templates.
 */

var GenericObject = function (options) {
    this.id = '';
    this.x = 0;
    this.y = 0;
    this.width = 0;
    this.height = 0;
    this.html = null;
    this.canvas = null;
    
    GenericObject.prototype.initObject.call(this, options);
};

GenericObject.prototype.initObject = function (options) {
    var defaults = {
        x : 0,
        y : 0,
        width : 0,
        height : 0,
        id : '',
        canvas : null
    };



    $.extend(true, defaults, options);
    this.setId(defaults.id)
        .setCanvas(defaults.canvas)
        .setX(defaults.x)
        .setY(defaults.y)
        .setWidth(defaults.width)
        .setHeight(defaults.height);
};



GenericObject.prototype.getHTMLDiv = function () {
    return document.createElement("div");
};
GenericObject.prototype.createHTML = function () {
    if (!this.html) {
        this.html = this.getHTMLDiv();
        this.html.id = this.id;
        this.html.style.position = "absolute";
        this.html.style.left = this.x + "px";
        this.html.style.top = this.y + "px";
        this.html.style.width = this.width + "px";
        this.html.style.height = this.height + "px";


    }
    return this.html;
};

GenericObject.prototype.getHTML = function () {
    if (!this.html) {
        return this.createHTML();
    } else {
        return this.html;
    }
};

GenericObject.prototype.paint = function () {
    return this;
};

GenericObject.prototype.attachListeners = function () {
  //implemented by subclasses
};

GenericObject.prototype.setPosition = function (x, y) {
    this.setX(x)
        .setY(y);
    return this;
};
GenericObject.prototype.setCanvas = function (canvas) {
    this.canvas = canvas;
    return this;
};
GenericObject.prototype.setDimension = function (w, h) {
    this.setWidth(w)
        .setHeight(h);
    return this;
};
GenericObject.prototype.setId = function (newId) {
    this.id = newId;
    return this;
};
GenericObject.prototype.setX = function (newX) {
    this.x = newX;
    if (this.html) {
        this.html.style.left = this.x + "px";
    }
    return this;
};
GenericObject.prototype.setY = function (newY) {
    this.y = newY;
    if (this.html) {
        this.html.style.top = this.y + "px";
    }
    return this;
};
GenericObject.prototype.setWidth = function (newWidth) {
    this.width = newWidth;
    if (this.html) {
        this.html.style.width = this.width + "px";
    }
    return this;
};
GenericObject.prototype.setHeight = function (newHeight) {
    this.height = newHeight;
    if (this.html) {
        this.html.style.height = this.height + "px";
    }
    return this;
};
