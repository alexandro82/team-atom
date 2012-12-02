/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 1:15 PM
 * To change this template use File | Settings | File Templates.
 */


var WzFacade = function (html) {
    if (!html) {
        return null;
    }
    this.wzGraph = new jsGraphics(html);
    this.color = new Color(0, 0 ,0);
};

WzFacade.prototype.drawLine = function (startPoint, endPoint, type) {
    if (!type) {
        type = "regular";
    }
    this.wzGraph.clear();
    switch (type) {
        case "dotted":
            this.wzGraph.setStroke(-1);
            break;
        default:
            this.wzGraph.setStroke(1);
    }

    this.wzGraph.setColor(this.color.getCSS());
    this.wzGraph.drawLine(startPoint.x, startPoint.y, endPoint.x, endPoint.y);
    this.wzGraph.paint();

};