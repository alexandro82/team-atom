/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 8:17 PM
 * To change this template use File | Settings | File Templates.
 */

var AppCanvas = function (options) {
    GenericObject.call(this, options);
    this.graphics = null;
    this.municipalities = [];
    AppCanvas.prototype.initObject.call(this, options);
};

AppCanvas.prototype = new GenericObject();

AppCanvas.prototype.initObject = function (options) {
    var defaults = {
        municipalities : []
    };

    $.extend(true, defaults, options);
    this.createHTML();
    this.graphics = [];
    this.initMunicipalities(defaults.municipalities);
};
AppCanvas.prototype.getHTMLDiv = function () {
    return document.getElementById(this.id);
};


AppCanvas.prototype.addElement = function (element, x, y) {
    element.setPosition(x, y);
    this.html.appendChild(element.getHTML());
    element.attachListeners();
    this.graphics.push(element);
    return this;
};

AppCanvas.prototype.createMunicipality = function (options) {
    var municipality;
    options.canvas = this;
    municipality = new Municipality(options);
    return municipality;
};

AppCanvas.prototype.initMunicipalities = function (municipalities) {
    var i;
    for (i = 0; i < municipalities.length; i += 1) {
        this.municipalities.push(this.createMunicipality(municipalities[i]));
    }
    return this;
};

AppCanvas.prototype.getMunicipality = function (id) {
    var i,
        municipality = null;
    for (i = 0; i < this.municipalities.length; i += 1) {
        if (this.municipalities[i].id == id) {
            municipality = this.municipalities[i];
            break;
        }
    }
    return municipality;
};



