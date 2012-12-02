/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 1:17 PM
 * To change this template use File | Settings | File Templates.
 */
/**
 * @class Color
 * This class holds the representation and operations of RGB Colors
 *
 * @constructor
 * Initialized an RGB Color
 * @param {Number} red
 * @param {Number} green
 * @param {Number} blue
 * @param {Number}opacity
 * @return {Color}
 */

var Color = function (red, green, blue, opacity) {
    /**
     * Red value of the RGB Color
     * @type {Number}
     */
    this.red = (!red) ? 0 : red;
    /**
     * Green value of the RGB Color
     * @type {Number}
     */
    this.green = (!green) ? 0 : green;
    /**
     * Blue value of the RGB Color
     * @type {Number}
     */
    this.blue = (!blue) ? 0 : blue;
    /**
     * Opacity value of the RGB Color
     * @type {Number}
     */
    this.opacity = (!opacity) ? 1 : opacity;
};

Color.prototype.type = "Color";
//getters
/**
 * Returns the red value of the RGB Color
 * @returns {Number}
 */
Color.prototype.getRed = function () {
    return this.red;
};
/**
 * Returns the green value of the RGB Color
 * @returns {Number}
 */
Color.prototype.getGreen = function () {
    return this.green;
};
/**
 * Returns the blue value of the RGB Color
 * @returns {Number}
 */
Color.prototype.getBlue = function () {
    return this.blue;
};
/**
 * Returns the opacity of the RGB Color
 * @returns {Number}
 */
Color.prototype.getOpacity = function () {
    return this.opacity;
};
/**
 * Set the red value of the RGB Color
 * @param {Number} newRed
 * @returns {Color}
 */
//setters
Color.prototype.setRed = function (newRed) {
    if (typeof newRed === "number" && newRed >= 0 && newRed <= 255) {
        this.red = newRed;
    }
    return this;
};

/**
 * Set the green value of the RGB Color
 * @param {Number} newRed
 * @returns {Color}
 */
Color.prototype.setGreen = function (newGreen) {
    if (typeof newGreen === "number" && newGreen >= 0 && newGreen <= 255) {
        this.green = newGreen;
    }
    return this;
};

/**
 * Set the blue value of the RGB Color
 * @param {Number} newBlue
 * @returns {Color}
 */
Color.prototype.setBlue = function (newBlue) {
    if (typeof newBlue === "number" && newBlue >= 0 && newBlue <= 255) {
        this.blue = newBlue;
    }
    return this;
};
/**
 * Set the opacity value of the RGB Color
 * @param {Number} newOpacity
 * @returns {Color}
 */
Color.prototype.setOpacity = function (newOpacity) {
    if (typeof newOpacity === "number" && newOpacity >= 0 && newOpacity <= 255) {
        this.opacity = newOpacity;
    }
    return this;
};
/**
 * Returns the css representation of the RGB color
 * @returns {String}
 */
Color.prototype.getCSS = function () {
    var css = "rgba(" + this.red + "," + this.green + "," + this.blue +
        "," + this.opacity + ")";
    return css;
};
