/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 3:48 PM
 * To change this template use File | Settings | File Templates.
 */

var Axis = function (options) {
    GenericObject.call(this, options);
    this.axisSize = 0;
    this.factor = 0;
    this.increment = 0;
    this.labels = null;
    this.type = "";
    this.minVal = null;
    this.maxVal = null;
    this.orientation = "";
    this.inverse = false;
    this.line;
    this.originalX = 0;
    this.originalY = 0;

    Axis.prototype.initObject.call(this, options);
};

Axis.prototype = new GenericObject();

Axis.prototype.initObject = function (options) {
    var defaults = {
        labels : [],
        type : "numeric",
        minVal : 0,
        maxVal : 0,
        increment : 0,
        orientation : "horizontal",
        inverse : false
     },
        temp;


    $.extend(true, defaults, options);
    this.originalX = this.x;
    this.originalY = this.y;
    this.minVal = defaults.minVal;
    this.maxVal = defaults.maxVal;
    this.increment = defaults.increment;
    if (this.minVal > this.maxVal) {
        temp = this.minVal;
        this.minVal = this.maxVal;
        this.maxVal = temp;

    }
    this.setType(defaults.type)
        .setOrientation(defaults.orientation)
        .setLabels(defaults.labels)
        .setInverse(defaults.inverse)
        .generateFactor();
};

Axis.prototype.generateGap = function (x, y, index) {
    var div = document.createElement("div"),
        label = document.createElement("div");
    label.innerHTML = this.labels[index];
    label.style.height = "15px";
    label.style.width = "15px";

    div.style.position = "absolute";
    label.style.position = "absolute";
    div.style.left = x + "px";
    div.style.top = y + "px";
    div.style.border = "solid black thin";
    div.style.backgroundColor = "black";
    if (this.orientation === "vertical") {
        div.style.height = "1px";
        div.style.width = "5px";
        label.style.left = x - 30 + "px";
        label.style.top = y - 7 + "px";
    } else {
        div.style.height = "5px";
        div.style.width = "1px";
        label.style.left = x + "px";
        label.style.top = y  + 7 + "px";
    }
    this.html.appendChild(div);
    this.html.appendChild(label);
    return this;
}

Axis.prototype.generateScale = function (middlePoint) {
    var i,
        changeVal;
    if (!middlePoint) {
        middlePoint = new Point({
            x : 1000,
            y: 1000
        });
    }
    if (this.orientation === "vertical") {
       for (i = 0; i < this.labels.length; i += 1) {
           changeVal = 0 + this.factor * i;
           if (changeVal < middlePoint.x - 5 || changeVal > middlePoint.x + 5) {

               this.generateGap(-5, changeVal, i);
           }
       }
    } else {
        for (i = 0; i < this.labels.length; i += 1) {
            changeVal = 0 + this.factor * i;
            this.generateGap(changeVal, 0, i);
        }
    }
    return this;
};
Axis.prototype.getHTML = function (middlePoint) {
    if (!this.html) {
        return this.createHTML(middlePoint);
    } else {
        return this.html;
    }
}
Axis.prototype.createHTML = function (middlePoint) {
    GenericObject.prototype.createHTML.call(this);
    if (this.orientation === "vertical") {
        this.line = new Line({
            startPoint : {
                x : 0,
                y : 0
            },
            endPoint : {
                x : 0,
                y : this.height
            }
        });


    } else {
        this.line = new Line ({
            startPoint : {
                x : 0,
                y : 0
            },
            endPoint : {
                x : this.width,
                y : 0
            }
        });
    }
    this.html.appendChild(this.line.getHTML());
    this.generateScale();
    return this.html;
};

Axis.prototype.paint = function () {
    this.line.paint();
};
Axis.prototype.generateFactor = function () {
    var size = this.axisSize,
        labelNum = this.labels.length;
    if (size === 0 || labelNum === 0) {
        return this;
    }
    labelNum -= 1;

    if (labelNum <= 0) {
        this.factor = 0;
    } else {
        this.factor = size / labelNum;
        return this;
    }

};

Axis.prototype.setType = function (newType) {
    this.type = newType;
    return this;
}

Axis.prototype.setLabels = function (labels) {
    var i,
        scaleVal = 0;
    this.labels = [];

    if (this.type === "string") {
        this.labels = labels;

    } else {
        if (this.minVal === this.maxVal) {

            return this;
        }
        scaleVal = this.minVal;

        while (scaleVal <= this.maxVal) {
            this.labels.push(scaleVal);
            scaleVal += this.increment;
        }
    }
    return this;
};

Axis.prototype.setOrientation = function (orientation) {

    if (orientation === "vertical") {
        this.orientation = orientation;
        this.axisSize = this.height;
    } else {
        this.orientation = "horizontal";
        this.axisSize = this.width;
    }
    return this;
};

Axis.prototype.setInverse = function (inverse) {
    var i;
    if (inverse === true) {
        this.inverse = true;
        this.labels.reverse();
    } else {
        this.inverse = false;
    }
    return this;
};

Axis.prototype.getValPosition = function (value) {
    var i,
        index;
    if (this.inverse) {
        index = 0;
        for (i = 0; i < this.labels.length; i += 1) {
            if (value >= this.labels[i]) {
                index = i;
                break;
            }
        }
    } else {
        index = this.labels.length;
        for (i = 0; i < this.labels.length; i += 1) {
            if (value <= this.labels[i]) {
                index = i;
                break;
            }
        }
    }
    return index;
}