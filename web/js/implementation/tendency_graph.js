/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/2/12
 * Time: 1:48 AM
 * To change this template use File | Settings | File Templates.
 */

var TendencyGraph = function (options) {
    DispersionGraphic.call(this, options);
    this.wzGraphics = null;
    TendencyGraph.prototype.initObject.call(this, options);
};

TendencyGraph.prototype = new DispersionGraphic();

TendencyGraph.prototype.initObject = function (options) {

};

TendencyGraph.prototype.createHTML = function () {
    DispersionGraphic.prototype.createHTML.call(this);
}