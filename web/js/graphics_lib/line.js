/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 1:01 PM
 * To change this template use File | Settings | File Templates.
 */

var Line = function (options) {
    GenericObject.call(this, options);

    this.lineType = "";
    this.startPoint = null;
    this.endPoint = null;
    this.wzgraphics = null;

    Line.prototype.initObject.call(this, options);
};

Line.prototype = new GenericObject();

Line.prototype.initObject = function (options) {
    var defaults = {
        startPoint : {
            x : 0,
            y : 0
        },
        endPoint : {
            x : 0,
            y : 0
        },
        lineType : "regular"
    };
    $.extend(true, defaults, options);

    this.setLineType(defaults.lineType);
    this.startPoint = new Point(defaults.startPoint);
    this.endPoint = new Point(defaults.endPoint);
};

Line.prototype.paint = function () {
    if (!this.html) {
        return this;
    }

    if (this.wzgraphics === null) {
        this.wzgraphics = new WzFacade(this.html);
    }

    this.wzgraphics.drawLine(this.startPoint, this.endPoint, this.lineType);
    return this;
};
Line.prototype.setLineType = function (newType) {
    this.lineType = newType;
    this.paint();
    return this;
};


